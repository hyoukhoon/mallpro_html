<?php session_start();
include $_SERVER["DOCUMENT_ROOT"]."/inc/dbcon.php";
include "pclzip.lib.php"; 

$uid=$_SESSION['AID'];
$jsonCheck=urldecode($_GET['jsonCheck']);
$itemNum=json_decode($jsonCheck);
$w="";
foreach($itemNum as $i){
		$w.="'".$i."',";
}
	$w=substr($w,0,-1);
	$where=" and num in (".$w.")";
	if(!$order){
		$order=" order by num desc";
	}

	$que="select itemThumb from myItem where uid='$uid'";
	$que.=$where;
	$que.=$order;

	$img="";
	$result = $mysqli->query($que) or die("3:".$mysqli->error);
	while($rs = $result->fetch_array()){
			$img="/thumb/".$rs[0];
			echo("<script>location.href='".$img."';</script>");
	}


?>