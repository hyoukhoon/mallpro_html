<?php session_start();
include $_SERVER["DOCUMENT_ROOT"]."/inc/dbcon.php";

//ini_set('display_errors', 1);
//ini_set('display_startup_errors', 1);
//error_reporting(E_ALL);

if(!$_SESSION['AID']){
	location_is_close('로그인이 필요한 메뉴입니다.');
	exit;
}

$uid=$_SESSION['AID'];

$num=$_POST['num'];
$pnum=$_POST['pnum'];
$videoUrl=$_POST['videoUrl'];
$noOption=$_POST['noOption'];
$contents=rawurldecode($_POST['contents']);


		$query="update myItem set itemContents='".$contents."', noOption='$noOption' where num='".$num."'";
		$sql = $mysqli->query($query) or die($mysqli->error);

		$query2="update taobao set videoUrl='".$videoUrl."' where num='".$pnum."'";
		$sql2 = $mysqli->query($query2) or die($mysqli->error);

if($sql){

	$data=array("result"=>1,"val"=>"등록했습니다.");
	echo json_encode($data);

}else{
	$data=array("result"=>-1,"val"=>"다시 시도해주십시오.");
	echo json_encode($data);
}

?>