<?php include $_SERVER["DOCUMENT_ROOT"]."/inc/dbcon.php";

$FILE_ID=json_decode(urldecode($_GET['FILE_ID']));

foreach($FILE_ID as $p){

	$que3="select FILEPATH,FILENM_SYS from product_file_info where FILE_ID='".$p."'";
	$result3 = $mysqli->query($que3) or die("1:".$mysqli->error);
	$rs3 = $result3->fetch_array();
	$del_file=$_SERVER["DOCUMENT_ROOT"].$rs3[0].$rs3[1];

	$que="update product_file_info set FILE_ORDER=0, DEL_FLAG='1', REP_FLAG='0' where FILE_ID='".$p."'";
	$sql = $mysqli->query($que) or die("2:".$mysqli->error);
	if($sql){
		unlink($del_file);
	}	

}

echo $_GET['FILE_ID'];
?>

