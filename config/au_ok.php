<?php session_start();

include $_SERVER["DOCUMENT_ROOT"]."/inc/dbcon.php";

$MOBILE_OS=$_POST['MOBILE_OS'];
$APP_VERSION=$_POST['APP_VERSION'];
$MARKET_URL=$_POST['MARKET_URL'];
$IS_MAN=$_POST['IS_MAN'];
$NOTE=addslashes($_POST['NOTE']);
$REG_YN=$_POST['REG_YN'];


$que="insert into app_version values ('',
'$APP_VERSION',
'$MARKET_URL',
'$NOTE',
'$REG_YN',
'$IS_MAN',
'$MOBILE_OS',
now())";

$sql=$mysqli->query($que) or die($mysqli->error);

if($sql){
	location_is_close('입력했습니다.');
}else{
	location_is('','','디비입력에 실패했습니다. 다시 입력해주십시오.');
}

?>

