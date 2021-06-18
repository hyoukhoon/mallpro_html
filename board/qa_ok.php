<?php session_start();

include $_SERVER["DOCUMENT_ROOT"]."/inc/dbcon.php";

$INQUIRY_ID=$_POST['INQUIRY_ID'];
$REPLY_CONTENTS=addslashes($_POST['REPLY_CONTENTS']);


$que="update price_inquiry set 
REPLY_YN='Y',
REPLY_CONTENTS='$REPLY_CONTENTS',
REPLY_ID='".$_SESSION['AID']."',
REPLY_DATE=now() 
where INQUIRY_ID='".$INQUIRY_ID."'";

$sql=$mysqli->query($que) or die($mysqli->error);

if($sql){
	location_is('','','입력했습니다.');
}else{
	location_is('','','디비입력에 실패했습니다. 다시 입력해주십시오.');
}

?>

