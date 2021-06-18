<?php session_start();

include $_SERVER["DOCUMENT_ROOT"]."/inc/dbcon.php";

$RETAILER_CODE=$_POST['RETAILER_CODE'];
$AUTH_CODE=$_POST['AUTH_CODE'];
$L1=$_POST['L1'];
$L2=$_POST['L2'];
$AUTH_MEMO=addslashes($_POST['AUTH_MEMO']);

$que="select * 
	from retailer  where RETAILER_CODE='".$RETAILER_CODE."'";
$result = $mysqli->query($que) or die("2:".$mysqli->error);
$rs = $result->fetch_object();//데이타를 읽어와서 seller 테이블에 입력한다.

$rc= (int)$rs->RETAILER_CODE; 
$pn=$rs->PROFIL_IMG;//프로필이미지
$bi=$rs->BUSINESS_REGISTERED_IMG;//사업자
$opath="http://www.mediapic.net/image/member/";
$new_path=$_SERVER["DOCUMENT_ROOT"]."media/RETAILER/".$rc."/";

$oldfile=$opath.$bi;
$newfile=$new_path.$bi;
$oldfile2=$opath.$pn;
$newfile2=$new_path.$pn;

if(!is_dir($new_path)){
	@umask(0);
	@mkdir($new_path,0777,true);
}

copy($oldfile, $newfile);
copy($oldfile2, $newfile2);

//echo "n:".$newfile.",".$newfile2;

if(file_exists($newfile)) {
//	@unlink($oldfile);
}

if(file_exists($newfile2)) {
//	@unlink($oldfile2);
}

$que2="update retailer set 
AUTH_MEMO='$AUTH_MEMO',
AUTH_CODE='$AUTH_CODE',
L1='$L1',
L2='$L2',
UPDATE_DATE=now() 
where RETAILER_CODE='".$RETAILER_CODE."'";
$sql=$mysqli->query($que2) or die($mysqli->error);

if($sql){
	location_is_close('입력했습니다.');
}else{
	location_is('','','디비입력에 실패했습니다. 다시 입력해주십시오.');
}

?>

