<?php session_start();

include $_SERVER["DOCUMENT_ROOT"]."/inc/dbcon.php";

$CATEGORY_NAME_CH=$CATEGORY_NAME_EN=$CATEGORY_NAME=$_POST['CATEGORY_NAME'];

$que2="select max(SORT) from bbs_category where BBS_TYPE='F'";
$result2 = $mysqli->query($que2) or die("1:".$mysqli->error);
$rs2 = $result2->fetch_array();
$sort=$rs2[0]+1;

$BBS_TYPE="F";
$CATEGORY_USE=1;
$que="insert into bbs_category values ('',
'$BBS_TYPE',
'$CATEGORY_NAME',
'$CATEGORY_NAME_EN',
'$CATEGORY_NAME_CH',
'$CATEGORY_USE',
'$sort',
now(),
'$UPDATE_DATE',
'".$_SESSION['AID']."')";

$sql=$mysqli->query($que) or die($mysqli->error);

if($sql){
	location_is_close('입력했습니다.');
}else{
	location_is('','','디비입력에 실패했습니다. 다시 입력해주십시오.');
}

?>

