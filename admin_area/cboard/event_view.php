<?include "$DOCUMENT_ROOT/admin_area/inc/top.php";

$result=mysql_query("select * from event where num='$num'") or die(mysql_error());
$rs=mysql_fetch_object($result);

?>
			<table width="100%" border="0" cellpadding="0" cellspacing="0">
				<tr><td class="title">게시판 내용 보기</td></tr>
				<tr><td style="height:10px;"></td></tr>
			</table>

			<table width="100%" border="0" cellpadding="0" cellspacing="1" class="tab_01">
				<tr>
					<td class="th_01" width="10%">제목</td>
					<td class="td_02"><?echo stripslashes($rs->subject);?></td>
					<td class="th_01" width="10%">작성일</td>
					<td class="td_02" align="right" width="10%"><?echo substr($rs->reg_date,0,10);?></td>
					<td class="th_01" width="10%">조회</td>
					<td class="td_02" align="right" width="10%"><?echo number_format($rs->cnt);?></td>
				</tr>
				<tr>
					<td class="th_01" width="10%">이벤트기간</td>
					<td class="td_02"><?echo $rs->f_date?> ~ <?echo $rs->t_date?></td>
					<td class="th_01" width="10%">참여자수</td>
					<td class="td_02" align="right" width="10%"><?echo number_format($rs->try_cnt);?></td>
					<td class="th_01" width="10%">프론트삭제</td>
					<td class="td_02" align="right" width="10%">삭제</td>
				</tr>
				<tr>
					<td class="th_01" width="10%">내용</td>
					<td class="td_02" colspan="5">
					<?if($rs->fn1){?>
						<img src="/board/data/<?=$rs->fn1?>"><br><br><br><br>
					<?}?>

					<?if($rs->fn2){?>
						<img src="/board/data/<?=$rs->fn2?>"><br><br><br><br>
					<?}?>

					<?if($rs->fn3){?>
						<img src="/board/data/<?=$rs->fn3?>"><br><br>
					<?}?>
					<br>
					<?echo stripslashes($rs->content);?>
					
					</td>
				</tr>
				<tr>
					<td class="th_01" width="10%">당첨자</td>
					<td class="td_02" colspan="5"><?echo content_is($rs->winner);?></td>
				</tr>

			</table>
			<br>
			<a href="event_list.php?num=<?=$rs->num?>&page_no=<?=$i?>&f_no=<?=$p_f_no?>&s_key=<?=$s_key?>&s_word=<?=$s_word?>&fromDate=<?=$fromDate?>&toDate=<?=$toDate?>">목록</a>

			<a href="event_edit.php?num=<?=$num?>&f_no=<?=$f_no?>&page_no=<?=$page_no?>&s_key=<?=$s_key?>&s_word=<?=$s_word?>&multi=<?=$multi?>&cate=<?=$cate?>">당첨자발표및 수정</a>

			<a href="event_del.php?num=<?=$rs->num?>&f_no=<?=$f_no?>&page_no=<?=$page_no?>&s_key=<?=$s_key?>&s_word=<?=$s_word?>&multi=<?=$multi?>&cate=<?=$cate?>" onclick="return confirm('정말 삭제하시겠습니까?');">삭제</a>

			<br><br>

		</td>
	</tr>
</table>

</body>
</html>
