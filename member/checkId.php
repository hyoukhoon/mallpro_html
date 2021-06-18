<?php include $_SERVER['DOCUMENT_ROOT']."/inc/dbcon.php";

$uid=removeHackTag($_POST['uid']);

$que3="SELECT count(*) FROM member WHERE uid = '".$uid."'";
$result3 = $mysqli->query($que3) or die("2:".$mysqli->error);
$rs3 = $result3->fetch_array();

if($rs3[0]) {
	echo -1;
}else {
	echo 1;
}

?>