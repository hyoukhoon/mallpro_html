<?php session_start();

include $_SERVER["DOCUMENT_ROOT"]."/inc/dbcon.php";

$ID=$_GET['ID'];


$que="delete from mediapic_user  
where ID='".$ID."'";

$sql=$mysqli->query($que) or die($mysqli->error);

if($sql){
	location_is('','','삭제했습니다.');
}else{
	location_is('','','디비입력에 실패했습니다. 다시 입력해주십시오.');
}

?>

