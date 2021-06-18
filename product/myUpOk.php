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

$jsonCheck=$_POST['jsonCheck'];
$uid=$_SESSION['AID'];
$itemNum=json_decode($jsonCheck);

foreach($itemNum as $i){

	$que="SELECT * FROM taobao WHERE num='$i'";
	$result = $mysqli->query($que);
	$rs = $result->fetch_object();

		$que2="SELECT count(1) FROM myItem WHERE  uid='$uid' and pnum='".$rs->num."'";
		$result2 = $mysqli->query($que2);
		$rs2 = $result2->fetch_array();

	if(!$rs2[0]){

		$query = "INSERT INTO `mallpro`.`myItem`
						(`uid`,
						`pnum`,
						`itemStatus`,
						`cateId`,
						`itemName`,
						`price`,
						`itemCnt`,
						`asContent`,
						`asPhone`,
						`itemThumb`,
						`itemImage`,
						`itemContents`,
						`itemCode`,
						`sellerBarCode`,
						`company`,
						`brand`,
						`makeDate`,
						`limitDate`,
						`taxGubun`,
						`isChild`,
						`reviewDisplay`,
						`originCode`,
						`importCompany`,
						`originMulti`,
						`originDirect`,
						`sendMethod`,
						`sendFeeType`,
						`sendBasicFee`,
						`sendFeePayType`,
						`sendFeeFreeLimit`,
						`sendFeeEachCnt`,
						`retunSendFee`,
						`changeSendFee`,
						`regionSendFee`,
						`installFee`,
						`sellerSp`,
						`nowFee`,
						`nowUnit`,
						`multiBuySaleCondition`,
						`multiBuySaleConditionUnit`,
						`multiBuySaleValue`,
						`multiBuySaleUnit`,
						`point`,
						`pointUnit`,
						`textReviewPoint`,
						`mediaReviewPoint`,
						`monthlyTextReviewPoint`,
						`monthlyMediaReviewPoint`,
						`toktokReviewPoint`,
						`noInterestMonth`,
						`serviceItem`,
						`optionType`,
						`optionName`,
						`optionValue`,
						`optionPrice`,
						`optionItemCnt`,
						`addItemName`,
						`addItemValue`,
						`addItemprice`,
						`addItemCnt`,
						`itemInfoItem`,
						`itemInfoModel`,
						`itemInfoGubun`,
						`itemInfoCompany`,
						`storeZzimMember`,
						`cultureFee`,
						`isbn`,
						`isbnGubun`,
						`regDate`)
						VALUES
						('$uid',
						'".$rs->num."',
						'$itemStatus',
						'$cateId',
						'".$subject."',
						'".$price."',
						'$itemCnt',
						'$asContent',
						'$asPhone',
						'".$rs->thumbFile."',
						'".$rs->itemImage."',
						'".$rs->contents."',
						'$itemCode',
						'$sellerBarCode',
						'$company',
						'$brand',
						'$makeDate',
						'$limitDate',
						'$taxGubun',
						'$isChild',
						'$reviewDisplay',
						'$originCode',
						'$importCompany',
						'$originMulti',
						'$originDirect',
						'$sendMethod',
						'$sendFeeType',
						'$sendBasicFee',
						'$sendFeePayType',
						'$sendFeeFreeLimit',
						'$sendFeeEachCnt',
						'$retunSendFee',
						'$changeSendFee',
						'$regionSendFee',
						'$installFee',
						'$sellerSp',
						'$nowFee',
						'$nowUnit',
						'$multiBuySaleCondition',
						'$multiBuySaleConditionUnit',
						'$multiBuySaleValue',
						'$multiBuySaleUnit',
						'$point',
						'$pointUnit',
						'$textReviewPoint',
						'$mediaReviewPoint',
						'$monthlyTextReviewPoint',
						'$monthlyMediaReviewPoint',
						'$toktokReviewPoint',
						'$noInterestMonth',
						'$serviceItem',
						'$optionType',
						'$optionName',
						'$optionValue',
						'$optionPrice',
						'$optionItemCnt',
						'$addItemName',
						'$addItemValue',
						'$addItemprice',
						'$addItemCnt',
						'$itemInfoItem',
						'$itemInfoModel',
						'$itemInfoGubun',
						'$itemInfoCompany',
						'$storeZzimMember',
						'$cultureFee',
						'$isbn',
						'$isbnGubun',
						now())";
		$sql = $mysqli->query($query) or die($mysqli->error);

	}

}

$data=array("result"=>1,"val"=>"등록했습니다.");

echo json_encode($data);


?>