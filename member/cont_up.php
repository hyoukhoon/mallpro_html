<?php session_start();
include $_SERVER["DOCUMENT_ROOT"]."/inc/dbcon.php";

$mode=$_GET['mode'];
$SELLER_CODE=$_GET['SELLER_CODE'];
$CONTRACT_ID=$_GET['CONTRACT_ID'];

/*
$que2="select * from seller where SELLER_CODE='".$SELLER_CODE."'";
$result2 = $mysqli->query($que2) or die("2:".$mysqli->error);
$rs2 = $result2->fetch_object();

if($CONTRACT_ID){
	$que="select * from contract where CONTRACT_ID='".$CONTRACT_ID."'";
	$result = $mysqli->query($que) or die("2:".$mysqli->error);
	$rs = $result->fetch_object();
}
*/
if($mode=="edit"){
	$title="계약 수정";
}else{
	$title="계약 등록";
}

$action="cu_ok.php";


?>
<!doctype html>
<html>
<head>
<meta charset="utf-8">
<title>Mediapic Back-office</title>
<link href="/css/dcg_tmall.css" rel="stylesheet" type="text/css" />
<link rel="stylesheet" href="http://code.jquery.com/ui/1.8.18/themes/base/jquery-ui.css" type="text/css" />  
<script src="http://ajax.googleapis.com/ajax/libs/jquery/1.7.1/jquery.min.js"></script>  
<script src="http://code.jquery.com/ui/1.8.18/jquery-ui.min.js"></script>  
<script>
	$(function(){
	
	$( "#start_date, #end_date" ).datepicker({
				showOn:"both"
				,buttonImage:"/images/calendar_Ico.png"
				,buttonImageOnly:true
				,dateFormat:'yy-mm-dd'
			});

	$( "#cont_date" ).datepicker({
				showOn:"both"
				,buttonImage:"/images/calendar_Ico.png"
				,buttonImageOnly:true
				,dateFormat:'yy-mm-dd'
			});

});
</script>
<style>
.ui-datepicker-trigger { position:relative;top:7px ;left:0px ; }
 /* {} is the value according to your need */
</style>
</head>

<body class="bg_popup">

<!-- 전체 넓이 S-->
<div id="pop_wrap">
  <!-- 상단 head로고 S-->
  <div class="pop_top_bg">
    <ul>
     <li><span><?=$title?></span></li>
    </ul>
  </div>
  <!-- 상단 head로고 E-->
  
  <!-- 컨텐츠 S -->
  <div class="pop_content">
<form method="post" action="<?=$action?>" name="sf">
<input type="hidden" name="SELLER_CODE" value="<?=$SELLER_CODE?>">
<input type="hidden" name="CONTRACT_ID" value="<?=$CONTRACT_ID?>">
<input type="hidden" name="mode" value="<?=$mode?>">
	  <!-- GRID S-->
              <div class="list_table_list01">
                <table width="100%" border="0" >
                  <colgroup>
                  <col width=100/>
                  <col width="*"/>
                  </colgroup>
                 
                  <tbody>
                    <tr>
                      <th class="color_ch" scope="row">계약코드</th>
                      <td ><?=$CONTRACT_ID?></td>
                    </tr>
					<tr>
                      <th class="color_ch" scope="row"><font color="red">*</font>계약일자</th>
                      <td ><input type="text" name="CONTRACT_DATE" id="cont_date" size="20" value="<?=$rs->CONTRACT_DATE?>"></td>
                    </tr>
					<tr>
                      <th class="color_ch" scope="row"><font color="red">*</font>계약상품</th>
                      <td >
						<select name="SERVICE_ID" id="cp" onchange="pprice(this)">
						<?/*
$que1="select * 
	from service_product where SERVICE_STS_CODE='0' order by SERVICE_ID";
	$result1 = $mysqli->query($que1) or die($mysqli->error);
	while($rs1 = $result1->fetch_object()){
		if(!$sprice){
			$sprice=$rs1->PRICE;
		}
?>
							<option value="<?=$rs1->SERVICE_ID?>" <?if($rs->SERVICE_ID==$rs1->SERVICE_ID){?>selected<?}?>><?=$rs1->SERVICE_PRODUCT_NAME?></option>
<?}*/?>
						</select>
					  </td>
                    </tr>
					<tr>
                      <th class="color_ch" scope="row"><font color="red">*</font>약정기간</th>
                      <td >
							<select name="STIPULATED_TIME">
								<option value="1" <?if($rs->STIPULATED_TIME=="1"){?>selected<?}?>>1달</option>
								<option value="12" <?if($rs->STIPULATED_TIME=="12"){?>selected<?}?>>1년</option>
								<option value="24" <?if($rs->STIPULATED_TIME=="24"){?>selected<?}?>>2년</option>
							</select>
								
					  </td>
                    </tr>
					<tr>
                      <th class="color_ch" scope="row"><font color="red">*</font>서비스기간</th>
                      <td ><input type="text" name="SERVICE_START_DATE" id="start_date" size="20" value="<?=$rs->SERVICE_START_DATE?>"> ~ 
					  <input type="text" name="SERVICE_END_DATE" id="end_date" size="20" value="<?=$rs->SERVICE_END_DATE?>">
					  </td>
                    </tr>
					<tr>
                      <th class="color_ch" scope="row"><font color="red">*</font>상품가격</th>
                      <td id="pprice">
							<?if($rs->PRICE){echo number_format($rs->PRICE);}else{echo number_format($sprice);}?>원
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
		<li><button type="button" class="button03" onclick="return sendform();">저장</button></li>
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

	if(!a.CONTRACT_DATE.value){
		alert('계약일자를 선택하세요');
		a.CONTRACT_DATE.focus();
		return false;
	}

	if(!a.SERVICE_ID.value){
		alert('계약상품을 선택하세요');
		return false;
	}

	if(!a.SERVICE_START_DATE.value){
		alert('서비스기간을 선택하세요');
		a.SERVICE_START_DATE.focus();
		return false;
	}

	if(!a.SERVICE_END_DATE.value){
		alert('서비스기간을 선택하세요');
		a.SERVICE_END_DATE.focus();
		return false;
	}

	a.submit();

	return true;
}
</script>
<script>
$('#cp').change( function() {
	var val=$('#cp').val();

	var params = "SERVICE_ID="+val;
		$.ajax({
			  type: 'get'
			, url: 'cp.php'
			,data : params
			, dataType : 'html'
			, success: function(data) {
					$("#pprice").html(data);
			  }
		});	


	});
</script>