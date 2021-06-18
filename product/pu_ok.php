<?php  include $_SERVER["DOCUMENT_ROOT"]."/inc/dbcon.php";

	$ADMIN=$_POST['ADMIN'];
	$SELLER_CODE=$_POST['SELLER_CODE'];
	$PRODUCT_ID=$_POST['PRODUCT_ID'];
	$DISPLAY_CODE=$_POST['DISPLAY_CODE'];
	$PRODUCT_NAME=removeHackTag($_POST['PRODUCT_NAME']);
	$PRODUCT_NAME_CH=removeHackTag($_POST['PRODUCT_NAME_CH']);
	$SHORTINFO=removeHackTag(addslashes($_POST['SHORTINFO']));
	$SHORTINFO_CH=removeHackTag(addslashes($_POST['SHORTINFO_CH']));
	$PROMOTION_YN=$_POST['PROMOTION_YN'];
	$PROMOTION_COLOR=$_POST['PROMOTION_COLOR'];
	$PROMOTION_CONTENTS=removeHackTag(addslashes($_POST['PROMOTION_CONTENTS']));
	$cate1=$_REQUEST['cate1'];
	$cate2=$_REQUEST['cate2'];
	$mate=$_REQUEST['mate'];//소재
	$pt=$_REQUEST['pt'];//퍼센트
	$COLOR=$_REQUEST['COLOR'];
	$COLOR_CH=$_REQUEST['COLOR_CH'];
	$WHOLESALE_PRICE=removeHackTag($_POST['WHOLESALE_PRICE']);
	$WHOLESALE_PRICE_CH=removeHackTag($_POST['WHOLESALE_PRICE_CH']);
	$DISP=$_POST['DISP'];
	$DISPLAY_START_DATE=$_POST['DISPLAY_START_DATE'];
	$DISPLAY_END_DATE=$_POST['DISPLAY_END_DATE'];
	$DISPLAY_YN=$_POST['DISPLAY_YN'];

	

//PRODUCT_CODE
$Pcode="01".$ADMIN;
$que3="select max(PRODUCT_CODE) from product where left(PRODUCT_CODE,4)='".$Pcode."'";
$result3 = $mysqli->query($que3) or die("1:".$mysqli->error);
$rs3 = $result3->fetch_array();
$pi=substr($rs3[0],4)+1;
$c0=5-strlen($pi);
for($k=0;$k<$c0;$k++){
	$cn.="0";
}
$PRODUCT_CODE=$Pcode.$cn.$pi;

//DISPLAY_CODE
$que3="select CODE_NAME from material_code a, product_material_info b where a.MATR_CODE=b.MATR_CODE and b.PRODUCT_ID='".$PRODUCT_ID."'";
$result3 = $mysqli->query($que3) or die("1:".$mysqli->error);
$rs3 = $result3->fetch_array();
$dCode=$rs3[0];

$que3="select max(DISPLAY_CODE) from product where left(DISPLAY_CODE,2)='".$dCode."'";
$result3 = $mysqli->query($que3) or die("1:".$mysqli->error);
$rs3 = $result3->fetch_array();
$pi=substr($rs3[0],2)+1;
$c0=5-strlen($pi);
for($k=0;$k<$c0;$k++){
	$cd.="0";
}
$DISPLAY_CODE=$dCode.$cd.$pi;

	
$que="insert into product values ('',
'$PRODUCT_ID',
'$GLOBAL_PINFO',
'$PRODUCT_TYPE',
'$STYLE',
'$PRODUCT_NAME',
'$PRODUCT_NAME__EN',
'$PRODUCT_NAME_CH',
'$PRODUCT_CODE',
'$DISPLAY_CODE',
'$BRAND',
'$BRAND_NAME',
'$C_IX',
'$COMPANY',
'$PAPER_PNAME',
'$BUYING_COMPANY',
'$SHORTINFO',
'$SHORTINFO_EN',
'$SHORTINFO_CH',
'$BUYINGSERVICE_COPRICE',
'$WHOLESALE_PRICE',
'$WHOLESALE_SELLPRICE',
'$PROMOTION_YN',
'$PROMOTION_CONTENTS',
'$PROMOTION_COLOR',
'$LISTPRICE',
'$SELLPRICE',
'$PREMIUMPRICE',
'$COPRICE',
'$WHOLESALE_YN',
'$OFFLINE_YN',
'$WHOLESALE_RESERVE_YN',
'$WHOLESALE_RESERVE',
'$WHOLESALE_RESERVE_RATE',
'$WHOLESALE_RATE_TYPE',
'$RESERVE_YN',
'$RESERVE',
'$RESERVE_RATE',
'$RATE_TYPE',
'$SNS_BTN_YN',
'$SNS_BTN',
'$DELIVERY_COUPON_YN',
'$COUPON_USE_YN',
'$BIMG',
'$MIMG',
'$MSIMG',
'$SIMG',
'$CIMG',
'$BASICINFO',
'$BASICINFO_EN',
'$BASICINFO_CH',
'$M_BASICINFO',
'$ICONS',
'$STATE',
'$PRODUCT_WEIGHT',
'$IS_ADULT',
'$IS_MOBILE_USE',
'$DISP',
'$MOVIE',
'$VIEWORDER',
'$SELLER_CODE',
'$TRADE_ADMIN',
'$MD_CODE',
'$SELL_ING_CNT',
'$STOCK',
'$SAFESTOCK',
'$AVAILABLE_STOCK',
'$REMAIN_STOCK',
'$VIEW_CNT',
'$ORDER_CNT',
'$RECOMMEND_CNT',
'$WISH_CNT',
'$AFTER_SCORE',
'$AFTER_CNT',
'$PRODUCT_POINT',
'$PRODUCT_LEVEL',
'$SEARCH_KEYWORD',
'$REG_CATEGORY',
'$OPTION_STOCK_YN',
'$SUPPLY_COMPANY',
'$INVENTORY_INFO',
'$SURTAX_YORN',
'$DELIVERY_COMPANY',
'$ONE_COMMISSION',
'$COMMISSION',
'$WHOLESALE_COMMISSION',
'$ACCOUNT_TYPE',
'$CUPON_USE_YN',
'$STOCK_USE_YN',
'$DELIVERY_POLICY',
'$DELIVERY_PRODUCT_POLICY',
'$DELIVERY_PACKAGE',
'$DELIVERY_FREEPRICE',
'$DELIVERY_PRICE',
'$DELIVERY_TYPE',
'$FREE_DELIVERY_YN',
'$FREE_DELIVERY_COUNT',
'$IS_SELL_DATE',
'$SELL_PRIOD_SDATE',
'$SELL_PRIOD_EDATE',
'$ALLOW_MAX_CNT',
'$WHOLESALE_ALLOW_MAX_CNT',
'$ALLOW_BASIC_CNT',
'$WHOLESALE_ALLOW_BASIC_CNT',
'$ALLOW_ORDER_TYPE',
'$ALLOW_ORDER_CNT_BYONESELL',
'$ALLOW_ORDER_CNT_BYONEPERSON',
'$ALLOW_ORDER_MINIMUM_CNT',
'$ALLOW_BYONEPERSON_CNT',
'$WHOLESALE_ALLOW_BYONEPERSON_CNt',
'$MD_ONE_COMMISSION',
'$MD_DISCOUNT_NAME',
'$MD_SELL_DATE_USE',
'$MD_SELL_PRIOD_SDATE',
'$MD_SELL_PRIOD_EDATE',
'$WHOLE_HEAD_COMPANY_SALE_RATE',
'$WHOLE_SELLER_COMPANY_SALE_RATE',
'$HEAD_COMPANY_SALE_RATE',
'$SELLER_COMPANY_SALE_RATE',
'$ORIGIN',
'$MAKE_DATE',
'$EXPIRY_DATE',
'$MANDATORY_TYPE',
'$RELATION_PRODUCT_CNT',
'$RELATION_DISPLAY_ORDER_TYPE',
'$RELATION_DISPLAY_ORDER_DATE',
'$RELATION_DISPLAY_TYPE',
'$BARCODE',
'$INPUT_DATE',
'$IS_AUTO_CHANGE',
'$AUTO_CHANGE_STATE',
'$SUBSTITUDE_YN',
'$SUBSTITUDE_TOTAL',
'$SUBSTITUDE_SELLER',
'$SUBSTITUDE_RATE',
'$ETC1',
'$ETC2',
'$ETC3',
'$ETC4',
'$ETC5',
'$ETC6',
'$ETC7',
'$ETC8',
'$ETC9',
'$ETC10',
'$DOWNLOAD_IMG',
'$DOWNLOAD_DESC',
'$HOTCON_EVENT_ID',
'$HOTCON_PCODE',
'$CO_GOODS',
'$CO_PID',
'$CO_COMPANY_ID',
'$BS_GOODS_URL',
'$BS_SITE',
'$PRICE_POLICY',
'$CURRENCY_IX',
'$ROUND_PRECISION',
'$ROUND_TYPE',
'$EDITDATE',
'$NAVER_UPDATE_DATE',
'$DISP_NAVER',
'$DISP_DAUM',
'$ADD_INDEX_DATE',
'$ADD_INDEX_DATE2',
'$IS_POS_LINK',
'$IS_ERP_LINK',
'$ADD_STATUS',
'$CATEGORY_ADD_INFOS',
now(),
'$REGDATE_DESC',
'$REG_CHARGER_IX',
'$REG_CHARGER_NAME',
'$GIFT_SPRICE',
'$GIFT_EPRICE',
'$IS_DELETE',
'$PRICE_DISP_YN',
'$REG_STANDARD_CATEGORY',
'$DISPLAY_YN',
'$DISPLAY_START_DATE',
'$DISPLAY_END_DATE')";

//echo $que;

$sql=$mysqli->query($que) or die("4:".$mysqli->error);

if($sql){

	for($j=0;$j<sizeof($cate1);$j++){

		if($cate2[$j]){
			$ca=$cate2[$j];
		}else{
			$ca=$cate1[$j];
		}

		$que="insert into category_relation values ('','$ca',
		'$PRODUCT_ID',
		'1',
		'$BASIC',
		'$INSERT_YN',
		now())";
//		echo $que."<br>";
		$mysqli->query($que) or die("1:".$mysqli->error);

	}

	for($j=0;$j<sizeof($mate);$j++){

		$que="insert into product_material_info values ('','$PRODUCT_ID','$mate[$j]','$pt[$j]',now(),now())";
//		echo $que."<br>";
		$mysqli->query($que) or die("2:".$mysqli->error);
	}

	for($j=0;$j<sizeof($COLOR);$j++){

		$que="insert into product_color values ('','$PRODUCT_ID','$COLOR[$j]','$COLOR_EN','$COLOR_CH[$j]',now(),now())";
//		echo $que."<br>";
		$mysqli->query($que) or die("3:".$mysqli->error);
	}


	location_is_close('등록했습니다.');
}

?>