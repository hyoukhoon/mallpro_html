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

if(!isMyCnt($_SESSION['AID'])){
	$data=array("result"=>-1,"val"=>"수집 가능 갯수가 없습니다. 유료회원으로 등록하십시오..");
	echo json_encode($data);
	exit;
}


$uid=$_SESSION['AID'];
$myLevel=$_SESSION['AMLEVEL'];
$url=$_POST['url'];
$tag=$_POST['tag'];
$gubun='2';

if(!strpos($url,"tmall.com") and !strpos($url,"taobao.com")){
	$data=array("result"=>-1,"val"=>"타오바오 제품만 등록할 수 있습니다."); 
	echo json_encode($data);
	exit;
}


//$url=urldecode($_POST['url']);

/*
$que2="SELECT * FROM memberType WHERE mLevel = '".$myLevel."'";
$result2 = $mysqli->query($que2);
$rs2 = $result2->fetch_object();
$allCnt=$rs2->allCnt;
$myCnt=$rs->myCnt;

$que3="SELECT count(1) FROM taobao WHERE uid = '".$uid."' and left(regDate,7)='".date("Y-m")."'";
$result3 = $mysqli->query($que3);
$rs3 = $result3->fetch_array();
$totalCnt=$rs3[0];
*/

if(!isMyCnt($_SESSION['AID'])){
	$data=array("result"=>-1,"val"=>"수집 가능 갯수가 없습니다. 유료회원으로 등록하십시오."); 
	echo json_encode($data);
	exit;
}

if(strpos($url,"?id=")){

	$url2=explode("?id=",$url);
	$url3=explode("&",$url2[1]);
	$pid=$url3[0];

}else if(strpos($url,"&id=")){

	$url2=explode("&id=",$url);
	$url3=explode("&",$url2[1]);
	$pid=$url3[0];

}

if(!$pid){
	$data=array("result"=>-1,"val"=>"제품정보가 없습니다. 제품상세 URL주소가 맞는지 다시한번 확인해주십시오."); 
	echo json_encode($data);
	exit;
}


$que="SELECT * FROM taobao WHERE uid='".$uid."' and pid = '".$pid."' and isDisplay='1'";
$result = $mysqli->query($que);
$rs = $result->fetch_object();

$uniqueId=$uid.$url;
$uniqueId=hash('sha512',$uniqueId);

if($rs->num){
	$data=array("result"=>-1,"val"=>"이미 등록된 상품입니다.."); 
}else{
		$cnt=0;
	    $query = "INSERT INTO `mallpro`.`taobao`
						(`mall`,
						`uid`,
						`pid`,
						`url`,
						`tag`,
						`gubun`,
						`isDisplay`,
						`uniqueId`)
						VALUES
						('$mall',
						'$uid',
						'$pid',
						'$url',
						'$tag',
						'$gubun',
						'1',
						'$uniqueId')";


    $sql = $mysqli->query($query) or die($mysqli->error);

	if($sql){
		//수집쿠폰 사용
		$c=0;
		$que2="SELECT * FROM memberCoupon where uid='$uid' and totalDownCnt>nowDownCnt and startDate<='$now2' and endDate>='$now2' order by num asc";
		$result2 = $mysqli->query($que2);
		while($c==0 and $rs2 = $result2->fetch_object()){

			if($rs2->gubun==1){
				$query3="update memberCoupon set nowDownCnt=nowDownCnt+1 where num='$rs2->num'";
				$sql3 = $mysqli->query($query3) or die($mysqli->error);
				$c++;
			}else if($rs2->isuse==1){
				$query3="update memberCoupon set nowDownCnt=nowDownCnt+1 where num='$rs2->num'";
				$sql3 = $mysqli->query($query3) or die($mysqli->error);
				$c++;
			}

		}
		$data=array("result"=>1,"val"=>"등록했습니다","pid"=>$pid);
	}else{
		$data=array("result"=>-1,"val"=>"등록할 수 없는제품이거나 이미 등록된 제품입니다");
	}

}


echo json_encode($data);


?>