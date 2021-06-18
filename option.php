<?php session_start();
include $_SERVER["DOCUMENT_ROOT"]."/inc/dbcon.php";

error_reporting(E_ALL);
ini_set('display_errors', TRUE);
ini_set('display_startup_errors', TRUE);

$que="select * , a.price as myPrice, b.price as itemPrice 
	from myItem a, taobao b where a.pnum=b.num and a.num='20'";

//	echo $que;
	$result = $mysqli->query($que) or die("3:".$mysqli->error);
	$rs = $result->fetch_object();

	$optionList=urldecode($rs->optionList);
	$optionList=json_decode($optionList);

	$optionValue=urldecode($rs->optionValue);
	$optionValue=json_decode($optionValue);

	echo "<pre>";
	print_r($optionList);
	print_r($optionValue);

?>