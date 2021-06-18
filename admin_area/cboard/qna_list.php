<?include "$DOCUMENT_ROOT/admin_area/inc/top.php";
if(!$ps){
	$ps=50;
}

if(!$multi){
	$multi="qna";
}

if(!$page_no){
	$page_no=1;
}

if(!$f_no){
	$f_no=1;
}

?>
<script language="javascript" src="/js/popupcalendar.js"></script>
			<table width="100%" border="0" cellpadding="0" cellspacing="0">
				<tr><td class="title">1:1문의 관리</td></tr>
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

			<table width="100%" border="0" cellpadding="0" cellspacing="1" class="tab_01">
<form method="post" name="g">
<input type="hidden" name="page_no" value="<?=$page_no?>">
<input type="hidden" name="f_no" value="<?=$f_no?>">
<input type="hidden" name="s_key" value="<?=$s_key?>">
<input type="hidden" name="s_word" value="<?=$s_word?>">
<?

	
	if($multi){
		$where.=" and multi='$multi'";
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

$list=mysql_query("select count(*) from kboard where num>0 $where") or die(mysql_error());



$rs_list=mysql_fetch_array($list);
$total=$rs_list[0];
mysql_free_result($list);


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


$result=mysql_query("select * from kboard where num>0 $where order by num desc limit $t_no,$b_no") or die(mysql_error());
while($rs=mysql_fetch_object($result)){


?>

				<tr>
					<td class="td_01">
						<table width="100%" border="0" cellpadding="0" cellspacing="1" class="tab_01">
							<tr>
								<td class="th_01" width="10%">문의유형</td>
								<td class="td_02"><?echo $rs->cate;?></td>
								<td class="th_01" width="10%">작성자</td>
								<td class="td_02"><?echo $rs->id;?></td>
								<td class="th_01" width="10%">등록일</td>
								<td class="td_02"><?echo $rs->reg_date;?></td>
							</tr>
							<tr>
								<td class="th_01" width="10%">제목</td>
								<td class="td_02"><?echo stripslashes($rs->subject);?></td>
								<td class="th_01" width="10%">작성자이메일</td>
								<td class="td_02"><?echo $rs->email;?></td>
								<td class="th_01" width="10%">답변여부</td>
								<td class="td_02"><?if($rs->reply_content){?>O<?}else{?>X<?}?></td>
							</tr>
							<tr>
								<td class="th_01" width="10%">내용</td>
								<td class="td_02" colspan="5">
								<?if($rs->fn1){?>
									첨부 : <a href="/board/data/<?=$rs->fn1?>" target="_blank"><?=$rs->fn_name1?></a><br><br><br>
								<?}?>
								<?echo content_is($rs->content);?></td>
							</tr>
							<tr>
								<td class="th_01" width="10%">답변</td>
								<td class="td_02" colspan="5">
									<textarea name="reply_content<?=$rs->num?>" rows="7" cols="60"><?echo stripslashes($rs->reply_content);?></textarea>
									<img src="/admin_area/img/btn_insert.gif" onclick="qna_write('<?=$rs->num?>')" style="cursor:hand">
								</td>
							</tr>
							<tr>
								<td class="td_02" colspan="6">
									<a href="qna_del.php?num=<?=$rs->num?>&f_no=<?=$f_no?>&page_no=<?=$page_no?>&s_key=<?=$s_key?>&s_word=<?=$s_word?>&multi=<?=$multi?>&cate=<?=$cate?>" onclick="return confirm('정말 삭제하시겠습니까?');">삭제하기</a>
								</td>
							</tr>

						</table>
					</td>
					
				</tr>
<?
	$no--;
}

	$n_f_no=$f_no+$sub_size;
	$p_f_no=$f_no-$sub_size;
?>
<form>
			</table>
<br><br>
			<table width="100%" border="0" cellpadding="0" cellspacing="0">
				<tr><td align="center">
					<?if($f_no!=1){?><a href="<?=$PHP_SELF?>?n=<?=$n?>&level=<?=$level?>&cate=<?=$cate?>&page_no=<?=$i?>&f_no=<?=$p_f_no?>&multi=<?=$multi?>&sort=<?=$sort?>&s_key=<?=$s_key?>&s_word=<?=$s_word?>&fromDate=<?=$fromDate?>&toDate=<?=$toDate?>">◀</a><?}?>
					<? for($i=$f_no;$i<=$l_no;$i++){?>
					<?if($i==$page_no){?>
					<b>[<?=$i?>]</b>
					<?} else {?>
					<a href="<?=$PHP_SELF?>?n=<?=$n?>&level=<?=$level?>&cate=<?=$cate?>&page_no=<?=$i?>&f_no=<?=$f_no?>&multi=<?=$multi?>&sort=<?=$sort?>&s_key=<?=$s_key?>&s_word=<?=$s_word?>&fromDate=<?=$fromDate?>&toDate=<?=$toDate?>">
					[<?=$i?>]&nbsp;
								</a>&nbsp;&nbsp;
					<?}?>
					<?}?>
					<?if($l_no<$total_page){?><a href="<?=$PHP_SELF?>?n=<?=$n?>&level=<?=$level?>&cate=<?=$cate?>&page_no=<?=$i?>&f_no=<?=$n_f_no?>&multi=<?=$multi?>&sort=<?=$sort?>&s_key=<?=$s_key?>&s_word=<?=$s_word?>&fromDate=<?=$fromDate?>&toDate=<?=$toDate?>">▶</a><?}?>
				</td></tr>
			</table>
<br>
<br>


		</td>
	</tr>
</table>
<script>
	function qna_write(nm){
		a=document.g;
		a.action='qna_ok.php?num='+nm;
		a.submit();
		}
</script>
</body>
</html>
