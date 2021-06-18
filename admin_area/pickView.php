<?php include $_SERVER['DOCUMENT_ROOT']."/inc/dbcon.php";

$pnum=$_POST['num'];
$AID="pixter";
$uid="punter";
$refund=0;
$gameResult=0;
$income=0;
$gubun=2;//픽보기

$que="select count(1) from `pickUserList` where uid='$uid' and pnum='$pnum'";
$result = $mysqli->query($que) or die("1:".$mysqli->error);
$rs = $result->fetch_array();
if($rs[0]){
	echo "-2";
	exit;
}


$nowCash=punterCash($uid);
if($nowCash<$pickFee){
	echo "-1";
	exit;
}

	$arrGame=array();
	$que2="select b.gnum, b.gamePreview from pickAdmin a, pickTable b where a.num=b.pnum and a.num='$pnum' order by b.gnum asc";
	$result2 = $mysqli->query($que2) or die("1:".$mysqli->error);
	while($rs2 = $result2->fetch_object()){
		$arrGame[]=$rs2->gnum.",".$rs2->gamePreview;
	}
	$json_arrGame=json_encode($arrGame);
	$hashData=hash('sha512',$json_arrGame);

	$que="select count(1) from `pickUserList` where uid='$uid' and hashData='$hashData'";
	$result = $mysqli->query($que) or die("1:".$mysqli->error);
	$rs = $result->fetch_array();
	if($rs[0]){
		echo "-3";
		exit;
	}

$mysqli->autocommit(FALSE);

	$query="INSERT INTO `propick`.`pickUserList`
	(`uid`,
	`pnum`,
	`amt`,
	`gameResult`,
	`regDate`,
	`hashData`)
	VALUES
	('$uid',
	'$pnum',
	'$pickFee',
	'$gameResult',
	now(),
	'$hashData')";
	$sql=$mysqli->query($query) or die("3:".$mysqli->error);
	$insertId=$mysqli->insert_id;

	if($sql){

		$spentFee=-$pickFee;//지출

		//환불불가인 캐쉬부터 불러옴
		$result = $mysqli->query("select * from punterCashList where uid='$uid' and isRefund=0 order by num desc limit 1") or die("2:".$mysqli->error);
		$rs = $result->fetch_object();

		if($rs->nowCash>0){

			if($rs->nowCash>=$pickFee){
				$query2="insert into punterCashList (uid, income, nowCash, gubun,isRefund) select uid, ".$spentFee.", nowCash+".$spentFee.", ".$gubun.", isRefund from punterCashList where num='".$rs->num."'";
				$sql2=$mysqli->query($query2) or die("4:".$mysqli->error);
				$spentFee=0;
				$noRefundFee=$pickFee;
			}else{
				$query2="insert into punterCashList (uid, income, nowCash, gubun,isRefund) select uid, ".$rs->nowCash.", 0, ".$gubun.", isRefund from punterCashList where num='".$rs->num."'";
				$sql2=$mysqli->query($query2) or die("4:".$mysqli->error);
				$spentFee=$spentFee+$rs->nowCash;
				$noRefundFee=$rs->nowCash;
			}

		}
		
			if($spentFee<0){
					//환불 가능한 캐쉬를 불러옴
					$result2 = $mysqli->query("select * from punterCashList where uid='$uid' and isRefund=1 order by num desc limit 1") or die("2:".$mysqli->error);
					$rs2 = $result2->fetch_object();

					$query2="insert into punterCashList (uid, income, nowCash, gubun,isRefund) select uid, ".$spentFee.", nowCash+".$spentFee.", ".$gubun.", isRefund from punterCashList where num='".$rs2->num."'";
					$sql2=$mysqli->query($query2) or die("4:".$mysqli->error);
					$refundFee=abs($spentFee);

			}

	}


	$query31="update pickUserList set refundFee='".$refundFee."', noRefundFee='".$noRefundFee."' where num='$insertId'";
	$sql31=$mysqli->query($query31) or die("5:".$mysqli->error);

	$query3="update pickAdmin set clickCnt=clickCnt+1 where num='$pnum'";
	$sql3=$mysqli->query($query3) or die("5:".$mysqli->error);

	if($sql && $sql2 && $sql31 && $sql3){
		$mysqli->commit();
		$qresult=1;
	}else{
		$mysqli->rollback();
		$qresult=0;
	}

echo $qresult;
?>