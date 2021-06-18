<?php session_start();
include $_SERVER["DOCUMENT_ROOT"]."/inc/dbcon.php";
require_once('pclzip.lib.php');

$uid=$_SESSION['AID'];
$jsonCheck=urldecode($_POST['jsonCheck']);
$itemNum=json_decode($jsonCheck);

if(!count($itemNum)){
	$data=array("result"=>-1,"val"=>"상품을 선택하세요.");
	echo json_encode($data);
	exit;
}

$w="";
foreach($itemNum as $i){
		$w.="'".$i."',";
}
	$w=substr($w,0,-1);
	$where=" and num in (".$w.")";
	if(!$order){
		$order=" order by num desc";
	}

	$que="select itemImage, itemName from myItem where uid='$uid'";
	$que.=$where;
	$que.=$order;


$dir="/itemImage/";
$file="상세이미지_".$now3.".zip";

$archive = new PclZip($file);

$result = $mysqli->query($que) or die("3:".$mysqli->error);
while($rs = $result->fetch_array()){

	$data=json_decode($rs[0]);
	$itemName=iconv("UTF-8", "EUC-KR", $rs[1]);
	$files_archive = $archive->add($data, PCLZIP_OPT_REMOVE_PATH, $dir, PCLZIP_OPT_ADD_PATH, $itemName);

}

if ($files_archive == 0) {
    $data=array("result"=>-1,"val"=>"실패했습니다. 다시시도해주세요.");
	echo json_encode($data);
}   
else{
    $data=array("result"=>1,
		"val"=>"압축파일을 생성했습니다.", 
		"rs"=>$file
		);
	echo json_encode($data);
}

?>
