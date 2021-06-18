<?php session_start();

include $_SERVER["DOCUMENT_ROOT"]."/inc/dbcon.php";

$email=$_GET['email'];
$SELLER_CODE=$_POST['SELLER_CODE'];
$CONTRACT_ID=$_POST['CONTRACT_ID'];
$CONTRACT_DATE=$_POST['CONTRACT_DATE'];
$SERVICE_ID=$_POST['SERVICE_ID'];
$STIPULATED_TIME=$_POST['STIPULATED_TIME'];
$SERVICE_START_DATE=$_POST['SERVICE_START_DATE'];
$SERVICE_END_DATE=$_POST['SERVICE_END_DATE'];


$que1="select count(*) 
	from member where email='".$email."'";
	$result1 = $mysqli->query($que1) or die($mysqli->error);
	$rs1 = $result1->fetch_array();

if(!$rs1[0]){

	location_is('','','존재하지 않는 이메일입니다.');

}else{

	$isAuth=1;
	$que="update member set isAuth='$isAuth' where email='".$email."'";
	$sql=$mysqli->query($que) or die($mysqli->error);
	location_is('/','','이메일 인증에 성공했습니다. 로그인 하십시오.');
}


?>

