<?php include $_SERVER["DOCUMENT_ROOT"]."/inc/dbcon.php";

$ID=$_GET['ID'];

	$que3="select count(*) from mediapic_user where ID='".$ID."'";
	$result3 = $mysqli->query($que3) or die("1:".$mysqli->error);
	$rs3 = $result3->fetch_array();

	if($rs3[0]){
		echo "이미 사용중인 아이디입니다.";
	}else{
		echo "사용 가능한 아이디입니다.";
	}
?>

