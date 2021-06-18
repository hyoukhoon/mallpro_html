<?php session_start();
include $_SERVER["DOCUMENT_ROOT"]."/inc/dbcon.php";

if(!$_SESSION['AID']){
	location_is_close('로그인이 필요한 메뉴입니다.');
	exit;
}

$uid=$_SESSION['AID'];
$num=$_GET['num'];
$optionCount=$_GET['optionCount'];
$optionType=$_GET['optionType'];

$optionCount=$optionCount?$optionCount:3;
$optionType=$optionType?$optionType:1;

$que="select optionType from taobao where num='".$num."'";
$result = $mysqli->query($que) or die("2:".$mysqli->error);
$rs = $result->fetch_array();
$optionType=$rs[0];

$que="select * from optiontable where pnum='".$num."' and isRegist='1'";
$result = $mysqli->query($que) or die("2:".$mysqli->error);
$rs = $result->fetch_object();

if($rs->isRegist){
	location_is_close('이미 옵션이 등록된 제품입니다. 미리보기에서 확인하세요.');
	exit;
}

$optMixPrice=json_decode(urldecode($rs->optionMixPrice));
$optCnt=count($optMixPrice);
?>
<!doctype html>
<html>
<head>
<meta charset="utf-8">
<title>Mediapic Back-office</title>
<link href="/css/dcg_tmall.css" rel="stylesheet" type="text/css" />
<script type="text/javascript" src="/js/jquery.min.js"></script>

</head>

<body class="bg_popup">

<!-- 전체 넓이 S-->
<div id="pop_wrap">
  <!-- 상단 head로고 S-->
  <div class="pop_top_bg">
    <ul>
     <li><span>옵션직접만들기</span></li>
    </ul>
  </div>
  <!-- 상단 head로고 E-->
  
  <!-- 컨텐츠 S -->
  <div class="pop_content">
<div style="font-size:13px;color:blue;">
				1.옵션갯수를 선택합니다.<br>
				2.옵션제품의 모든가격이 같으면 단독형, 가격이 다르면 조합형을 선택하세요.<br>
			  </div>
	  <!-- GRID S-->
              <div class="list_table_list01">
			  <table width="100%" border="0" >
                  <colgroup>
                  <col width="140"/>
                  <col width="*"/>
                  </colgroup>
                 
                  <tbody>

                    <tr>
					  <th scope="col">옵션갯수</th>
                      <td>
					  <select name="optionCount" onchange="changeOption(this.value)">
							<option value="1">1개</option>
							<option value="2">2개</option>
							<option value="3">3개</option>
							<option value="4">4개</option>
							<option value="5">5개</option>
							<option value="6">6개</option>
						</select>
					  </th>
                    </tr>
					<tr>
					  <th scope="col">옵션타입</th>
                      <td>
					  <select name="optionType"  id="optionType" onchange="changeOptionType(this.value)">
							<option value="1">단독형</option>
							<option value="2">조합형</option>
						</select>
					  </th>
                    </tr>

				</table>

				<table width="100%" border="0" >
                  <colgroup>
                  <col width="140"/>
                  <col width="*"/>
                  </colgroup>
                 
                  <tbody id="optionPlace">

                    <tr>
					  <th scope="col">옵션1</th>
                      <td style="line-height:25px;">
						옵션명 : <input type="text" name="optionName_01" id="optionName" style="width:85%;" placeholder="컬러나 사이즈같은 옵션이름"><br>
						옵션값 : <input type="text" name="optionValue_01" id="optionValue" style="width:85%;" placeholder="블루,블랙,화이트">
					  </th>
                    </tr>
					<!-- <tr>
					  <th scope="col">옵션2</th>
                      <td style="line-height:25px;">
						옵션명 : <input type="text" name="optionName_02" id="optionName" style="width:85%;" placeholder="컬러나 사이즈같은 옵션이름"><br>
						옵션값 : <input type="text" name="optionValue_02" id="optionValue" style="width:85%;" placeholder="블루,블랙,화이트">
					  </th>
                    </tr>
					<tr>
					  <th scope="col">옵션3</th>
                      <td style="line-height:25px;">
						옵션명 : <input type="text" name="optionName_03" id="optionName" style="width:85%;" placeholder="컬러나 사이즈같은 옵션이름"><br>
						옵션값 : <input type="text" name="optionValue_03" id="optionValue" style="width:85%;" placeholder="블루,블랙,화이트">
					  </th>
                    </tr> -->

				</table>

              </div>
      <!-- GRID E-->

   <!-- 하단 버튼 S-->
  
   <div class="bottom_bu_area mt5">
	<ul id="optionTypePlace">
<?if($optionType==1){?>
		<li><a href="javascript:;" class="button03" onclick="sendform();">저장</a></li>
<?}else if($optionType==2){?>
		<li><a href="javascript:;" class="button03" onclick="sendNext();">다음</a></li>
<?}?>

		<li><a href="javascript:;" class="button03_1" onclick="window.close();">창닫기</a></li>
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

function changeOption(n){
	n=parseInt(n)+1;
	var content="";
	for(var i=1;i<n;i++){

		content+="<tr><th scope=\"col\">옵션"+i+"</th><td style=\"line-height:25px;\">옵션명 : <input type=\"text\" name=\"optionName_0"+i+"\" id=\"optionName\" style=\"width:85%;\" placeholder=\"컬러나 사이즈같은 옵션이름\"><br>옵션값 : <input type=\"text\" name=\"optionValue_0"+i+"\" id=\"optionValue\" style=\"width:85%;\" placeholder=\"블루,블랙,화이트\"></th></tr>"

	}

	$("#optionPlace").html(content);

}

function changeOptionType(n){

	if(n==1){
		var content="<li><a href=\"javascript:;\" class=\"button03\" onclick=\"sendform();\">저장</a></li><li><a href=\"javascript:;\" class=\"button03_1\" onclick=\"window.close();\">창닫기</a></li>";
	}else if(n==2){
		var content="<li><a href=\"javascript:;\" class=\"button03\" onclick=\"sendNext();\">다음</a></li><li><a href=\"javascript:;\" class=\"button03_1\" onclick=\"window.close();\">창닫기</a></li>";
	}


	$("#optionTypePlace").html(content);

}



function sendform(){

	var total_cnt=0;
	var optionType=$("#optionType option:selected").val();
	var optionNameArray=new Array();
	$('input:text[id="optionName"]').each(function() {
			optionNameArray[total_cnt]=this.value;//배열로 저장
			total_cnt++;
	});

	var total_cnt=0;
	var optionValueArray=new Array();
	$('input:text[id="optionValue"]').each(function() {
			optionValueArray[total_cnt]=this.value;//배열로 저장
			total_cnt++;
	});


		var  optionNameJson = encodeURIComponent(JSON.stringify(optionNameArray));//json으로 바꿈
		var optionValueJson = encodeURIComponent(JSON.stringify(optionValueArray));//json으로 바꿈

		var params = "num=<?=$num?>&optionNameJson="+optionNameJson+"&optionValueJson="+optionValueJson+"&optionType="+optionType;
		console.log(params);
//		return;
		$.ajax({
			  type: 'post'
			, url: 'optionRegistOk.php'
			,data : params
			, dataType : 'json'
			, success: function(data) {
//				console.log(data.val);

				if(data.result==1){
					alert(data.val);
					window.close();
					opener.location.reload();
				}else if(data.result==-1){
					alert(data.val);
					return;
				}else if(data.result==-3){
					alert(data.val);
					return;
				}else{
					alert('다시 시도해 주십시오.');
					return;
				}
			  }
		});	

}

function sendNext(){

	var total_cnt=0;
	var optionType=$("#optionType option:selected").val();
	var optionNameArray=new Array();
	$('input:text[id="optionName"]').each(function() {
			optionNameArray[total_cnt]=this.value;//배열로 저장
			total_cnt++;
	});

	var total_cnt=0;
	var optionValueArray=new Array();
	$('input:text[id="optionValue"]').each(function() {
			optionValueArray[total_cnt]=this.value;//배열로 저장
			total_cnt++;
	});


		var  optionNameJson = encodeURIComponent(JSON.stringify(optionNameArray));//json으로 바꿈
		var optionValueJson = encodeURIComponent(JSON.stringify(optionValueArray));//json으로 바꿈

		var params = "num=<?=$num?>&optionNameJson="+optionNameJson+"&optionValueJson="+optionValueJson+"&optionType="+optionType;
		console.log(params);
//		return;
		location.href='optionRegistNext.php?'+params;

}

</script>

