<?php session_start();
include $_SERVER["DOCUMENT_ROOT"]."/inc/dbcon.php";

$CONTENT_SEQ=$_GET['CONTENT_SEQ'];
$BBS_TYPE=$_GET['BBS_TYPE'];


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
     <li><span>약관 등록</span></li>
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
                      <th class="color_ch" scope="row"><font color="red">*</font>제목</th>
                      <td colspan="5"><input type="text" name="SUBJECT" size="90" value="<?=$rs->SUBJECT?>"></td>
                    </tr>
					<tr>
                      <th class="color_ch" scope="row">게시상태</th>
                      <td colspan="5">
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
						<th class="color_ch" scope="row"><font color="red">*</font>약관구분</th>
                      <td colspan="5">
					  <span>
						<select name="BBS_TYPE" onchange="termsel(this.value)">
							<option value=""<?if(!$BBS_TYPE){?> selected<?}?>>상위분류</option>
							<option value="Q"<?if($BBS_TYPE=="Q"){?> selected<?}?>>문의글약관</option>
							<option value="S"<?if($BBS_TYPE=="S"){?> selected<?}?>>도매회원신청약관</option>
							<option value="T"<?if($BBS_TYPE=="T"){?> selected<?}?>>약관</option>
						</select>
					</span>
					<span id="t2">
						<select name="CATEGORY_SEQ" class="scate">
								<option value="">하위분류</option>
								<?
								if($rs->CATEGORY_SEQ){
									$que3="select CATEGORY_SEQ,CATEGORY_NAME from bbs_category where CATEGORY_USE='1' and BBS_TYPE='".$BBS_TYPE."' order by SORT asc";
									$result3 = $mysqli->query($que3) or die("3:".$mysqli->error);
									while($rs3 = $result3->fetch_object()){
								?>
									<option value="<?=$rs3->CATEGORY_SEQ?>" <?if($rs3->CATEGORY_SEQ==$rs->CATEGORY_SEQ){?> selected<?}?>><?=$rs3->CATEGORY_NAME?></option>
								<?}
					}
								?>
						</select>
					</span>
					  </td>

                    </tr>
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
		alert('제목을 입력하세요.');
      		elClickedObj.SUBJECT.focus();
      		return false;
	}


	if(!elClickedObj.CATEGORY_SEQ.value){
		alert('약관 구분을 선택하세요.');
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
<script>
function termsel(BBS_TYPE){

	var params = "BBS_TYPE="+BBS_TYPE;
	$.ajax({
		  type: 'get'
		, url: 'terms_ajax.php'
		,data : params
		, dataType : 'html'
		, success: function(data) {
			$("#t2").html(data);
		  }
	});	
}
</script>
