<?php session_start();
include $_SERVER["DOCUMENT_ROOT"]."/inc/dbcon.php";

$id=$_POST['uid'];
$pw=$_POST['passwd'];
$pw=hash('sha512',$pw);

$que="select * from admin where admin_id='".$id."' and admin_pwd='".$pw."' and use_yn='Y'";
$result = $mysqli->query($que) or die($mysqli->error);
$rs = $result->fetch_object();

if(!$rs->admin_id){
	location_is('','','아이디나 암호가 틀렸습니다. 다시한번 확인해주십시오.');
	exit;
}else{

	$sql=$mysqli->query("update admin set last_date=now() where admin_id='".$id."'") or die($mysqli->error);

	$_SESSION['MMS_ID']		= $rs->admin_id;
	$_SESSION['MMS_PWR']	= $rs->power;
	$_SESSION["MMS_NAME"]=$rs->admin_name;


	location_is('/admin_area/memberList.php','','로그인 되었습니다.');
}
?>