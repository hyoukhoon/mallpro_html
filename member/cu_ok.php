<?php session_start();

include $_SERVER["DOCUMENT_ROOT"]."/inc/dbcon.php";

$mode=$_POST['mode'];
$SELLER_CODE=$_POST['SELLER_CODE'];
$CONTRACT_ID=$_POST['CONTRACT_ID'];
$CONTRACT_DATE=$_POST['CONTRACT_DATE'];
$SERVICE_ID=$_POST['SERVICE_ID'];
$STIPULATED_TIME=$_POST['STIPULATED_TIME'];
$SERVICE_START_DATE=$_POST['SERVICE_START_DATE'];
$SERVICE_END_DATE=$_POST['SERVICE_END_DATE'];


$que1="select * 
	from service_product where SERVICE_ID='".$SERVICE_ID."'";
	$result1 = $mysqli->query($que1) or die($mysqli->error);
	$rs1 = $result1->fetch_object();
	$PRICE=$rs1->price;

if($mode=="edit"){

	$STS_CODE=0;//0:사용
	$que="update contract set 
	CONTRACT_DATE='$CONTRACT_DATE',
	SERVICE_ID='$SERVICE_ID',
	STIPULATED_TIME='$STIPULATED_TIME',
	SERVICE_START_DATE='$SERVICE_START_DATE',
	SERVICE_END_DATE='$SERVICE_END_DATE',
	PRICE='$PRICE',
	SELLER_CODE='$SELLER_CODE',
	STS_CODE='$STS_CODE',
	UPDATE_DATE=now() where CONTRACT_ID='".$CONTRACT_ID."'";


}else{

	$STS_CODE=0;//0:사용
	$que="insert into contract values ('',
	'$CONTRACT_DATE',
	'$SERVICE_ID',
	'$STIPULATED_TIME',
	'$SERVICE_START_DATE',
	'$SERVICE_END_DATE',
	'$PRICE',
	'$SELLER_CODE',
	'$STS_CODE',
	now(),
	now())";

}

$sql=$mysqli->query($que) or die($mysqli->error);

if($sql){
	location_is_close('입력했습니다.');
}else{
	location_is('','','디비입력에 실패했습니다. 다시 입력해주십시오.');
}

?>

