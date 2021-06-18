<?php session_start();
include $_SERVER["DOCUMENT_ROOT"]."/inc/dbcon.php";

//ini_set('display_errors', 1);
//ini_set('display_startup_errors', 1);
//error_reporting(E_ALL);

$uid=$_SESSION['AID'];

$num=$_POST["num"];
$basicPrice=$_POST["basicPrice"];
$myPriceJson=urldecode($_POST['myPriceJson']);
$myPrice=json_decode($myPriceJson);


		$optMix=array();
		$result2 = $mysqli->query("select * from optiontable where pnum='".$num."'") or die("725:".$mysqli->error);
		$rs2 = $result2->fetch_object();

		$optionMixPrice=$rs2->optionMixPrice;
		$arrayPrice=json_decode(urldecode($optionMixPrice));

		$j=0;
		$topPrice=0;
		foreach($arrayPrice as $ap){
			$optMix[$j]["name"]=$ap->name;
			$optMix[$j]["price"]=$ap->price;
			$optMix[$j]["pricek"]=$myPrice[$j];
			$optMix[$j]["promoPrice"]=$ap->promoPrice;
			$optMix[$j]["promoPricek"]=$myPrice[$j];
			if($topPrice<$myPrice[$j])$topPrice=$myPrice[$j];
			$j++;
		}

		if(($topPrice*2)>$basicPrice){

			$data=array("result"=>-1,"val"=>"제품 기준가는 옵션가의 최고값보다 2배이상 커야합니다.");
			echo json_encode($data);
			exit;

		}



		$optMix=urlencode(json_encode($optMix));
		$query1="update optiontable set  optionMixPrice='$optMix' where pnum='".$num."'";
		$sql = $mysqli->query($query1) or die($mysqli->error);

		$query="update myItem set  price='$basicPrice' where pnum='".$num."'";
		$sql = $mysqli->query($query) or die($mysqli->error);



		$data=array("result"=>1,"val"=>"등록했습니다.");
		echo json_encode($data);


?>