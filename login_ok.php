<?php session_start();





include $_SERVER["DOCUMENT_ROOT"]."/inc/dbcon.php";

$uid=removeHackTag($_POST['uid']);
$passwd=removeHackTag($_POST['passwd']);
$passwd=hash('sha512',$passwd);
$saveLogin=removeHackTag($_POST['saveLogin']);

//$que="select * from member where uid='".$uid."' and passwd='".$passwd."' and isAuth='1'";
$que="select * from member where uid='".$uid."' and passwd='".$passwd."'";
//echo $que."<br>";
//exit;
$result = $mysqli->query($que) or die($mysqli->error);
$rs = $result->fetch_object();

if(!$rs->uid){
	location_is('','','아이디나 암호가 틀렸습니다. 다시한번 확인해주십시오.');
	exit;
}else{

	//유료회원확인
	$que2="select * from memberCoupon where uid='".$uid."' and startDate<='$now2' and endDate>='$now2' order by num desc limit 1";
	$result2 = $mysqli->query($que2) or die($mysqli->error);
	$rs2 = $result2->fetch_object();
	if($rs2->isuse){
		$isAuth=1;
		$endDate=$rs2->endDate;
		$totalDownCnt=$rs2->totalDownCnt;
		$nowDownCnt=$rs2->nowDownCnt;
		$buyCoupon=$rs2->buyCoupon;
		$nowCoupon=$rs2->nowCoupon;
	}else{	
		$isAuth=0;
		$endDate=$rs2->endDate;
		$totalDownCnt=$rs2->totalDownCnt;
		$nowDownCnt=$rs2->nowDownCnt;
		$buyCoupon=$rs2->buyCoupon;
		$nowCoupon=$rs2->nowCoupon;
	}

	$sql=$mysqli->query("update member set lastLogin=now() where uid='".$uid."'") or die($mysqli->error);

	$_SESSION['AID']= $uid;
	$_SESSION['AAUTH']= $isAuth;
	$_SESSION['AISUSE']= $rs2->isuse;

	if($saveLogin==1){
			$loginInfo=$rs->uid;
			$_SESSION["saveLoginInfo"]=$loginInfo;
	}


	location_is('/product/itemList.php','','어서오십시오.');
}
?>