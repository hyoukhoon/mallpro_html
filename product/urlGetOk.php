<?php session_start();
include $_SERVER["DOCUMENT_ROOT"]."/inc/dbcon.php";


$uid=$_SESSION['AID'];
$myLevel=$_SESSION['AMLEVEL'];
$pid=$_POST['pid'];

$ok=0;
while($ok<1){

	$que="SELECT count(1) FROM taobao WHERE uid='".$uid."' and pid = '".$pid."' and gubun='0' and isDisplay='1'";
	$result = $mysqli->query($que);
	$rs = $result->fetch_array();


	if($rs[0]){
		$ok=1;
	}else{
		$ok=0;
	}

}

$data=array("result"=>1,"val"=>1);
echo json_encode($data);

?>