<?php session_start();
include $_SERVER["DOCUMENT_ROOT"]."/inc/dbcon.php";

//ini_set('display_errors', 1);
//ini_set('display_startup_errors', 1);
//error_reporting(E_ALL);

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

$uid=$_SESSION['AID'];
$myLevel=$_SESSION['AMLEVEL'];
//$kw=urlencode($_POST['kw']);
$kw=$_POST['kw'];
$tag=$_POST['tag'];
$pageNumber=$_POST['pageNumber'];

$que2="SELECT * FROM memberType WHERE mLevel = '".$myLevel."'";
$result2 = $mysqli->query($que2);
$rs2 = $result2->fetch_object();
$allCnt=$rs2->allCnt;

$que3="SELECT count(1) FROM taobao WHERE uid = '".$uid."' and left(regDate,7)='".date("Y-m")."'";
$result3 = $mysqli->query($que3);
$rs3 = $result3->fetch_array();
$totalCnt=$rs3[0];

if($totalCnt>=$allCnt){
	$data=array("result"=>-1,"val"=>"상품등록 허용갯수를 초과했습니다.\n총 허용갯수는 ".$allCnt."이고 현재 등록갯수는 ".$totalCnt."입니다."); 
	echo json_encode($data);
	exit;
}



//$que="SELECT * FROM searchWord WHERE uid='$uid' and  kw = '".$kw."'";
//$result = $mysqli->query($que);
//$rs = $result->fetch_object();

if($rs->num){
	$data=array("result"=>-1,"val"=>"이미 등록된 검색어입니다. 상품관리에서 검색해보세요."); 
}else{
		$cnt=0;
	    $query = "INSERT INTO `mallpro`.`searchWord`
							(`uid`,
							`kw`,
							`tag`,
							`cnt`,
							`pageNumber`)
							VALUES
							('$uid',
							'$kw',
							'$tag',
							'$cnt',
							'$pageNumber')";

    $sql = $mysqli->query($query) or die($mysqli->error);
	$snum=$mysqli->insert_id;
	$data=array("result"=>1,"val"=>"입력했습니다.","snum"=>$snum);

}


echo json_encode($data);


?>