<?php session_start();
include $_SERVER["DOCUMENT_ROOT"]."/inc/dbcon.php";

$INQUIRY_ID=$_GET['INQUIRY_ID'];
/*
$que="select *,a.PRODUCT_ID as PRODUCT_ID 
	from price_inquiry a, (select PRODUCT_ID,PRODUCT_NAME from product) b where a.PRODUCT_ID=b.PRODUCT_ID and INQUIRY_ID='".$INQUIRY_ID."'";
$result = $mysqli->query($que) or die("2:".$mysqli->error);
$rs = $result->fetch_object();
*/

?>
<!doctype html>
<html>
<head>
<meta charset="utf-8">
<title>Mediapic Back-office</title>
<link href="/css/dcg_tmall.css" rel="stylesheet" type="text/css" />
<script type="text/javascript" src="/asset/js/jquery-1.11.3.min.js"></script>
</head>

<body class="bg_popup">

<!-- 전체 넓이 S-->
<div id="pop_wrap">
  <!-- 상단 head로고 S-->
  <div class="pop_top_bg">
    <ul>
     <li><span>구매문의관리</span></li>
    </ul>
  </div>
  <!-- 상단 head로고 E-->
  
  <!-- 컨텐츠 S -->
  <div class="pop_content">
<form method="post" action="qa_ok.php" name="sf" enctype="multipart/form-data">
<input type="hidden" name="INQUIRY_ID" value="<?=$INQUIRY_ID?>">
  <!-- 타이틀 S--> 
     <ul class="top_title_area">
       <li class="top_title">문의내용</li>
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
                      <th class="color_ch" scope="row">구분</th>
                      <td colspan="3"><?if($rs->GUBUN==0){?>구매<?}else{?>상품<?}?></td>
                    </tr>
                    <tr>
                      <th class="color_ch" scope="row">매장명</th>
                      <td><?=$rs->STORE_NAME?></td>
                      <th class="color_ch"  scope="row">상품코드</th>
                      <td><?=$rs->PRODUCT_ID?></td>
                    </tr>
					<tr>
                      <th class="color_ch" scope="row">상품명</th>
                      <td><?=$rs->PRODUCT_NAME?></td>
                      <th class="color_ch"  scope="row">예상수량</th>
                      <td><?echo number_format($rs->AMOUNT);?></td>
                    </tr>
					<tr>
                      <th class="color_ch" scope="row">아름</th>
                      <td><?=$rs->NAME?></td>
                      <th class="color_ch"  scope="row">연락처</th>
                      <td><?=$rs->TEL?></td>
                    </tr>
					<tr>
                      <th class="color_ch" scope="row">문의내용</th>
                      <td colspan="3"><?echo stripslashes($rs->CONTENTS)?></td>
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
						<input type="radio" name="REPLY_YN" value="N" <?if($rs->REPLY_YN=="N"){?>checked<?}?>>처리중 &nbsp;<input type="radio" name="REPLY_YN" value="Y" <?if($rs->REPLY_YN=="Y"){?>checked<?}?>>처리완료
					  </td>
                    </tr>
					<tr>
                      <th class="color_ch" scope="row">메모</th>
                      <td>
						<?
						if($rs->REPLY_CONTENTS){
							echo $rs->REPLY_ID." (".$rs->REPLY_DATE.") &nbsp; ".stripslashes($rs->REPLY_CONTENTS);
				  }
						?>
						<br>
						<textarea name="REPLY_CONTENTS" rows="2" cols="60"></textarea>
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

			a.submit();

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
