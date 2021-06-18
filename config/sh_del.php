<?php session_start();

include $_SERVER["DOCUMENT_ROOT"]."/inc/dbcon.php";

$STORE_PROPERTY_SEQ=$_GET['STORE_PROPERTY_SEQ'];


$que="delete from store_property  
where STORE_PROPERTY_SEQ='".$STORE_PROPERTY_SEQ."'";

$sql=$mysqli->query($que) or die($mysqli->error);

if($sql){
	location_is('','','삭제했습니다.');
}else{
	location_is('','','디비입력에 실패했습니다. 다시 입력해주십시오.');
}

?>

