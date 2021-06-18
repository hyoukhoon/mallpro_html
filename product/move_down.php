<?php include $_SERVER["DOCUMENT_ROOT"]."/inc/dbcon.php";

$FILE_ID=$_GET['FILE_ID'];
$ud=$_GET['ud'];

	$que3="select FILE_ORDER,PRODUCT_ID from product_file_info where FILE_ID='".$FILE_ID."'";
	$result3 = $mysqli->query($que3) or die("1:".$mysqli->error);
	$rs3 = $result3->fetch_array();
	$fo=$rs3[0];
	
	$pid=$rs3[1];

	$que2="select max(FILE_ORDER),min(FILE_ORDER) from product_file_info where PRODUCT_ID='".$pid."' and DEL_FLAG='0' and USE_FLAG='0' and IMGVOD_FLAG='0'";
	$result2 = $mysqli->query($que2) or die("1:".$mysqli->error);
	$rs2 = $result2->fetch_array();

if($ud=="d"){
	$cfo=$fo+1;
	if($rs2[0]<=$cfo){$cfo=$rs2[0];}

	$que4="select FILE_ID from product_file_info where PRODUCT_ID='".$pid."' and DEL_FLAG='0' and USE_FLAG='0' and IMGVOD_FLAG='0' and FILE_ORDER='".$cfo."'";
	$result4 = $mysqli->query($que4) or die("1:".$mysqli->error);
	$rs4 = $result4->fetch_array();
	$C_FILE_ID=$rs4[0];

	$que="update product_file_info set FILE_ORDER=FILE_ORDER-1 where FILE_ID='".$C_FILE_ID."'";
	$sql = $mysqli->query($que) or die("1:".$mysqli->error);

}else if($ud=="u"){
	if($fo==1){
		echo "stop";
		exit;
	}
	$cfo=$fo-1;
	if($rs2[1]>=$cfo){$cfo=$rs2[1];}

	$que4="select FILE_ID from product_file_info where PRODUCT_ID='".$pid."' and DEL_FLAG='0' and USE_FLAG='0' and IMGVOD_FLAG='0' and FILE_ORDER='".$cfo."'";
	$result4 = $mysqli->query($que4) or die("1:".$mysqli->error);
	$rs4 = $result4->fetch_array();
	$C_FILE_ID=$rs4[0];

	$que="update product_file_info set FILE_ORDER=FILE_ORDER+1 where PRODUCT_ID='".$pid."' and DEL_FLAG='0' and USE_FLAG='0' and IMGVOD_FLAG in ('0','3') and FILE_ORDER='".$cfo."'";
	$sql = $mysqli->query($que) or die("1:".$mysqli->error);
}

	$que="update product_file_info set FILE_ORDER='".$cfo."' where FILE_ID='".$FILE_ID."' or FILE_ID_PARENT='".$FILE_ID."'";
	$sql = $mysqli->query($que) or die("3:".$mysqli->error);

	$val=array($FILE_ID,$cfo,$C_FILE_ID,$fo);

echo urlencode(json_encode($val));
?>

