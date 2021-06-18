<?php session_start();
include $_SERVER["DOCUMENT_ROOT"]."/inc/dbcon.php";

$CONTENT_SEQ=$_GET['CONTENT_SEQ'];

$que="select * from bbs_content where CONTENT_SEQ='".$CONTENT_SEQ."'";
$result = $mysqli->query($que) or die("2:".$mysqli->error);
$rs = $result->fetch_object();

?>
<!doctype html>
<html>
<head>
<meta charset="utf-8">
<title>Mediapic Back-office</title>
<link href="/admin_page/css/dcg_tmall.css" rel="stylesheet" type="text/css" />
<script type="text/javascript" src="/asset/js/jquery-1.11.3.min.js"></script>
<script type="text/javascript" src="/se2/js/HuskyEZCreator.js" charset="utf-8"></script>
</head>

<body class="bg_popup">

<!-- 전체 넓이 S-->
<div id="pop_wrap">
  <!-- 상단 head로고 S-->
  <div class="pop_top_bg">
    <ul>
     <li><span>FAQ 등록</span></li>
    </ul>
  </div>
  <!-- 상단 head로고 E-->
  
  <!-- 컨텐츠 S -->
  <div class="pop_content">
<form method="post" action="nw_ok.php" onsubmit="return submitContents(this)" name="sf" enctype="multipart/form-data">
<input type="hidden" name="CONTENT_SEQ" value="<?=$CONTENT_SEQ?>">
	  <!-- GRID S-->
              <div class="list_table_list01">
                <table width="100%" border="0" >
                  <colgroup>
                  <col width=100/>
                  <col width="*"/>
                  </colgroup>
                 
                  <tbody>
                    
					<tr>
                      <th class="color_ch" scope="row"><font color="red">*</font>질문</th>
                      <td colspan="5"><input type="text" name="SUBJECT" size="90" value="<?=$rs->SUBJECT?>"></td>
                    </tr>
					<tr>
						<th class="color_ch" scope="row">카테고리</th>
                      <td colspan="3">
						<select name="CATEGORY_SEQ">
								<?
								$que2="select 
								 CATEGORY_NAME,CATEGORY_SEQ from bbs_category where BBS_TYPE='F' and CATEGORY_USE='1' order by SORT asc";
								$result2 = $mysqli->query($que2) or die("1:".$mysqli->error);
								while($rs2 = $result2->fetch_array()){
							?>
								<option value="<?=$rs2[1]?>"<?if($rs->CATEGORY_SEQ==$rs2[1]){?> selected<?}?>><?=$rs2[0]?></option>
							<?}?>
								</select>
					  </td>
                      <th class="color_ch" scope="row">게시상태</th>
                      <td>
							<input type="radio" name="CONTENT_DISPLAY" value="1" <?if($rs->CONTENT_DISPLAY==1 or !$CONTENT_SEQ){?> checked<?}?>>노출 &nbsp; <input type="radio" name="CONTENT_DISPLAY" value="0" <?if($rs->CONTENT_DISPLAY==0 and $CONTENT_SEQ){?> checked<?}?>>미노출
					  </td>
                    </tr>
<?if($CONTENT_SEQ){?>
					<tr>
                      <th class="color_ch" scope="row">조회수</th>
                      <td><?=$rs->HIT?></td>
					  <th class="color_ch" scope="row">등록일</th>
                      <td><?=$rs->REG_DATE?></td>
					  <th class="color_ch" scope="row">등록자</th>
                      <td><?=$rs->WRITER?></td>
                    </tr>
<?}?>
					<tr>
                      <th class="color_ch" scope="row"><font color="red">*</font>답변</th>
                      <td colspan="5">
							<textarea name="ir1" id="ir1" style="width:620px; height:300px; display:none;"><?echo stripslashes($rs->CONTENTS);?></textarea>
					  </td>
                    </tr>

                  </tbody>
                </table>
              </div>
      <!-- GRID E-->



   <!-- 하단 버튼 S-->
  
   <div class="bottom_bu_area mt5">
	<ul>
		<li><button type="submit" class="button03">저장</a></li>
		<li><a href="javascript:reset();" class="button03_1">취소</a></li>
	</ul>
</div>    
            
  <!-- 하단 버튼 E-->
</form>

   
</div>
  <!-- 컨텐츠 E --> 
 
   
  </div>
 <!-- 전체 넓이 E-->

</body>
</html>
<script>
function submitContents(elClickedObj) {
	oEditors.getById["ir1"].exec("UPDATE_CONTENTS_FIELD", []);	// 에디터의 내용이 textarea에 적용됩니다.
	
	// 에디터의 내용에 대한 값 검증은 이곳에서 document.getElementById("ir1").value를 이용해서 처리하면 됩니다.


	if(!elClickedObj.SUBJECT.value){
		alert('질문을 입력하세요.');
      		elClickedObj.SUBJECT.focus();
      		return false;
	}


	if(document.getElementById("ir1").value=="<br>"){
		alert('답변을 입력하세요.');
		return false;
	}

		return true;
	try {
		elClickedObj.form.submit();
	} catch(e) {}
}

</script>
<script type="text/javascript">
var oEditors = [];
nhn.husky.EZCreator.createInIFrame({
oAppRef: oEditors,
elPlaceHolder: "ir1",
sSkinURI: "../../se2/SmartEditor2Skin.html",
fCreator: "createSEditor2"
});
</script>