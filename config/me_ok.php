<?php session_start();

include $_SERVER["DOCUMENT_ROOT"]."/inc/dbcon.php";

$MATR_CODE=removeHackTag($_POST['MATR_CODE']);
$CODE_NAME=removeHackTag($_POST['CODE_NAME']);
$MATR_NAME=removeHackTag($_POST['MATR_NAME']);
$MATR_NAME_EN=removeHackTag($_POST['MATR_NAME_EN']);
$MATR_NAME_CH=removeHackTag($_POST['MATR_NAME_CH']);
$DESCRIPTION=removeHackTag(addslashes($_POST['DESCRIPTION']));


$que="update material_code set 
CODE_NAME='$CODE_NAME',
MATR_NAME='$MATR_NAME',
MATR_NAME_EN='$MATR_NAME_EN',
MATR_NAME_CH='$MATR_NAME_CH',
DESCRIPTION='$DESCRIPTION' 
where MATR_CODE='".$MATR_CODE."'";

$sql=$mysqli->query($que) or die($mysqli->error);

if($sql){
	location_is_close('수정했습니다.');
}else{
	location_is('','','디비입력에 실패했습니다. 다시 입력해주십시오.');
}

?>

