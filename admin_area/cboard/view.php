<?php session_start();
include $_SERVER['DOCUMENT_ROOT']."/admin_page/inc/top.php";

$ps=$_GET['ps'];
$multi=$_POST['multi']?$_POST['multi']:$_GET['multi'];
$subject=$_POST['subject']?$_POST['subject']:$_GET['subject'];
$ir1=$_POST['ir1']?$_POST['ir1']:$_GET['ir1'];

$level=$_POST['level']?$_POST['level']:$_GET['level'];
$step=$_POST['step']?$_POST['step']:$_GET['step'];
$list=$_POST['list']?$_POST['list']:$_GET['list'];
$mode=$_POST['mode']?$_POST['mode']:$_GET['mode'];
$num=$_POST['num']?$_POST['num']:$_GET['num'];


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
                if($file == "." or $file == ".." or !preg_match("jpg|gif|bmp|png",$imgtype)) continue;
                $img[] = $file;
        }
        
        for($i=0;$i<sizeof($img);$i++) {
                if(!$img[$i]) continue;
                $simg = $img[$i];
                if(!file_exists($_SERVER['DOCUMENT_ROOT']."/se2/small/".$img[$i])) { 
                        resizeimage(465,$_SERVER['DOCUMENT_ROOT']."/se2/small/".$img[$i],$_SERVER['DOCUMENT_ROOT']."/se2/upload/".$img[$i]); 
//                        echo("s".$img[$i]." create image <br>"); 
                        set_time_limit(10);
                        flush();
                }                
        }

$result = $mysqli->query("select * from cboard where num='$num'");
$rs = $result->fetch_object();
$multi=$rs->multi;

if($multi){
		$where.=" and multi='$multi'";
	}

//검색 구분자

	if($s_word){

		if(!$s_key){
			$s_key="uid";
		}

		$where.=" and $s_key like '%$s_word%'";

	}

	if($fromDate){
	$where.=" and substring(reg_date,1,10)>='$fromDate'";
	}

	if($toDate){
		$where.=" and substring(reg_date,1,10)<='$toDate'";
	}


$result2 = $mysqli->query("select max(num) from cboard where num<'$num' $where order by num desc");
$rs2 = $result2->fetch_array();
$next_num=$rs2[0];

$result2 = $mysqli->query("select min(num) from cboard where num>'$num' $where order by num desc");
$rs2 = $result2->fetch_array();
$pre_num=$rs2[0];

?>
			<table width="100%" border="0" cellpadding="0" cellspacing="0">
				<tr><td class="title">내용 보기 - <?echo comm_title_is($multi);?></td></tr>
				<tr><td style="height:10px;"></td></tr>
			</table>

			<table width="1000" border="0" cellpadding="0" cellspacing="1" class="tab_01">
				<tr>
					<td class="th_01" width="10%">제목</td>
					<td class="td_02"><?echo stripslashes($rs->subject);?></td>
					<td class="td_02" align="right" width="15%"><?echo substr($rs->reg_date,0,10);?></td>
				</tr>
				<tr>
					<td class="td_02" colspan="3"  style="font:15px 굴림; color:#333">

					<?echo content_is2($rs->content);?>
					<?php
						if($rs->fn1){
					?>
					<br>
					첨부파일 : <a href="/data/<?=$rs->fn1?>" target="_blank"><?php echo $rs->fn_name1;?></a>
					<?
					}
					?>
					</td>
				</tr>

			</table>
			<br>
			<?if($multi!="market"){?>
			<a href="write.php?multi=<?=$multi?>&num=<?=$rs->num?>&page_no=<?=$page_no?>&f_no=<?=$p_f_no?>&s_key=<?=$s_key?>&s_word=<?=$s_word?>&fromDate=<?=$fromDate?>&toDate=<?=$toDate?>">등록</a>
			<?}?>
<a href="write.php?list=<?=$rs->list?>&level=<?=$rs->level?>&step=<?=$rs->step?>&multi=<?=$multi?>&num=<?=$rs->num?>&page_no=<?=$page_no?>&f_no=<?=$p_f_no?>&s_key=<?=$s_key?>&s_word=<?=$s_word?>&fromDate=<?=$fromDate?>&toDate=<?=$toDate?>">답글</a>

			<a href="list.php?multi=<?=$multi?>&num=<?=$rs->num?>&page_no=<?=$page_no?>&f_no=<?=$p_f_no?>&s_key=<?=$s_key?>&s_word=<?=$s_word?>&fromDate=<?=$fromDate?>&toDate=<?=$toDate?>&gubun=<?=$gubun?>">목록</a>

			<a href="edit.php?multi=<?=$multi?>&num=<?=$num?>&f_no=<?=$f_no?>&page_no=<?=$page_no?>&s_key=<?=$s_key?>&s_word=<?=$s_word?>&multi=<?=$multi?>&gubun=<?=$gubun?>">수정</a>

			<a href="del.php?multi=<?=$multi?>&num=<?=$rs->num?>&f_no=<?=$f_no?>&page_no=<?=$page_no?>&s_key=<?=$s_key?>&s_word=<?=$s_word?>&multi=<?=$multi?>&gubun=<?=$gubun?>" onclick="return confirm('정말 삭제하시겠습니까?');">삭제</a>
			<br><br>
<?
$result3 = $mysqli->query("select * from cboard where multi='$multi' and num='$pre_num'");
$rs3 = $result3->fetch_object();

$result4 = $mysqli->query("select * from cboard where multi='$multi' and num='$next_num'");
$rs4 = $result4->fetch_object();
?>
			<table width="700" border="0" cellpadding="0" cellspacing="1" class="tab_02">
				<tr>
					<td class="th_02" width="100">이전글</td>
					<td class="td_02">
					<?if($rs3->num){?>
					<a href="/admin_page/board/view.php?multi=<?=$multi?>&num=<?=$rs3->num?>&page_no=<?=$i?>&f_no=<?=$p_f_no?>&s_key=<?=$s_key?>&s_word=<?=$s_word?>&fromDate=<?=$fromDate?>&toDate=<?=$toDate?>"><?echo stripslashes($rs3->subject);?></a>
					<?}else{?>
						이전글이 없습니다.
					<?}?>
					</td>
				</tr>
				<tr>
					<td class="th_02" width="100">다음글</td>
					<td class="td_02">
						<?if($rs4->num){?>
							<a href="/admin_page/board/view.php?multi=<?=$multi?>&num=<?=$rs4->num?>&page_no=<?=$i?>&f_no=<?=$p_f_no?>&s_key=<?=$s_key?>&s_word=<?=$s_word?>&fromDate=<?=$fromDate?>&toDate=<?=$toDate?>"><?echo stripslashes($rs4->subject);?></a>
							<?}else{?>
								다음글이 없습니다.
							<?}?>
					</td>
				</tr>
			</table>

			<br><br>

		</td>
	</tr>
</table>

</body>
</html>
