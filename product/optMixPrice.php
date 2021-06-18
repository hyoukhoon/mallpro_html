<?php session_start();
include $_SERVER["DOCUMENT_ROOT"]."/inc/dbcon.php";

		$result2 = $mysqli->query("select * from optiontable where pnum='2646'") or die("725:".$mysqli->error);
		$rs2 = $result2->fetch_object();

		$optMixArray=json_decode(urldecode($rs2->optionMixPrice));


echo "<Pre>";
print_r($optMixArray);


?>