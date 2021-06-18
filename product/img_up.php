<?php include $_SERVER["DOCUMENT_ROOT"]."/inc/dbcon.php";

$FILE_ID=$_GET['FILE_ID'];

	$que3="select FILE_ORDER,PRODUCT_ID from product_file_info where FILE_ID='".$FILE_ID."'";
	$result3 = $mysqli->query($que3) or die("1:".$mysqli->error);
	$rs3 = $result3->fetch_array();
	$fo=$rs3[0];
	$pid=$rs3[1];
	
	$que="update product_file_info set REP_FLAG='0' where PRODUCT_ID='".$pid."' and DEL_FLAG='0' and USE_FLAG='0'";
	$sql = $mysqli->query($que) or die("1:".$mysqli->error);

	$que="update product_file_info set REP_FLAG='1' where FILE_ID='".$FILE_ID."' or FILE_ID_PARENT='".$FILE_ID."'";
	$sql = $mysqli->query($que) or die("2:".$mysqli->error);


echo "대표이미지로 적용했습니다.";
?>

