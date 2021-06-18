<?include "$DOCUMENT_ROOT/admin_page/inc/top.php";

$result=mysql_query("select * from cboard where num='$num'") or die(mysql_error());
$rs=mysql_fetch_object($result);

?>
			<table width="100%" border="0" cellpadding="0" cellspacing="0">
				<tr><td class="title">커뮤니티 수정하기 - <?echo comm_title_is($multi);?></td></tr>
				<tr><td style="height:10px;"></td></tr>
			</table>

<script type="text/javascript" src="../../se2/js/HuskyEZCreator.js" charset="utf-8"></script>

<script>

function submitContents(elClickedObj) {
	oEditors.getById["ir1"].exec("UPDATE_CONTENTS_FIELD", []);	// 에디터의 내용이 textarea에 적용됩니다.
	
	// 에디터의 내용에 대한 값 검증은 이곳에서 document.getElementById("ir1").value를 이용해서 처리하면 됩니다.

	//alert(document.getElementById("subject").value);
	//alert(document.getElementById("ir1").value);

	if(!document.getElementById("subject").value){
		alert('제목을 입력하세요.');
      		elClickedObj.subject.focus();
      		return false;
	}
	
	if(!document.getElementById("ir1").value){
		alert('내용을 입력하세요.');
      		elClickedObj.ir1.focus();
      		return false;
	}

		return true;
	try {
		elClickedObj.form.submit();
	} catch(e) {}
}

</script>

			<table width="100%" border="0" cellpadding="0" cellspacing="1" class="tab_01" style="table-layout:fixed">
<form action="edit_ok.php"  method="post"  name="f" onsubmit="return submitContents(this)" enctype="multipart/form-data">
				<input type=hidden name=mode value="up">
				<input type=hidden name=multi value="<?=$multi?>">
				<input type=hidden name=num value="<?=$num?>">
				<input type=hidden name=gubun value="<?=$gubun?>">


				<tr>
					<td class="th_01" width="10%">제목</td>
					<td class="td_02"><input type="text" name="subject" size="50" value="<?echo stripslashes($rs->subject);?>"></td>
				</tr>
				<tr>
					<td class="th_01" width="10%">등록일</td>
					<td class="td_02"><input type="text" name="reg_date" size="50" value="<?echo $rs->reg_date;?>"></td>
				</tr>
								<tr>
					<td class="th_01">표시여부</td>
					<td class="td_02"><input type=radio name=isdisp value="0" <?if(!$rs->isdisp){echo "checked";}?>>숨김&nbsp;<input type=radio name=isdisp value="1" <?if($rs->isdisp){echo "checked";}?>>표시</td>
				</tr>
				<tr>
					<td class="th_01">메인글</td>
					<td class="td_02"><input type=radio name=notice value="0" <?if(!$rs->notice){echo "checked";}?>>일반글&nbsp;<input type=radio name=notice value="1" <?if($rs->notice){echo "checked";}?>>메인글</td>
				</tr>

				<?if($multi=="stream"){?>
				<tr>
					<td class="th_01" width="10%">동영상</td>
					<td class="td_02"><textarea name="stream" rows="7" cols="80"><?echo stripslashes($rs->stream);?></textarea></td>
				</tr>
				<?}?>

				<tr>
					<td class="th_01">내용</td>
					<td class="td_02" height="680" style="word-break:break-all;"><textarea name="ir1" id="ir1" style="width:1000px; height:600px; display:none;"><?echo stripslashes($rs->content);?></textarea></td>
					</td>
				</tr>
				<tr>
					<td class="th_01" width="10%">메인사진</td>
					<td class="td_02">
						<?if($rs->fn1){?>
						<img src="/board/data/<?=$rs->fn1?>" width="30" height="30"><br>
						<input type=hidden name=fn[0] value="<?=$rs->fn1?>">
						<input type=checkbox name=upfile_check[0] value="<?=$rs->fn1?>">기존화일만 삭제하실려면 체크하세요<br>
						<?}?>
						<input type="file" name="upfile[0]" size="50">[660x270]
					</td>
				</tr>



			</table>

			<br><br>

			<input type="image" src="/admin_page/img/btn_insert.gif"  style=cursor:hand>
</form>
		</td>
	</tr>
</table>
<script type="text/javascript">
var oEditors = [];
nhn.husky.EZCreator.createInIFrame({
oAppRef: oEditors,
elPlaceHolder: "ir1",
sSkinURI: "../../se2/SmartEditor2Skin.html",
fCreator: "createSEditor2"
});
</script>
</body>
</html>
