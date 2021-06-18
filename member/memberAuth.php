<?php session_start();
include $_SERVER["DOCUMENT_ROOT"]."/inc/dbcon.php";


if(!$_SESSION['AID']){
	location_is_close('로그인이 필요한 메뉴입니다.');
	exit;
}
$uid=$_SESSION["AID"];

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
      
           <!-- <thead>        
           <tr style="font-weight:bold;color:#000;">
             <td class="color_sub_ch" scope="col" width="100">회원구분</td>
             <td class="color_sub_ch" scope="col">등록건수</td>
			 <td class="color_sub_ch" scope="col">이용료</td>
			 <td class="color_sub_ch" scope="col">선택</td>
             </tr>
           </thead>
             <tbody>

             <tr id="v1" class="viewLine" style="line-height:30px;cursor:pointer;">
             <td><img src="/images/icon_bronze.png"></td>
             <td style="font-weight:bold;">
				매월 전체상품 <span style="color:red;">3,000개</span>등록<br>
				매월 내상품 <span style="color:blue;">1,000개</span>등록<br>
			</td>
			<td style="line-height:22px;">
				1개월 55만원<br>
				3개월 165만원<br>
				6개월 297만원<br>
				12개월 528만원<br>
			 </td>
             <td>브론즈회원 선택 <input type="radio" name="mLevel" id="mLevel" value="10"><br>
					<select name="authMonthBronze" id="authMonthBronze">
						<option value="0">기간을선택하세요</option>
						<option value="1">1개월(55만원)</option>
						<option value="3">3개월(165만원)</option>
						<option value="6">6개월(297만원)</option>
						<option value="12">12개월(528만원)</option>
					</select>
			 </td>
             </tr>
			 <tr id="v1" class="viewLine" style="line-height:30px;cursor:pointer;">
             <td><img src="/images/icon_silver.png"></td>
             <td style="font-weight:bold;">
				매월 전체상품 <span style="color:red;">1만개</span>등록<br>
				매월 내상품 <span style="color:blue;">2500개</span>등록<br>
			</td>
			<td style="line-height:22px;">
				1개월 110만원<br>
				3개월 330만원<br>
				6개월 594만원<br>
				12개월 1,056만원<br>
			 </td>
             <td>실버회원 선택 <input type="radio" name="mLevel" id="mLevel" value="20"><br>
					<select name="authMonthSilver" id="authMonthSilver">
						<option value="0">기간을선택하세요</option>
						<option value="1">1개월(110만원)</option>
						<option value="3">3개월(330만원)</option>
						<option value="6">6개월(594만원)</option>
						<option value="12">12개월(1,056만원)</option>
					</select>
			 </td>
             </tr>
			 <tr id="v1" class="viewLine" style="line-height:30px;cursor:pointer;">
             <td><img src="/images/icon_gold.png"></td>
             <td style="font-weight:bold;">
				매월 전체상품 <span style="color:red;">5만개</span>등록<br>
				매월 내상품 <span style="color:blue;">1만개</span>등록<br>
			</td>
			<td style="line-height:22px;">
				1개월 165만원<br>
				3개월 495만원<br>
				6개월 891만원<br>
				12개월 1,584만원<br>
			 </td>
             <td>골드회원 선택 <input type="radio" name="mLevel" id="mLevel" value="30"><br>
					<select name="authMonthGold" id="authMonthGold">
						<option value="0">기간을선택하세요</option>
						<option value="1">1개월(165만원)</option>
						<option value="3">3개월(495만원)</option>
						<option value="6">6개월(891만원)</option>
						<option value="12">12개월(1,584만원)</option>
					</select>
			 </td>
             </tr>


        </tbody> -->

		<thead>        
           <tr style="font-weight:bold;color:#000;">
             <td class="color_sub_ch" scope="col">상품수집갯수</td>
			 <td class="color_sub_ch" scope="col">엑셀다운갯수</td>
             <!-- <td class="color_sub_ch" scope="col">등록건수</td> -->
			 <td class="color_sub_ch" scope="col" width="200">이용료</td>
			 <td class="color_sub_ch" scope="col" width="100">선택</td>
             </tr>
           </thead>
             <tbody>

             <tr id="v1" class="viewLine" style="line-height:30px;cursor:pointer;">
             <td style="font-weight:bold;">
				20개
			</td>
			<td style="font-weight:bold;">
				10개
			</td>
			<td style="line-height:22px;">
				30,000원
			 </td>
             <td><input type="radio" name="couponCnt" id="mLevel" value="10"><br>
			 </td>
             </tr>
			 <tr id="v1" class="viewLine" style="line-height:30px;cursor:pointer;">
			 <td style="font-weight:bold;">
				100개
			</td>
             <td style="font-weight:bold;">
				50개
			</td>
			<td style="line-height:22px;">
				100,000원
			 </td>
             <td><input type="radio" name="couponCnt" id="mLevel" value="50"><br>
			 </td>
             </tr>
			 <tr id="v1" class="viewLine" style="line-height:30px;cursor:pointer;">
			 <td style="font-weight:bold;">
				220개
			</td>
             <td style="font-weight:bold;">
				110개
			</td>
			<td style="line-height:22px;">
				200,000원
			 </td>
             <td><input type="radio" name="couponCnt" id="mLevel" value="110"><br>
			 </td>
             </tr>
			 <tr id="v1" class="viewLine" style="line-height:30px;cursor:pointer;">
			 <td style="font-weight:bold;">
				1,200개
			</td>
             <td style="font-weight:bold;">
				600개
			</td>
			<td style="line-height:22px;">
				1000,000원
			 </td>
             <td><input type="radio" name="couponCnt" id="mLevel" value="600"><br>
			 </td>
             </tr>
			 <tr id="v1" class="viewLine" style="line-height:30px;cursor:pointer;">
			 <td style="font-weight:bold;">
				2,400개
			</td>
             <td style="font-weight:bold;">
				1,200개
			</td>
			<td style="line-height:22px;">
				2,000,000원
			 </td>
             <td><input type="radio" name="couponCnt" id="mLevel" value="1200"><br>
			 </td>
             </tr>
			 


        </tbody>
      </table>
    </div>
      <!-- GRID E-->
<p style="font-weight:bold;font-size:14px;padding:5px;">
	※ 유의사항
</p>
<ul>
	<li style="padding-left:5px;">
		01.본 프로그램은 스마트스토어(스토어팜)전용 솔루션입니다. 다른 오픈마켓은 지원하지 않습니다.
	</li>
	<li style="padding-left:5px;">
		02.본 프로그램은 타오바오,티몰만 수집이 가능한  전용 솔루션입니다.
	</li>
	<li style="padding-left:5px;">
		03.본 프로그램은 상품수집 솔루션으로, 수집한 상품의 판매에의해 발생하는 어떠한 문제에대해서도 법적인 책임을 지지 않습니다.
	</li>
	<li style="padding-left:5px;">
		04.본 가격은 VAT 포함가격이며 세금계산서는 신청 후 금요일 일괄 발급됩니다.
	</li>
	<li style="padding-left:5px;">
		05.쿠폰의 유효기간은 2년입니다.
	</li>
	<li style="padding-left:5px;">
		06.<a href="#" onclick="window.open('/member/yak.html','yak','width=640,height=820,scrollbars=yes');">클릭해서 약관을 확인하세요</a>
	</li>
	<li style="padding-left:5px;">
		07.한번 다운로드 받은 제품은 더이상 쿠폰이 차감되지 않습니다.
	</li>
</ul>
   

   <!-- 하단 버튼 S-->
  
   <div class="bottom_bu_area mt10">
	<p style="font-weight:bold;font-size:14px;padding:15px;color:blue;">
		다운갯수를 선택 후 다음을 클릭하세요. 다음을 클릭하시면 약관에 동의한것으로 간주됩니다.
	</p>
	<ul>
		<li><a href="javascript:" onclick="request()" class="button03">다음</a></li>
		<li><a href="#" class="button03_1" onclick="window.close();">창닫기</a></li>
	</ul>
</div>    
            
  <!-- 하단 버튼 E-->


   
</div>
  <!-- 컨텐츠 E --> 
 
   
  </div>
 <!-- 전체 넓이 E-->
 
  
<script>
function request(){

	//alert('당분간 유료 회원의 가입을 받지 않고 있습니다. 양해 부탁드립니다.');
	//return;

	if($('input:radio[name=couponCnt]').is(':checked')==false){
		alert('회원을 선택하세요');
		return;
	}

	var couponCnt=$(':radio[name="couponCnt"]:checked').val();

	var params = "couponCnt="+couponCnt;
		//console.log(params);
	location.href="maNext.php?"+params;
	return;

}
</script>

</body>
</html>
