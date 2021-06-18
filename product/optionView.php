<?php session_start();
include $_SERVER["DOCUMENT_ROOT"]."/inc/dbcon.php";


if(!$_SESSION['AID']){
	location_is_close('로그인이 필요한 메뉴입니다.');
	exit;
}


if(!$_SESSION['AAUTH']){
	location_is_close('유료회원 전용서비스입니다.');
	exit;
}

if(!$_SESSION['AMLEVEL']){
	location_is_close('유료회원 전용서비스입니다.');
	exit;
}

$num=$_GET['num'];

$que="select * from taobao where num='$num'";
$result = $mysqli->query($que) or die("2:".$mysqli->error);
$rs = $result->fetch_object();

	$contents=explode(",",$rs->optionImage);
?>
<!doctype html>
<html>
<head>
<meta charset="utf-8">
<title>Mallpro Back-office</title>
<link href="/css/dcg_tmall.css" rel="stylesheet" type="text/css" />
</head>

<body class="bg_popup">

<!-- 전체 넓이 S-->
<div id="pop_wrap">
  <!-- 상단 head로고 S-->
  <div class="pop_top_bg">
    <ul>
     <li><span>제품 옵션 보기</span></li>
    </ul>
  </div>
  <!-- 상단 head로고 E-->
  
  <!-- 컨텐츠 S -->
  <div class="pop_content">
  
    
  <!-- 타이틀 S--> 
     <ul class="top_title_area">
       <li class="top_title"><?echo $rs->subject;?></li>
     </ul>
  <!-- 타이틀 E--> 
  
    <ul>
			<?php
				foreach($contents as $c){
				echo "<img src='".$c."'><br>";
	}
			?>
    </ul>
  
                     
      <!-- 하단 버튼 S-->
  
   <div class="bottom_bu_area">
	<ul>
		<li><a href="#" class="button03">확인</a></li>
		<li><a href="#" class="button03_1">취소</a></li>
	</ul>
</div>    
            
  <!-- 하단 버튼 E-->


   
</div>
     <!-- 컨텐츠 E -->
 
   
  </div>
 <!-- 전체 넓이 E-->
 
  
     
   
     
     

</body>
</html>
