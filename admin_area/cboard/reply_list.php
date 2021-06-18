<?include "$DOCUMENT_ROOT/admin_page/inc/top.php";
if(!$ps){
	$ps=20;
}

?>
<script language="javascript" src="/js/popupcalendar.js"></script>
			<table width="100%" border="0" cellpadding="0" cellspacing="0">
				<tr><td class="title">댓글 관리</td></tr>
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

			<table width="100%" border="0" cellpadding="0" cellspacing="1" class="tab_01">
				<tr>
					<td class="th_01" width="50">No</td>
					<td class="th_01" width="80">이름</td>
					<td class="th_01" width="80">아이피</td>
					<td class="th_01" width="200">원글제목</td>
					<td class="th_01">내용</td>
					<td class="th_01" width="70">작성일</td>
					<td class="th_01" width="30">삭제</td>
				</tr>
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
$que="select count(*) from cboard_memo where num>0 $where";
//echo $que."<br>";
$list=mysql_query($que) or die("db error3");



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


$result=mysql_query("select * from cboard_memo where num>0 $where order by num desc limit $t_no,$b_no") or die(mysql_error());
while($rs=mysql_fetch_object($result)){

	$result2=mysql_query("select subject,multi from cboard where num='$rs->pa_num'") or die(mysql_error());
	$rs2=mysql_fetch_object($result2);

	$result3=mysql_query("select count(1) from cboard_memo_memo where num='$rs->num'") or die(mysql_error());
	$rs3=mysql_fetch_array($result3);


?>

				<tr>
					<td class="td_01" width="50"><?echo $no?></td>
					<td class="td_01" width="80"><?=$rs->m_name?></td>
					<td class="td_01" width="80"><?=$rs->ip?></td>
					<td class="td_02" width="200">
						<?echo $rs2->subject;?>
					</td>
					<td class="td_02">
						<?echo content_is($rs->m_content);?> [<?echo $rs3[0];?>]
					</td>
					<td class="td_01" width="70">
						<?echo $rs->reg_date;?>
					</td>
					<td class="td_01" width="30"><a href="reply_del.php?pa_num=<?=$rs->pa_num?>&num=<?=$rs->num?>&uid=<?=$rs->m_id?>" onclick="return confirm('삭제하시겠습니까?');">DEL</a></td>
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

		</td>
	</tr>
</table>

</body>
</html>
