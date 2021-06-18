<?php session_start();

include $_SERVER["DOCUMENT_ROOT"]."/inc/dbcon.php";

$APP_VERSION_SEQ=$_GET['APP_VERSION_SEQ'];


$que="delete from app_version  
where APP_VERSION_SEQ='".$APP_VERSION_SEQ."'";

$sql=$mysqli->query($que) or die($mysqli->error);

if($sql){
	location_is('','','삭제했습니다.');
}else{
	location_is('','','디비입력에 실패했습니다. 다시 입력해주십시오.');
}

?>

