<?php session_start();

include $_SERVER["DOCUMENT_ROOT"]."/inc/dbcon.php";

$USD=$_POST['USD'];
$JPY=$_POST['JPY'];
$CNY=$_POST['CNY'];
$EUR=$_POST['EUR'];
$ER_SEQ=$_POST['ER_SEQ'];


$que="update common_exchange_rate set 
USD='$USD',
JPY='$JPY',
CNY='$CNY',
EUR='$EUR',
UPDATE_DATE=now()
where ER_SEQ='".$ER_SEQ."'";

$sql=$mysqli->query($que) or die($mysqli->error);

if($sql){
	location_is_close('수정했습니다.');
}else{
	location_is('','','디비입력에 실패했습니다. 다시 입력해주십시오.');
}

?>

