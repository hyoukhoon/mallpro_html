<?php session_start();

include $_SERVER["DOCUMENT_ROOT"]."/inc/dbcon.php";

$num=$_POST['num'];
$isend=addslashes($_POST['isend']);


$que="update photo_request set 
isend='$isend',
mod_date=now() 
where num='".$num."'";

$sql=$mysqli->query($que) or die($mysqli->error);

if($sql){
	location_is('','','입력했습니다.');
}else{
	location_is('','','디비입력에 실패했습니다. 다시 입력해주십시오.');
}

?>

