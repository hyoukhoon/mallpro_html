<?php session_start();
include $_SERVER["DOCUMENT_ROOT"]."/inc/dbcon.php";
$uid=$_SESSION['AID'];

//error_reporting(E_ALL);
//ini_set('display_errors', TRUE);
//ini_set('display_startup_errors', TRUE);

$jsonCheck=urldecode($_GET['jsonCheck']);
$itemNum=json_decode($jsonCheck);
$w="";
foreach($itemNum as $i){
		$w.="'".$i."',";
}
	$w=substr($w,0,-1);
	$where=" and a.num in (".$w.")";
	if(!$order){
		$order=" order by a.num desc";
	}

	$que="select * , a.price as myPrice, b.price as itemPrice 
	from myItem a, taobao b where a.pnum=b.num and a.uid='$uid'";
	$que.=$where;
	$que.=$order;

//	echo $que;
	$result = $mysqli->query($que) or die("3:".$mysqli->error);
	while($rs = $result->fetch_object()){
			$rsc[]=$rs;
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

						$imgCnt=0;
						$ectImg="";
						$viewImg="";
						$tf=explode(",",$p->itemThumb);
						$viewImg="상세이미지는 다운받으신 후 입력하세요.";
						$ectImg=substr($ectImg,0,-1);
						$itemThumb=str_replace($tf[0].",","",$p->itemThumb);

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
$contents=urldecode($p->contents);
$contents=str_replace("\\","",$contents);
$contents=htmlspecialchars($contents);

$objPHPExcel->setActiveSheetIndex(0)
            ->setCellValue('A'.$n, '신상품')
            ->setCellValue('B'.$n, $p->cateId)
            ->setCellValue('C'.$n, $p->itemName)
            ->setCellValue('D'.$n, $p->myPrice)
            ->setCellValue('E'.$n, 100)
            ->setCellValue('F'.$n, '평일 오전10시~오후5시')
            ->setCellValue('G'.$n, '070-7777-8888')
            ->setCellValue('H'.$n, $tf[0])
            ->setCellValue('I'.$n, $itemThumb)
            ->setCellValue('J'.$n, $contents)
            ->setCellValue('K'.$n, '')
            ->setCellValue('L'.$n, '')
            ->setCellValue('M'.$n, '')
            ->setCellValue('N'.$n, '')
            ->setCellValue('O'.$n, '')
            ->setCellValue('P'.$n, '')
            ->setCellValue('Q'.$n, '과세상품')
            ->setCellValue('R'.$n, 'Y')
            ->setCellValue('S'.$n, 'Y')
            ->setCellValue('T'.$n, '0200037')
            ->setCellValue('U'.$n, '타오바오')
            ->setCellValue('V'.$n, 'N')
            ->setCellValue('W'.$n, '')
            ->setCellValue('X'.$n, '택배‚ 소포‚ 등기')
            ->setCellValue('Y'.$n, '조건부 무료')
            ->setCellValue('Z'.$n, 2500)
            ->setCellValue('AA'.$n, '선결제')
            ->setCellValue('AB'.$n, 30000)
            ->setCellValue('AC'.$n, '')
            ->setCellValue('AD'.$n, 5000)
            ->setCellValue('AE'.$n, 5000)
            ->setCellValue('AF'.$n, '제주/도서산간은 1만원추가')
            ->setCellValue('AG'.$n, 'N')
            ->setCellValue('AH'.$n, '')
            ->setCellValue('AI'.$n, '')
            ->setCellValue('AJ'.$n, '')
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
            ->setCellValue('AX'.$n, '')
            ->setCellValue('AY'.$n, '')
            ->setCellValue('AZ'.$n, '')
            ->setCellValue('BA'.$n, '')
            ->setCellValue('BB'.$n, '')
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
header('Content-Disposition: attachment;filename="01simple.xls"');
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