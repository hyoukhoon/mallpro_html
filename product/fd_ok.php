<?php include $_SERVER["DOCUMENT_ROOT"]."/inc/dbcon.php";

//error_reporting(E_ERROR | E_WARNING | E_PARSE);
//ini_set('error_reporting', E_ERROR | E_WARNING | E_PARSE);
//ini_set("display_errors", 1);

include $_SERVER["DOCUMENT_ROOT"]."/admin_page/file/product_info.php";
include $_SERVER["DOCUMENT_ROOT"]."/admin_page/product/product_insert_func.php";


	$sd=$_GET['sd'];

	$que5="select max(reg_idx) from ptest";
	$result5 = $mysqli->query($que5) or die("5:".$mysqli->error);
	$rs5 = $result5->fetch_array();
	$reg_idx=$rs5[0]+1;

	foreach($sd as $n){
		$m=substr($n,0,6);
		$ps1=file_read($m,$n,$reg_idx);
	}

	if($ps1){
		location_is('','','등록했습니다.');
		exit;
	}

/*
	foreach($sd as $n){
		$df=date("Y-m-d",strtotime(substr($n,0,8)));
		$ps2=product_insert($df);
		echo $ps2."<br>";
	}
	*/



?>

