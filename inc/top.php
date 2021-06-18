<?php session_start();
include $_SERVER["DOCUMENT_ROOT"]."/inc/dbcon.php";

header("Last-Modified: " . gmdate( "D, j M Y H:i:s" ) . " GMT"); // Date in the past
header("Expires: " . gmdate( "D, j M Y H:i:s", time() ) . " GMT"); // always modified
header("Cache-Control: no-store, no-cache, must-revalidate, max-age=0");
header("Cache-Control: post-check=0, pre-check=0", FALSE);
header("Pragma: no-cache");

//error_reporting(E_ALL);
//ini_set("display_errors", 1);

if($_SESSION["saveLoginInfo"]){
	SetCookie("cookieSaveLoginInfo",$_SESSION["saveLoginInfo"],time()+86400*365,"/");
}

if($_COOKIE['cookieSaveLoginInfo'] and !$_SESSION['AID']){

	$queTop="SELECT uid,isAuth,mLevel FROM member WHERE isAuth='1' and uid = '".$_COOKIE['cookieSaveLoginInfo']."'";
	$resultTop = $mysqli->query($queTop);
	$rsTop = $resultTop->fetch_object();

	//유료회원확인
	$que2="select * from memberCoupon where uid='".$rsTop->uid."' and startDate<='$now2' and endDate>='$now2' order by num desc limit 1";
	$result2 = $mysqli->query($que2) or die($mysqli->error);
	$rs2 = $result2->fetch_object();
	if($rs2->isuse){
		$isAuth=1;
		$endDate=$rs2->endDate;
		$totalDownCnt=$rs2->totalDownCnt;
		$nowDownCnt=$rs2->nowDownCnt;
		$buyCoupon=$rs2->buyCoupon;
		$nowCoupon=$rs2->nowCoupon;
	}else{	
		$isAuth=0;
		$endDate=$rs2->endDate;
		$totalDownCnt=$rs2->totalDownCnt;
		$nowDownCnt=$rs2->nowDownCnt;
		$buyCoupon=$rs2->buyCoupon;
		$nowCoupon=$rs2->nowCoupon;
	}

	$sql=$mysqli->query("update member set lastLogin=now() where uid='".$rsTop->uid."'") or die($mysqli->error);

	$_SESSION['AID']= $rsTop->uid;
	$_SESSION['AAUTH']= $isAuth;
	$_SESSION['AISUSE']= $rs2->isuse;

}



if(!$_SESSION['AID']){
	location_is('/login.html','','로그인이 필요한 메뉴입니다.');
	exit;
}


?>
<!doctype html>
<html>
<head>
<!-- Global site tag (gtag.js) - Google Analytics -->
<meta name="naver-site-verification" content="3560e8c5dcae0af03827b8b75f82faada6fdcf4f" />
<script async src="https://www.googletagmanager.com/gtag/js?id=UA-161408990-1"></script>
<script>
  window.dataLayer = window.dataLayer || [];
  function gtag(){dataLayer.push(arguments);}
  gtag('js', new Date());

  gtag('config', 'UA-161408990-1');
</script>

<meta charset="utf-8">
<title>해외구매대행 상품 자동수집 솔루션-몰프로</title>
<meta name="description" content="페이지 설명">
<meta property="og:type" content="website">
<meta property="og:title" content="해외구매대행 상품 자동수집 솔루션-몰프로">
<meta property="og:description" content="타오바오상품 정보를 가져와서 아주 쉽게 스마트스토어에 등록할 수 있게 도와줍니다.">
<meta property="og:image" content="http://www.mallpro.kr/images/main.jpg">
<meta property="og:url" content="http://www.mallpro.kr">
<meta name="twitter:card" content="summary">
<meta name="twitter:title" content="해외구매대행 상품 자동수집 솔루션-몰프로">
<meta name="twitter:description" content="타오바오상품 정보를 가져와서 아주 쉽게 스마트스토어에 등록할 수 있게 도와줍니다.">
<meta name="twitter:image" content="http://www.mallpro.kr/images/main.jpg">
<meta name="twitter:domain" content="해외구매대행 상품 자동수집 솔루션-몰프로">

<link href="/css/dcg_tmall.css" rel="stylesheet" type="text/css" />
<link rel="stylesheet" type="text/css" href="/css/jquery-ui-1.8.16.custom.css" />

<script type="/js/text/javascript" language="javascript" src="tooltip.js"></script>
<script type="text/javascript" src="/js/jquery.min.js"></script>
	<script type="text/javascript" src="/js/jquery-ui.min.js"></script>
<style>
.container {
    overflow: hidden;
    background-color: #333;
    font-family: Arial;
}

.container a {
    float: left;
    font-size: 16px;
    color: white;
    text-align: center;
    padding: 14px 16px;
    text-decoration: none;
}

.dropdown {
    float: left;
    overflow: hidden;
}

.dropdown .dropbtn {
    font-size: 16px;    
    border: none;
    outline: none;
    color: white;
    padding: 14px 16px;
    background-color: inherit;
}

.container a:hover, .dropdown:hover .dropbtn {
    background-color: red;
}

.dropdown-content {
    display: none;
    position: absolute;
    background-color: #f9f9f9;
    min-width: 160px;
    box-shadow: 0px 8px 16px 0px rgba(0,0,0,0.2);
    z-index: 1;
}

.dropdown-content a {
    float: none;
    color: black;
    padding: 12px 16px;
    text-decoration: none;
    display: block;
    text-align: left;
	font-family: Arial;
}

.dropdown-content a:hover {
    background-color: #ddd;
}

.dropdown:hover .dropdown-content {
    display: block;
}
</style>
</head>


<body>
<!-- 상단 헤드색(오렌지,red) S--> 
<div class="top_head_line01"></div>
<!-- 상단 헤드색(오렌지,red) E--> 

<!-- 전제영역 Warp S-->
<div id="wrap_tmall">
  
   <div id="skipnavi"> <a href="#wrap_tmall_top">상단메뉴 바로가기</a><a href="#wrap_tmall_content">주메뉴 바로가기</a> </div>

<!-- 상단 로고, 주 메뉴 S-->
   <div id="wrap_tmall_top">
        <!-- 상단 로고 개인정보, 로그아웃 S-->
		<table border=0 width="100%">
			<tr>
				<td>
					<img src="/images/title.jpg">
				</td>
				<td>
				<li class="top_text_area">
				<ul>
					<li style="font-size:16px;padding-right:10px;padding-bottom:20px;"><a href="#"><?=$_SESSION['AID']?>님</a>은
					<?if($_SESSION['AISUSE']){?>
								유료 회원이십니다. (<span style="color:red;font-size:18px;"><?echo isMyCnt($_SESSION['AID']);?>개</span> 수집가능 / <span style="color:red;font-size:18px;"><?echo isCouponCnt($_SESSION['AID']);?>개</span> 엑셀다운가능)  </li>
								<!-- <li style="color:#f39603;"><?echo isTaobaoCnt($_SESSION['AID']);?>개 등록</li> -->
					<?}else{?>
								무료 회원이십니다. (<span style="color:red;font-size:18px;"><?echo isMyCnt($_SESSION['AID']);?>개</span> 수집가능 / <span style="color:red;font-size:18px;"><?echo isCouponCnt($_SESSION['AID']);?>개</span> 엑셀다운가능)  </li>
					<?}?>
								&nbsp;&nbsp;
				   <li style="padding-right:10px;">
					   <a class="button01" href="javascript:;" onclick="window.open('/member/memberEdit.php','me','width=600,height=400');" style="background-color:#256ebb;height:30px;line-height:30px;">회원정보수정</a>           
					</li>
					<li style="padding-right:10px;">
					   <a class="button01" href="javascript:;" onclick="window.open('/member/storeEdit.php','se','width=640,height=600,scrollbars=yes');" style="background-color:#256ebb;height:30px;line-height:30px;">스토어정보수정</a>           
					</li>
					<li style="padding-right:0px;">
					   <a class="button01"style="height:30px;line-height:30px;" href="/logout.php">Logout</a>
					</li>
				</ul>
				</li>
				</td>
			</tr>
		</table>

        <!-- 상단 로고 개인정보, 로그아웃 E-->
   
        <!-- 주메뉴S-->
<ul class="top_main_menuarea">
<div class="container">
         <!-- 클릭시click_on -->
         <div class="dropdown">
			<a href="/product/itemList.php" style="padding:0px;cursor:pointer;"><button class="dropbtn" style="cursor:pointer;">전체상품 리스트</button></a>
		  </div> 
		  <div class="dropdown">
			<a href="/product/myList.php" style="padding:0px;cursor:pointer;"><button class="dropbtn" style="cursor:pointer;">내상품 리스트</button></a>
		  </div> 
		  <!-- <div class="dropdown">
			<a href="javascript:;" onclick="window.open('/product/searchUp.php','s1','width=600,height=400,left=200,top=100,scrollbars=yes')" style="padding:0px;cursor:pointer;"><button class="dropbtn" style="cursor:pointer;color:#f39603;">타오바오 상품 수집하기(검색어)</button></a>
		  </div>  -->
		 <div class="dropdown">
			<a href="javascript:;" onclick="window.open('/product/searchUp2.php','s2','width=600,height=400,left=200,top=100,scrollbars=yes')" style="padding:0px;cursor:pointer;"><button class="dropbtn" style="cursor:pointer;color:#f39603;">상품 수집하기</button></a>
		  </div> 
         
		<!-- <div class="dropdown">
			<button class="dropbtn"<?if(strpos("/".$_SERVER['PHP_SELF'],"/member/")){?> style="background-color:red;"<?}?>>정보수정</button>
			<div class="dropdown-content">
			  <a href="#" onclick="window.open('/member/memberEdit.php','me','width=600,height=400');">회원정보수정</a>
			  <a href="#" onclick="window.open('/member/storeEdit.php','se','width=640,height=600,scrollbars=yes');">스토어정보수정</a>
			</div>
		  </div> -->
		
		  <div class="dropdown">
			<a href="javascript:;" onclick="window.open('/product/guide.php','s2','width=600,height=400,left=200,top=100,scrollbars=yes')" style="padding:0px;cursor:pointer;"><button class="dropbtn" style="cursor:pointer;background-color:#256ebb;">사용가이드</button></a>
		  </div>
<?if($_SESSION['AID']!="kawaiko"){?>
		  <div class="dropdown">
			<a href="javascript:;" onclick="window.open('/member/memberAuth.php','s2','width=850,height=650,left=200,top=100,scrollbars=yes')" style="padding:0px;cursor:pointer;"><button class="dropbtn" style="cursor:pointer;background-color:#256ebb;">유료회원 결제</button></a>
		  </div>
<?}?>
		  <div class="dropdown">
			<a href="javascript:;" onclick="window.open('/member/qna.php','qa','width=900,height=700,left=200,top=100,scrollbars=yes')" style="padding:0px;cursor:pointer;"><button class="dropbtn" style="cursor:pointer;background-color:#256ebb;">1:1문의</button></a>
		  </div>

         
</div>
</ul>
        <!-- 주메뉴E-->
      
      
   </div>
     <!-- 상단 로고, 주 메뉴 E-->
     