<?php session_start();
include $_SERVER['DOCUMENT_ROOT']."/inc/dbcon.php";

if(!$_SESSION['AID']){
	$data=array("result"=>-1,"val"=>"로그인하십시오."); 
	echo json_encode($data);
	exit;
}

$uid=$_SESSION["AID"];
	$couponCnt=removeHackTag($_POST['couponCnt']);
	$amt=removeHackTag($_POST['amt']);
	$totalDownCnt=$couponCnt*2;
	$nowDownCnt=0;
	$nowCoupon=0;
/*
	$mLevel=removeHackTag($_POST['mLevel']);
	$authVal=removeHackTag($_POST['authVal']);
	$uname=removeHackTag($_POST['uname']);
	$gubun=removeHackTag($_POST['gubun']);

	$mysqli->autocommit(FALSE);

	$query="INSERT INTO `mallpro`.`memberAuth`
					(`uid`,
					`uname`,
					`mLevel`,
					`period`,
					`gubun`)
					VALUES
					('$uid',
					'$uname',
					'$mLevel',
					'$authVal',
					'$gubun')";
*/

	$isuse=0;
	$gubun=2;//구매
	$query="INSERT INTO `mallpro`.`memberCoupon`
					(`uid`,
					`totalDownCnt`,
					`nowDownCnt`,
					`buyCoupon`,
					`nowCoupon`,
					`price`,
					`regDate`,
					`startDate`,
					`endDate`,
					`isuse`,
					`gubun`)
					VALUES
					('$uid',
					'$totalDownCnt',
					'$nowDownCnt',
					'$couponCnt',
					'$nowCoupon',
					'$amt',
					now(),
					now(),
					date_add(now(),INTERVAL 2 Year),
					'$isuse',
					'$gubun')
	";
	$sql1=$mysqli->query($query) or die("3:".$mysqli->error);


	if($sql1){

		$mysqli->commit();
		$data=array("result"=>1,"val"=>"성공"); 
	}else{
		$data=array("result"=>0,"val"=>"실패"); 
	}

	echo json_encode($data);
?>