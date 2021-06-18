<?php
include $_SERVER['DOCUMENT_ROOT']."/admin_page/inc/top.php";

$ps=$_GET['ps'];
$multi=$_POST['multi']?$_POST['multi']:$_GET['multi'];
$s_key=$_POST['s_key']?$_POST['s_key']:$_GET['s_key'];
$s_word=$_POST['s_word']?$_POST['s_word']:$_GET['s_word'];
$fromDate=$_POST['fromDate']?$_POST['fromDate']:$_GET['fromDate'];
$toDate=$_POST['toDate']?$_POST['toDate']:$_GET['toDate'];
$page_no=$_POST['page_no']?$_POST['page_no']:$_GET['page_no'];
$f_no=$_POST['f_no']?$_POST['f_no']:$_GET['f_no'];

if(!$ps){
	$ps=50;
}

if(!$multi){
	$multi="notice";
}


function resizeimage($maxsize,$smallfile,$picture) 
        {        
                $picsize = getimagesize($picture);
                if(!$picsize) { 
						 //echo("손상된 이미지 이거나 이미지 정보를 갖어올 수 없습니다."); 
						 return; 
						 }
                
                // 가로가 세로보다 클 경우 가로를 기준으로 비율조정
                if($picsize[0] > $picsize[1]) {                
                        $rewidth = $maxsize;
                        $reheight = round(($picsize[1]*$rewidth) / $picsize[0]);                        
                } else {
                // 세로가 가로보다 클 경우 세로를 기준으로 비율 조정
                        $reheight = $maxsize;
                        $rewidth = round(($picsize[0]*$reheight) / $picsize[1]);
                }
        
            if($picsize[2]===1) {
            $dstimg=ImageCreate($rewidth,$reheight);
            $srcimg=@ImageCreateFromGIF($picture);
            ImageCopyResized($dstimg, $srcimg,0,0,0,0,$rewidth,$reheight,ImageSX($srcimg),ImageSY($srcimg));
            Imagegif($dstimg,$smallfile,76);
            }
            elseif($picsize[2]===2) {
            $dstimg=ImageCreatetruecolor($rewidth,$reheight);
            $srcimg=ImageCreateFromJPEG($picture);
            Imagecopyresampled($dstimg, $srcimg,0,0,0,0,$rewidth,$reheight,ImageSX($srcimg),ImageSY($srcimg));
            Imagejpeg($dstimg,$smallfile,76);
            }
            elseif($picsize[2]===3) {
            $dstimg=ImageCreate($rewidth,$reheight);
            $srcimg=ImageCreateFromPNG($picture);
            ImageCopyResized($dstimg, $srcimg,0,0,0,0,$rewidth,$reheight,ImageSX($srcimg),ImageSY($srcimg));
            Imagepng($dstimg,$smallfile,9);
            }

            @ImageDestroy($dstimg);
            @ImageDestroy($srcimg); 
        }
                
        $img_num_count = 0;

        $img_dir = opendir($_SERVER['DOCUMENT_ROOT']."/se2/upload");

        while($file = readdir($img_dir)) {
							
                $imgtype = strrchr($file,".");                
                if($file == "." or $file == ".." or !mb_eregi("jpg|gif|bmp|png",$imgtype)) continue;
                $img[] = $file;
        }

        for($i=0;$i<sizeof($img);$i++) {
                if(!file_exists($_SERVER['DOCUMENT_ROOT']."/se2/small/".$img[$i])) { 
                        resizeimage(465,$_SERVER['DOCUMENT_ROOT']."/se2/small/".$img[$i],$_SERVER['DOCUMENT_ROOT']."/se2/upload/".$img[$i]); 
                        //echo("s".$img[$i]." create image <br>"); 
                        set_time_limit(10);
                        flush();
                }                
        }
$result = $mysqli->query("select multi_title from cboard_admin where multi='$multi'");
$rs = $result->fetch_array();
$multi_title=$rs[0];
?>
<script language="javascript" src="/js/popupcalendar.js"></script>
			<table width="100%" border="0" cellpadding="0" cellspacing="0">
				<tr><td class="title">커뮤니티 관리 - <?echo $multi_title;?></td></tr>
				<tr><td style="height:10px;"></td></tr>
			</table>
			<table width="100%" border="0" cellpadding="0" cellspacing="0">
<form method="get" action="<?=$PHP_SELF?>" name="f">
<input type="hidden" name="multi" value="<?=$multi?>">
				<tr>
					<td class="te_le te_gray2">
						<select name="s_key" class="select">
							<option value="">선택</option>
							<option value="id" <?if($s_key=="id"){echo "selected";}?>>아이디</option>
							<option value="name" <?if($s_key=="name"){echo "selected";}?>>이름</option>
							<option value="subject" <?if($s_key=="subject"){echo "selected";}?>>제목</option>
							<option value="content" <?if($s_key=="content"){echo "selected";}?>>내용</option>
						</select>
						<input type="text" name="s_word" class="input" size="30">
						<input type="image" src="../img/btn_search.gif" align="absbottom">
					</td>
					<td align="right" class="te_le te_gray2">
					</td>
				</tr>
				<tr><td colspan="2" style="height:10px;"></td></tr>
				<tr><td colspan="2" style="height:1px;background-color:#ddd"></td></tr>
				<tr><td colspan="2" style="height:10px;"></td></tr>
</form>
			</table>
<br>
<?if($multi!="market"){?>
<a href="write.php?multi=<?=$multi?>"><img src="/admin_page/img/btn_insert.gif"></a>
<?}?>
<br>
			<table width="100%" border="0" cellpadding="0" cellspacing="1" class="tab_01">
				<tr>
					<td class="th_01">No</td>
					<td class="th_01">이름</td>
					<td class="th_01">제목</td>
					<td class="th_01">작성일</td>
					<td class="th_01">조회수</td>
				</tr>
<?

	
	if($multi){
		$where.=" and multi='$multi'";
	}

		if($gubun){
		$where.=" and gubun='$gubun'";
	}



//검색 구분자

	if($s_word){

		if(!$s_key){
			$s_key="id";
		}

		$where.=" and $s_key like '%$s_word%'";

	}

	if($fromDate){
	$where.=" and substring(reg_date,1,10)>='$fromDate'";
	}

	if($toDate){
		$where.=" and substring(reg_date,1,10)<='$toDate'";
	}


//	echo $where."<br>";

$result = $mysqli->query("select count(*) from cboard where num>0 $where");
$rs_list = $result->fetch_array();
$total=$rs_list[0];
$result->free();

$page_size=$ps;//한페이지에 몇개를 표시할지
$sub_size=10;//아래에 나오는 페이징은 몇개를 할지
$total_page=ceil($total/$page_size);//몇페이지


//page_no이 없거나 1보다 작으면 무조건 1
if(!$page_no or $page_no<1){
	$page_no=1;
}


//페이징의 첫 숫자
if(!$f_no or $f_no<1){
	$f_no=1;
}


//페이징의 마지막 숫자
$l_no=$f_no+$sub_size-1;

//l_no 이 토탈 페이지보다 크면
if($l_no>$total_page){
	$l_no=$total_page;
}


//어디부터
$t_no=$page_size*($page_no-1);

//어디까지
$b_no=$page_size;

$no=$total-($page_no-1)*$page_size;//번호매기기

$result = $mysqli->query("select * from cboard where num>0 $where order by  notice desc,list desc,step asc limit $t_no,$b_no");
while ($rs = $result->fetch_object()) {

$memo_date=strtotime($rs->memo_date)+86400;


?>

				<tr>
					<td class="td_01"><?echo $no?></td>
					<td class="td_01"><?echo $rs->name?></td>
					<td class="td_02">
					<?if($multi=="market"){
							if($rs->gubun==1){
								echo "[팝니다]";
							}else if($rs->gubun==2){
								echo "[삽니다]";
							}else if($rs->gubun==9){
								echo "[완료]";
							}
					}?>
					<a href="/admin_page/cboard/view.php?num=<?=$rs->num?>&multi=<?=$rs->multi?>&gubun=<?=$rs->gubun?>&page_no=<?=$page_no?>&f_no=<?=$f_no?>&s_key=<?=$s_key?>&s_word=<?=$s_word?>&fromDate=<?=$fromDate?>&toDate=<?=$toDate?>">
					<?
					//답글
					if($rs->level>0){
						for($i=0;$i<=$rs->level;$i++){
					?>
					&nbsp;
					<?}?>
					<b>RE:</b>
					<?}?>
					<?echo stripslashes($rs->subject)?><?if($now<=$memo_date){?><font color="red"><?}?>[<?echo $rs->memo_cnt;?>]</font></a></td>
					<td class="td_01">
						<?echo substr($rs->reg_date,0,10);?>
					</td>
					<td class="td_01">
						<?echo number_format($rs->cnt);?>
					</td>
					
				</tr>
<?
	$no--;
}

	$n_f_no=$f_no+$sub_size;
	$p_f_no=$f_no-$sub_size;
?>

			</table>
<br><br>
			<table width="100%" border="0" cellpadding="0" cellspacing="0">
				<tr><td align="center">
					<?if($f_no!=1){?><a href="<?=$PHP_SELF?>?n=<?=$n?>&level=<?=$level?>&gubun=<?=$gubun?>&page_no=<?=$p_f_no?>&f_no=<?=$p_f_no?>&multi=<?=$multi?>&sort=<?=$sort?>&s_key=<?=$s_key?>&s_word=<?=$s_word?>&fromDate=<?=$fromDate?>&toDate=<?=$toDate?>">◀</a><?}?>
					<? for($i=$f_no;$i<=$l_no;$i++){?>
					<?if($i==$page_no){?>
					<b>[<?=$i?>]</b>
					<?} else {?>
					<a href="<?=$PHP_SELF?>?n=<?=$n?>&level=<?=$level?>&gubun=<?=$gubun?>&page_no=<?=$i?>&f_no=<?=$f_no?>&multi=<?=$multi?>&sort=<?=$sort?>&s_key=<?=$s_key?>&s_word=<?=$s_word?>&fromDate=<?=$fromDate?>&toDate=<?=$toDate?>">
					[<?=$i?>]&nbsp;
								</a>&nbsp;&nbsp;
					<?}?>
					<?}?>
					<?if($l_no<$total_page){?><a href="<?=$PHP_SELF?>?n=<?=$n?>&level=<?=$level?>&gubun=<?=$gubun?>&page_no=<?=$n_f_no?>&f_no=<?=$n_f_no?>&multi=<?=$multi?>&sort=<?=$sort?>&s_key=<?=$s_key?>&s_word=<?=$s_word?>&fromDate=<?=$fromDate?>&toDate=<?=$toDate?>">▶</a><?}?>
				</td></tr>
			</table>
<br>
<br>
<?if($multi!="market"){?>
<a href="write.php?multi=<?=$multi?>"><img src="/admin_page/img/btn_insert.gif"></a>
<?}?>
		</td>
	</tr>
</table>

</body>
</html>
