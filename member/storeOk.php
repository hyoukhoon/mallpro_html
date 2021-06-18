<?php session_start();
include $_SERVER["DOCUMENT_ROOT"]."/inc/dbcon.php";

//ini_set('display_errors', 1);
//ini_set('display_startup_errors', 1);
//error_reporting(E_ALL);
/*
if(!$_SESSION['AAUTH']){
	$data=array("result"=>-1,"val"=>"유료회원전용서비스입니다.");
	echo json_encode($data);
	exit;
}

if(!$_SESSION['AMLEVEL']){
	$data=array("result"=>-1,"val"=>"유료회원전용서비스입니다.");
	echo json_encode($data);
	exit;
}
*/
$uid=$_SESSION['AID'];
$asTel=removeHackTag($_POST['asTel']);
$asComment=removeHackTag($_POST['asComment']);
$topImage=removeHackTag($_POST['topImage']);
$footerImage=removeHackTag($_POST['footerImage']);
$topText=addslashes($_POST['topText']);
//$topText=addslashes($topText);

		$cnt=0;
	    $query = "INSERT INTO `mallpro`.`storeinfo`
					(`uid`,
					`asTel`,
					`asComment`,
					`topImage`,
					`footerImage`,
					`topText`)
					VALUES
					('$uid',
					'$asTel',
					'$asComment',
					'$topImage',
					'$footerImage',
					'$topText') ON DUPLICATE KEY UPDATE asTel='$asTel', asComment='$asComment', topImage='$topImage', footerImage='$footerImage', topText='$topText'";
    $sql = $mysqli->query($query) or die($mysqli->error);
	$data=array("result"=>1,"val"=>"입력했습니다.");


echo json_encode($data);


?>