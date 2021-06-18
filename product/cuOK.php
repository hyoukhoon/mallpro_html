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
$categoryCode=$_POST['categoryCode'];
$sword=$_POST['sword'];
$jsonCheck=urldecode($_POST['jsonCheck']);
$itemNum=json_decode($jsonCheck);
$cate1=$_POST['cate1'];
$cate2=$_POST['cate2'];
$cate3=$_POST['cate3'];
$cate4=$_POST['cate4'];



if($sword){

	foreach($itemNum as $i){

		$query = "update myItem set cateId='".$categoryCode."' where num='$i'";
		$sql = $mysqli->query($query) or die($mysqli->error);

	}

}else{

		$where=" cate1='".$cate1."' and cate2='".$cate2."' and cate3='".$cate3."' and cate4='".$cate4."'";
		$que="select * from naver_category where ".$where." order by categoryCode desc limit 1";
		$result = $mysqli->query($que) or die("2:".$mysqli->error);
		$rs = $result->fetch_object();

		



		foreach($itemNum as $i){

				$query = "update myItem set cateId='".$rs->categoryCode."' where num='$i'";
				$sql = $mysqli->query($query) or die($mysqli->error);


		}

}

$data=array("result"=>1,"val"=>"등록했습니다.");
echo json_encode($data);


?>