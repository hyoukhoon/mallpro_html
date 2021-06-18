<?php session_start();
$snum=$_GET["snum"];
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
     <li><span>검색어 등록</span></li>
    </ul>
  </div>
    <div class="pop_content" style="text-align:center;">
		데이타를 수집하고 있습니다.잠시만 기다려주십시오.
	</div>
	<!-- <div class="pop_content2" style="text-align:center;display:none;">
		<span id="thisCnt"></span> / <span id="totalCnt"></span>
	</div> -->
	<div class="pop_content2" style="text-align:center;display:none;">
		<span id="totalCnt"></span>개를 수집했습니다.
	</div>
	<div class="pop_content3" style="text-align:center;display:none;">
		총 <span id="totalCnt2"></span>개의 데이타 수집을 완료했습니다. <br>창닫기 버튼을 클릭하시면 확인할 수 있습니다.
	</div>
	<div id="wrap-loading" style="display:none;"><img src="/images/loading.gif"></div>
	<br>
	<div id="closeButton" style="display:none;">
	<button style="margin:auto" class="button03" onclick="wclose();">창닫기</button> 
	</div>
</div>
<script>


$( document ).ready(function() {
    $("#wrap-loading").show();
	$("#wrap-loading").center();
});


jQuery.fn.center = function () {
    this.css("position","absolute");
    this.css("top", Math.max(0, (($(window).height() - $(this).outerHeight()) / 2) + $(window).scrollTop()) + "px");
    this.css("left", Math.max(0, (($(window).width() - $(this).outerWidth()) / 2) + $(window).scrollLeft()) + "px");
    return this;
}

function wclose(){
	opener.location.reload();
	window.close();
}



$(function() {

	timer = setInterval( function () {

		var params = "snum=<?=$snum?>"
//		console.log(params)
		$.ajax({
			  type: 'post'
			, url: '/product/kwGetOk.php'
			,data : params
			, dataType : 'json'
			, success: function(data) {
				console.log(data.searchCnt+":rs:"+data.val);

				if(data.val>0 && data.searchCnt>0){
					$(".pop_content2").show();
					//$("#thisCnt").text(data.val);
					//$("#totalCnt").text(data.searchCnt);
					$("#totalCnt").text(data.val);
				}else if(data.val>0 && data.searchCnt==0){
						$("#wrap-loading").hide();
						$(".pop_content").hide();
						$(".pop_content2").hide();
						$("#totalCnt2").text(data.val);
						$(".pop_content3").show();
						$("#closeButton").show();
						return;
					}
				
			  }

		});

		}, 5000);

});


</script>
 <!-- 전체 넓이 E-->

</body>
</html>
