<?php include $_SERVER["DOCUMENT_ROOT"]."/inc/dbcon.php";

$SERVICE_ID=$_GET['SERVICE_ID'];

$que1="select * 
	from service_product where SERVICE_ID='".$SERVICE_ID."'";
	$result1 = $mysqli->query($que1) or die($mysqli->error);
	$rs1 = $result1->fetch_object();
	echo number_format($rs1->PRICE)."원";

?>