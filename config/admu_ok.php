<?php session_start();

include $_SERVER["DOCUMENT_ROOT"]."/inc/dbcon.php";

$ID=$_POST['ID'];
$PW=$_POST['PW'];
$IS_DEL=$_POST['IS_DEL'];
$AUTH=$_POST['AUTH'];
$DESCRIPTION=addslashes($_POST['DESCRIPTION']);

$que="insert into mediapic_user values ('$ID',password('".$PW."'),
'$AUTH',
'$SELLER_ID',
'$DESCRIPTION',
now(),
now(),
'$IS_DEL')";

$sql=$mysqli->query($que) or die($mysqli->error);

if($sql){
	location_is_close('입력했습니다.');
}else{
	location_is('','','디비입력에 실패했습니다. 다시 입력해주십시오.');
}

?>

