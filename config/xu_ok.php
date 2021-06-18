<?php session_start();

include $_SERVER["DOCUMENT_ROOT"]."/inc/dbcon.php";

$USD=$_POST['USD'];
$JPY=$_POST['JPY'];
$CNY=$_POST['CNY'];
$EUR=$_POST['EUR'];


$IS_USE=0;//사용:0, 미사용:1
$que="insert into common_exchange_rate values ('','$USD','$JPY','$CNY','$EUR','$IS_USE',now(),now())";

$sql=$mysqli->query($que) or die($mysqli->error);

if($sql){
	location_is_close('입력했습니다.');
}else{
	location_is('','','디비입력에 실패했습니다. 다시 입력해주십시오.');
}

?>

