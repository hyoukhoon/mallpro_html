<?php session_start();

include $_SERVER["DOCUMENT_ROOT"]."/inc/dbcon.php";

//ini_set('display_errors', 1);
//ini_set('display_startup_errors', 1);
//error_reporting(E_ALL);

/*
if(!$_SESSION['AAUTH']){
	$data=array("result"=>-1,"val"=>"유료회원전용서비스입니다.");
	echo json_encode($data);
	exit;
}

if(!$_SESSION['AMLEVEL']){
	$data=array("result"=>-1,"val"=>"유료회원전용서비스입니다.");
	echo json_encode($data);
	exit;
}
*/

$jsonCheck=$_POST['jsonCheck'];
$uid=$_SESSION['AID'];
$itemNum=json_decode($jsonCheck);



foreach($itemNum as $i){

	$uniqueId=$uid.$i.time();
	$uniqueId=hash('sha512',$uniqueId);

		$query="update taobao set isDisplay='0', uniqueId='$uniqueId' where uid='$uid' and num='$i'";

//		$data=array("result"=>1,"val"=>$query);
//		echo json_encode($data);
//		exit;

		$sql = $mysqli->query($query) or die($mysqli->error);

}

$data=array("result"=>1,"val"=>"처리했습니다.");

echo json_encode($data);


?>