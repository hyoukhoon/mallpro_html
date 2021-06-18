<?php session_start();
include $_SERVER["DOCUMENT_ROOT"]."/inc/dbcon.php";

//ini_set('display_errors', 1);
//ini_set('display_startup_errors', 1);
//error_reporting(E_ALL);

$uid=$_SESSION['AID'];

$num=$_POST["num"];
$basicPrice=$_POST["basicPrice"];
$optionType=$_POST["optionType"];
$optionCount=$_POST["optionCount"];

$myPriceJson=rawurldecode($_POST['myPriceJson']);
$myPrice=json_decode($myPriceJson);

$optMixArray=rawurldecode($_POST['optMixArray']);
$omArray=json_decode($optMixArray);

//echo $num."<br>";
//echo $basicPrice."<br>";
//echo $optionType."<br>";
//echo $optionCount."<br>";
//echo $myPriceJson."<br>";
//echo $optMixArray."<br>";


		$j=0;
		foreach($omArray as $ap){
			$optMix[$j]["name"]=$ap->name;
			$optMix[$j]["price"]=0;
			$optMix[$j]["pricek"]=$myPrice[$j];
			$optMix[$j]["promoPrice"]=0;
			$optMix[$j]["promoPricek"]=$myPrice[$j];
			$j++;
		}



		$optMix=urlencode(json_encode($optMix));
		$query1="update optiontable set  optionMixPrice='$optMix', isRegist='1' where pnum='".$num."'";
		$sql = $mysqli->query($query1) or die($mysqli->error);

		$query2="update myItem set  price='$basicPrice', noOption='1' where pnum='".$num."'";
		$sql = $mysqli->query($query2) or die($mysqli->error);

		$query3="update taobao set  optionType='$optionType' where num='".$num."'";
		$sql = $mysqli->query($query3) or die($mysqli->error);

//echo $query1."<br>";
//echo $query2."<br>";
//echo $query3."<br>";

//exit;


		$data=array("result"=>1,"val"=>"등록했습니다.");
		echo json_encode($data);


?>