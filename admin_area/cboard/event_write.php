<?include "$DOCUMENT_ROOT/admin_area/inc/top.php";
?>
<script language="javascript" src="/js/popupcalendar.js"></script>
			<table width="100%" border="0" cellpadding="0" cellspacing="0">
				<tr><td class="title">이벤트 등록하기</td></tr>
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
<form action="event_write_ok.php" method="post" name="add_form" onsubmit="return sendform()" enctype='multipart/form-data'>
				<input type=hidden name=mode value="up">
				<input type=hidden name=multi value="<?=$multi?>">
				<input type=hidden name=num value="<?=$num?>">
				<tr>
					<td class="th_01" width="10%">제목</td>
					<td class="td_02"><input type="text" name="subject" size="50"></td>
				</tr>
				<tr>
					<td class="th_01" width="10%">기간</td>
					<td class="td_02">
						<input type="text" name="fdate"  class="cal_input" value="<?=$fdate?>" size=10> <img src="/admin_area/img/ico_calendar.gif" width="16" height="16" align="absmiddle"  onclick="popUpCalendar(this, fdate, 'yyyy-mm-dd')" style=cursor:hand>  ~ <input type="text" class="cal_input" id="endDay" name="tdate" value="<?=$tdate?>"  size=10> <img src="/admin_area/img/ico_calendar.gif" width="16" height="16" align="absmiddle"  onclick="popUpCalendar(this, tdate, 'yyyy-mm-dd')" style=cursor:hand>
					</td>
				</tr>
				<tr>
					<td class="th_01" width="10%">내용</td>
					<td class="td_02"><textarea name="content" rows="11" cols="60"></textarea></td>
				</tr>
				<tr>
					<td class="th_01" width="10%">첨부파일1</td>
					<td class="td_02"><input type="file" name="upfile[0]" size="50"></td>
				</tr>
				<tr>
					<td class="th_01" width="10%">첨부파일2</td>
					<td class="td_02"><input type="file" name="upfile[1]" size="50"></td>
				</tr>
				<tr>
					<td class="th_01" width="10%">첨부파일3</td>
					<td class="td_02"><input type="file" name="upfile[2]" size="50"></td>
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
