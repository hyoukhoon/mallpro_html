<?php session_start();
include $_SERVER["DOCUMENT_ROOT"]."/inc/dbcon.php";

?>
<!doctype html>
<html>
<head>
<meta charset="utf-8">
<title>Mallpro</title>
<link href="/css/dcg_tmall.css" rel="stylesheet" type="text/css" />
<script type="text/javascript" src="/js/jquery.min.js"></script>
	<script type="text/javascript" src="/js/jquery-ui.min.js"></script>
</head>

<body class="bg_popup">

<!-- 전체 넓이 S-->
<div id="pop_wrap">
  <!-- 상단 head로고 S-->
  <div class="pop_top_bg">
    <ul>
     <li><span>사용가이드</span></li>
    </ul>
  </div>
  <!-- 상단 head로고 E-->
  
  <!-- 컨텐츠 S -->
  <div class="pop_content">
	  <!-- GRID S-->
              <div class="list_table_list01">
                <iframe width="560" height="315" src="https://youtu.be/-shwdeasyd0" frameborder="0"></iframe>
              </div>
      <!-- GRID E-->


   <!-- 하단 버튼 S-->
  
   <div class="bottom_bu_area mt5">
	<ul>
		<!-- <li><button type="button" class="button03" onclick="send()">저장</a></li> -->
		<li><a href="javascript:window.close();" class="button03_1">닫기</a></li>
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


function send(){

		var kw=$("#kw").val();
		var tag=$("#tag").val();
		var pageNumber=$(":input:radio[name=pageNumber]:checked").val();
		var params = "kw="+kw+"&tag="+tag+"&pageNumber="+pageNumber;

		if(!kw){
			alert('검색어를 입력하세요.');
			return;
		}

		$.ajax({
			  type: 'post'
			, url: '/product/suOK.php'
			,data : params
			, dataType : 'json'
			, success: function(data) {
				if(data.result==1){
					//alert('데이터를 가져옵니다. 잠시만 기다려주십시오.');
					//window.close();
					location.href='suPb.php?snum='+data.snum
				}else if(data.result==-1){
//					console.log(data.val);
					alert(data.val);
				}else{
					alert('다시 시도하세요');
				}
			  }
		});


}

</script>