<?php session_start();
include $_SERVER["DOCUMENT_ROOT"]."/inc/dbcon.php";

if(!$_SESSION['AID']){
	location_is_close('로그인이 필요한 메뉴입니다.');
	exit;
}

$uid=$_SESSION['AID'];
$num=$_GET['num'];
$optionType=$_GET["optionType"];


$optionNameJson=urldecode($_GET['optionNameJson']);
$optionName=json_decode($optionNameJson);

$optionValueJson=urldecode($_GET['optionValueJson']);
$optionValue=json_decode($optionValueJson);


//echo $optionType."<br>";
//echo $optionNameJson."<br>";
//echo $optionValueJson."<br>";


$que="select if(a.promoPrice,a.promoPrice,a.price) as price, b.price as myprice from taobao a, myItem b where a.num=b.pnum and a.num='".$num."'";
$result = $mysqli->query($que) or die("2:".$mysqli->error);
$rs = $result->fetch_array();

$pp=explode("-",$rs[0]);
$priceCny=trim($pp[0]);
$priceCnyo=$priceCny*$cny;
$priceCnyo=ceil(($priceCnyo)/100)*100;

if(!$rs[1]){
	$priceo=$priceCny*$cny;
	$priceo=ceil(($priceo)/100)*100;
}else{
	$priceo=$rs[1];
}

$optionCount=count($optionName);

for($i=0;$i<$optionCount;$i++){
	$optVal[$i]=explode(",",$optionValue[$i]);
}

$que="select * from optiontable where pnum='".$num."'";
$result = $mysqli->query($que) or die("2:".$mysqli->error);
$rs = $result->fetch_object();

$optMixPrice=json_decode(urldecode($rs->optionMixPrice));

		$optMix=array();

		if($optionCount==1){

				foreach($optVal[0] as $ov1){

							$optMix[$j]["name"]=$ov1;
							$optMix[$j]["price"]=0;
							$optMix[$j]["pricek"]=0;
							$optMix[$j]["promoPrice"]=0;
							$optMix[$j]["promoPricek"]=0;
						
						$j++;

				}

		}else if($optionCount==2){

				foreach($optVal[0] as $ov1){
					foreach($optVal[1] as $ov2){

							$optMix[$j]["name"]=$ov1."+".$ov2;
							$optMix[$j]["price"]=0;
							$optMix[$j]["pricek"]=0;
							$optMix[$j]["promoPrice"]=0;
							$optMix[$j]["promoPricek"]=0;
						
						$j++;

					}
				}

		}else if($optionCount==3){

				foreach($optVal[0] as $ov1){
					foreach($optVal[1] as $ov2){
						foreach($optVal[2] as $ov3){

							$optMix[$j]["name"]=$ov1."+".$ov2."+".$ov3;
							$optMix[$j]["price"]=0;
							$optMix[$j]["pricek"]=0;
							$optMix[$j]["promoPrice"]=0;
							$optMix[$j]["promoPricek"]=0;
						
						$j++;
						}
					}
				}

		}else if($optionCount==4){

			foreach($optVal[0] as $ov1){
					foreach($optVal[1] as $ov2){
						foreach($optVal[2] as $ov3){
							foreach($optVal[3] as $ov4){

								$optMix[$j]["name"]=$ov1."+".$ov2."+".$ov3."+".$ov4;
								$optMix[$j]["price"]=0;
								$optMix[$j]["pricek"]=0;
								$optMix[$j]["promoPrice"]=0;
								$optMix[$j]["promoPricek"]=0;
							$j++;
							}
						}
					}
				}

		}else if($optionCount==5){

			foreach($optVal[0] as $ov1){
					foreach($optVal[1] as $ov2){
						foreach($optVal[2] as $ov3){
							foreach($optVal[3] as $ov4){
								foreach($optVal[4] as $ov5){

									$optMix[$j]["name"]=$ov1."+".$ov2."+".$ov3."+".$ov4."+".$ov5;
									$optMix[$j]["price"]=0;
									$optMix[$j]["pricek"]=0;
									$optMix[$j]["promoPrice"]=0;
									$optMix[$j]["promoPricek"]=0;
								$j++;
								}
							}
						}
					}
				}

		}else if($optionCount==6){

			foreach($optVal[0] as $ov1){
					foreach($optVal[1] as $ov2){
						foreach($optVal[2] as $ov3){
							foreach($optVal[3] as $ov4){
								foreach($optVal[4] as $ov5){
									foreach($optVal[5] as $ov6){

										$optMix[$j]["name"]=$ov1."+".$ov2."+".$ov3."+".$ov4."+".$ov5."+".$ov6;
										$optMix[$j]["price"]=0;
										$optMix[$j]["pricek"]=0;
										$optMix[$j]["promoPrice"]=0;
										$optMix[$j]["promoPricek"]=0;
									$j++;
									}
								}
							}
						}
					}
				}

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
<title>Mediapic Back-office</title>
<link href="/css/dcg_tmall.css" rel="stylesheet" type="text/css" />
<script type="text/javascript" src="/js/jquery.min.js"></script>

</head>

<body class="bg_popup">

<!-- 전체 넓이 S-->
<div id="pop_wrap">
  <!-- 상단 head로고 S-->
  <div class="pop_top_bg">
    <ul>
     <li><span>옵션직접만들기 Step.2</span></li>
    </ul>
  </div>
  <!-- 상단 head로고 E-->
  
  <!-- 컨텐츠 S -->
  <div class="pop_content">
<div style="font-size:13px;color:blue;">
				1.옵션가는 기준가에서 +-한 값을 입력하셔야합니다.<br>
				2.옵션가중에는 반드시 0원이 있어야합니다.<br>
				3.옵션가는 기준가에서 -50%~+50%까지 입력하세요<br>
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
					  </th>

                    </tr>
                  </thead>
				  <tr style="background-color:red; color:#fff;">
                      <td  scope="row" style="text-align:center; color:#fff;"><b>기준가</b></th>
                      <td><input type="text" name="basicPrice" id="basicPrice" size="10"  style="text-align:right" value="<?echo $priceo?>">원</td>
                    </tr>

<?php
	foreach($optMix as $p){
		$pricek=$p["promoPricek"];
		$promoPrice=$p["promoPrice"];

		$pricek=ceil($pricek/100)*100;
		$hiddenPrice=ceil(($promoPrice*$cny)/100)*100;
?>
					<input type="hidden" name="hiddenPrice" id="hiddenPrice" value="<?=$hiddenPrice?>">
					<tr>
                      <th class="color_ch" scope="row" style="text-align:center"><?echo $p["name"];?></th>
                      <td><input type="text" name="myPrice" id="myPrice" size="10"  style="text-align:right"  value="<?echo $pricek;?>" <?if($optionType==1){?>disabled<?}?>>원</td>
                    </tr>
<?
	}

$optMixArray=urlencode(json_encode($optMix));

					?>



                  </tbody>
                </table>
              </div>
      <!-- GRID E-->

   <!-- 하단 버튼 S-->
  
   <div class="bottom_bu_area mt5">
	<ul>
		<li><a href="javascript:;" class="button03" onclick="sendform();">저장</a></li>
		<li><a href="javascript:reset();" class="button03_1">취소</a></li>
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

function changePrice(n){

	if(n=="first"){

			var cnt=0;
			var pp=<?=$priceCnyo?>;
			$('input:text[id="basicPrice"]').val(<?=$priceCnyo?>);
			$('input:text[id="myPrice"]').each(function() {
					var hp=parseInt($('input:hidden[id="hiddenPrice"]')[cnt].value);
					this.value=hp-pp;
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

			$('input:text[id="myPrice"]').each(function() {
					//var hp=parseInt($('input:hidden[id="hiddenPrice"]')[cnt].value);
					var hp=parseInt(this.value);
					price=hp+(hp*an)
					this.value=Math.ceil(price/100)*100;
					cnt++;
			});
		}else{
			var an=Math.abs(n)/100;
			var cnt=0;
			var priceo=$('input:text[id="basicPrice"]').val();
			priceo=priceo-(priceo*an)
			priceo=Math.ceil(priceo/100)*100;
			$('input:text[id="basicPrice"]').val(priceo);

			$('input:text[id="myPrice"]').each(function() {
					//var hp=parseInt($('input:hidden[id="hiddenPrice"]')[cnt].value);
					var hp=this.value;
					price=hp-(hp*an)
					this.value=Math.ceil(price/100)*100;
					cnt++;
			});
		}

	}

}



function sendform(){

	var total_cnt=0;
	var basicPrice=$('input:text[id="basicPrice"]').val();
	var myPriceArray=new Array();
	$('input:text[id="myPrice"]').each(function() {
			console.log(this.value);
			myPriceArray[total_cnt]=this.value;//배열로 저장
			total_cnt++;
	});

	var myPriceJson = encodeURIComponent(JSON.stringify(myPriceArray));//json으로 바꿈

		var params = "num=<?=$num?>&optionCount=<?=$optionCount?>&optionType=<?=$optionType?>&optMixArray=<?=$optMixArray?>&myPriceJson="+myPriceJson+"&basicPrice="+basicPrice;
		console.log(params);

		$.ajax({
			  type: 'post'
			, url: 'optionRegistNextOk.php'
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

</script>

