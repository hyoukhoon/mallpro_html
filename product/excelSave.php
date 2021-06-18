<?php session_start();
include $_SERVER["DOCUMENT_ROOT"]."/inc/dbcon.php";
$uid=$_SESSION['AID'];

error_reporting(E_ALL);
ini_set('display_errors', TRUE);
ini_set('display_startup_errors', TRUE);
date_default_timezone_set('Asia/Seoul');

$jsonCheck=urldecode($_GET['jsonCheck']);
$itemNum=json_decode($jsonCheck);

if(!count($itemNum)){
	location_is('','','상품을 선택하세요.');
	exit;
}


$w="";
foreach($itemNum as $i){
		$w.="'".$i."',";
}
	$w=substr($w,0,-1);
	$where=" and a.num in (".$w.")";
	if(!$order){
		$order=" order by a.num desc";
	}

	$que="select * , a.price as myPrice, b.price as itemPrice, b.num as pnum 
	from myItem a, taobao b where a.pnum=b.num and a.uid='$uid'";
	$que.=$where;
	$que.=$order;

//	echo $que;
	$result = $mysqli->query($que) or die("3:".$mysqli->error);
	while($rs = $result->fetch_object()){
			$rsc[]=$rs;
	}

	$que2="select * from storeinfo where uid='".$uid."'";
	$result2 = $mysqli->query($que2) or die($mysqli->error);
	$rs2 = $result2->fetch_object();

	if(!isCouponCnt($_SESSION['AID'])){
		location_is('','','엑셀다운로드는 유료회원만 가능합니다.');
		exit;
	}


if (PHP_SAPI == 'cli')
	die('This example should only be run from a Web Browser');
/** Include PHPExcel */
require_once '../Classes/PHPExcel.php';
// Create new PHPExcel object
$objPHPExcel = new PHPExcel();
// Set document properties
$objPHPExcel->getProperties()->setCreator("Maarten Balliauw")
							 ->setLastModifiedBy("Maarten Balliauw")
							 ->setTitle("Office 2007 XLSX Test Document")
							 ->setSubject("Office 2007 XLSX Test Document")
							 ->setDescription("Test document for Office 2007 XLSX, generated using PHP classes.")
							 ->setKeywords("office 2007 openxml php")
							 ->setCategory("Test result file");
$objPHPExcel->getActiveSheet()->getStyle('AY1')->getAlignment()->setWrapText(true);
$objPHPExcel->getActiveSheet()->getStyle('AZ1')->getAlignment()->setWrapText(true);
$objPHPExcel->getActiveSheet()->getStyle('BA1')->getAlignment()->setWrapText(true);
// Add some data
$objPHPExcel->setActiveSheetIndex(0)
            ->setCellValue('A1', '상품상태')
            ->setCellValue('B1', '카테고리ID')
            ->setCellValue('C1', '상품명')
            ->setCellValue('D1', '판매가')
            ->setCellValue('E1', '재고수량')
            ->setCellValue('F1', 'A/S 안내내용')
            ->setCellValue('G1', 'A/S 전화번호')
            ->setCellValue('H1', '대표 이미지 파일명')
            ->setCellValue('I1', '추가 이미지 파일명')
            ->setCellValue('J1', '상품 상세정보')
            ->setCellValue('K1', '판매자 상품코드')
            ->setCellValue('L1', '판매자 바코드')
            ->setCellValue('M1', '제조사')
            ->setCellValue('N1', '브랜드')
            ->setCellValue('O1', '제조일자')
            ->setCellValue('P1', '유효일자')
            ->setCellValue('Q1', '부가세')
            ->setCellValue('R1', '미성년자 구매')
            ->setCellValue('S1', '구매평 노출여부')
            ->setCellValue('T1', '원산지 코드')
            ->setCellValue('U1', '수입사')
            ->setCellValue('V1', '복수원산지 여부')
            ->setCellValue('W1', '원산지 직접입력')
            ->setCellValue('X1', '배송방법')
            ->setCellValue('Y1', '배송비 유형')
            ->setCellValue('Z1', '기본배송비')
            ->setCellValue('AA1', '배송비 결제방식')
            ->setCellValue('AB1', '조건부무료-상품판매가합계')
            ->setCellValue('AC1', '수량별부과-수량')
            ->setCellValue('AD1', '반품배송비')
            ->setCellValue('AE1', '교환배송비')
            ->setCellValue('AF1', '지역별 차등배송비 정보')
            ->setCellValue('AG1', '별도설치비')
            ->setCellValue('AH1', '판매자 특이사항')
            ->setCellValue('AI1', '즉시할인 값')
            ->setCellValue('AJ1', '즉시할인 단위')
            ->setCellValue('AK1', '복수구매할인 조건 값')
            ->setCellValue('AL1', '복수구매할인 조건 단위')
            ->setCellValue('AM1', '복수구매할인 값')
            ->setCellValue('AN1', '복수구매할인 단위')
            ->setCellValue('AO1', '상품구매시 포인트 지급 값')
            ->setCellValue('AP1', '상품구매시 포인트 지급 단위')
            ->setCellValue('AQ1', '텍스트리뷰 작성시 지급 포인트')
            ->setCellValue('AR1', '포토/동영상 리뷰 작성시 지급 포인트')
            ->setCellValue('AS1', '"한달사용텍스트리뷰 작성시 지급 포인트"')
            ->setCellValue('AT1', '"한달사용포토/동영상리뷰 작성시 지급 포인트"')
            ->setCellValue('AU1', '"톡톡친구/스토어찜고객리뷰 작성시 지급 포인트"')
            ->setCellValue('AV1', '무이자 할부 개월')
            ->setCellValue('AW1', '사은품')
            ->setCellValue('AX1', '옵션형태')
            ->setCellValue('AY1', '옵션명')
            ->setCellValue('AZ1', '옵션값')
            ->setCellValue('BA1', '옵션가')
            ->setCellValue('BB1', '옵션 재고수량')
            ->setCellValue('BC1', '추가상품명')
            ->setCellValue('BD1', '추가상품값')
            ->setCellValue('BE1', '추가상품가')
            ->setCellValue('BF1', '추가상품 재고수량')
            ->setCellValue('BG1', '상품정보제공고시 품명')
            ->setCellValue('BH1', '상품정보제공고시 모델명')
            ->setCellValue('BI1', '상품정보제공고시 인증허가사항')
            ->setCellValue('BJ1', '상품정보제공고시 제조자')
            ->setCellValue('BK1', '스토어찜회원 전용여부')
            ->setCellValue('BL1', '문화비 소득공제')
            ->setCellValue('BM1', 'ISBN')
            ->setCellValue('BN1', '독립출판');
// Miscellaneous glyphs, UTF-8
$n=2;
foreach($rsc as $p){

						if(!$p->cateId){
							location_is('','','카테고리를 지정하지 않은 상품이 있습니다.');
							exit;
						}

						if(!$p->itemName){
							location_is('','','상품명을 입력하지 않은 상품이 있습니다.');
							exit;
						}

						if(!$p->myPrice){
							location_is('','','가격을 입력하지 않은 상품이 있습니다.\n조합형은 옵션가수정을 클릭후 가격을 입력하세요.');
							exit;
						}


						$imgCnt=0;
						$ectImg="";
						$viewImg="";
						$nowFee=0;//즉시할인
						$tf=explode(",",$p->thumbFile);
						$viewImg="상세이미지는 다운받으신 후 입력하세요.";
						$ectImg=substr($ectImg,0,-1);
						$itemThumb=str_replace($tf[0].",","",$p->thumbFile);

/*
						$imgArray=json_decode($p->itemImage);
						$imgTotal=sizeof($imgArray);
						foreach($imgArray as $img){
							if(!strpos($img,".gif")){
								$viewImg.="<img src='http://www.mallpro.kr/itemImage/".$img."' width='100%'><br style='mso-data-placement:same-cell;'>";
								$imgCnt++;
							}
						}
*/
$optImg=explode(",",$p->optionImage);
$contents=rawurldecode($p->itemContents);
//$contents=$p->itemContents;
$contents=str_replace("\\","",$contents);
$contents=str_replace("src=\"//","src=\"http://",$contents);
//$contents=htmlspecialchars($contents);

if(!$p->noOption and $p->optionCount<4){

	if($p->optionImage){

		$que3="select if(optionName1='컬러',optionValue1, if(optionName2='컬러',optionValue2, optionValue3)) as optVal,isRegist,optionMixPrice from optiontable where pnum='".$p->pnum."'";
		$result3 = $mysqli->query($que3) or die($mysqli->error);
		$rs3 = $result3->fetch_object();
		$optVal=explode(",",$rs3->optVal);
		$optPriceArray=json_decode(urldecode($rs3->optionMixPrice));

		if(!$rs3->isRegist){//직접등록인경우엔 옵션이미지를 삭제

			$opt="
			<p>&nbsp;</p>
			 <table width=\"100%\" border=\"0\" align=\"center\" cellpadding=\"0\" cellspacing=\"0\">
			  <tr>
				<td height=\"100\" align=\"center\" bgcolor=\"#333333\" style=\"font-family: 'Nanum Gothic', sans-serif;
				font-size: 43px;color:#ffffff\">옵션상세정보</td>
			  </tr>
			  <tr>
				<td height=\"219\" style=\"text-align:center;\">
				<p>&nbsp;</p>";
			$i=0;
			foreach($optImg as $c){

				if(!strpos($optVal[$i],"매진") and !strpos($optVal[$i],"품절")){

					//if($optPriceArray[$i]->pricek!=-999900){
							$opt.=" <table border=\"0\" align=\"center\" cellpadding=\"0\" cellspacing=\"20\" style=\"border:1px solid #e1e1e1;\">
									  <tr>
										<td height=\"61\" align=\"center\" style=\"font-family: 'Nanum Gothic', sans-serif;
					font-size: 28px;color:#288ee5;\">옵션 : ".$optVal[$i]."</td>
									  </tr>
									  <tr>
										<td align=\"center\"><img src=\"".$c."\" style=\"max-width:100%\"></td>
									  </tr>
									</table>
									<p>&nbsp;</p>";
					//}

				}
				$i++;
			}

			$opt.="</td>
			  </tr>
			</table>";
			$contents.=$opt;

		}
	}

}

if($p->videoUrl){

	$vUrl=$p->videoUrl;
	$vUrl=str_replace("e/1","e/6",$vUrl);
	$vUrl=str_replace("t/8","t/1",$vUrl);
	$vUrl=str_replace(".swf",".mp4",$vUrl);
	$vUrl="http:".$vUrl;
	$vs="<video width='800' controls='controls' loop='loop'><source src='".$vUrl."'></video><br><br>";
	$contents=$vs.$contents;
	
}

	$contentsText=stripslashes($rs2->topText)."<br>";

	if($rs2->topImage){
		$contentsTopImage="<img src='".$rs2->topImage."'><br>";
	}

	if($rs2->footerImage){
		$contentsFooterImage="<br><img src='".$rs2->footerImage."'>";
	}

		$contents=$contentsText.$contentsTopImage.$contents.$contentsFooterImage;



	$result3 = $mysqli->query("select * from optiontable where pnum='".$p->pnum."'") or die("725:".$mysqli->error);
	$rs3 = $result3->fetch_object();

	$optionName="";
	if($rs3->optionName1)$optionName=$rs3->optionName1."\r";
	if($rs3->optionName2)$optionName.=$rs3->optionName2."\r";
	if($rs3->optionName3)$optionName.=$rs3->optionName3."\r";

	$optionValue="";
	if($rs3->optionName1)$optionValue=$rs3->optionValue1."\r";
	if($rs3->optionName2)$optionValue.=$rs3->optionValue2."\r";
	if($rs3->optionName3)$optionValue.=$rs3->optionValue3."\r";

	$optPrice="";
	if($p->optionType=="0"){
		$optGubun="";
		$optionName="";
		$optionValue="";
		$optionPrice="";
		$optionCnt="";

	}else if($p->optionType=="1"){
		if($rs3->isRegist==1){
			$optionValue="";
			$optGubun="단독형";
			$optionName="선택하세요";
			$optPriceArray=json_decode(urldecode($rs3->optionMixPrice));
			foreach($optPriceArray as $op){
				if($op->pricek!=-999900){
					$optPrice.=$op->pricek.",";
					$optionValue.=$op->name.",";
					$optionCnt.="100".",";
				}
			}
			$optionPrice=substr($optPrice,0,-1);
			$optionValue=substr($optionValue,0,-1);
			$optionCnt=substr($optionCnt,0,-1);
		}else{
			$optGubun="단독형";
		}
	}else if($p->optionType=="2"){
		$optionValue="";
		$optGubun="조합형";
		$optPriceArray=json_decode(urldecode($rs3->optionMixPrice));
		foreach($optPriceArray as $op){
			if($op->pricek!=-999900){
				$optPrice.=$op->pricek.",";
				$optionValue.=$op->name.",";
				$optionCnt.="100".",";
			}
		}
		$optionName="선택하세요";
		$optionPrice=substr($optPrice,0,-1);
		$optionValue=substr($optionValue,0,-1);
		$optionCnt=substr($optionCnt,0,-1);
	}else{
		$optGubun="";
	}

	if($p->optionCount>3){
		$optGubun="";
		$optionName="";
		$optionValue="";
		$optionPrice="";
		$optionCnt="";
	}

	if($p->nowFee){
		$nowFee=$p->nowFee;
		$nowUnit=$p->nowUnit;
	}

//옵션 갯수별 포인트 지정해서 디비 입력, 쿠폰 차감

	$que5="select * from memberExcelDown where uid='".$uid."' and itemNum='".$p->pnum."'";
	$result5 = $mysqli->query($que5) or die($mysqli->error);
	$rs5 = $result5->fetch_object();

	if(!$rs5->num){//등록한적이 없는 제품만 입력하고 쿠폰 차감

		$coupon=0;
		$coupon=optionCountCoupon($p->optionCount);
		$query="INSERT INTO `mallpro`.`memberExcelDown`
			(`uid`,
			`itemNum`,
			`optionCount`,
			`coupon`,
			`regDate`)
			VALUES
			('$uid',
			'$p->pnum',
			'$p->optionCount',
			'$coupon',
			now())";
		$sql = $mysqli->query($query);

		$query2="update memberCoupon set nowCoupon=nowCoupon+1 where uid='".$uid."' and isuse=1 and buyCoupon>nowCoupon and startDate<='$now2' and endDate>='$now2'";
		$sql = $mysqli->query($query2);
	}


//$optGubun="조합형";
//$optionPrice="0,0,5000,10000,20000,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,5000,10000";
//$optionCnt="100,100,5000,10000,20000,100,100,100,100,100,100,100,100,100,100,100,100,100,100,100,100,100,100,5000,100";

//$contents=urlencode($contents);

$objPHPExcel->setActiveSheetIndex(0)
            ->setCellValue('A'.$n, '신상품')
            ->setCellValue('B'.$n, $p->cateId)
            ->setCellValue('C'.$n, $p->itemName)
            ->setCellValue('D'.$n, $p->myPrice)
            ->setCellValue('E'.$n, 100)
            ->setCellValue('F'.$n, $rs2->asComment)
            ->setCellValue('G'.$n, $rs2->asTel)
            ->setCellValue('H'.$n, $tf[0])
            ->setCellValue('I'.$n, $itemThumb)
            ->setCellValue('J'.$n, $contents)
            ->setCellValue('K'.$n, '')
            ->setCellValue('L'.$n, '')
            ->setCellValue('M'.$n, '상품상세참조')
            ->setCellValue('N'.$n, '상품상세참조')
            ->setCellValue('O'.$n, '')
            ->setCellValue('P'.$n, '')
            ->setCellValue('Q'.$n, '과세상품')
            ->setCellValue('R'.$n, 'Y')
            ->setCellValue('S'.$n, 'Y')
            ->setCellValue('T'.$n, '0200037')
            ->setCellValue('U'.$n, '협력사')
            ->setCellValue('V'.$n, 'N')
            ->setCellValue('W'.$n, '')
            ->setCellValue('X'.$n, $p->sendMethod)
            ->setCellValue('Y'.$n, $p->sendFeeType)
            ->setCellValue('Z'.$n, $p->sendBasicFee)
            ->setCellValue('AA'.$n, $p->sendFeePayType)
            ->setCellValue('AB'.$n, $p->sendFeeFreeLimit)
            ->setCellValue('AC'.$n, $p->sendFeeEachCnt)
            ->setCellValue('AD'.$n, $p->retunSendFee)
            ->setCellValue('AE'.$n, $p->changeSendFee)
            ->setCellValue('AF'.$n, '제주/도서산간은 5천원추가')
            ->setCellValue('AG'.$n, 'N')
            ->setCellValue('AH'.$n, '')
            ->setCellValue('AI'.$n, $nowFee)
            ->setCellValue('AJ'.$n, $nowUnit)
            ->setCellValue('AK'.$n, 1000)
            ->setCellValue('AL'.$n, '개')
            ->setCellValue('AM'.$n, '1')
            ->setCellValue('AN'.$n, '%')
            ->setCellValue('AO'.$n, '')
            ->setCellValue('AP'.$n, '')
            ->setCellValue('AQ'.$n, '')
            ->setCellValue('AR'.$n, '')
            ->setCellValue('AS'.$n, '')
            ->setCellValue('AT'.$n, '')
            ->setCellValue('AU'.$n, '')
            ->setCellValue('AV'.$n, '')
            ->setCellValue('AW'.$n, '')
            ->setCellValue('AX'.$n, $optGubun)
            ->setCellValue('AY'.$n, $optionName)
            ->setCellValue('AZ'.$n, $optionValue)
            ->setCellValue('BA'.$n, $optionPrice)
            ->setCellValue('BB'.$n, $optionCnt)
            ->setCellValue('BC'.$n, '')
            ->setCellValue('BD'.$n, '')
            ->setCellValue('BE'.$n, '')
            ->setCellValue('BF'.$n, '')
            ->setCellValue('BG'.$n, '')
            ->setCellValue('BH'.$n, '')
            ->setCellValue('BI'.$n, '')
            ->setCellValue('BJ'.$n, '')
            ->setCellValue('BK'.$n, 'N')
            ->setCellValue('BL'.$n, '')
            ->setCellValue('BM'.$n, '')
            ->setCellValue('BN'.$n, '');

	$n++;
}


// Rename worksheet
$objPHPExcel->getActiveSheet()->setTitle('Simple');
// Set active sheet index to the first sheet, so Excel opens this as the first sheet
$objPHPExcel->setActiveSheetIndex(0);
// Redirect output to a client’s web browser (Excel5)
header('Content-Type: application/vnd.ms-excel');
header('Content-Disposition: attachment;filename="myList_'.$now3.'.xls"');
header('Cache-Control: max-age=0');
// If you're serving to IE 9, then the following may be needed
header('Cache-Control: max-age=1');
// If you're serving to IE over SSL, then the following may be needed
header ('Expires: Mon, 26 Jul 1997 05:00:00 GMT'); // Date in the past
header ('Last-Modified: '.gmdate('D, d M Y H:i:s').' GMT'); // always modified
header ('Cache-Control: cache, must-revalidate'); // HTTP/1.1
header ('Pragma: public'); // HTTP/1.0
$objWriter = PHPExcel_IOFactory::createWriter($objPHPExcel, 'Excel5');
$objWriter->save('php://output');
exit;

?>