<?include "$DOCUMENT_ROOT/admin_area/inc/top.php";
if(!$ps){
	$ps=50;
}

?>
<script language="javascript" src="/js/popupcalendar.js"></script>
			<table width="100%" border="0" cellpadding="0" cellspacing="0">
				<tr><td class="title">이벤트 관리</td></tr>
				<tr><td style="height:10px;"></td></tr>
			</table>
			
			<table width="100%" border="0" cellpadding="0" cellspacing="1" class="tab_01">
				<tr>
					<td class="th_01">No</td>
					<td class="th_01">제목</td>
					<td class="th_01">참여수</td>
					<td class="th_01">진행여부</td>
					<td class="th_01">당첨자</td>
					<td class="th_01">조회수</td>
					<td class="th_01">이벤트기간</td>
					<td class="th_01">작성일</td>
				</tr>
<?

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

$list=mysql_query("select count(*) from event where num>0 $where") or die("db error3");



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


$result=mysql_query("select * from event where num>0 $where order by num desc limit $t_no,$b_no") or die(mysql_error());
while($rs=mysql_fetch_object($result)){


?>

				<tr>
					<td class="td_01"><?echo $no?></td>
					<td class="td_01"><a href="event_view.php?n=<?=$n?>&num=<?=$rs->num?>&net_id=<?=$net_id?>&gubun=<?=$gubun?>&ps=<?=$ps?>&gubun=<?=$gubun?>&page_no=<?=$page_no?>&f_no=<?=$f_no?>&s_key=<?=$s_key?>&s_word=<?=$s_word?>"><?echo stripslashes($rs->subject)?></a></td>
					<td class="td_01"><?echo number_format($rs->try_cnt);?></td>
					<td class="td_01"><?if($rs->t_date>=$now2){?>진행중<?}else{?><font color="gray">완료</font><?}?></td>
					<td class="td_01"><?if($rs->iswinner){echo "발표";}else{echo "미발표";}?></td>
					<td class="td_01"><?echo number_format($rs->cnt);?></td>
					<td class="td_01"><?echo date("Y.m.d",strtotime($rs->f_date));?> ~ <?echo date("Y.m.d",strtotime($rs->t_date));?></td>
					<td class="td_01"><?echo $rs->reg_date?></td>
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
<br>
<a href="event_write.php?multi=<?=$multi?>"><img src="/admin_area/img/btn_insert.gif"></a>

		</td>
	</tr>
</table>

</body>
</html>
