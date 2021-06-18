<?php session_start();
include $_SERVER["DOCUMENT_ROOT"]."/inc/dbcon.php";

$num=$_GET['num'];
$db=$_GET['db'];

$sql=$mysqli->query("delete from $db where num='$num'") or die($mysqli->error);

if($sql){
	location_is('/admin_area/allCashHistory.php','','삭제했습니다.');

}else{
	location_is('/admin_area/allCashHistory.php','','다시시도해주십시오.');
}

?>