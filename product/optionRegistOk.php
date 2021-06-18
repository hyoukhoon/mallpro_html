<?php session_start();
include $_SERVER["DOCUMENT_ROOT"]."/inc/dbcon.php";

//ini_set('display_errors', 1);
//ini_set('display_startup_errors', 1);
//error_reporting(E_ALL);

$uid=$_SESSION['AID'];

$num=$_POST["num"];
$optionType=$_POST["optionType"];

//$optionNameJson="%5B%22%EC%BB%AC%EB%9F%AC%22%2C%22%EC%82%AC%EC%9D%B4%EC%A6%88%22%2C%22%EB%AA%A8%EC%96%91%22%5D";
$optionNameJson=urldecode($_POST['optionNameJson']);
$optionName=json_decode($optionNameJson);

//$optionValueJson="%5B%22%EB%B8%94%EB%A3%A8%2C%EB%A0%88%EB%93%9C%2C%ED%99%94%EC%9D%B4%ED%8A%B8%22%2C%22%EB%8C%80%2C%EC%A4%91%2C%EC%86%8C%22%2C%22%EC%82%AC%EA%B0%81%2C%EC%82%BC%EA%B0%81%22%5D";
$optionValueJson=urldecode($_POST['optionValueJson']);
$optionValue=json_decode($optionValueJson);

//echo "<pre>";
//print_r($optionValue);


		$optMix=array();
		$result2 = $mysqli->query("select * from optiontable where pnum='".$num."'") or die("725:".$mysqli->error);
		$rs2 = $result2->fetch_object();

		$optionCount=count($optionName);

		for($i=0;$i<$optionCount;$i++){
			$optVal[$i]=explode(",",$optionValue[$i]);
		}

//		print_r($optVal);



		
		$j=0;

if($optionCount==3){

		foreach($optVal[0] as $ov1){
			foreach($optVal[1] as $ov2){
				foreach($optVal[2] as $ov3){

					$optMix[$j]["name"]=$ov1."/".$ov2."/".$ov3;
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

						$optMix[$j]["name"]=$ov1."/".$ov2."/".$ov3."/".$ov4;
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

							$optMix[$j]["name"]=$ov1."/".$ov2."/".$ov3."/".$ov4."/".$ov5;
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

								$optMix[$j]["name"]=$ov1."/".$ov2."/".$ov3."/".$ov4."/".$ov5."/".$ov6;
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

//			print_r($optMix);
//exit;



		$optMix=urlencode(json_encode($optMix));
		$query1="update optiontable set  optionMixPrice='$optMix', isRegist='1' where pnum='".$num."'";
		$sql = $mysqli->query($query1) or die($mysqli->error);

		$query1="update taobao set  optionType='$optionType' where num='".$num."'";
		$sql = $mysqli->query($query1) or die($mysqli->error);

		$data=array("result"=>1,"val"=>"등록했습니다.");
		echo json_encode($data);


?>