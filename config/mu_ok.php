<?php session_start();

include $_SERVER["DOCUMENT_ROOT"]."/inc/dbcon.php";

$MATR_CODE=removeHackTag($_POST['MATR_CODE']);
$CODE_NAME=removeHackTag($_POST['CODE_NAME']);
$MATR_NAME=removeHackTag($_POST['MATR_NAME']);
$MATR_NAME_EN=removeHackTag($_POST['MATR_NAME_EN']);
$MATR_NAME_CH=removeHackTag($_POST['MATR_NAME_CH']);
$DESCRIPTION=removeHackTag(addslashes($_POST['DESCRIPTION']));

if(strlen($MATR_CODE)!=5){
	location_is('','','소재코드는 5자의 숫자로 이루어져야합니다.');
	exit;
}

$que3="select count(1) from material_code where MATR_CODE='".$MATR_CODE."'";
$result3 = $mysqli->query($que3) or die("1:".$mysqli->error);
$rs3 = $result3->fetch_array();
if($rs3[0]){
	location_is('','','이미 등록된 소재코드입니다. 소재코드를 변경하십시오.');
	exit;
}


$IS_USE=0;//사용:0, 미사용:1
$que="insert into material_code values ('$MATR_CODE',
'$CODE_NAME',
'$MATR_NAME',
'$MATR_NAME_EN',
'$MATR_NAME_CH',
'$DESCRIPTION',
now(),
now())";

$sql=$mysqli->query($que) or die($mysqli->error);

if($sql){
	location_is_close('입력했습니다.');
}else{
	location_is('','','디비입력에 실패했습니다. 다시 입력해주십시오.');
}

?>

