<?php session_start();

include $_SERVER["DOCUMENT_ROOT"]."/inc/dbcon.php";

$ID=removeHackTag($_POST['ID']);
$PW=removeHackTag($_POST['PW']);
$IS_DEL=removeHackTag($_POST['IS_DEL']);
$AUTH=removeHackTag($_POST['AUTH']);
$DESCRIPTION=removeHackTag(addslashes($_POST['DESCRIPTION']));
$OLD_PW=removeHackTag($_POST['OLD_PW']);
$passchange=removeHackTag($_POST['passchange']);

$que3="select count(*) from mediapic_user where ID='".$ID."' and PW=password('".$OLD_PW."')";
$result3 = $mysqli->query($que3) or die("1:".$mysqli->error);
$rs3 = $result3->fetch_array();
if(!$rs3[0]){
	location_is('','','아이디와 비밀번호가 일치하지 않습니다.');
	exit;
}



$que="update mediapic_user set ID='$ID',";
if($passchange){//비밀번호변경일 경우에만 업데이트
	$que.="PW=password('".$PW."'),";
}
$que.="
AUTH='$AUTH',
SELLER_ID='$SELLER_ID',
DESCRIPTION='$DESCRIPTION',
UPDATE_DATE=now(),
IS_DEL='$IS_DEL' where ID='".$ID."'";

$sql=$mysqli->query($que) or die($mysqli->error);

if($sql){
	location_is_close('수정했습니다.');
}else{
	location_is('','','디비입력에 실패했습니다. 다시 입력해주십시오.');
}

?>

