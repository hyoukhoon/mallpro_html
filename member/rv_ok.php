<?php session_start();

include $_SERVER["DOCUMENT_ROOT"]."/inc/dbcon.php";

$RETAILER_CODE=$_POST['RETAILER_CODE'];
$STS_CODE=$_POST['STS_CODE'];
$CORPORATE_PERSONAL=$_POST['CORPORATE_PERSONAL'];

	$que="update retailer set 
	STS_CODE='$STS_CODE',
	CORPORATE_PERSONAL='$CORPORATE_PERSONAL' 
	where RETAILER_CODE='".$RETAILER_CODE."'";


$sql=$mysqli->query($que) or die($mysqli->error);

if($sql){
	location_is_close('입력했습니다.');
}else{
	location_is('','','디비입력에 실패했습니다. 다시 입력해주십시오.');
}

?>

