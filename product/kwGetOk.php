<?php session_start();
include $_SERVER["DOCUMENT_ROOT"]."/inc/dbcon.php";


$uid=$_SESSION['AID'];
$myLevel=$_SESSION['AMLEVEL'];
$snum=$_POST['snum'];

$que2="SELECT count(1) FROM taobao WHERE uid='$uid' and snum='$snum' and gubun='1'";
$result2 = $mysqli->query($que2);
$rs2 = $result2->fetch_array();
$searchCnt=$rs2[0];

$que="SELECT count(1) FROM taobao WHERE uid='$uid' and snum='$snum' and gubun='0'";
$result = $mysqli->query($que);
$rs = $result->fetch_array();


	$data=array("searchCnt"=>$searchCnt,"val"=>$rs[0]);
	echo json_encode($data);

?>