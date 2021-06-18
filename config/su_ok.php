<?php session_start();

include $_SERVER["DOCUMENT_ROOT"]."/inc/dbcon.php";

$STORE_PROPERTY_SEQ=removeHackTag($_POST['STORE_PROPERTY_SEQ']);
$PROPERTY_NAME=removeHackTag($_POST['PROPERTY_NAME']);
$PROPERTY_NAME_EN=removeHackTag($_POST['PROPERTY_NAME_EN']);
$PROPERTY_NAME_CH=removeHackTag($_POST['PROPERTY_NAME_CH']);
$PROPERTY_DEL='0';

$IS_USE=0;//사용:0, 미사용:1
$que="insert into store_property values ('',
'$PROPERTY_NAME',
'$PROPERTY_NAME_EN',
'$PROPERTY_NAME_CH',
'$PROPERTY_DEL',
now(),
now())";

$sql=$mysqli->query($que) or die($mysqli->error);

if($sql){
	location_is_close('입력했습니다.');
}else{
	location_is('','','디비입력에 실패했습니다. 다시 입력해주십시오.');
}

?>

