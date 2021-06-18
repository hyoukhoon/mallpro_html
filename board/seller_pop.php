<?php session_start();
include $_SERVER["DOCUMENT_ROOT"]."/inc/dbcon.php";

$REQUEST_SEQ=$_GET['REQUEST_SEQ'];

$que="select * 
	from seller_request  where REQUEST_SEQ='".$REQUEST_SEQ."'";
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
<script>
$(window).load(function() {
 
  var strWidth;
  var strHeight;
 
  //innerWidth / innerHeight / outerWidth / outerHeight 지원 브라우저 
  if ( window.innerWidth && window.innerHeight && window.outerWidth && window.outerHeight ) {
    strWidth = $('#pop_wrap').outerWidth() + (window.outerWidth - window.innerWidth);
    strHeight = $('#pop_wrap').outerHeight() + (window.outerHeight - window.innerHeight);
  }
  else {
    var strDocumentWidth = $(document).outerWidth();
    var strDocumentHeight = $(document).outerHeight();
 
    window.resizeTo ( strDocumentWidth, strDocumentHeight );
 
    var strMenuWidth = strDocumentWidth - $(window).width();
    var strMenuHeight = strDocumentHeight - $(window).height();
 
    strWidth = $('#pop_wrap').outerWidth() + strMenuWidth;
    strHeight = $('#pop_wrap').outerHeight() + strMenuHeight;
  }
 
  //resize 
  window.resizeTo( strWidth, strHeight );
 
}); 
</script>
</head>

<body class="bg_popup">

<!-- 전체 넓이 S-->
<div id="pop_wrap">
  <!-- 상단 head로고 S-->
  <div class="pop_top_bg">
    <ul>
     <li><span>도매회원신청관리</span></li>
    </ul>
  </div>
  <!-- 상단 head로고 E-->
  
  <!-- 컨텐츠 S -->
  <div class="pop_content">
<form method="post" action="sr_ok.php" name="sf" enctype="multipart/form-data">
<input type="hidden" name="REQUEST_SEQ" value="<?=$REQUEST_SEQ?>">
  <!-- 타이틀 S--> 
     <ul class="top_title_area">
       <li class="top_title">도매회원신청내용</li>
     </ul>
  <!-- 타이틀 E--> 
  
  
  <!-- GRID S-->
              <div class="list_table_list01">
                <table width="100%" border="0" >
                  <colgroup>
                  <col width=100/>
                  <col width=30%/>
                  <col width=100/>
                  <col width="*"/>
                  </colgroup>
                 
                  <tbody>
                    <tr>
                      <th class="color_ch" scope="row">아이디</th>
                      <td><?=$rs->SELLER_ID?></td>
                      <th class="color_ch"  scope="row">상가명</th>
                      <td><?echo shop_name_is('ko',$rs->SHOP_CODE);?></td>
                    </tr>
					<tr>
                      <th class="color_ch" scope="row">매장명</th>
                      <td><?=$rs->SNAME?></td>
                      <th class="color_ch"  scope="row">매장위치</th>
                      <td><?echo $rs->FLOOR."층 ".$rs->FLOOR_ROW."열 ".$rs->FLOOR_HO."호";?></td>
                    </tr>
					<tr>
                      <th class="color_ch" scope="row">대표자</th>
                      <td><?=$rs->SELLER_NAME?></td>
                      <th class="color_ch"  scope="row">매장속성</th>
                      <td><?echo store_property_val('ko',$rs->STORE_PROPERTY_SEQ);?></td>
                    </tr>
					<tr>
                      <th class="color_ch" scope="row">사업자번호</th>
                      <td><?=$rs->BUSINESS_REGISTERED_NUMBER?></td>
                      <th class="color_ch"  scope="row">매장주소</th>
                      <td><?=$rs->ADDRESS?></td>
                    </tr>
					<tr>
                      <th class="color_ch" scope="row">휴대폰</th>
                      <td><?=$rs->CELLPHONE?></td>
                      <th class="color_ch"  scope="row">이메일</th>
                      <td><?=$rs->EMAIL?></td>
                    </tr>
					<tr>
                      <th class="color_ch" scope="row">사업자등록증</th>
                      <td colspan="3"><img src="/image/member/<?echo $rs->BUSINESS_REGISTERED_IMG;?>" style="max-width:100%;"></td>
                    </tr>
                  </tbody>
                </table>
              </div>
      <!-- GRID E-->

  <!-- 타이틀 S--> 
     <ul class="top_title_area">
       <li class="top_title">처리내용</li>
     </ul>
  <!-- 타이틀 E--> 

	  <!-- GRID S-->
              <div class="list_table_list01">
                <table width="100%" border="0" >
                  <colgroup>
                  <col width=100/>
                  <col width="*"/>
                  </colgroup>
                 
                  <tbody>
					<tr>
                      <th class="color_ch" scope="row">처리상태</th>
                      <td>
							<input type="radio" name="STS_CODE" value="0" <?if($rs->STS_CODE=="1"){?>disabled<?}?> <?if($rs->STS_CODE=="0"){?>checked<?}?>>처리중 &nbsp; <input type="radio" name="STS_CODE" value="1" <?if($rs->STS_CODE=="1"){?>disabled<?}?> <?if($rs->STS_CODE=="1"){?>checked<?}?>>처리완료
					  </td>
                    </tr>
					<tr>
                      <th class="color_ch" scope="row">메모</th>
                      <td>
							<textarea name="REPLY_CONTENTS" rows="5" cols="60"><?echo stripslashes($rs->REPLY_CONTENTS);?></textarea>
					  </td>
                    </tr>

                  </tbody>
                </table>
              </div>
      <!-- GRID E-->

</form>
   <!-- 하단 버튼 S-->
  
   <div class="bottom_bu_area mt5">
	<ul>
		<li><a href="javascript:;" class="button03" onclick="return sendform();">저장</a></li>
		<li><a href="javascript:reset();" class="button03_1">취소</a></li>
	</ul>
</div>    
            
  <!-- 하단 버튼 E-->


   
</div>
  <!-- 컨텐츠 E --> 
 
   
  </div>
 <!-- 전체 넓이 E-->

</body>
</html>
<script>
function sendform(){
	a=document.sf;

	if(a.STS_CODE.value==1){

			a.submit();

	}

	return true;
}



	function chk_id(){

		a=document.sf;
		if(!a.SELLER_ID.value){
			alert('아이디를 입력하세요.');
		}
		var params = "sid="+a.SELLER_ID.value;
		$.ajax({
			  type: 'get'
			, url: 'checkId.php'
			,data : params
			, dataType : 'html'
			, success: function(data) {
				alert(data);
			  }
		});	
}
</script>
