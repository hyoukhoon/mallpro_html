<?php session_start();

include $_SERVER["DOCUMENT_ROOT"]."/inc/dbcon.php";


$jsonCheck=$_POST['jsonCheck'];
$uid=$_SESSION['AID'];
$itemNum=json_decode($jsonCheck);

foreach($itemNum as $i){

		$query="update taobao set gubun='2' where uid='$uid' and num='$i'";
		$sql = $mysqli->query($query) or die($mysqli->error);

}

$data=array("result"=>1,"val"=>"처리했습니다.");

echo json_encode($data);


?>