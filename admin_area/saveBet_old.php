<?php include $_SERVER['DOCUMENT_ROOT']."/inc/dbcon.php";

$nums=json_decode($_POST['jsonCheck']);
$wins=json_decode($_POST['jsonNum']);
$gameRound=$_POST['gameRound'];
$gameResult=array();

$setNum=time();
$istate=1;//등록
$sitem=0;//없음
$clickCnt=0;
$sameGame=0;
for($i=0;$i<sizeof($nums);$i++){

	$que3="select count(1) from pick_table where gameRound='".$gameRound."' and pnum='".$nums[$i]."' and gamePreview='".$wins[$i]."'";
	$result3 = $mysqli->query($que3) or die("1:".$mysqli->error);
	$rs3 = $result3->fetch_array();
	if($rs3[0]){
		$sameGame++;
	}

}

if($sameGame>=2){
	echo -2;
	exit;
}

for($i=0;$i<sizeof($nums);$i++){

	$que="INSERT INTO `propick`.`pick_table`
(uid, setNum, gameRound, pnum, gamePreview, gameResult, sitem, clickCnt, istate, reg_date)
VALUES
('admin', 
'".$setNum."', 
'".$gameRound."', 
'".$nums[$i]."', 
'".$wins[$i]."', 
'".$gameResult."', 
'".$sitem."', 
'".$clickCnt."', 
'".$istate."', 
now());
	";
	$sql = $mysqli->query($que) or die("2:".$mysqli->error);

}

if($sql){
	echo "1";
}else{
	echo "-1";
}

?>
