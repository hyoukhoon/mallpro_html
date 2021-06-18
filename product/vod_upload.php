<?php session_start();
include $_SERVER["DOCUMENT_ROOT"]."/inc/dbcon.php";

//$iPath=$_POST['iPath'];
$PRODUCT_ID=$_POST['PRODUCT_ID'];
$SELLER_CODE=$_POST['SELLER_CODE'];
$ADMIN=$_POST['ADMIN'];
$USE_FLAG=$_POST['USE_FLAG'];

$que="select count(1) from product_file_info where PRODUCT_ID='".$PRODUCT_ID."' and IMGVOD_FLAG='1' and USE_FLAG='".$USE_FLAG."' and DEL_FLAG='0'";
$result = $mysqli->query($que) or die("1:".$mysqli->error);
$rs = $result->fetch_array();

if($rs[0]){
	echo "[";
	echo "{'fnm':'no'}";
	echo "]";
	exit;
}


$iPath="media/SHOP/".$ADMIN."/".$SELLER_CODE."/MOBILE/".$PRODUCT_ID."/MOV/";
$iPath2="/media/SHOP/".$ADMIN."/".$SELLER_CODE."/MOBILE/".$PRODUCT_ID."/MOV/";
$iPath3=$_SERVER["DOCUMENT_ROOT"].$iPath;
$iPath4=$_SERVER["DOCUMENT_ROOT"]."media/SHOP/".$ADMIN."/".$SELLER_CODE."/MOBILE/".$PRODUCT_ID;

if(!is_dir($iPath3)){
	@mkdir($iPath3,0777,true);
	@chmod($iPath4,0777);
	@chmod($iPath3,0777);
}

if ($_FILES["imgfileb"]["error"] > 0){  // 에러가 있는지 검사하는 구문
	echo "Return Code: " . $_FILES["imgfileb"]["error"] . "<br>";  // 에러가 있으면 어떤 에러인지 출력함
}
else
{   // 에러가 없다면
	$fnm = $PRODUCT_ID."_".date("YmdHis").substr(rand(),0,4);

	
		$imgsize=$_FILES["imgfile2"]["size"];
		$ext = substr(strrchr($_FILES["imgfile2"]["name"],"."),1);

		if($ext!="mp4" && $ext!="mov"){
			echo "[";
			echo "{'fnm':'not'}";
			echo "]";
			exit;
		}

		move_uploaded_file($_FILES["imgfile2"]["tmp_name"], $_SERVER['DOCUMENT_ROOT'].$iPath . $fnm.".".$ext);


		$ofn=$_FILES["imgfile2"]["name"];
		$fn=$fnm.".".$ext;
		$fo=1;

		$que="insert into product_file_info values ('',
		'$PRODUCT_ID',
		'$fo',
		'".$ofn."',
		'".$fn."',
		'$FILE_ID_PARENT',
		'$iPath',
		'$imgsize',
		'$USE_FLAG',
		'1',
		'1',
		'0',
		now(),
		now()
		)";
		$sql=$mysqli->query($que) or die("1:".$mysqli->error);
		$insert_id=$mysqli->insert_id;

		echo "[";
		echo "{'fnm':'".$fnm.".".$ext."','aa':'".time()."','iid':'".$insert_id."','fo':'".$fo."','ofn':'".$ofn."'}";
		echo "]";
		// upload 폴더에 파일을 저장시킴
		//echo "Stored in: " . "upload/" . $_FILES["imgfileb"]["name"];   // upload 폴더에 저장된 파일의 내용

	

}

?>