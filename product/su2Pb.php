<?php session_start();
$pid=$_GET["pid"];
?>
<!doctype html>
<html>
<head>
<meta charset="utf-8">
<title>Mallpro Back-office</title>
<link href="/css/dcg_tmall.css" rel="stylesheet" type="text/css" />
<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>

<style>
#myProgress {
  width: 100%;
  background-color: #ddd;
}

#myBar {
  width: 1%;
  height: 30px;
  background-color: #4CAF50;
  text-align: center;
  line-height: 30px;
  color: white;
}
</style>

<body class="bg_popup">
<div id="pop_wrap">
  <!-- 상단 head로고 S-->
  <div class="pop_top_bg">
    <ul>
     <li><span>URL 등록</span></li>
    </ul>
  </div>
    <div class="pop_content" style="font-size:24px;text-align:center;">
		데이타를 수집하고 있습니다.잠시만 기다려주십시오.
	</div>
	<!-- <div id="cancelButton">
	<button style="margin:auto" class="button03" onclick="cancelWindow();">취소</button> 
	</div> -->
	<div class="pop_content2" style="font-size:18px;text-align:center;display:none;">
		데이타 수집을 완료했습니다. 창닫기 버튼을 클릭하시면 확인할 수 있습니다.<br>
	</div>
	<div class="pop_content3" style="font-size:18px;text-align:center;color:red;display:none;">
		제품 정보를 가져오지 못했습니다. <br> 창닫기 버튼을 클릭하시고 받기 실패한 제품은 삭제 하시고 <br>잠시 후 다시 시도해주십시오.<br>
	</div>
	<div id="wrap-loading" style="display:none;"><img src="/images/loading.gif"></div>
	
	<div id="closeButton" style="display:none;">
	<button style="margin:auto" class="button03" onclick="wclose();">창닫기</button> 
	</div>
</div>
<script>

$( document ).ready(function() {
    $("#wrap-loading").show();
	$("#wrap-loading").center();

	var params = "pid=<?=$pid?>"
		console.log(params)
		$.ajax({
			  type: 'post'
			, url: '/product/urlGetOk.php'
			,data : params
			, dataType : 'json'
			, success: function(data) {
				//console.log(data.result+":rs:"+data.val);
				//alert(data.val);
				if(data.result==1){
					$("#wrap-loading").hide();
					$(".pop_content").hide();
					$(".pop_content2").show();
//					$("#cancelButton").hide();
					$("#closeButton").show();
					return;
				}else{
					$("#wrap-loading").hide();
					$(".pop_content").hide();
					$(".pop_content3").show();
//					$("#cancelButton").hide();
					$("#closeButton").show();
				}
			  }

		});
});


jQuery.fn.center = function () {
    this.css("position","absolute");
    this.css("top", Math.max(0, (($(window).height() - $(this).outerHeight()) / 2) + $(window).scrollTop()) + "px");
    this.css("left", Math.max(0, (($(window).width() - $(this).outerWidth()) / 2) + $(window).scrollLeft()) + "px");
    return this;
}

function wclose(){
	opener.location.href='/product/itemList.php';
	window.close();
}

function cancelWindow(){
	alert('취소하시겠습니까?');
}


/*
$(function() {

	timer = setInterval( function () {

		var params = "pid=<?=$pid?>"
		
		$.ajax({
			  type: 'post'
			, url: '/product/urlGetOk.php'
			,data : params
			, dataType : 'json'
			, success: function(data) {
				
				if(data.result==1){
					$("#wrap-loading").hide();
					$(".pop_content").hide();
					$(".pop_content2").show();
					$("#closeButton").show();
					return;
				}
			  }

		});

		}, 30000);

});
*/

</script>
 <!-- 전체 넓이 E-->

</body>
</html>
