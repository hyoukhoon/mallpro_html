<?php include $_SERVER["DOCUMENT_ROOT"]."/inc/dbcon.php";

$SELLER_CODE=$_POST['SELLER_CODE'];
$SELLER_ID=removeHackTag($_POST['SELLER_ID']);
$passwd=removeHackTag($_POST['PASSWD']);
$STS_CODE=$_POST['STS_CODE'];
$SHOP_CODE=$_POST['shop_code'];
$sp=$_POST['sp'];
$SNAME=removeHackTag($_POST['SNAME']);
$FLOOR=$_POST['FLOOR'];
$FLOOR_ROW=$_POST['FLOOR_ROW'];
$FLOOR_HO=$_POST['FLOOR_HO'];

$SNAME_CH=removeHackTag($_POST['SNAME_CH']);
$SNAME_EN=removeHackTag($_POST['SNAME_EN']);

$ADDRESS=removeHackTag($_POST['ADDRESS']);
$BUSINESS_REGISTERED_NUMBER=removeHackTag($_POST['BUSINESS_REGISTERED_NUMBER']);

$TEL=removeHackTag($_POST['TEL']);
$CELLPHONE=removeHackTag($_POST['CELLPHONE']);
$EMAIL=removeHackTag($_POST['EMAIL']);

$BANK_CODE=$_POST['BANK_CODE'];
$ACCOUNT_NUMBER=removeHackTag($_POST['ACCOUNT_NUMBER']);
$ACCOUNT_HOLDER=removeHackTag($_POST['ACCOUNT_HOLDER']);
$PAYMENT_DATE=$_POST['PAYMENT_DATE'];

if(!$SELLER_CODE){
	$sql2 = "SELECT count(*) FROM seller WHERE SELLER_ID = '{$SELLER_ID}'";
	$result2 = $mysqli->query($sql2) or die($mysqli->error);
	$rs2 = $result2->fetch_array();
	$cnt = $rs2[0];

	if($cnt>0){
		location_is('','','이미 사용중인 아이디입니다.');
		exit;
	}
}


if($_FILES["fn"]["name"])
	{
		$oname=$_FILES["fn"]["name"];
		$PROFIL_IMG_ORIGINAL=$oname;
		$fnm = time().substr(rand(),0,3);
		$ext = substr(strrchr($_FILES["fn"]["name"],"."),1);
//		$aaa = move_uploaded_file($_FILES["fn"]["tmp_name"], $_SERVER['DOCUMENT_ROOT']."/image/member/" . $fnm.".".$ext);
		$fn =$fnm.".".$ext;
	}else{
		$fn="";
	}

if($_FILES["bizfile"]["name"])
	{
		$oname=$_FILES["bizfile"]["name"];
		$BUSINESS_REGISTERED_IMG_ORIGINAL=$oname;
		$fnm2 = time().substr(rand(),0,3);
		$ext2 = substr(strrchr($_FILES["bizfile"]["name"],"."),1);
//		$aaa = move_uploaded_file($_FILES["bizfile"]["tmp_name"], $_SERVER['DOCUMENT_ROOT']."/image/member/" . $fnm2.".".$ext2);
		$bizfile =$fnm2.".".$ext2;
	}else{
		$bizfile="";
	}


if($SELLER_CODE){

	$que="select * from seller where SELLER_CODE='".$SELLER_CODE."'";
	$result = $mysqli->query($que) or die("2:".$mysqli->error);
	$rs = $result->fetch_object();

	$img_dir=$_SERVER["DOCUMENT_ROOT"]."media/SHOP/".$rs->SHOP_CODE."/".$SELLER_CODE."/COMMON/";

	if(!is_dir($img_dir)){
				@umask(0);
				@mkdir($img_dir,0777,true);
			}

	if($_FILES["fn"]["name"]){
		$aaa = move_uploaded_file($_FILES["fn"]["tmp_name"], $img_dir.$fnm.".".$ext);
	}

	if($_FILES["bizfile"]["name"]){
		$aaa = move_uploaded_file($_FILES["bizfile"]["tmp_name"], $img_dir.$fnm2.".".$ext2);
	}


	if(!$fn){
		$fn=$rs->PROFIL_IMG;
		$PROFIL_IMG_ORIGINAL=$rs->PROFIL_IMG_ORIGINAL;
	}

	if(!$bizfile){
		$bizfile=$rs->BUSINESS_REGISTERED_IMG;
		$BUSINESS_REGISTERED_IMG_ORIGINAL=$rs->BUSINESS_REGISTERED_IMG_ORIGINAL;
	}

	if(!$passwd){
		$pass="PASSWD='$rs->PASSWD'";
	}else{
		$pass="PASSWD=password('".$passwd."')";
	}

	$que="update seller set 
	SELLER_NAME='$SELLER_NAME',
	STS_CODE='$STS_CODE',
	PROFIL_IMG='$fn',
	PROFIL_IMG_ORIGINAL='$PROFIL_IMG_ORIGINAL',
	PROFIL_IMG_ORIGINAL_PATH='$PROFIL_IMG_ORIGINAL_PATH',
	SNAME='$SNAME',
	SNAME_EN='$SNAME_EN',
	SNAME_CH='$SNAME_CH',
	FLOOR='$FLOOR',
	FLOOR_ROW='$FLOOR_ROW',
	FLOOR_HO='$FLOOR_HO',
	SHOP_CODE='$SHOP_CODE',
	".$pass.",
	TEL='$TEL',
	BUSINESS_REGISTERED_NUMBER='$BUSINESS_REGISTERED_NUMBER',
	CORPORATE_PERSONAL='$CORPORATE_PERSONAL',
	BUSINESS_REGISTERED_IMG='$bizfile',
	BUSINESS_REGISTERED_IMG_ORIGINAL='$BUSINESS_REGISTERED_IMG_ORIGINAL',
	BUSINESS_REGISTERED_IMG_ORIGINAL_PATH='$BUSINESS_REGISTERED_IMG_ORIGINAL_PATH',
	CELLPHONE='$CELLPHONE',
	EMAIL='$EMAIL',
	KAKAO_EMAIL='$KAKAO_EMAIL',
	WECHAT_EMAIL='$WECHAT_EMAIL',
	BANK_CODE='$BANK_CODE',
	ACCOUNT_NUMBER='$ACCOUNT_NUMBER',
	ACCOUNT_HOLDER='$ACCOUNT_HOLDER',
	PAYMENT_DATE='$PAYMENT_DATE',
	CONTRACT_CODE='$CONTRACT_CODE',
	UPDATE_DATE=now(),
	STORE_PROPERTY_SEQ='$sp',
	ADDRESS='$ADDRESS' 
	where SELLER_CODE='$SELLER_CODE'
	";

}else{

$que="insert into seller values('',
'$SELLER_ID',
'$SELLER_NAME',
'$STS_CODE',
'$fn',
'$PROFIL_IMG_ORIGINAL',
'$PROFIL_IMG_ORIGINAL_PATH',
'$SNAME',
'$SNAME_EN',
'$SNAME_CH',
'$FLOOR',
'$FLOOR_ROW',
'$FLOOR_HO',
'$SHOP_CODE',
password('".$passwd."'),
'$TEL',
'$BUSINESS_REGISTERED_NUMBER',
'$CORPORATE_PERSONAL',
'$bizfile',
'$BUSINESS_REGISTERED_IMG_ORIGINAL',
'$BUSINESS_REGISTERED_IMG_ORIGINAL_PATH',
'$CELLPHONE',
'$EMAIL',
'$KAKAO_EMAIL',
'$WECHAT_EMAIL',
'$BANK_CODE',
'$ACCOUNT_NUMBER',
'$ACCOUNT_HOLDER',
'$PAYMENT_DATE',
'$CONTRACT_CODE',
now(),
'$UPDATE_DATE',
'$sp',
'$ADDRESS')";

}

$sql=$mysqli->query($que) or die($mysqli->error);
$insert_id=$mysqli->insert_id;

if($sql){

	if(!$SELLER_CODE){

		$c0=10-strlen($insert_id);
		for($k=0;$k<$c0;$k++){
			$cn.="0";
		}
			$insert_id=$cn.$insert_id;
			$img_dir2=$_SERVER["DOCUMENT_ROOT"]."media/SHOP/".$SHOP_CODE."/".$insert_id;
			$img_dir=$_SERVER["DOCUMENT_ROOT"]."media/SHOP/".$SHOP_CODE."/".$insert_id."/COMMON/";

			if(!is_dir($img_dir)){
				@umask(0);
				@mkdir($img_dir,0777,true);
			}

			if($_FILES["fn"]["name"])
			{
				$aaa = move_uploaded_file($_FILES["fn"]["tmp_name"], $img_dir.$fnm.".".$ext);
			}

			if($_FILES["bizfile"]["name"])
			{
				$aaa = move_uploaded_file($_FILES["bizfile"]["tmp_name"], $img_dir.$fnm2.".".$ext2);

			}

	}

	location_is('','','입력했습니다.');
}else{
	location_is('','','디비입력에 실패했습니다. 다시 입력해주십시오.');
}

?>

