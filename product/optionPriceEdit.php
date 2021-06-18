<?php session_start();
include $_SERVER["DOCUMENT_ROOT"]."/inc/dbcon.php";

if(!$_SESSION['AID']){
	location_is_close('로그인이 필요한 메뉴입니다.');
	exit;
}

$uid=$_SESSION['AID'];
$num=$_GET['num'];
$cny=cnyIs();
//$num="7436";
$que="select if(a.promoPrice,a.promoPrice,a.price) as price, b.price as myprice, optionCount from taobao a, myItem b where a.num=b.pnum and a.num='".$num."'";
//echo $que."<br>";
$result = $mysqli->query($que) or die("2:".$mysqli->error);
$rs = $result->fetch_array();

$pp=explode("-",$rs[0]);
$priceCny=trim($pp[0]);
$priceCnyo=$priceCny*$cny;
$priceCnyo=ceil(($priceCnyo)/100)*100;
$optionCount=$rs[2];

if(!$rs[1]){
	$priceo=$priceCny*$cny;
	$priceo=ceil(($priceo)/100)*100;
}else{
	$priceo=$rs[1];
}

$que="select * from optiontable where pnum='".$num."'";
$result = $mysqli->query($que) or die("2:".$mysqli->error);
$rs = $result->fetch_object();
$opp=urldecode($rs->optionPromoPrice);

//echo "할인가:".$opp."<br>";

$opp=json_decode(str_replace("'","\"",$opp));
$optMixPrice=json_decode(urldecode($rs->optionMixPrice));

//echo "<pre>";
//print_r($optMixPrice);

if(!count($optMixPrice)){

		$optMix=array();
		$result2 = $mysqli->query("select * from optiontable where pnum='".$num."'") or die("725:".$mysqli->error);
		$rs2 = $result2->fetch_object();

		if($rs2->optionNum1!="%22%22"){
			$optionNum1=urldecode($rs2->optionNum1);
			$optionNum1=json_decode($optionNum1);
		}else{
			$optionNum1=array();
		}
		if($rs2->optionNum2!="%22%22"){
			$optionNum2=urldecode($rs2->optionNum2);
			$optionNum2=json_decode($optionNum2);
		}else{
			$optionNum2=array();
		}
		if($rs2->optionNum3!="%22%22"){
			$optionNum3=urldecode($rs2->optionNum3);
			$optionNum3=json_decode($optionNum3);
		}else{
			$optionNum3=array();
		}

		//echo "<pre>";
//		print_r($optionNum1);
//		print_r($optionNum2);
//		print_r($optionNum3);

//exit;
		$optValArray1=explode(",",$rs2->optionValue1);
		$optValArray2=explode(",",$rs2->optionValue2);
		$optValArray3=explode(",",$rs2->optionValue3);

//		print_r($optValArray1);
//		print_r($optValArray2);
//		print_r($optValArray3);

//exit;
		$optionPrice=urldecode($rs2->optionPrice);
		$optionPrice=json_decode($optionPrice);

		$optionPromoPrice=urldecode($rs2->optionPromoPrice);
		$optionPromoPrice=json_decode(str_replace("'","\"",$optionPromoPrice));
//		echo "<pre>";
		//print_r($optionPrice);
		//print_r($optionPromoPrice);

		//echo $optionCount;
		//exit;

		if($optionCount==3){

			$ii=0;
			$i=0;
			foreach($optionNum1 as $ot1){
				$j=0;
				foreach($optionNum2 as $ot2){
					$h=0;
					foreach($optionNum3 as $ot3){
						$k=";".$ot1.";".$ot2.";".$ot3.";";
						$skuId="";
						$optMix[$ii]["name"]=trim($optValArray1[$i])."+".trim($optValArray2[$j])."+".trim($optValArray3[$h]);
						$optMix[$ii]["price"]=$optionPrice->{$k}->price;
						$optMix[$ii]["pricek"]=($optionPrice->{$k}->price-$priceCny)*$cny;
						$skuId=$optionPrice->{$k}->skuId;
						//echo $optValArray1[$i]." + ".$optValArray2[$j]."-->".$skuId."<br>";
						if($optionPromoPrice->{$skuId}->quantity>0){
							$optMix[$ii]["promoPrice"]=$optionPromoPrice->{$skuId}->price->priceText;
							$optMix[$ii]["promoPricek"]=($optionPromoPrice->{$skuId}->price->priceText-$priceCny)*$cny;
						}else{
							$optMix[$ii]["promoPrice"]=-999900;
							$optMix[$ii]["promoPricek"]=-999900;
						}
						$h++;
						$ii++;
					}
					
					$j++;
					
					
				}
				$i++;
				
			}

		}else if($optionCount==2){

			$ii=0;
			$i=0;
			foreach($optionNum1 as $ot1){
				$j=0;
				foreach($optionNum2 as $ot2){

						$k=";".$ot1.";".$ot2.";";
						$skuId="";
						$optMix[$ii]["name"]=trim($optValArray1[$i])." + ".trim($optValArray2[$j]);
						$optMix[$ii]["price"]=$optionPrice->{$k}->price;
						$optMix[$ii]["pricek"]=($optionPrice->{$k}->price-$priceCny)*$cny;
						$skuId=$optionPrice->{$k}->skuId;
						//echo $optValArray1[$i]." + ".$optValArray2[$j]."-->".$skuId."<br>";
						if($optionPromoPrice->{$skuId}->quantity>0){
							$optMix[$ii]["promoPrice"]=$optionPromoPrice->{$skuId}->price->priceText;
							$optMix[$ii]["promoPricek"]=($optionPromoPrice->{$skuId}->price->priceText-$priceCny)*$cny;
						}else{
							$optMix[$ii]["promoPrice"]=-999900;
							$optMix[$ii]["promoPricek"]=-999900;
						}

					$ii++;
					$j++;
					
					
				}
				$i++;
				
			}
		}else if($optionCount==1){

			$ii=0;
			$i=0;
			foreach($optionNum1 as $ot1){

						$k=";".$ot1.";";
						$skuId="";
						$optMix[$ii]["name"]=trim($optValArray1[$i]);
						$optMix[$ii]["price"]=$optionPrice->{$k}->price;
						$optMix[$ii]["pricek"]=($optionPrice->{$k}->price-$priceCny)*$cny;
						$skuId=$optionPrice->{$k}->skuId;
						//echo $optValArray1[$i]." + ".$optValArray2[$j]."-->".$skuId."<br>";
						if($optionPromoPrice->{$skuId}->quantity>0){
							$optMix[$ii]["promoPrice"]=$optionPromoPrice->{$skuId}->price->priceText;
							$optMix[$ii]["promoPricek"]=($optionPromoPrice->{$skuId}->price->priceText-$priceCny)*$cny;
						}else{
							$optMix[$ii]["promoPrice"]=-999900;
							$optMix[$ii]["promoPricek"]=-999900;
						}

				$ii++;
				$i++;
				
			}
		}

	
	//echo "<pre>";
	//print_r($optMix);

//	exit;
		

}
//echo "<br><-----------------------------------><br>";
//echo "<pre>";
//print_r($optMix);
//exit;
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
     <li><span>옵션가격수정</span></li>
    </ul>
  </div>
  <!-- 상단 head로고 E-->
  
  <!-- 컨텐츠 S -->
  <div class="pop_content">
<div style="font-size:13px;color:blue;">
				1.옵션가는 기준가에서 +-한 값을 입력하셔야합니다.<br>
				2.옵션가중에는 반드시 0원이 있어야합니다.<br>
				3.옵션가는 기준가에서 -50%~+50%까지<br>
				4.빼고싶은 옵션은 삭제에 체크하세요
			  </div>
	  <!-- GRID S-->
              <div class="list_table_list01">
			  
                <table width="100%" border="0" >
                  <colgroup>
                  <col width="*"/>
                  <col width="140"/>
                  </colgroup>
                 
                  <tbody>
				  <thead>
                    <tr>
					  <th scope="col">옵션명</th>
                      <th scope="col">가격
						<select name="priceAuto" onchange="changePrice(this.value)">
							<option value="0">선택</option>
							<option value="-10">-10%</option>
							<option value="10">10%</option>
							<option value="20">20%</option>
							<option value="30">30%</option>
							<option value="40">40%</option>
							<option value="50">50%</option>
							<option value="60">60%</option>
							<option value="70">70%</option>
							<option value="80">80%</option>
							<option value="90">90%</option>
							<option value="100">100%</option>
							<option value="first">초기화</option>
						</select>
					  </th>
					  <th width="30">
						삭제
					  </th>


                    </tr>
                  </thead>
				  <tr style="background-color:red; color:#fff;">
                      <td  scope="row" style="text-align:center; color:#fff;"><b>기준가</b></th>
                      <td style="text-align:right; color:#fff;"><input type="text" numberOnly name="basicPrice" id="basicPrice" size="7"  style="text-align:right" value="<?echo $priceo?>">원</td>
					  <td></td>
                    </tr>
					<!-- <tr style="background-color:#ffa700; color:#fff;">
                      <td  scope="row" style="text-align:center; color:#fff;"><b>옵션가</b></th>
                      <td style="text-align:right; color:#fff;"><span id="bprice1"></span> ~ <span id="bprice2"></span></td>
					  <td></td>
                    </tr> -->

<?php
if(!count($optMixPrice)){

	$t=0;
	foreach($optMix as $p){
		$pricek=$p["promoPricek"]>0?$p["promoPricek"]:$p["pricek"];
		$promoPrice=$p["promoPrice"];

		$pricek=ceil($pricek/100)*100;
		$hiddenPrice=ceil(($promoPrice*$cny)/100)*100;
?>
					<input type="hidden" name="hiddenPrice_<?=$t?>" id="hiddenPrice" value="<?=$hiddenPrice?>">
					<tr>
                      <th class="color_ch" scope="row" style="text-align:center"><?echo $p["name"];?></th>
                      <td style="text-align:right;"><input type="text" numberOnly name="myPrice_<?=$t?>" id="myPrice" size="7"  style="text-align:right"  value="<?echo $pricek;?>" <?if($pricek==-999900){?>disabled<?}?>>원</td>
					  <td><input type="checkbox" name="priceDel_<?=$t?>" id="priceDel_<?=$t?>" value="1" onclick="delPrice('<?=$t?>')"></td>
                    </tr>
<?
	$t++;
	}
					
}else{
						
						$t=0;
						foreach($optMixPrice as $p){
							$pricek=$p->promoPricek>0?$p->promoPricek:$p->pricek;
							$promoPrice=$p->promoPrice;
							$pricek=ceil($pricek/100)*100;
							$hiddenPrice=ceil(($promoPrice*$cny)/100)*100;

							if($p->name){
						?>
					<input type="hidden" name="hiddenPrice_<?=$t?>" id="hiddenPrice" value="<?=$hiddenPrice?>">
					<tr>
                      <th class="color_ch" scope="row" style="text-align:center"><?echo $p->name;?></th>
                      <td style="text-align:right; color:#fff;"><input type="text" numberOnly name="myPrice_<?=$t?>" id="myPrice" style="text-align:right" size="7" value="<?echo $pricek;?>" <?if($pricek==-999900){?>disabled<?}?>>원</td>
					  <td><input type="checkbox" name="priceDel_<?=$t?>" id="priceDel_<?=$t?>" value="1" onclick="delPrice('<?=$t?>')"></td>
                    </tr>
<?
								$t++;
							}
						}
					}


if(!count($optMixPrice)){
					$optMix=urlencode(json_encode($optMix));
					$query="update optiontable set  optionMixPrice='$optMix' where pnum='".$num."'";
//					echo $query;
					$sql = $mysqli->query($query) or die($mysqli->error);
}

					?>



                  </tbody>
                </table>
              </div>
      <!-- GRID E-->

   <!-- 하단 버튼 S-->
  
   <div class="bottom_bu_area mt5">
	<ul style="width:300px;">
		<li><a href="javascript:;" class="button03" onclick="sendform();">저장</a></li>
		<li><a href="javascript:" class="button03_1" onclick="window.close();">취소</a></li>
		<li><a href="javascript:;" class="button03" onclick="resetPrice();">옵션초기화</a></li>
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
		$(this).val($(this).val().replace(/[^0-9\\-]/g,""));
	});

	var basicPrice=$("#basicPrice").val()/2;
	var bp1="-"+basicPrice;
	var bp2=basicPrice;
	$("#bprice1").text(bp1);
	$("#bprice2").text(bp2);


});



function delPrice(n){
//	console.log(n);
var pp=<?=$priceCnyo?>;
if($('input[name=priceDel_'+n+']').is(":checked") == true){
	$('input[name=myPrice_'+n+']').val('-999900');
	$('input[name=myPrice_'+n+']').attr("disabled",true);
}else{
	var hp=parseInt($('input:hidden[name=hiddenPrice_'+n+']').val());
	$('input[name=myPrice_'+n+']').val(hp-pp);
	$('input[name=myPrice_'+n+']').attr("disabled",false);
}

}


function changePrice(n){

	if(n=="first"){

			var cnt=0;
			var pp=<?=$priceCnyo?>;
			$('input:text[id="basicPrice"]').val(<?=$priceCnyo?>);
			$('input:text[id="myPrice"]').each(function() {
					var hp=parseInt($('input:hidden[id="hiddenPrice"]')[cnt].value);
					this.value=hp-pp;
					$(this).attr("disabled",false);
					cnt++;
			});

	}else{

		if(n>0){
			var an=n/100;
			var cnt=0;
			var priceo=parseInt($('input:text[id="basicPrice"]').val());
			priceo=priceo+(priceo*an)
			priceo=Math.ceil(priceo/100)*100;
			$('input:text[id="basicPrice"]').val(priceo);
/*
			$('input:text[id="myPrice"]').each(function() {
					var hp=parseInt(this.value);
					price=hp+(hp*an)
					this.value=Math.ceil(price/100)*100;
					cnt++;
			});
*/
		}else{
			var an=Math.abs(n)/100;
			var cnt=0;
			var priceo=$('input:text[id="basicPrice"]').val();
			priceo=priceo-(priceo*an)
			priceo=Math.ceil(priceo/100)*100;
			$('input:text[id="basicPrice"]').val(priceo);
/*
			$('input:text[id="myPrice"]').each(function() {
					var hp=this.value;
					price=hp-(hp*an)
					this.value=Math.ceil(price/100)*100;
					cnt++;
			});
*/
		}

	}

}



function sendform(){

	var total_cnt=0;
	var basicPrice=$('input:text[id="basicPrice"]').val();
	var myPriceArray=new Array();
	$('input:text[id="myPrice"]').each(function() {
//			console.log(this.value);
			myPriceArray[total_cnt]=this.value;//배열로 저장
			total_cnt++;
	});

	if(basicPrice<=0){
		alert('기준가는 0이상이어야합니다.');
		return;
	}

	var myPriceJson = encodeURIComponent(JSON.stringify(myPriceArray));//json으로 바꿈

		var params = "num=<?=$num?>&myPriceJson="+myPriceJson+"&basicPrice="+basicPrice;
//		console.log(params);

		$.ajax({
			  type: 'post'
			, url: 'optionPriceOk.php'
			,data : params
			, dataType : 'json'
			, success: function(data) {
//				console.log(data.val);

				if(data.result==1){
					alert(data.val);
					window.close();
					opener.location.reload();
				}else if(data.result==-1){
					alert(data.val);
					return;
				}else if(data.result==-3){
					alert(data.val);
					return;
				}else{
					alert('다시 시도해 주십시오.');
					return;
				}
			  }
		});	

}

function resetPrice(){

		if(!confirm('제품의 옵션과 가격을 원래 상태로 되돌립니다. 진행하시겠습니까?')){
			return;
		}

		var params = "num=<?=$num?>";

		$.ajax({
			  type: 'post'
			, url: 'resetPrice.php'
			,data : params
			, dataType : 'json'
			, success: function(data) {
//				console.log(data.val);

				if(data.result==1){
					alert(data.val);
					location.reload();
				}else if(data.result==-1){
					alert(data.val);
					return;
				}else if(data.result==-3){
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

