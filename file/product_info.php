<?php
//error_reporting(E_ERROR | E_WARNING | E_PARSE);
//ini_set('error_reporting', E_ERROR | E_WARNING | E_PARSE);
//ini_set("display_errors", 1);

function file_read($subdir,$toDay,$reg_idx){

	global $mysqli;

	require_once $_SERVER["DOCUMENT_ROOT"]."/phpExcel/Classes/PHPExcel.php"; // PHPExcel.php을 불러와야 하며, 경로는 사용자의 설정에 맞게 수정해야 한다.
	$objPHPExcel = new PHPExcel();
	require_once $_SERVER["DOCUMENT_ROOT"]."/phpExcel/Classes/PHPExcel/IOFactory.php"; // IOFactory.php을 불러와야 하며, 경로는 사용자의 설정에 맞게 수정해야 한다.
	$filename = $_SERVER["DOCUMENT_ROOT"]."media/PRODUCT/".$subdir."/".$toDay."/".$toDay.".xlsx"; // 읽어들일 엑셀 파일의 경로와 파일명을 지정한다.

	if(!file_exists($filename)){
		location_is('','','/'.$subdir.'/'.$toDay.'/ 폴더안에 엑셀파일이 존재하지 않습니다.');
		exit;
	}

	try {
	  // 업로드 된 엑셀 형식에 맞는 Reader객체를 만든다.
		$objReader = PHPExcel_IOFactory::createReaderForFile($filename);
		// 읽기전용으로 설정
		$objReader->setReadDataOnly(true);
		// 엑셀파일을 읽는다
		$objExcel = $objReader->load($filename);
		// 첫번째 시트를 선택
		$objExcel->setActiveSheetIndex(0);
		$objWorksheet = $objExcel->getActiveSheet();
		$rowIterator = $objWorksheet->getRowIterator();
		foreach ($rowIterator as $row) { // 모든 행에 대해서
				   $cellIterator = $row->getCellIterator();
				   $cellIterator->setIterateOnlyExistingCells(false); 
		}
		$maxRow = $objWorksheet->getHighestRow();

		$rs=array();

		for ($i = 6 ; $i <= $maxRow ; $i++) {
				foreach (range('A', 'U') as $column){
				   //echo $column.$i.":".$objWorksheet->getCell($column.$i)->getValue()."<br>";
				   if($column=="B"){
						$reg_date = $objWorksheet->getCell('B' . $i)->getValue(); 
					   $val = PHPExcel_Style_NumberFormat::toFormattedString($reg_date, 'YYYY-MM-DD');
				   }else{
					   $val=$objWorksheet->getCell($column.$i)->getValue();
				   }
				   $rs[$i][]=$val;
				}
	/*
					echo "AA".$i.":".$objWorksheet->getCell('AA' . $i)->getValue()."<br>";
					echo  "AB".$i.":".$objWorksheet->getCell('AB' . $i)->getValue()."<br>";
					echo  "AC".$i.":".$objWorksheet->getCell('AC' . $i)->getValue()."<br>";
					echo  "AD".$i.":".$objWorksheet->getCell('AD' . $i)->getValue()."<br>";
					echo  "AE".$i.":".$objWorksheet->getCell('AE' . $i)->getValue()."<br>";
					echo  "AF".$i.":".$objWorksheet->getCell('AF' . $i)->getValue()."<br>";
					echo  "AG".$i.":".$objWorksheet->getCell('AG' . $i)->getValue()."<br>";
					echo  "AH".$i.":".$objWorksheet->getCell('AH' . $i)->getValue()."<br>";
					echo  "AI".$i.":".$objWorksheet->getCell('AI' . $i)->getValue()."<br>";
					echo  "AJ".$i.":".$objWorksheet->getCell('AJ' . $i)->getValue()."<br>";
					echo  "AK".$i.":".$objWorksheet->getCell('AK' . $i)->getValue()."<br>";
	*/
		  }
	} 
	 catch (exception $e) {
		echo '엑셀파일을 읽는도중 오류가 발생하였습니다. 엑셀파일이 올바른지 확인해주세요.';
	}
//echo "<pre>";
//	print_r($rs);
//echo "<pre>";
//exit;
	foreach($rs as $p){
	//		echo $p[$k]."<br>";

			$idx=$p[0]??$idx;
			$reg_date=$p[1]??$reg_date;
			$pname=trim($p[9]);
			$pname_ch=$p[10]?trim($p[10]):$pname;
			$content=addslashes(trim($p[11]));
			$content_ch=$p[12]?addslashes(trim($p[12])):$content;
			$sname=trim($p[2]);
			$seller_id=$p[3]??$sname;

			if($p[0]){

				$isupdate=0;
				if($pname){
					$que="select num from ptest where folder_name='".$toDay."' and seller_id='".$seller_id."' and pname='".$pname."'";
					$result = $mysqli->query($que) or die("1:".$mysqli->error);
					$rs = $result->fetch_array();
				}

				if($p[0] and $rs[0]){//기존 등록한 자료가 있으면
					$isupdate=1;
					$pnum=$rs[0];

					$que="update ptest set folder_name='$toDay',pname_ch='$pname_ch',price='$p[13]',content='$content',content_ch='$content_ch',gubun='0',utype='1',modify_date=now(),reason='' where num='$pnum'";
					$sql=$mysqli->query($que) or die("95:".$mysqli->error);

					if($p[0]){

						//echo "제품명:".$pname.", // 제품명중국어:".$pname_ch.", // 내용:".$content.", // 내용중국어:".$content_ch."<br>";

						if(!$pname){//제품명이 없음
								$que="update ptest set gubun='4', reason=concat(reason,'1,') where num='$pnum'";
								$sql=$mysqli->query($que) or die("103:".$mysqli->error);
						}

						if(!$pname_ch){//제품명 중국어가 없음
								$que="update ptest set gubun='4', reason=concat(reason,'5,') where num='$pnum'";
								//$sql=$mysqli->query($que) or die("108:".$mysqli->error);
						}

						if(!$content){//상품설명 없음
								$que="update ptest set gubun='4', reason=concat(reason,'6,') where num='$pnum'";
								$sql=$mysqli->query($que) or die("113:".$mysqli->error);
						}

						if(!$content_ch){//상품설명 중국어 없음
								$que="update ptest set gubun='4', reason=concat(reason,'7,') where num='$pnum'";
								//$sql=$mysqli->query($que) or die("118:".$mysqli->error);
						}

					}

					//관련된 테이블의 자료를 모두 지우고 다시 입력
					$que89="delete from ptest_file where pnum='$pnum'";
					$sql = $mysqli->query($que89) or die("91:".$mysqli->error);

					$sname_u=iconv('UTF-8','EUC-KR',trim($sname));
					$pname_u=iconv('UTF-8','EUC-KR',trim($pname));
					$iPath1="media/PRODUCT/".$subdir."/".$toDay."/".$sname."/".$pname;//미디어파일경로
					$iPath=$_SERVER["DOCUMENT_ROOT"]."media/PRODUCT/".$subdir."/".$toDay."/".$sname_u."/".$pname_u;
					//echo $iPath1."<br>";
					//echo $iPath."<br>";

					if($sname_u && $pname_u && is_dir($iPath)){//디렉토리가 있는지 확인

						$img = scandir($iPath);//디렉토리에 들어있는 파일들의 정보를 읽어옴
						//echo "<pre>";
						//print_r($img);
						//echo "</pre>";
						$fe=0;
						foreach($img as $g){
							if($g!="." and $g!=".." and $g!="Thumbs.db"){
								$fileinfo = pathinfo($g);
								$imgtype = $fileinfo['extension'];
								if(mb_eregi("jpg|gif|bmp|png",$imgtype)){
									$itype="0";//이미지
								}else if(mb_eregi("mov|mp4",$imgtype)){
									$itype="1";//동영상
								}
								//$g=strtolower($g);
								$que2="insert into ptest_file value ('','$pnum','$g','$iPath1','$itype')";//해당제품에 대한 미디어파일들의 정보를 입력
								//echo $que2."<br>";
								$sql2=$mysqli->query($que2) or die("153:".$mysqli->error);
								$fe++;
							}
							
						}//foreach

					}else{//if is_dir
						
						$que="update ptest set gubun='-1' where num='$pnum'";//서버에 제품에 해당하는 디렉토리가 없음
	//					echo $que."<br>";
						$sql=$mysqli->query($que) or die("163:".$mysqli->error);

					}

					if(!$fe){//디렉토리가 있지만 파일이 없음
						$que="update ptest set gubun='-2' where num='$pnum'";
						$sql=$mysqli->query($que) or die("169:".$mysqli->error);
					}


				}else if($p[0] and !$rs[0]){//엑셀인덱스가 있고 디비에 입력된 값이 아니면

					

					$que="insert into ptest value ('','$idx','$reg_idx','$reg_date','$toDay','$pid','$pname','$pname_ch','$seller_id','$sname','$p[13]','$content','$content_ch','0',now(),'0','','')";
//					echo $que."<br>";
					$sql=$mysqli->query($que) or die("179:".$mysqli->error);
					$pnum=$mysqli->insert_id;

					if($p[0]){

						//echo "제품명:".$pname.", // 제품명중국어:".$pname_ch.", // 내용:".$content.", // 내용중국어:".$content_ch."<br>";

						if(!$pname){//제품명이 없음
								$que="update ptest set gubun='4', reason=concat(reason,'1,') where num='$pnum'";
								$sql=$mysqli->query($que) or die("188:".$mysqli->error);
						}

						if(!$pname_ch){//제품명 중국어가 없음
								$que="update ptest set gubun='4', reason=concat(reason,'5,') where num='$pnum'";
								//$sql=$mysqli->query($que) or die("193:".$mysqli->error);
						}

						if(!$content){//상품설명 없음
								$que="update ptest set gubun='4', reason=concat(reason,'6,') where num='$pnum'";
								$sql=$mysqli->query($que) or die("198:".$mysqli->error);
						}

						if(!$content_ch){//상품설명 중국어 없음
								$que="update ptest set gubun='4', reason=concat(reason,'7,') where num='$pnum'";
								//$sql=$mysqli->query($que) or die("203:".$mysqli->error);
						}

					}

					$sname_u=iconv('UTF-8','EUC-KR',trim($sname));
					$pname_u=iconv('UTF-8','EUC-KR',trim($pname));
					$iPath1="media/PRODUCT/".$subdir."/".$toDay."/".$sname."/".$pname;//미디어파일경로
					$iPath=$_SERVER["DOCUMENT_ROOT"]."media/PRODUCT/".$subdir."/".$toDay."/".$sname_u."/".$pname_u;
//					echo $iPath1."<br>";


					if($sname_u && $pname_u && is_dir($iPath)){//디렉토리가 있는지 확인

						$img = scandir($iPath);//디렉토리에 들어있는 파일들의 정보를 읽어옴
						//print_r($img);
						$fe=0;
						foreach($img as $g){
							if($g!="." and $g!=".." and $g!="Thumbs.db"){
								$fileinfo = pathinfo($g);
								$imgtype = $fileinfo['extension'];
								if(mb_eregi("jpg|gif|bmp|png",$imgtype)){
									$itype="0";//이미지
								}else if(mb_eregi("mov|mp4",$imgtype)){
									$itype="1";//동영상
								}
								$que2="insert into ptest_file value ('','$pnum','$g','$iPath1','$itype')";//해당제품에 대한 미디어파일들의 정보를 입력
								//echo $que2."<br>";
								$sql2=$mysqli->query($que2) or die("231:".$mysqli->error);
								$fe++;
							}
							
						}//foreach

						if(!$fe){//디렉토리가 있지만 파일이 없음
							$que="update ptest set gubun='-2' where num='$pnum'";
							$sql=$mysqli->query($que) or die("239:".$mysqli->error);
						}

					}else{//if is_dir
						
						$que="update ptest set gubun='-1' where num='$pnum'";//해당디렉토리없음
	//					echo $que."<br>";
						$sql=$mysqli->query($que) or die("246:".$mysqli->error);

					}

				}




					if($p[7]){//카테고리정보
						//관련된 테이블의 자료를 모두 지우고 다시 입력
						if($isupdate){
							$que89="delete from ptest_cate where pnum='$pnum'";
							$sql = $mysqli->query($que89) or die("192:".$mysqli->error);
						}
						//cate
						$cate1=trim($p[7]);
						$cate2=trim($p[8]);
						//echo "c1:".$p[7]."// c2:".$p[8]."<br>";
						if($cate1 && $cate2){
							$que="insert into ptest_cate value ('','$pnum','$cate1','$cate2','$cate3','$cate4')";
							//echo $que."<br>";
							$sql=$mysqli->query($que) or die("268:".$mysqli->error);
						}else if(!$cate1 && $cate2){
								//대분류없음
								$que="update ptest set gubun='4',  reason=concat(reason,'2,') where num='$pnum'";
								//echo $que."<br>";
								$sql=$mysqli->query($que) or die("273:".$mysqli->error);
						}else if($cate1 && !$cate2){
								//소분류없음
								$que="update ptest set  gubun='0', reason=concat(reason,'3,') where num='$pnum'";
								//echo $que."<br>";
								$sql=$mysqli->query($que) or die("278:".$mysqli->error);
						}else if(!$cate1 && !$cate2){
								//둘다없음
								$que="update ptest set  gubun='4', reason=concat(reason,'4,') where num='$pnum'";
								//echo $que."<br>";
								$sql=$mysqli->query($que) or die("283:".$mysqli->error);
						}

					}else{//대분류가 없고

						$cate1=trim($p[7]);
						$cate2=trim($p[8]);

						if($p[0]){//첫번째 값이 있으면

							if(!$cate1 && $cate2){
								//대분류없음
								$que="update ptest set  gubun='4', reason=concat(reason,'2,') where num='$pnum'";
								//echo $que."<br>";
								$sql=$mysqli->query($que) or die("297:".$mysqli->error);
							}else if(!$cate1 && !$cate2){
								//둘다없음
								$que="update ptest set  gubun='4', reason=concat(reason,'4,') where num='$pnum'";
								//echo $que."<br>";
								$sql=$mysqli->query($que) or die("302:".$mysqli->error);
							}

						}

					}

					if($p[17] or $p[18]){//컬러정보
						if($isupdate){
							//관련된 테이블의 자료를 모두 지우고 다시 입력
							$que89="delete from ptest_color where pnum='$pnum'";
							$sql = $mysqli->query($que89) or die("205:".$mysqli->error);
						}
						//color
						$color=trim($p[17]);
						$color_en=trim($p[18]);
						if($color and $color_en){
							$que="insert into ptest_color value ('','$pnum','$color','$color_ch','$color_en')";
							//echo $que."<br>";
							$sql=$mysqli->query($que) or die("321:".$mysqli->error);
						}else if($color && !$color_en){//컬러영문명없음
							$que="update ptest set gubun='4', reason=concat(reason,'8,') where num='$pnum'";
							$sql=$mysqli->query($que) or die("326:".$mysqli->error);
						}else if(!$color && $color_en){//컬러국문명없음
							$que="update ptest set gubun='4', reason=concat(reason,'12,') where num='$pnum'";
							$sql=$mysqli->query($que) or die("326:".$mysqli->error);
						}
					}else if(!$p[17] and !$p[18]){
						if($isupdate){
							//관련된 테이블의 자료를 모두 지우고 다시 입력
							$que89="delete from ptest_color where pnum='$pnum'";
							$sql = $mysqli->query($que89) or die("205:".$mysqli->error);
						}
						$que="update ptest set gubun='4', reason=concat(reason,'13,') where num='$pnum'";
						$sql=$mysqli->query($que) or die("326:".$mysqli->error);
					}

					if($p[19]){//혼용율

						if($isupdate){
							//관련된 테이블의 자료를 모두 지우고 다시 입력
							$que89="delete from ptest_mate where pnum='$pnum'";
							$sql = $mysqli->query($que89) or die("220:".$mysqli->error);
						}

						//material
							$m1=trim($p[19]);
							$perc=trim($p[20]);
							$que2="select MATR_CODE from material_code where MATR_NAME='".$m1."'";
							$result2 = $mysqli->query($que2) or die("1:".$mysqli->error);
							$rs2 = $result2->fetch_array();
						
						if($m1 && $perc){
							$que="insert into ptest_mate value ('','$pnum','".$rs2[0]."','".$perc."')";
							//echo $que."<br>";
							$sql=$mysqli->query($que) or die("348:".$mysqli->error);
						}else if(!$m1 && $perc){//혼용율 재료없음
							$que="update ptest set gubun='4', reason=concat(reason,'9,') where num='$pnum'";
							$sql=$mysqli->query($que) or die("351:".$mysqli->error);
						}else if($m1 && !$perc){//혼용율 숫자없음
							$que="update ptest set gubun='4', reason=concat(reason,'10,') where num='$pnum'";
							$sql=$mysqli->query($que) or die("354:".$mysqli->error);
						}else if(!$m1 && !$perc){//혼용율 둘다없으면 기타 100%
							$que="insert into ptest_mate value ('','$pnum','00050','100')";
							//echo $que."<br>";
							$sql=$mysqli->query($que) or die("358:".$mysqli->error);
						}

					}else{

						if($isupdate){
							//관련된 테이블의 자료를 모두 지우고 다시 입력
							$que89="delete from ptest_mate where pnum='$pnum'";
							$sql = $mysqli->query($que89) or die("220:".$mysqli->error);
						}

						$m1=trim($p[19]);
						$perc=trim($p[20]);

						if($p[0]){
							if(!$m1 && $perc){//혼용율 재료없음
								$que="update ptest set gubun='4', reason=concat(reason,'9,') where num='$pnum'";
								$sql=$mysqli->query($que) or die("375:".$mysqli->error);
							}else if(!$m1 && !$perc){//혼용율 둘다없으면 기타 100%
								$que="insert into ptest_mate value ('','$pnum','00050','100')";
								//echo $que."<br>";
								$sql=$mysqli->query($que) or die("379:".$mysqli->error);
							}
						}

					}
				
			}else{


				if($p[7]){//카테고리정보
						//관련된 테이블의 자료를 모두 지우고 다시 입력
						if($isupdate){
							$que89="delete from ptest_cate where pnum='$pnum'";
							$sql = $mysqli->query($que89) or die("192:".$mysqli->error);
						}
						//cate
						$cate1=trim($p[7]);
						$cate2=trim($p[8]);
						//echo "c1:".$p[7]."// c2:".$p[8]."<br>";
						if($cate1 && $cate2){
							$que="insert into ptest_cate value ('','$pnum','$cate1','$cate2','$cate3','$cate4')";
							//echo $que."<br>";
							$sql=$mysqli->query($que) or die("268:".$mysqli->error);
						}else if(!$cate1 && $cate2){
								//대분류없음
								$que="update ptest set gubun='4',  reason=concat(reason,'2,') where num='$pnum'";
								//echo $que."<br>";
								$sql=$mysqli->query($que) or die("273:".$mysqli->error);
						}else if($cate1 && !$cate2){
								//소분류없음
								$que="update ptest set  gubun='0', reason=concat(reason,'3,') where num='$pnum'";
								//echo $que."<br>";
								$sql=$mysqli->query($que) or die("278:".$mysqli->error);
						}else if(!$cate1 && !$cate2){
								//둘다없음
								$que="update ptest set  gubun='4', reason=concat(reason,'4,') where num='$pnum'";
								//echo $que."<br>";
								$sql=$mysqli->query($que) or die("283:".$mysqli->error);
						}

					}else{//대분류가 없고

						$cate1=trim($p[7]);
						$cate2=trim($p[8]);

						if($p[0]){//첫번째 값이 있으면

							if(!$cate1 && $cate2){
								//대분류없음
								$que="update ptest set  gubun='4', reason=concat(reason,'2,') where num='$pnum'";
								//echo $que."<br>";
								$sql=$mysqli->query($que) or die("297:".$mysqli->error);
							}else if(!$cate1 && !$cate2){
								//둘다없음
								$que="update ptest set  gubun='4', reason=concat(reason,'4,') where num='$pnum'";
								//echo $que."<br>";
								$sql=$mysqli->query($que) or die("302:".$mysqli->error);
							}

						}

					}

					if($p[17] or $p[18]){//컬러정보
						if($isupdate){
							//관련된 테이블의 자료를 모두 지우고 다시 입력
							$que89="delete from ptest_color where pnum='$pnum'";
							$sql = $mysqli->query($que89) or die("205:".$mysqli->error);
						}
						//color
						$color=trim($p[17]);
						$color_en=trim($p[18]);
						if($color and $color_en){
							$que="insert into ptest_color value ('','$pnum','$color','$color_ch','$color_en')";
							//echo $que."<br>";
							$sql=$mysqli->query($que) or die("321:".$mysqli->error);
						}else if($color && !$color_en){//컬러영문명없음
							$que="update ptest set gubun='4', reason=concat(reason,'8,') where num='$pnum'";
							$sql=$mysqli->query($que) or die("326:".$mysqli->error);
						}else if(!$color && $color_en){//컬러국문명없음
							$que="update ptest set gubun='4', reason=concat(reason,'12,') where num='$pnum'";
							$sql=$mysqli->query($que) or die("326:".$mysqli->error);
						}
					}

					if($p[19]){//혼용율

						if($isupdate){
							//관련된 테이블의 자료를 모두 지우고 다시 입력
							$que89="delete from ptest_mate where pnum='$pnum'";
							$sql = $mysqli->query($que89) or die("220:".$mysqli->error);
						}

						//material
							$m1=trim($p[19]);
							$perc=trim($p[20]);
							$que2="select MATR_CODE from material_code where MATR_NAME='".$m1."'";
							$result2 = $mysqli->query($que2) or die("1:".$mysqli->error);
							$rs2 = $result2->fetch_array();
						
						if($m1 && $perc){
							$que="insert into ptest_mate value ('','$pnum','".$rs2[0]."','".$perc."')";
							//echo $que."<br>";
							$sql=$mysqli->query($que) or die("348:".$mysqli->error);
						}else if(!$m1 && $perc){//혼용율 재료없음
							$que="update ptest set gubun='4', reason=concat(reason,'9,') where num='$pnum'";
							$sql=$mysqli->query($que) or die("351:".$mysqli->error);
						}else if($m1 && !$perc){//혼용율 숫자없음
							$que="update ptest set gubun='4', reason=concat(reason,'10,') where num='$pnum'";
							$sql=$mysqli->query($que) or die("354:".$mysqli->error);
						}else if(!$m1 && !$perc){//혼용율 둘다없으면 기타 100%
							$que="insert into ptest_mate value ('','$pnum','00050','100')";
							//echo $que."<br>";
							$sql=$mysqli->query($que) or die("358:".$mysqli->error);
						}

					}else{

						if($isupdate){
							//관련된 테이블의 자료를 모두 지우고 다시 입력
							$que89="delete from ptest_mate where pnum='$pnum'";
							$sql = $mysqli->query($que89) or die("220:".$mysqli->error);
						}

						$m1=trim($p[19]);
						$perc=trim($p[20]);

						if($p[0]){
							if(!$m1 && $perc){//혼용율 재료없음
								$que="update ptest set gubun='4', reason=concat(reason,'9,') where num='$pnum'";
								$sql=$mysqli->query($que) or die("375:".$mysqli->error);
							}else if(!$m1 && !$perc){//혼용율 둘다없으면 기타 100%
								$que="insert into ptest_mate value ('','$pnum','00050','100')";
								//echo $que."<br>";
								$sql=$mysqli->query($que) or die("379:".$mysqli->error);
							}
						}

					}

				

			}
	}

return $toDay;

}


​?>