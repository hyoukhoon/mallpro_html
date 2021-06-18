<?php
include $_SERVER['DOCUMENT_ROOT']."/admin_page/inc/top.php";

$ps=$_GET['ps'];
$multi=$_POST['multi']?$_POST['multi']:$_GET['multi'];
$s_key=$_POST['s_key']?$_POST['s_key']:$_GET['s_key'];
$s_word=$_POST['s_word']?$_POST['s_word']:$_GET['s_word'];
$fromDate=$_POST['fromDate']?$_POST['fromDate']:$_GET['fromDate'];
$toDate=$_POST['toDate']?$_POST['toDate']:$_GET['toDate'];
$list=$_POST['list']?$_POST['list']:$_GET['list'];
$mode=$_POST['mode']?$_POST['mode']:$_GET['mode'];
$num=$_POST['num']?$_POST['num']:$_GET['num'];

$buffer_num=substr(rand(),0,10);

if(($list and !$mode)){

$result = $mysqli->query("select * from cboard where num='$num'");
$rs = $result->fetch_object();
$result->free();

	if($rs->notice){
		location_is('','','공지글엔 답글을 다실 수 없습니다');
		exit;
	}


		$subject=stripslashes($rs->subject);
		$content=chr(10).chr(10).chr(10)."------------------------<br><br>".chr(10).chr(10).content_is($rs->content);
		
//		echo $subject."<br>";

}

?>

<meta http-equiv="content-type" content="text/html; charset=utf-8">
<script type="text/javascript" src="../../se2/js/HuskyEZCreator.js" charset="utf-8"></script>

			<table width="100%" border="0" cellpadding="0" cellspacing="0">
				<tr><td class="title">커뮤니티 등록하기 - <?echo comm_title_is($multi);?></td></tr>
				<tr><td style="height:10px;"></td></tr>
			</table>

<script>

function submitContents(elClickedObj) {
	oEditors.getById["ir1"].exec("UPDATE_CONTENTS_FIELD", []);	// 에디터의 내용이 textarea에 적용됩니다.
	
	// 에디터의 내용에 대한 값 검증은 이곳에서 document.getElementById("ir1").value를 이용해서 처리하면 됩니다.


	if(!elClickedObj.subject.value){
		alert('제목을 입력하세요.');
      		elClickedObj.subject.focus();
      		return false;
	}


	if(!elClickedObj.ir1.value){
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
<form action="write_ok.php"  name="f" method="post" onsubmit="return submitContents(this)" enctype="multipart/form-data">
				<input type=hidden name=mode value="up">
				<input type=hidden name=multi value="<?=$multi?>">
				<input type=hidden name=num value="<?=$num?>">
				<input type=hidden name=buffer_num value="<?=$buffer_num?>">
				<input type=hidden name=list value="<?=$list?>">
				<input type=hidden name=level value="<?=$level?>">
				<input type=hidden name=step value="<?=$step?>">
				<input type=hidden name=secret value="<?=$rs->secret?>">
				<input type=hidden name=passwd value="<?=$rs->passwd?>">
				<tr>
					<td class="th_01" width="10%">제목</td>
					<td class="td_02"><input type="text" name="subject" size="50" value="<?=$subject?>"></td>
				</tr>
				<tr>
					<td class="th_01" width="10%">등록일</td>
					<td class="td_02"><input type="text" name="reg_date" size="50" value="<?echo $now4;?>"></td>
				</tr>
				<tr>
					<td class="th_01">표시여부</td>
					<td class="td_02"><input type=radio name=isdisp value="0" >숨김&nbsp;<input type=radio name=isdisp value="1" checked>표시</td>
				</tr>
				<tr>
					<td class="th_01">메인글</td>
					<td class="td_02"><input type=radio name=notice value="0" checked>일반글&nbsp;<input type=radio name=notice value="1">메인글</td>
				</tr>
				
				<!-- <tr>
					<td class="th_01" width="10%">메인내용</td>
					<td class="td_02"><textarea name="main_content" rows="7" cols="80"></textarea></td>
				</tr>
				-->
				<?if($multi=="stream"){?>
				<tr>
					<td class="th_01" width="10%">동영상</td>
					<td class="td_02"><textarea name="stream" rows="7" cols="80"></textarea></td>
				</tr>
				<?}?>
				<tr>
					<td class="th_01" width="10%">내용</td>
					<td class="td_02" height="680" style="word-break:break-all;"><textarea name="ir1" id="ir1" style="width:740px; height:680px; display:none;"><?echo $content;?></textarea></td>
				</tr>
				<tr>
					<td class="th_01" width="10%">대표이미지</td>
					<td class="td_02"><input type="file" name="upfile" size="50"></td>
				</tr>
			</table>

			<br><br>

			<input type="image" src="/admin_page/img/btn_insert.gif"  style=cursor:hand>
</form>
		</td>
	</tr>
</table>

<?php 
include $_SERVER['DOCUMENT_ROOT']."/admin_page/inc/bt.php";

?>
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
