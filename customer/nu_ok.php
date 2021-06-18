<?php session_start();

include $_SERVER["DOCUMENT_ROOT"]."/inc/dbcon.php";

$CATEGORY_SEQ=$_POST['CATEGORY_SEQ'];
$CONTENT_DISPLAY=$_POST['CONTENT_DISPLAY'];
$CONTENTS=$CONTENTS_EN=$CONTENTS_CH=addslashes($_POST['ir1']);
$SUBJECT=$SUBJECT_EN=$SUBJECT_CH=$_POST['SUBJECT'];

$CONTENT_DEL=0;
$REPLY=0;
$que="update bbs_content set 
CONTENTS='$CONTENTS',
CONTENTS_EN='$CONTENTS_EN',
CONTENTS_CH='$CONTENTS_CH',
UPDATE_DATE=now() 
where CATEGORY_SEQ='".$CATEGORY_SEQ."'";

$sql=$mysqli->query($que) or die($mysqli->error);

if($sql){
	location_is('','','입력했습니다.');
}else{
	location_is('','','디비입력에 실패했습니다. 다시 입력해주십시오.');
}

?>

