<?php session_start();

include $_SERVER["DOCUMENT_ROOT"]."/inc/dbcon.php";

$MATR_CODE=$_GET['MATR_CODE'];


$que="delete from material_code  
where MATR_CODE='".$MATR_CODE."'";

$sql=$mysqli->query($que) or die($mysqli->error);

if($sql){
	location_is('','','삭제했습니다.');
}else{
	location_is('','','디비입력에 실패했습니다. 다시 입력해주십시오.');
}

?>

