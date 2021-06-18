<?php session_start();
include $_SERVER["DOCUMENT_ROOT"]."/inc/dbcon.php";
$APP_VERSION_SEQ=$_GET['APP_VERSION_SEQ'];

if($APP_VERSION_SEQ){
$que="select * from app_version where APP_VERSION_SEQ='".$APP_VERSION_SEQ."'";
$result = $mysqli->query($que) or die("2:".$mysqli->error);
$rs = $result->fetch_object();
	$action="ae_ok.php";
}else{
	$action="au_ok.php";
}

?>
<!doctype html>
<html>
<head>
<meta charset="utf-8">
<title>Mediapic Back-office</title>
<link href="/admin_page/css/dcg_tmall.css" rel="stylesheet" type="text/css" />
<script type="text/javascript" src="/asset/js/jquery-1.11.3.min.js"></script>
</head>

<body class="bg_popup">

<!-- 전체 넓이 S-->
<div id="pop_wrap">
  <!-- 상단 head로고 S-->
  <div class="pop_top_bg">
    <ul>
     <li><span>APP버전 등록</span></li>
    </ul>
  </div>
  <!-- 상단 head로고 E-->
  
  <!-- 컨텐츠 S -->
  <div class="pop_content">
<form method="post" action="<?=$action?>" name="sf" enctype="multipart/form-data">
<input type="hidden" name="APP_VERSION_SEQ" value="<?=$APP_VERSION_SEQ?>">
	  <!-- GRID S-->
              <div class="list_table_list01">
                <table width="100%" border="0" >
                  <colgroup>
                  <col width=100/>
                  <col width="*"/>
                  </colgroup>
                 
                  <tbody>
                    
					<tr>
                      <th class="color_ch" scope="row"><font color="red">*</font>플랫폼</th>
                      <td colspan="5">
						<select name="MOBILE_OS">
							<option value="A" <?if($rs->MOBILE_OS=="A"){?>selected<?}?>>Android</option>
							<option value="I" <?if($rs->MOBILE_OS=="I"){?>selected<?}?>>iOS</option>
						</select>
</td>
                    </tr>
					<tr>
                      <th class="color_ch" scope="row"><font color="red">*</font>버전</th>
                      <td colspan="5"><input type="text" name="APP_VERSION" size="60" value="<?=$rs->APP_VERSION?>"></td>
                    </tr>
					<tr>
                      <th class="color_ch" scope="row">마켓URL</th>
                      <td colspan="5"><input type="text" name="MARKET_URL" size="60"  value="<?=$rs->MARKET_URL?>"></td>
                    </tr>
					<tr>
                      <th class="color_ch" scope="row"><font color="red">*</font>업데이트표시옵션</th>
                      <td colspan="5">
					  <select name="IS_MAN">
							<option value="Y" <?if($rs->IS_MAN=="Y"){?>selected<?}?>>필수업데이트</option>
							<option value="N" <?if($rs->IS_MAN=="N"){?>selected<?}?>>권장업데이트</option>
						</select>
					  </td>
                    </tr>
					<tr>
                      <th class="color_ch" scope="row">개선내용</th>
                      <td colspan="5"><textarea name="NOTE" rows="5" cols="50"><?echo stripslashes($rs->NOTE)?></textarea></td>
                    </tr>
					<tr>
                      <th class="color_ch" scope="row"><font color="red">*</font>마켓등록상태</th>
                      <td colspan="5"><input type="radio" name="REG_YN" value="N" <?if($rs->REG_YN!="Y"){?>checked<?}?>>미등록 <input type="radio" name="REG_YN" value="Y" <?if($rs->REG_YN=="Y"){?>checked<?}?>>등록완료</td>
                    </tr>
                  </tbody>
                </table>
              </div>
      <!-- GRID E-->



   <!-- 하단 버튼 S-->
  
   <div class="bottom_bu_area mt5">
	<ul>
		<li><button type="submit" class="button03">저장</button></li>
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
