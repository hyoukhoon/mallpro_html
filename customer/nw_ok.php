<?php session_start();
//error_reporting(E_ERROR | E_WARNING | E_PARSE);
//ini_set('error_reporting', E_ERROR | E_WARNING | E_PARSE);
//ini_set("display_errors", 1);
include $_SERVER["DOCUMENT_ROOT"]."/inc/dbcon.php";

$CATEGORY_SEQ=$_POST['CATEGORY_SEQ'];
$CONTENT_DISPLAY=$_POST['CONTENT_DISPLAY'];
$CONTENTS=$CONTENTS_EN=$CONTENTS_CH=removeHackTag(addslashes($_POST['ir1']));
$SUBJECT=$SUBJECT_EN=$SUBJECT_CH=removeHackTag(addslashes($_POST['SUBJECT']));
$CONTENT_SEQ=$_POST['CONTENT_SEQ'];

$CONTENT_DEL=0;
$REPLY=0;

if($CONTENT_SEQ){

	$que="update bbs_content set CATEGORY_SEQ='$CATEGORY_SEQ',
	CONTENT_DISPLAY='$CONTENT_DISPLAY',
	SUBJECT='$SUBJECT',
	SUBJECT_EN='$SUBJECT_EN',
	SUBJECT_CH='$SUBJECT_CH',
	CONTENTS='$CONTENTS',
	CONTENTS_EN='$CONTENTS_EN',
	CONTENTS_CH='$CONTENTS_CH',
	UPDATE_DATE=now() 
	where CONTENT_SEQ='".$CONTENT_SEQ."' ";

}else{

	$que="insert into bbs_content values ('',
	'$CATEGORY_SEQ',
	'$CONTENT_DEL',
	'$CONTENT_DISPLAY',
	'$REPLY',
	'$PARENT',
	'$SUBJECT',
	'$SUBJECT_EN',
	'$SUBJECT_CH',
	'$CONTENTS',
	'$CONTENTS_EN',
	'$CONTENTS_CH',
	'$HIT',
	now(),
	'$UPDATE_DATE',
	'".$_SESSION['AID']."')";
}

//echo $que;
//exit;

$sql=$mysqli->query($que) or die($mysqli->error);

if($sql){
	location_is_close('입력했습니다.');
}else{
	location_is('','','디비입력에 실패했습니다. 다시 입력해주십시오.');
}

?>

