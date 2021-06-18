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
<option value="5700">1.5kg(5,700원)</option>
<option value="6300">2.0kg(6,300원)</option>
<option value="6900">2.5kg(6,900원)</option>
<option value="7500">3.0kg(7,500원)</option>
<option value="8100">3.5kg(8,100원)</option>
<option value="8700">4.0kg(8,700원)</option>
<option value="9300">4.5kg(9,300원)</option>
<option value="9900">5.0kg(9,900원)</option>
<option value="10500">5.5kg(10,500원)</option>
<option value="11100">6.0kg(11,100원)</option>
<option value="11700">6.5kg(11,700원)</option>
<option value="12300">7.0kg(12,300원)</option>
<option value="12900">7.5kg(12,900원)</option>
<option value="13500">8.0kg(13,500원)</option>
<option value="14100">8.5kg(14,100원)</option>
<option value="14700">9.0kg(14,700원)</option>
<option value="15300">9.5kg(15,300원)</option>
<option value="15900">10.0kg(15,900원)</option>
<option value="16500">10.5kg(16,500원)</option>
<option value="17100">11.0kg(17,100원)</option>
<option value="17700">11.5kg(17,700원)</option>
<option value="18300">12.0kg(18,300원)</option>
<option value="18900">12.5kg(18,900원)</option>
<option value="19500">13.0kg(19,500원)</option>
<option value="20100">13.5kg(20,100원)</option>
<option value="20700">14.0kg(20,700원)</option>
<option value="21300">14.5kg(21,300원)</option>
<option value="21900">15.0kg(21,900원)</option>
<option value="22500">15.5kg(22,500원)</option>
<option value="23100">16.0kg(23,100원)</option>
<option value="23700">16.5kg(23,700원)</option>
<option value="24300">17.0kg(24,300원)</option>
<option value="24900">17.5kg(24,900원)</option>
<option value="25500">18.0kg(25,500원)</option>
<option value="26100">18.5kg(26,100원)</option>
<option value="26700">19.0kg(26,700원)</option>
<option value="27300">19.5kg(27,300원)</option>
<option value="27900">20.0kg(27,900원)</option>
<option value="28500">20.5kg(28,500원)</option>
<option value="29100">21.0kg(29,100원)</option>
<option value="29700">21.5kg(29,700원)</option>
<option value="30300">22.0kg(30,300원)</option>
<option value="30900">22.5kg(30,900원)</option>
<option value="31500">23.0kg(31,500원)</option>
<option value="32100">23.5kg(32,100원)</option>
<option value="32700">24.0kg(32,700원)</option>
<option value="33300">24.5kg(33,300원)</option>
<option value="33900">25.0kg(33,900원)</option>
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

