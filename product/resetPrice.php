<?php session_start();
include $_SERVER["DOCUMENT_ROOT"]."/inc/dbcon.php";

//ini_set('display_errors', 1);
//ini_set('display_startup_errors', 1);
//error_reporting(E_ALL);

$uid=$_SESSION['AID'];
$num=$_POST["num"];
$optMix="";

$que="select * from taobao where num='".$num."'";
$result = $mysqli->query($que) or die("2:".$mysqli->error);
$rs = $result->fetch_object();

if($uid==$rs->uid){

		$query1="update optiontable set  optionMixPrice='$optMix' where pnum='".$num."'";
		$sql = $mysqli->query($query1) or die($mysqli->error);


		$data=array("result"=>1,"val"=>"초기화했습니다. 리로드합니다.");
		echo json_encode($data);

}else{

	$data=array("result"=>-1,"val"=>"본인이 등록한 제품만 초기화할 수 있습니다.");
	echo json_encode($data);

}


?>