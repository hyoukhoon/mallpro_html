<?php session_start();

include $_SERVER["DOCUMENT_ROOT"]."/inc/dbcon.php";

$REQUEST_SEQ=$_POST['REQUEST_SEQ'];
$STS_CODE=$_POST['STS_CODE'];
$REPLY_CONTENTS=addslashes($_POST['REPLY_CONTENTS']);

$que="select * 
	from seller_request  where REQUEST_SEQ='".$REQUEST_SEQ."'";
$result = $mysqli->query($que) or die("2:".$mysqli->error);
$rs = $result->fetch_object();//데이타를 읽어와서 seller 테이블에 입력한다.

$que3="select count(1) from seller where SELLER_ID='".$rs->SELLER_ID."'";
$result3 = $mysqli->query($que3) or die("1:".$mysqli->error);
$rs3 = $result3->fetch_array();//기존 seller테이블에 있는지 확인
if($rs3[0]){
	location_is('','','이미 같은 도매회원 아이디가 존재합니다.');
	exit;
}

$que="insert into seller values ('',
'$rs->SELLER_ID',
'$rs->SELLER_NAME',
'$rs->STS_CODE',
'$rs->PROFIL_IMG',
'$rs->PROFIL_IMG_ORIGINAL',
'$rs->PROFIL_IMG_ORIGINAL_PATH',
'$rs->SNAME',
'$rs->SNAME_EN',
'$rs->SNAME_CH',
'$rs->FLOOR',
'$rs->FLOOR_ROW',
'$rs->FLOOR_HO',
'$rs->SHOP_CODE',
'$rs->PASSWD',
'$rs->TEL',
'$rs->BUSINESS_REGISTERED_NUMBER',
'$rs->CORPORATE_PERSONAL',
'$rs->BUSINESS_REGISTERED_IMG',
'$rs->BUSINESS_REGISTERED_IMG_ORIGINAL',
'$rs->BUSINESS_REGISTERED_IMG_ORIGINAL_PATH',
'$rs->CELLPHONE',
'$rs->EMAIL',
'$rs->KAKAO_EMAIL',
'$rs->WECHAT_EMAIL',
'$rs->BANK_CODE',
'$rs->ACCOUNT_NUMBER',
'$rs->ACCOUNT_HOLDER',
'$rs->PAYMENT_DATE',
'$rs->CONTRACT_CODE',
now(),
'$rs->UPDATE_DATE',
'$rs->STORE_PROPERTY_SEQ',
'$rs->ADDRESS')";
$sql=$mysqli->query($que) or die($mysqli->error);
$insert_id=$mysqli->insert_id;
$c0=10-strlen($insert_id);
		for($k=0;$k<$c0;$k++){
			$cn.="0";
		}
$insert_id=$cn.$insert_id;


$que2="update seller_request set 
REPLY_CONTENTS='$REPLY_CONTENTS',
STS_CODE='$STS_CODE',
UPDATE_DATE=now() 
where REQUEST_SEQ='".$REQUEST_SEQ."'";
$sql=$mysqli->query($que2) or die($mysqli->error);

$pn=$rs->PROFIL_IMG;//프로필이미지
$bi=$rs->BUSINESS_REGISTERED_IMG;//사업자
$opath="http://www.mediapic.net/image/member/";
$new_path=$_SERVER["DOCUMENT_ROOT"]."media/SHOP/".$rs->SHOP_CODE."/".$insert_id."/COMMON/";
if(!is_dir($new_path)){
	@umask(0);
	@mkdir($new_path,0777,true);
}

$oldfile=$opath.$bi;
$newfile=$new_path.$bi;
$oldfile2=$opath.$pn;
$newfile2=$new_path.$pn;
copy($oldfile, $newfile);
copy($oldfile2, $newfile2);

if(file_exists($newfile)) {
//	@unlink($oldfile);
}

if(file_exists($newfile2)) {
//	@unlink($oldfile2);
}


if($sql){
	location_is_close('입력했습니다.');
}else{
	location_is('','','디비입력에 실패했습니다. 다시 입력해주십시오.');
}

?>

