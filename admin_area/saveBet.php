<?php include $_SERVER['DOCUMENT_ROOT']."/inc/dbcon.php";

$nums=json_decode($_POST['jsonCheck']);
$wins=json_decode($_POST['jsonNum']);
$gameRound=$_POST['gameRound'];
$coupon=$_POST['coupon'];
$gameResult=array();

$AID="pixter";

//$hashData="admin".$gameRound.$_POST['jsonCheck'];//게임별로 하나의 승부만 등록
$hashData=$AID.$gameRound.$_POST['jsonCheck'].$_POST['jsonNum'];
$hashData=hash('sha512',$hashData);

	$query2="select count(1) from pickAdmin where hashData='".$hashData."'";
	$result2 = $mysqli->query($query2) or die("3:".$mysqli->error);
	$rs2 = $result2->fetch_array();

	if($rs2[0]){
		echo "-2";
		exit;
	}

if($coupon==1){//쿠폰 사용을 체크했으면
	$query2="select * from couponUser where uid='".$AID."' and couponGubun='2' and isuse='0' and couponStart<'$now4' and couponEnd>'$now4'";
	$result2 = $mysqli->query($query2) or die("26:".$mysqli->error);
	$rs2 = $result2->fetch_object();
	$couponNum=$rs2->num;
	if(!$rs2->num){
		echo "-3";
		exit;
	}
}

$setNum=time();
$istate=1;//등록
$sitem=$coupon?$coupon:0;
$clickCnt=0;
$sameGame=0;
$pickCnt=count($nums);

	$que="INSERT INTO `propick`.`pickAdmin`
	( uid, gameRound, isWin, sitem, istate, pickCnt, clickCnt, isuse, hashData, regDate)
	VALUES
	('$AID', 
	'".$gameRound."', 
	'0', 
	'".$sitem."', 
	'".$istate."', 
	'".$pickCnt."', 
	'0', 
	'1', 
	'".$hashData."',
	now());
		";
	$sql = $mysqli->query($que) or die("2:".$mysqli->error);
	$pnum=$mysqli->insert_id;

for($i=0;$i<sizeof($nums);$i++){

	$query="select * from proto where num='".$nums[$i]."'";
	$result = $mysqli->query($query) or die("3:".$mysqli->error);
	$rs = $result->fetch_object();

	if($wins[$i]=="1"){
		$odds=$rs->odds1;
	}else if($wins[$i]=="0"){
		$odds=$rs->odds2;
	}else if($wins[$i]=="-1"){
		$odds=$rs->odds3;
	}else if($wins[$i]=="7"){
		$odds=$rs->odds1;
	}else if($wins[$i]=="8"){
		$odds=$rs->odds3;
	}

	$que="INSERT INTO `propick`.`pickTable`
	(pnum, gnum, home, away, gamePreview, odds, gameResult, istate, isWin)
	VALUES
	('".$pnum."', 
	'".$nums[$i]."', 
	'".$rs->home."', 
	'".$rs->away."', 
	'".$wins[$i]."', 
	'".$odds."',
	'0', 
	'1', 
	'0');
		";
		$sql2 = $mysqli->query($que) or die("2:".$mysqli->error);

}

if($sql2){

	if($coupon){
		$que3="update couponUser set isuse='1' where num='$couponNum' and uid='$AID'";
		$sql3 = $mysqli->query($que3) or die("2:".$mysqli->error);
	}
	echo "1";
}else{
	echo "-1";
}

?>
