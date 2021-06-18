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
                      <td style="text-align:right;"><input type="text" numberOnly name="naverFee" id="naverFee" size="7"  style="text-align:right"  value="5.74" >%</td>
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
<option value="5500">1.0kg이하(5,500원)</option>
<option value="6150">1.5kg(6,150원)</option>
<option value="6800">2.0kg(6,800원)</option>
<option value="7450">2.5kg(7,450원)</option>
<option value="8100">3.0kg(8,100원)</option>
<option value="8750">3.5kg(8,750원)</option>
<option value="9400">4.0kg(9,400원)</option>
<option value="10050">4.5kg(10,050원)</option>
<option value="10700">5.0kg(10,700원)</option>
<option value="11350">5.5kg(11,350원)</option>
<option value="12000">6.0kg(12,000원)</option>
<option value="12650">6.5kg(12,650원)</option>
<option value="13300">7.0kg(13,300원)</option>
<option value="13950">7.5kg(13,950원)</option>
<option value="14600">8.0kg(14,600원)</option>
<option value="15250">8.5kg(15,250원)</option>
<option value="15900">9.0kg(15,900원)</option>
<option value="16550">9.5kg(16,550원)</option>
<option value="17200">10.0kg(17,200원)</option>
<option value="17850">10.5kg(17,850원)</option>
<option value="18500">11.0kg(18,500원)</option>
<option value="19150">11.5kg(19,150원)</option>
<option value="19800">12.0kg(19,800원)</option>
<option value="20450">12.5kg(20,450원)</option>
<option value="21100">13.0kg(21,100원)</option>
<option value="21750">13.5kg(21,750원)</option>
<option value="22400">14.0kg(22,400원)</option>
<option value="23050">14.5kg(23,050원)</option>
<option value="23700">15.0kg(23,700원)</option>
<option value="24350">15.5kg(24,350원)</option>
<option value="25000">16.0kg(25,000원)</option>
<option value="25650">16.5kg(25,650원)</option>
<option value="26300">17.0kg(26,300원)</option>
<option value="26950">17.5kg(26,950원)</option>
<option value="27600">18.0kg(27,600원)</option>
<option value="28250">18.5kg(28,250원)</option>
<option value="28900">19.0kg(28,900원)</option>
<option value="29550">19.5kg(29,550원)</option>
<option value="30200">20.0kg(30,200원)</option>
<option value="30850">20.5kg(30,850원)</option>
<option value="31500">21.0kg(31,500원)</option>
<option value="32150">21.5kg(32,150원)</option>
<option value="32800">22.0kg(32,800원)</option>
<option value="33450">22.5kg(33,450원)</option>
<option value="34100">23.0kg(34,100원)</option>
<option value="34750">23.5kg(34,750원)</option>
<option value="35400">24.0kg(35,400원)</option>
<option value="36050">24.5kg(36,050원)</option>
<option value="36700">25.0kg(36,700원)</option>
<option value="37350">25.5kg(37,350원)</option>
<option value="38000">26.0kg(38,000원)</option>
<option value="38650">26.5kg(38,650원)</option>
<option value="39300">27.0kg(39,300원)</option>
<option value="39950">27.5kg(39,950원)</option>
<option value="40600">28.0kg(40,600원)</option>
<option value="41250">28.5kg(41,250원)</option>
<option value="41900">29.0kg(41,900원)</option>
<option value="42550">29.5kg(42,550원)</option>
<option value="43200">30.0kg(43,200원)</option>
<option value="43850">30.5kg(43,850원)</option>
<option value="44500">31.0kg(44,500원)</option>
<option value="45150">31.5kg(45,150원)</option>
<option value="45800">32.0kg(45,800원)</option>
<option value="46450">32.5kg(46,450원)</option>
<option value="47100">33.0kg(47,100원)</option>
<option value="47750">33.5kg(47,750원)</option>
<option value="48400">34.0kg(48,400원)</option>
<option value="49050">34.5kg(49,050원)</option>
<option value="49700">35.0kg(49,700원)</option>
<option value="50350">35.5kg(50,350원)</option>
<option value="51000">36.0kg(51,000원)</option>
<option value="51650">36.5kg(51,650원)</option>
<option value="52300">37.0kg(52,300원)</option>
<option value="52950">37.5kg(52,950원)</option>
<option value="53600">38.0kg(53,600원)</option>
<option value="54250">38.5kg(54,250원)</option>
<option value="54900">39.0kg(54,900원)</option>
<option value="55550">39.5kg(55,550원)</option>
<option value="56200">40.0kg(56,200원)</option>
<option value="56850">40.5kg(56,850원)</option>
<option value="57500">41.0kg(57,500원)</option>
<option value="58150">41.5kg(58,150원)</option>
<option value="58800">42.0kg(58,800원)</option>
<option value="59450">42.5kg(59,450원)</option>
<option value="60100">43.0kg(60,100원)</option>
<option value="60750">43.5kg(60,750원)</option>
<option value="61400">44.0kg(61,400원)</option>
<option value="62050">44.5kg(62,050원)</option>
<option value="62700">45.0kg(62,700원)</option>
<option value="63350">45.5kg(63,350원)</option>
<option value="64000">46.0kg(64,000원)</option>
<option value="64650">46.5kg(64,650원)</option>
<option value="65300">47.0kg(65,300원)</option>
<option value="65950">47.5kg(65,950원)</option>
<option value="66600">48.0kg(66,600원)</option>
<option value="67250">48.5kg(67,250원)</option>
<option value="67900">49.0kg(67,900원)</option>
<option value="68550">49.5kg(68,550원)</option>
<option value="69200">50.0kg(69,200원)</option>
<option value="69850">50.5kg(69,850원)</option>
<option value="70500">51.0kg(70,500원)</option>
<option value="71150">51.5kg(71,150원)</option>
<option value="71800">52.0kg(71,800원)</option>
<option value="72450">52.5kg(72,450원)</option>
<option value="73100">53.0kg(73,100원)</option>
<option value="73750">53.5kg(73,750원)</option>
<option value="74400">54.0kg(74,400원)</option>
<option value="75050">54.5kg(75,050원)</option>
<option value="75700">55.0kg(75,700원)</option>
<option value="76350">55.5kg(76,350원)</option>
<option value="77000">56.0kg(77,000원)</option>
<option value="77650">56.5kg(77,650원)</option>
<option value="78300">57.0kg(78,300원)</option>
<option value="78950">57.5kg(78,950원)</option>
<option value="79600">58.0kg(79,600원)</option>
<option value="80250">58.5kg(80,250원)</option>
<option value="80900">59.0kg(80,900원)</option>
<option value="81550">59.5kg(81,550원)</option>
<option value="82200">60.0kg(82,200원)</option>
<option value="82850">60.5kg(82,850원)</option>
<option value="83500">61.0kg(83,500원)</option>
<option value="84150">61.5kg(84,150원)</option>
<option value="84800">62.0kg(84,800원)</option>
<option value="85450">62.5kg(85,450원)</option>
<option value="86100">63.0kg(86,100원)</option>
<option value="86750">63.5kg(86,750원)</option>
<option value="87400">64.0kg(87,400원)</option>
<option value="88050">64.5kg(88,050원)</option>
<option value="88700">65.0kg(88,700원)</option>
<option value="89350">65.5kg(89,350원)</option>
<option value="90000">66.0kg(90,000원)</option>
<option value="90650">66.5kg(90,650원)</option>
<option value="91300">67.0kg(91,300원)</option>
<option value="91950">67.5kg(91,950원)</option>
<option value="92600">68.0kg(92,600원)</option>
<option value="93250">68.5kg(93,250원)</option>
<option value="93900">69.0kg(93,900원)</option>
<option value="94550">69.5kg(94,550원)</option>
<option value="95200">70.0kg(95,200원)</option>
<option value="95850">70.5kg(95,850원)</option>
<option value="96500">71.0kg(96,500원)</option>
<option value="97150">71.5kg(97,150원)</option>
<option value="97800">72.0kg(97,800원)</option>
<option value="98450">72.5kg(98,450원)</option>
<option value="99100">73.0kg(99,100원)</option>
<option value="99750">73.5kg(99,750원)</option>
<option value="100400">74.0kg(100,400원)</option>
<option value="101050">74.5kg(101,050원)</option>
<option value="101700">75.0kg(101,700원)</option>
<option value="102350">75.5kg(102,350원)</option>
<option value="103000">76.0kg(103,000원)</option>
<option value="103650">76.5kg(103,650원)</option>
<option value="104300">77.0kg(104,300원)</option>
<option value="104950">77.5kg(104,950원)</option>
<option value="105600">78.0kg(105,600원)</option>
<option value="106250">78.5kg(106,250원)</option>
<option value="106900">79.0kg(106,900원)</option>
<option value="107550">79.5kg(107,550원)</option>
<option value="108200">80.0kg(108,200원)</option>
<option value="108850">80.5kg(108,850원)</option>
<option value="109500">81.0kg(109,500원)</option>
<option value="110150">81.5kg(110,150원)</option>
<option value="110800">82.0kg(110,800원)</option>
<option value="111450">82.5kg(111,450원)</option>
<option value="112100">83.0kg(112,100원)</option>
<option value="112750">83.5kg(112,750원)</option>
<option value="113400">84.0kg(113,400원)</option>
<option value="114050">84.5kg(114,050원)</option>
<option value="114700">85.0kg(114,700원)</option>
<option value="115350">85.5kg(115,350원)</option>
<option value="116000">86.0kg(116,000원)</option>
<option value="116650">86.5kg(116,650원)</option>
<option value="117300">87.0kg(117,300원)</option>
<option value="117950">87.5kg(117,950원)</option>
<option value="118600">88.0kg(118,600원)</option>
<option value="119250">88.5kg(119,250원)</option>
<option value="119900">89.0kg(119,900원)</option>
<option value="120550">89.5kg(120,550원)</option>
<option value="121200">90.0kg(121,200원)</option>
<option value="121850">90.5kg(121,850원)</option>
<option value="122500">91.0kg(122,500원)</option>
<option value="123150">91.5kg(123,150원)</option>
<option value="123800">92.0kg(123,800원)</option>
<option value="124450">92.5kg(124,450원)</option>
<option value="125100">93.0kg(125,100원)</option>
<option value="125750">93.5kg(125,750원)</option>
<option value="126400">94.0kg(126,400원)</option>
<option value="127050">94.5kg(127,050원)</option>
<option value="127700">95.0kg(127,700원)</option>
<option value="128350">95.5kg(128,350원)</option>
<option value="129000">96.0kg(129,000원)</option>
<option value="129650">96.5kg(129,650원)</option>
<option value="130300">97.0kg(130,300원)</option>
<option value="130950">97.5kg(130,950원)</option>
<option value="131600">98.0kg(131,600원)</option>
<option value="132250">98.5kg(132,250원)</option>
<option value="132900">99.0kg(132,900원)</option>
<option value="133550">99.5kg(133,550원)</option>
<option value="134200">100.0kg(134,200원)</option>
<option value="134850">100.5kg(134,850원)</option>

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

