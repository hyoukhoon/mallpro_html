<?php include $_SERVER["DOCUMENT_ROOT"]."/inc/dbcon.php";

$FILE_ID=json_decode(urldecode($_GET['FILE_ID']));

foreach($FILE_ID as $p){

	$rep_flag=0;
	$que3="select FILE_ORDER,PRODUCT_ID,FILEPATH,FILENM_SYS,REP_FLAG from product_file_info where FILE_ID='".$p."'";
	$result3 = $mysqli->query($que3) or die("1:".$mysqli->error);
	$rs3 = $result3->fetch_array();
	$fo=$rs3[0];
	$pid=$rs3[1];
	$del_file=$_SERVER["DOCUMENT_ROOT"].$rs3[2].$rs3[3];
	$del_file2=$_SERVER["DOCUMENT_ROOT"].$rs3[2]."T_".$rs3[3];
	$rep_flag=$rs3[4];//대표이미지

	$que="update product_file_info set FILE_ORDER=FILE_ORDER-1 where PRODUCT_ID='".$pid."' and DEL_FLAG='0' and USE_FLAG='0' and IMGVOD_FLAG in ('0','3') and FILE_ORDER>'".$fo."'";
	$sql = $mysqli->query($que) or die("2:".$mysqli->error);

	if($rep_flag==1){
		$que2="update product_file_info set REP_FLAG='1' where PRODUCT_ID='".$pid."' and DEL_FLAG='0' and IMGVOD_FLAG in ('0','3') and USE_FLAG='0' and FILE_ORDER='1'";
		$sql2 = $mysqli->query($que2) or die("5:".$mysqli->error);
	}

	$que="update product_file_info set DEL_FLAG='1' where FILE_ID='".$p."' or FILENM_SYS='T_".$rs3[3]."'";
	$sql2 = $mysqli->query($que) or die("3:".$mysqli->error);
	if($sql2){
		unlink($del_file);
		unlink($del_file2);
	}

}

echo $_GET['FILE_ID'];
?>

