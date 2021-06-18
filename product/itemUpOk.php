<?php session_start();
include $_SERVER["DOCUMENT_ROOT"]."/inc/dbcon.php";

//ini_set('display_errors', 1);
//ini_set('display_startup_errors', 1);
//error_reporting(E_ALL);

if(!$_SESSION['AID']){
	location_is_close('로그인이 필요한 메뉴입니다.');
	exit;
}

$uid=$_SESSION['AID'];

$jsonCheck=urldecode($_POST['jsonCheck']);
$jsonName=rawurldecode($_POST['jsonName']);
$jsonMemo=rawurldecode($_POST['jsonMemo']);
$jsonPrice=urldecode($_POST['jsonPrice']);
$jsonSendMethod=urldecode($_POST['jsonSendMethod']);
$jsonSendFeePayType=urldecode($_POST['jsonSendFeePayType']);
$jsonSendFeeType=urldecode($_POST['jsonSendFeeType']);
$jsonSendFeeFreeLimit=urldecode($_POST['jsonSendFeeFreeLimit']);
$jsonSendFeeEachCnt=urldecode($_POST['jsonSendFeeEachCnt']);

$jsonSendBasicFee=urldecode($_POST['jsonSendBasicFee']);
$jsonRetunSendFee=urldecode($_POST['jsonRetunSendFee']);
$jsonChangeSendFee=urldecode($_POST['jsonChangeSendFee']);
$jsonOptCont1=rawurldecode($_POST['jsonOptCont1']);
$jsonOptCont2=rawurldecode($_POST['jsonOptCont2']);
$jsonOptCont3=rawurldecode($_POST['jsonOptCont3']);

$jsonNowFee=urldecode($_POST['jsonNowFee']);
$jsonNowUnit=urldecode($_POST['jsonNowUnit']);
$jsonupRatio=urldecode($_POST['jsonupRatio']);
$jsonoptionType=urldecode($_POST['jsonoptionType']);


$itemNum=json_decode($jsonCheck);
$itemName=json_decode($_POST['jsonName']);
$itemMemo=json_decode($_POST['jsonMemo']);

$itemPrice=json_decode($jsonPrice);
$sendMethod=json_decode($jsonSendMethod);
$sendFeePayType=json_decode($jsonSendFeePayType);
$sendFeeType=json_decode($jsonSendFeeType);
$sendFeeFreeLimit=json_decode($jsonSendFeeFreeLimit);
$sendFeeEachCnt=json_decode($jsonSendFeeEachCnt);

$sendBasicFee=json_decode($jsonSendBasicFee);
$retunSendFee=json_decode($jsonRetunSendFee);
$changeSendFee=json_decode($jsonChangeSendFee);
$optCont1=json_decode($jsonOptCont1);
$optCont2=json_decode($jsonOptCont2);
$optCont3=json_decode($jsonOptCont3);
$nowFee=json_decode($jsonNowFee);
$nowUnit=json_decode($jsonNowUnit);
$upRatio=json_decode($jsonupRatio);
$optionType=json_decode($jsonoptionType);

	$kk=0;
	$cny=cnyIs();

	foreach($itemNum as $i){


		$query = "update myItem set itemName='".rawurldecode($itemName[$kk])."',itemMemo='".rawurldecode($itemMemo[$kk])."', price='".$itemPrice[$kk]."', sendMethod='".$sendMethod[$kk]."', sendFeePayType='".$sendFeePayType[$kk]."', sendFeeType='".$sendFeeType[$kk]."', sendFeeFreeLimit='".$sendFeeFreeLimit[$kk]."', sendFeeEachCnt='".$sendFeeEachCnt[$kk]."', sendBasicFee='".$sendBasicFee[$kk]."', retunSendFee='".$retunSendFee[$kk]."', changeSendFee='".$changeSendFee[$kk]."', nowFee='".$nowFee[$kk]."', nowUnit='".$nowUnit[$kk]."' where num='".$i."'";
		$sql = $mysqli->query($query) or die($mysqli->error);

		$que3="select pnum from myItem where num='".$i."'";
		$result3 = $mysqli->query($que3) or die("53:".$mysqli->error);
		$rs3 = $result3->fetch_array();

		$optionValue1=$optCont1[$kk];
		$optionValue2=$optCont2[$kk];
		$optionValue3=$optCont3[$kk];

		
		$result2 = $mysqli->query("select * from optiontable where pnum='".$rs3[0]."'") or die("725:".$mysqli->error);
		$rs2 = $result2->fetch_object();

		$optValArray1=explode(",",$optionValue1);
		$optValArray2=explode(",",$optionValue2);
		$optValArray3=explode(",",$optionValue3);
		$optMixArray=json_decode(urldecode($rs2->optionMixPrice));

if(count($optMixArray)){
		
		$optMix=array();
		if($optionValue1 and $optionValue2 and $optionValue3){
			$i=0;

				$a=0;
				foreach($optValArray1 as $optv1){
					$b=0;
					foreach($optValArray2 as $optv2){
						$c=0;
						foreach($optValArray3 as $optv3){

							$optMix[$i]["name"]=$optValArray1[$a]." + ".$optValArray2[$b]." + ".$optValArray3[$c];
							$optMix[$i]["price"]=$optMixArray[$i]->price;
							$optMix[$i]["pricek"]=$optMixArray[$i]->pricek;
							$optMix[$i]["promoPrice"]=$optMixArray[$i]->promoPrice;
							$optMix[$i]["promoPricek"]=$optMixArray[$i]->promoPricek;
							$c++;
							$i++;
						}

						$b++;
						
					}
					$a++;

				
			}
		}else if($optionValue1 and $optionValue2){
			$i=0;

				$a=0;
				foreach($optValArray1 as $optv1){
					$b=0;
					foreach($optValArray2 as $optv2){
						$optMix[$i]["name"]=$optValArray1[$a]." + ".$optValArray2[$b];
						$optMix[$i]["price"]=$optMixArray[$i]->price;
						$optMix[$i]["pricek"]=$optMixArray[$i]->pricek;
						$optMix[$i]["promoPrice"]=$optMixArray[$i]->promoPrice;
						$optMix[$i]["promoPricek"]=$optMixArray[$i]->promoPricek;
						$b++;
						$i++;
					}
					$a++;

				
			}
		}else if($optionValue1 and !$optionValue2){
			$i=0;
			foreach($optMixArray as $oa1){

						$optMix[$i]["name"]=$optValArray1[$i];
						$optMix[$i]["price"]=$oa1->price;
						$optMix[$i]["pricek"]=$oa1->pricek;
						$optMix[$i]["promoPrice"]=$oa1->promoPrice;
						$optMix[$i]["promoPricek"]=$oa1->promoPricek;
				$i++;
			}
		}else if(!$optionValue1 and $optionValue2){
			$i=0;
			foreach($optMixArray as $oa2){
						$optMix[$i]["name"]=$optValArray2[$i];
						$optMix[$i]["price"]=$oa2->price;
						$optMix[$i]["pricek"]=$oa2->pricek;
						$optMix[$i]["promoPrice"]=$oa1->promoPrice;
						$optMix[$i]["promoPricek"]=$oa1->promoPricek;
				$i++;

			}
		}

		$optMix=urlencode(json_encode($optMix));

}

		$query="update optiontable set optionValue1='$optionValue1', optionValue2='$optionValue2', optionValue3='$optionValue3', optionMixPrice='$optMix' where pnum='".$rs3[0]."' and isRegist<>'1'";
		$sql = $mysqli->query($query) or die($mysqli->error);

		//$query="update taobao set optionType='".$optionType[$kk]."' where num='".$rs3[0]."'";
		//$sql = $mysqli->query($query) or die($mysqli->error);

		$kk++;
	}



$data=array("result"=>1,"val"=>"등록했습니다.");
echo json_encode($data);


?>