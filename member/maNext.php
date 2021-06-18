<?php session_start();
include $_SERVER["DOCUMENT_ROOT"]."/inc/dbcon.php";


if(!$_SESSION['AID']){
	location_is_close('로그인이 필요한 메뉴입니다.');
	exit;
}
$uid=$_SESSION["AID"];

$couponCnt=removeHackTag($_GET['couponCnt']);
$authVal=removeHackTag($_GET['authVal']);

if($couponCnt==10){
	$amt=30000;
}else if($couponCnt==50){
	$amt=100000;
}else if($couponCnt==110){
	$amt=200000;
}else if($couponCnt==600){
	$amt=1000000;
}else if($couponCnt==1200){
	$amt=2000000;
}


/*
$que2="select count(1) from memberAuth where uid='$uid' and isAuth='1' and isUse='1'";
$result2 = $mysqli->query($que2) or die("2:".$mysqli->error);
$rs2 = $result2->fetch_array();

if($rs2[0]){
	$authHistory=1;
}else{
	$authHistory=0;
}
*/
?>
<!doctype html>
<html>
<head>
<meta charset="utf-8">
<title>몰프로</title>
<link href="/css/dcg_tmall.css" rel="stylesheet" type="text/css" />
<link rel="stylesheet" href="http://code.jquery.com/ui/1.8.18/themes/base/jquery-ui.css" type="text/css" />  
<script src="http://ajax.googleapis.com/ajax/libs/jquery/1.7.1/jquery.min.js"></script>  
<script src="http://code.jquery.com/ui/1.8.18/jquery-ui.min.js"></script>  
<script type="text/javascript" src="/js/jquery.min.js"></script>
</head>

<body class="bg_popup">

<!-- 전체 넓이 S-->
<div id="pop_wrap">
  <!-- 상단 head로고 S-->
  <div class="pop_top_bg">
    <ul>
     <li><span>유료회원 안내/결제</span></li>
    </ul>
  </div>
  <!-- 상단 head로고 E-->
  
  <!-- 컨텐츠 S -->
  <div class="pop_content">
  
  
  

    <!-- GRID S-->
    <div class="list_table_list03">
      <table width="100%" border="0"  summary="이 표는 주문결제정보를 나타내는 테이블 입니다.">
      
           <thead>        
           <tr style="font-weight:bold;color:#000;">
             <td class="color_sub_ch" scope="col">쿠폰갯수</td>
             <td class="color_sub_ch" scope="col">이용료</td>
			 <td class="color_sub_ch" scope="col">기간</td>
             </tr>
           </thead>
             <tbody>

             <tr id="v1" class="viewLine" style="line-height:30px;cursor:pointer;">
             <td>
				
					<?=$couponCnt?>개
				</td>
             <td style="font-weight:bold;">
				<?echo number_format($amt);?>만원</span>(부가세포함)
			</td>
			<td style="font-weight:bold;">

				구매후 2년
			</td>

             </tr>


        </tbody>
      </table>
	  <p style="padding:10px;font-size:14px;text-align:center;font-weight:bold;">
		선택하신 주문이 맞는지 확인하시기 바랍니다.
	  </p>
    </div>
      <!-- GRID E-->
	<div style="border-bottom:1px solid #e8e8e8;"></div>
	<br>
   <div>
	<span  style="font-weight:bold;font-size:18px;">결제방법선택</span>
   </div>
	<br>
   <div style="float:left;">
		<table border="1">
           <thead>        
           <tr>
             <td  style="font-weight:bold;color:#fff;background-color:#000;width:450px;text-align:center;padding:15px;">무통장입금</td>
             </tr>
           </thead>
             <tbody>
				 <tr id="v1" class="viewLine" style="line-height:20px;cursor:pointer;">
					 <td style="color:#000;background-color:#f3f3f3;width:450px;padding:15px;">
						<div style="float:left;margin-right:10px;">
							<li><!-- <input type="radio" name="bank" id="bank" value="신한" checked> --> 우리은행 : 1002-433-830187</li>
							<!-- <li style="padding-left:18px;"> -->
							<li>
							예금주 : 김상희
							</li>
						</div>
							<button type="button"  style="background-color: #7c7c7c;border: 1px solid #737372;width: 80px;height: 25px;font-size: 13px;line-height: 26px;font-weight: bold;color:#fff;border-radius:3px;" onclick="send(1);">신청하기</button>
						
					</td>
				 </tr>
				 <tr id="v1" class="viewLine" style="line-height:20px;cursor:pointer;">
						<td style="color:#000;background-color:#f3f3f3;width:450px;padding:15px;">
						<li>
							- 입금자명은 반드시 가입하신 아이디로 하시기 바랍니다.
						</li>
						<li>
							- 입금후 1시간 내외로 셋팅이 완료 됩니다.
						</li>
						<li>
							- 입금확인후 1:1문의에 입금확인 요청 해주시면 빠른 처리 도와드리겠습니다.
						</li>
						<li>
							- 입금 신청후 24시간 미입금시에는 자동 취소처리 됩니다.
						</li>
					</td>
				 </tr>
	        </tbody>
      </table>
   </div>
   <div style="float:right;">
	<table border="1">
           <thead>        
           <tr>
             <td  style="font-weight:bold;color:#fff;background-color:#000;width:250px;text-align:center;padding:15px;">신용카드결제</td>
             </tr>
           </thead>
             <tbody>
				 <tr id="v1" class="viewLine" style="line-height:20px;cursor:pointer;">
					 <td style="color:#000;background-color:#f3f3f3;width:250px;padding:15px;">
							<span>
								카드구매는 준비중입니다.
							</span>
							<br>
							<div style="margin-top:10px;">
							<span style="font-weight:bold;font-size:12px;">이 름<span>&nbsp;&nbsp;
							<span><input type="text" name="uname" id="uname" style="width:180px;height:35px !important;"></span>
							</div>
							<div style="margin-top:10px;text-align:center;">
								<button type="button"  style="background-color: #7c7c7c;border: 1px solid #737372;width: 80px;height: 25px;font-size: 13px;line-height: 26px;font-weight: bold;color:#fff;border-radius:3px;" onclick="send(2)">신청하기</button>
							</div>
							<p style="margin-top:10px;text-align:center;">
								- 결제후 1시간이내에 세팅이 완료됩니다.
							</p>
					</td>
				 </tr>

	        </tbody>
      </table>
   </div>

   
</div>
  <!-- 컨텐츠 E --> 
 
   
  </div>
 <!-- 전체 넓이 E-->
 
  
<script>
function send(n){
	var uname=$('#uname').val();

	//alert('당분간 유료 회원의 가입을 받지 않고 있습니다. 양해 부탁드립니다.');
	//return;

	if(n==2){
		alert('카드결제는 준비중에 있습니다. 무통장 입금으로 신청해주십시오.');
		return;
		if(!uname){
			alert('이름을 입력하세요.');
			return;
		}
	}

	var params = "couponCnt=<?=$couponCnt?>&amt=<?=$amt?>";
	//console.log(params);
	//return;

		$.ajax({
			  type: 'post'
			, url: '/member/maOk.php'
			,data : params
			, dataType : 'json'
			, success: function(data) {
				//console.log(data.result);

				if(data.result==1){
					alert('등록됐습니다. 입금하시면 자동으로 처리됩니다. 감사합니다.');
					window.close();
				}else if(data.result==-1){
					alert(data.val);
					return;
				}else{
					alert('다시 시도해 주십시오.');
					return;
				}
			  }
		});	

}
</script>

</body>
</html>
