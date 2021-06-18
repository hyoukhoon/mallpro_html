<?php session_start();
include $_SERVER["DOCUMENT_ROOT"]."/inc/dbcon.php";

//ini_set('display_errors', 1);
//ini_set('display_startup_errors', 1);
//error_reporting(E_ALL);


$uid=$_SESSION['AID'];

$jsonCheck=urldecode($_POST['jsonCheck']);
$itemNum=json_decode($jsonCheck);

if(!count($itemNum)){
	$data=array("result"=>-1,"val"=>"번역할 상품을 선택하세요.");
	echo json_encode($data);
	exit;
}

$w="";
foreach($itemNum as $i){
		$w.="'".$i."',";
}
	$w=substr($w,0,-1);
	$where=" and a.num in (".$w.")";
	if(!$order){
		$order=" order by a.num desc";
	}

	$que="select b.optionValue as optionValue, b.num as pnum from myItem a, taobao b where a.pnum=b.num and a.uid='$uid'";
	$que.=$where;
	$que.=$order;


//	echo $que;
//	$que="select b.optionValue as optionValue, b.num as pnum from myItem a, taobao b where a.pnum=b.num and a.num='53'";
	$result = $mysqli->query($que) or die("28:".$mysqli->error);
	while($rs = $result->fetch_object()){
			$rsc[]=$rs;
	}


foreach($rsc as $p){


	$result2 = $mysqli->query("select * from optiontable where pnum='".$p->pnum."'") or die("725:".$mysqli->error);
	$rs2 = $result2->fetch_object();

	$ov1="";
	if($rs2->optionValue1){
		$opt1=explode(",",$rs2->optionValue1);
		foreach($opt1 as $op1){
			$ov1.=trans($op1).",";
		}
		$ov1=substr($ov1,0,-1);
	}



	$ov2="";
	if($rs2->optionValue2){
		$opt2=explode(",",$rs2->optionValue2);
		foreach($opt2 as $op2){
			$ov2.=trans($op2).",";
		}
		$ov2=substr($ov2,0,-1);
	}

	$query="update optiontable set optionValue1='$ov1', optionValue2='$ov2' where pnum='".$p->pnum."'";
	$sql=$mysqli->query($query);


	}
$data=array("result"=>1,"val"=>"수정했습니다.");
echo json_encode($data);



  // 네이버 Papago NMT 기계번역 Open API 예제
function trans($encText){

	  $client_id = "Sb4fkqGD_qte93YESTjQ"; // 네이버 개발자센터에서 발급받은 CLIENT ID
	  $client_secret = "CAx9X8V9kD";// 네이버 개발자센터에서 발급받은 CLIENT SECRET
	  $encText = urlencode($encText);
	  $postvars = "source=zh-CN&target=ko&text=".$encText;
	  $url = "https://openapi.naver.com/v1/papago/n2mt";
	  $is_post = true;
	  $ch = curl_init();
	  curl_setopt($ch, CURLOPT_URL, $url);
	  curl_setopt($ch, CURLOPT_POST, $is_post);
	  curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
	  curl_setopt($ch,CURLOPT_POSTFIELDS, $postvars);
	  $headers = array();
	  $headers[] = "X-Naver-Client-Id: ".$client_id;
	  $headers[] = "X-Naver-Client-Secret: ".$client_secret;
	  curl_setopt($ch, CURLOPT_HTTPHEADER, $headers);
	  $response = curl_exec ($ch);
	  $status_code = curl_getinfo($ch, CURLINFO_HTTP_CODE);
	  //echo "status_code:".$status_code."<br>";
	  curl_close ($ch);
	  if($status_code == 200) {
		$ts=json_decode($response);
		return $ts->message->result->translatedText;
	  } else {
		return "Error 내용:".$response;
	  }

}



?>