<?php session_start();
include $_SERVER["DOCUMENT_ROOT"]."/inc/dbcon.php";

		$result2 = $mysqli->query("select * from optiontable where pnum='2325'") or die("725:".$mysqli->error);
		$rs2 = $result2->fetch_object();

		$optionValue1="白色";
		$optionValue2="공식 표준, 패키지 1, 패키지 2 ";
		$optValArray1=explode(",",$optionValue1);
		$optValArray2=explode(",",$optionValue2);
		$optMixArray=json_decode(urldecode($rs2->optionMixPrice));


				$i=0;
				$a=0;
				foreach($optValArray1 as $optv1){
					$b=0;
					foreach($optValArray2 as $optv2){
						$optMix[$i]["name"]=$optValArray1[$a]." + ".$optValArray2[$b];
						$optMix[$i]["price"]=$optMixArray[$i]->price;
						$optMix[$i]["pricek"]=$optMixArray[$i]->pricek;
						$optMix[$i]["promoPrice"]=$optMixArray[$i]->promoPrice;
						$optMix[$i]["promoPricek"]=$optMixArray[$i]->promoPricek;
						$b++;
						$i++;
					}
					$a++;

				
			}

echo "<Pre>";
print_r($optMix);


?>