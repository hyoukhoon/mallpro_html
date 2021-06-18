<?php include $_SERVER["DOCUMENT_ROOT"]."/inc/dbcon.php";

$SERVICE_ID=$_POST['SERVICE_ID']??$_GET['SERVICE_ID'];
$mode=$_POST['mode']??$_GET['mode'];
$SERVICE_PRODUCT_NAME=removeHackTag($_POST['SERVICE_PRODUCT_NAME']);
$SERVICE_STS_CODE=$_POST['SERVICE_STS_CODE'];
$DURATION=$_POST['DURATION'];
$QUANTITY=$_POST['QUANTITY'];
$CONTENTS=removeHackTag(addslashes($_POST['CONTENTS']));
$PRODUCT_CONDITION=removeHackTag(addslashes($_POST['PRODUCT_CONDITION']));
$PRICE=removeHackTag($_POST['PRICE']);
$REMARK=removeHackTag($_POST['REMARK']);
$STIPULATION=$_POST['STIPULATION']??"0";
$DIVISION_CODE=$_POST['DIVISION_CODE'];




if($SERVICE_ID){

	if($mode=="del"){
			$sql=$mysqli->query("delete from service_product where SERVICE_ID='".$SERVICE_ID."'") or die($mysqli->error);
			if($sql){
				location_is_close('삭제했습니다.');
				exit;
			}
	}


	$que="update service_product set 
SERVICE_PRODUCT_NAME='$SERVICE_PRODUCT_NAME',
SERVICE_STS_CODE='$SERVICE_STS_CODE',
DURATION='$DURATION',
QUANTITY='$QUANTITY',
CONTENTS='$CONTENTS',
PRICE='$PRICE',
REMARK='$REMARK',
PRODUCT_CONDITION='$PRODUCT_CONDITION',
DIVISION_CODE='$DIVISION_CODE',
STIPULATION='$STIPULATION',
UPDATE_DATE=now() 
where SERVICE_ID='$SERVICE_ID'";

}else{

$que="insert into service_product values('',
'$SERVICE_PRODUCT_NAME',
'$SERVICE_STS_CODE',
'$DURATION',
'$QUANTITY',
'$CONTENTS',
'$PRODUCT_CONDITION',
'$PRICE',
'$REMARK',
'$DIVISION_CODE',
'$STIPULATION',
now(),
'$UPDATE_DATE')";

}

$sql=$mysqli->query($que) or die($mysqli->error);

if($sql){
	location_is('','','입력했습니다.');
}else{
	location_is('','','디비입력에 실패했습니다. 다시 입력해주십시오.');
}

?>

