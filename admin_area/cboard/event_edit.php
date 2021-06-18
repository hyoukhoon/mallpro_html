<?include "$DOCUMENT_ROOT/admin_area/inc/top.php";

$result=mysql_query("select * from event where num='$num'") or die(mysql_error());
$rs=mysql_fetch_object($result);
?>
<script language="javascript" src="/js/popupcalendar.js"></script>
			<table width="100%" border="0" cellpadding="0" cellspacing="0">
				<tr><td class="title">이벤트 수정하기</td></tr>
				<tr><td style="height:10px;"></td></tr>
			</table>

<script>
	function sendform(){
					a=document.add_form;
					if(!a.subject.value){
						alert('제목을 넣으세요');
						a.subject.focus();
						return false;
					}

					if(!a.content.value){
						alert('내용을 넣으세요');
						a.content.focus();
						return false;
					}

					return true;

				  }
</script>

			<table width="100%" border="0" cellpadding="0" cellspacing="1" class="tab_01">
<form action="event_edit_ok.php" method="post" name="add_form" onsubmit="return sendform()" enctype='multipart/form-data'>
				<input type=hidden name=mode value="up">
				<input type=hidden name=multi value="<?=$multi?>">
				<input type=hidden name=num value="<?=$num?>">
				<tr>
					<td class="th_01" width="10%">제목</td>
					<td class="td_02"><input type="text" name="subject" size="50" value="<?echo stripslashes($rs->subject);?>"></td>
				</tr>
				<tr>
					<td class="th_01" width="10%">기간</td>
					<td class="td_02">
						<input type="text" name="fdate"  class="cal_input" value="<?=$rs->f_date?>" size=10> <img src="/admin_area/img/ico_calendar.gif" width="16" height="16" align="absmiddle"  onclick="popUpCalendar(this, fdate, 'yyyy-mm-dd')" style=cursor:hand>  ~ <input type="text" class="cal_input" id="endDay" name="tdate" value="<?=$rs->t_date?>"  size=10> <img src="/admin_area/img/ico_calendar.gif" width="16" height="16" align="absmiddle"  onclick="popUpCalendar(this, tdate, 'yyyy-mm-dd')" style=cursor:hand>
					</td>
				</tr>
				<tr>
					<td class="th_01" width="10%">내용</td>
					<td class="td_02"><textarea name="content" rows="11" cols="60"><?echo stripslashes($rs->content);?></textarea></td>
				</tr>
				<tr>
					<td class="th_01" width="10%">당첨자발표</td>
					<td class="td_02"><input type="radio" name="iswinner" value="0" <?if(!$rs->iswinner){echo "checked";}?>>미발표 / <input type="radio" name="iswinner" value="1" <?if($rs->iswinner){echo "checked";}?>>발표</td>
				</tr>
				<tr>
					<td class="th_01" width="10%">당첨자</td>
					<td class="td_02"><textarea name="winner" rows="11" cols="60"><?echo stripslashes($rs->winner);?></textarea></td>
				</tr>
				<tr>
					<td class="th_01" width="10%">첨부파일1</td>
					<td class="td_02">
					<?if($rs->fn1){?>
					<img src="/board/data/<?=$rs->fn1?>" width="30" height="30"><br>
					<input type=hidden name=fn[0] value="<?=$rs->fn1?>">
					<input type=checkbox name=upfile_check[0] value="<?=$rs->fn1?>">기존화일만 삭제하실려면 체크하세요<br>
					<?}?>
					<input type="file" name="upfile[0]" size="50"></td>
				</tr>
				<tr>
					<td class="th_01" width="10%">첨부파일2</td>
					<td class="td_02">
					<?if($rs->fn2){?>
					<img src="/board/data/<?=$rs->fn2?>" width="30" height="30"><br>
					<input type=hidden name=fn[1] value="<?=$rs->fn2?>">
					<input type=checkbox name=upfile_check[1] value="<?=$rs->fn2?>">기존화일만 삭제하실려면 체크하세요<br>
					<?}?>
					<input type="file" name="upfile[1]" size="50"></td>
				</tr>
				<tr>
					<td class="th_01" width="10%">첨부파일3</td>
					<td class="td_02">
					<?if($rs->fn3){?>
					<img src="/board/data/<?=$rs->fn3?>" width="30" height="30"><br>
					<input type=hidden name=fn[2] value="<?=$rs->fn3?>">
					<input type=checkbox name=upfile_check[2] value="<?=$rs->fn3?>">기존화일만 삭제하실려면 체크하세요<br>
					<?}?>
					<input type="file" name="upfile[2]" size="50"></td>
				</tr>

			</table>

			<br><br>

			<input type="image" src="/admin_area/img/btn_insert.gif">
</form>
		</td>
	</tr>
</table>

</body>
</html>
