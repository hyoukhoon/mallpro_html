<?php session_start();
ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);
include $_SERVER["DOCUMENT_ROOT"]."/inc/dbcon.php";
		$uid="mall2";
		/*
		$query3="update memberCoupon set nowDownCnt=nowDownCnt+1 where uid='$uid' and startDate<='$now2' and endDate>='$now2' and totalDownCnt>nowDownCnt and gubun='1'";
		echo $query3."<br>";
		$sql3 = $mysqli->query($query3);
*/
		$c=0;
		$que2="SELECT * FROM memberCoupon where uid='$uid' and totalDownCnt>nowDownCnt and startDate<='$now2' and endDate>='$now2' order by num asc";

		$result2 = $mysqli->query($que2);
		while($rs2 = $result2->fetch_object()){

			if($rs2->gubun==1){
				$query3="update memberCoupon set nowDownCnt=nowDownCnt+1 where num='$rs2->num'";
				$sql3 = $mysqli->query($query3) or die($mysqli->error);
				$c++;
			}else if($rs2->isuse==1){
				$query3="update memberCoupon set nowDownCnt=nowDownCnt+1 where num='$rs2->num'";
				$sql3 = $mysqli->query($query3) or die($mysqli->error);
				$c++;
			}

		}

		echo $sql3;


?>