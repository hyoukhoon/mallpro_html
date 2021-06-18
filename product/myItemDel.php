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

$jsonCheck=urldecode($_POST['jsonCheck']);
$itemNum=json_decode($jsonCheck);

if(!count($itemNum)){
	$data=array("result"=>-1,"val"=>"삭제할 상품을 선택하세요.");
	echo json_encode($data);
	exit;
}


	foreach($itemNum as $i){

		$query = "delete from myItem  where uid='".$uid."' and num='".$i."'";
		$sql = $mysqli->query($query) or die($mysqli->error);

	}

$data=array("result"=>1,"val"=>"삭제했습니다.");
echo json_encode($data);


?>