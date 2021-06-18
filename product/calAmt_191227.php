<?php session_start();
include $_SERVER["DOCUMENT_ROOT"]."/inc/dbcon.php";

if(!$_SESSION['AID']){
	location_is_close('로그인이 필요한 메뉴입니다.');
	exit;
}

$uid=$_SESSION['AID'];
$num=$_GET['num'];
$cny=cnyIs();

?>
<!doctype html>
<html>
<head>
<meta charset="utf-8">
<title>Mallpro Back-office</title>
<link href="/css/dcg_tmall.css" rel="stylesheet" type="text/css" />
<script type="text/javascript" src="/js/jquery.min.js"></script>

</head>

<body class="bg_popup">

<!-- 전체 넓이 S-->
<div id="pop_wrap">
  <!-- 상단 head로고 S-->
  <div class="pop_top_bg">
    <ul>
     <li><span>순수익계산기</span></li>
    </ul>
  </div>
  <!-- 상단 head로고 E-->
  
  <!-- 컨텐츠 S -->
  <div class="pop_content">

	  <!-- GRID S-->
              <div class="list_table_list01">
			  
                <table width="100%" border="0" >
                  <colgroup>
                  <col width="*"/>
                  <col width="240"/>
                  </colgroup>
                 
                  <tbody>


					<tr>
                      <th class="color_ch" scope="row" style="text-align:center">네이버판매가</th>
                      <td style="text-align:right;"><input type="text" numberOnly name="naverPrice" id="naverPrice" size="7"  style="text-align:right"  value="" >원</td>
                    </tr>
					<tr>
                      <th class="color_ch" scope="row" style="text-align:center">네이버택배비</th>
                      <td style="text-align:right;"><input type="text" numberOnly name="naverSendFee" id="naverSendFee" size="7"  style="text-align:right"  value="10000" >원</td>
                    </tr>
					<tr>
                      <th class="color_ch" scope="row" style="text-align:center">네이버수수료</th>
                      <td style="text-align:right;"><input type="text" numberOnly name="naverFee" id="naverFee" size="7"  style="text-align:right"  value="3.50" >%</td>
                    </tr>
					<tr>
                      <th class="color_ch" scope="row" style="text-align:center">타오바오구매가</th>
                      <td style="text-align:right;"><input type="text" numberOnly name="tprice" id="tprice" size="7"  style="text-align:right"  value="" >위안</td>
                    </tr>
					<tr>
                      <th class="color_ch" scope="row" style="text-align:center">타오바오수수료</th>
                      <td style="text-align:right;"><input type="text" numberOnly name="tFee" id="tFee" size="7"  style="text-align:right"  value="3.00" >%</td>
                    </tr>
					<tr>
                      <th class="color_ch" scope="row" style="text-align:center">배대지배송료</th>
                      <td style="text-align:right;"><select name="tSendFee" id="tSendFee">
						<option value="5100">1.0kg이하(5,100원)</option>
<option value="6600">1.5kg(6,600원)</option>
<option value="7300">2.0kg(7,300원)</option>
<option value="8000">2.5kg(8,000원)</option>
<option value="8700">3.0kg(8,700원)</option>
<option value="9400">3.5kg(9,400원)</option>
<option value="10100">4.0kg(10,100원)</option>
<option value="10800">4.5kg(10,800원)</option>
<option value="11500">5.0kg(11,500원)</option>
<option value="12200">5.5kg(12,200원)</option>
<option value="12900">6.0kg(12,900원)</option>
<option value="13600">6.5kg(13,600원)</option>
<option value="14300">7.0kg(14,300원)</option>
<option value="15000">7.5kg(15,000원)</option>
<option value="15700">8.0kg(15,700원)</option>
<option value="16400">8.5kg(16,400원)</option>
<option value="17100">9.0kg(17,100원)</option>
<option value="17800">9.5kg(17,800원)</option>
<option value="18500">10.0kg(18,500원)</option>
<option value="19200">10.5kg(19,200원)</option>
<option value="19900">11.0kg(19,900원)</option>
<option value="20600">11.5kg(20,600원)</option>
<option value="21300">12.0kg(21,300원)</option>
<option value="22000">12.5kg(22,000원)</option>
<option value="22700">13.0kg(22,700원)</option>
<option value="23400">13.5kg(23,400원)</option>
<option value="24100">14.0kg(24,100원)</option>
<option value="24800">14.5kg(24,800원)</option>
<option value="25500">15.0kg(25,500원)</option>
<option value="26200">15.5kg(26,200원)</option>
<option value="26900">16.0kg(26,900원)</option>
<option value="27600">16.5kg(27,600원)</option>
<option value="28300">17.0kg(28,300원)</option>
<option value="29000">17.5kg(29,000원)</option>
<option value="29700">18.0kg(29,700원)</option>
<option value="30400">18.5kg(30,400원)</option>
<option value="31100">19.0kg(31,100원)</option>
<option value="31800">19.5kg(31,800원)</option>
<option value="32500">20.0kg(32,500원)</option>
<option value="33200">20.5kg(33,200원)</option>
<option value="33900">21.0kg(33,900원)</option>
<option value="34600">21.5kg(34,600원)</option>
<option value="35300">22.0kg(35,300원)</option>
<option value="36000">22.5kg(36,000원)</option>
<option value="36700">23.0kg(36,700원)</option>
<option value="37400">23.5kg(37,400원)</option>
<option value="38100">24.0kg(38,100원)</option>
<option value="38800">24.5kg(38,800원)</option>
<option value="39500">25.0kg(39,500원)</option>
<option value="40200">25.5kg(40,200원)</option>
<option value="40900">26.0kg(40,900원)</option>
<option value="41600">26.5kg(41,600원)</option>
<option value="42300">27.0kg(42,300원)</option>
<option value="43000">27.5kg(43,000원)</option>
<option value="43700">28.0kg(43,700원)</option>
<option value="44400">28.5kg(44,400원)</option>
<option value="45100">29.0kg(45,100원)</option>
<option value="45800">29.5kg(45,800원)</option>
<option value="46500">30.0kg(46,500원)</option>
<option value="47200">30.5kg(47,200원)</option>
<option value="47900">31.0kg(47,900원)</option>
<option value="48600">31.5kg(48,600원)</option>
<option value="49300">32.0kg(49,300원)</option>
<option value="50000">32.5kg(50,000원)</option>
<option value="50700">33.0kg(50,700원)</option>
<option value="51400">33.5kg(51,400원)</option>
<option value="52100">34.0kg(52,100원)</option>
<option value="52800">34.5kg(52,800원)</option>
<option value="53500">35.0kg(53,500원)</option>
<option value="54200">35.5kg(54,200원)</option>
<option value="54900">36.0kg(54,900원)</option>
<option value="55600">36.5kg(55,600원)</option>
<option value="56300">37.0kg(56,300원)</option>
<option value="57000">37.5kg(57,000원)</option>
<option value="57700">38.0kg(57,700원)</option>
<option value="58400">38.5kg(58,400원)</option>
<option value="59100">39.0kg(59,100원)</option>
<option value="59800">39.5kg(59,800원)</option>
<option value="60500">40.0kg(60,500원)</option>
<option value="61200">40.5kg(61,200원)</option>
<option value="61900">41.0kg(61,900원)</option>
<option value="62600">41.5kg(62,600원)</option>
<option value="63300">42.0kg(63,300원)</option>
<option value="64000">42.5kg(64,000원)</option>
<option value="64700">43.0kg(64,700원)</option>
<option value="65400">43.5kg(65,400원)</option>
<option value="66100">44.0kg(66,100원)</option>
<option value="66800">44.5kg(66,800원)</option>
<option value="67500">45.0kg(67,500원)</option>
<option value="68200">45.5kg(68,200원)</option>
<option value="68900">46.0kg(68,900원)</option>
<option value="69600">46.5kg(69,600원)</option>
<option value="70300">47.0kg(70,300원)</option>
<option value="71000">47.5kg(71,000원)</option>
<option value="71700">48.0kg(71,700원)</option>
<option value="72400">48.5kg(72,400원)</option>
<option value="73100">49.0kg(73,100원)</option>
<option value="73800">49.5kg(73,800원)</option>
<option value="74500">50.0kg(74,500원)</option>
</select>
					  </td>
                    </tr>
					<tr style="background-color:red; color:#fff;">
                      <td  scope="row" style="text-align:center; color:#fff;"><b>순수익</b></th>
                      <td style="text-align:right; color:#fff;">약 <span id="priceResult">0</span>원</td>
                    </tr>


                  </tbody>
                </table>
              </div>
      <!-- GRID E-->

   <!-- 하단 버튼 S-->
  
   <div class="bottom_bu_area mt5">
	<ul>
		<li><a href="javascript:;" class="button03" onclick="sendform();">계산</a></li>
		<li><a href="javascript:" class="button03_1" onclick="window.close();">닫기</a></li>
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

$( document ).ready(function() {

    $("input:text[numberOnly]").on("keyup", function() {
		$(this).val($(this).val().replace(/[^0-9.\\-]/g,""));
	});

});


function sendform(){

	var naverPrice=parseInt($("#naverPrice").val());
	var naverSendFee=parseInt($("#naverSendFee").val());
	var naverFee=$("#naverFee").val();
	var tPrice=$("#tprice").val();
	var tFee=$("#tFee").val();
	var tSendFee=parseInt($("#tSendFee option:selected").val());

	if(!naverPrice){
		alert('네이버판매가를 입력하세요');
		return;
	}

	if(!tPrice){
		alert('타오바오구매가를 입력하세요');
		return;
	}

	var yen=<?=$cny?>;
//	var nstep1=naverPrice+naverSendFee;
	var nstep1=naverPrice;
	var nstep2=nstep1-(nstep1*(naverFee/100));
	var nstep2=nstep2+naverSendFee;
	console.log(nstep2);
	var tstep1=tPrice*yen;
	//console.log("e:"+tSendFee);
	//console.log(tstep1);
	var tstep2=tstep1+(tstep1*(tFee/100))+tSendFee;
	console.log(tstep2);
	var price=nstep2-tstep2;

	$("#priceResult").text(price.toFixed(2));

}

</script>

