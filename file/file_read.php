<?php include $_SERVER["DOCUMENT_ROOT"]."/inc/dbcon.php";
//error_reporting(E_ERROR | E_WARNING | E_PARSE);
//ini_set('error_reporting', E_ERROR | E_WARNING | E_PARSE);
//ini_set("display_errors", 1);

function file_read($toDay){

	require_once $_SERVER["DOCUMENT_ROOT"]."/phpExcel/Classes/PHPExcel.php"; // PHPExcel.php을 불러와야 하며, 경로는 사용자의 설정에 맞게 수정해야 한다.
	$objPHPExcel = new PHPExcel();
	require_once $_SERVER["DOCUMENT_ROOT"]."/phpExcel/Classes/PHPExcel/IOFactory.php"; // IOFactory.php을 불러와야 하며, 경로는 사용자의 설정에 맞게 수정해야 한다.
	$filename = $_SERVER["DOCUMENT_ROOT"]."media/PRODUCT/".$toDay."/".$toDay.".xlsx"; // 읽어들일 엑셀 파일의 경로와 파일명을 지정한다.

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
		echo '엑셀파일을 읽는도중 오류가 발생하였습니다.';
	}


	foreach($rs as $p){
	//		echo $p[$k]."<br>";

			$idx=$p[0]??$idx;
			$reg_date=$p[1]??$reg_date;
			$pname=addslashes($p[7])??$pname;
			$pname_ch=addslashes($p[9])??$pname_ch;
			$content=addslashes($p[10]);
			$content_ch=addslashes($p[11]);
			$sname=$p[2]??$sname;

			if($p[16]){//컬러가 있으면

				$que="select num from ptest where reg_date='".$reg_date."' and sname='".$sname."' and pname='".$pname."'";
				$result = $mysqli->query($que) or die("1:".$mysqli->error);
				$rs = $result->fetch_array();


				if($p[0] and !$rs[0]){//엑셀인덱스가 있고 디비에 입력된 값이 아니면

					$que="insert into ptest value ('','$idx','$reg_date','$pid','$pname','$pname_ch','$sname','$p[12]','$content','$content_ch')";
//					echo $que."<br>";
					$sql=$mysqli->query($que) or die($mysqli->error);
					$pnum=$mysqli->insert_id;

					$sname_u=iconv('UTF-8','EUC-KR',$sname);
					$pname_u=iconv('UTF-8','EUC-KR',$pname);
					$iPath1="media/PRODUCT/".$toDay."/".$sname."/".$pname;//미디어파일경로
					$iPath=$_SERVER["DOCUMENT_ROOT"]."media/PRODUCT/".$toDay."/".$sname_u."/".$pname_u;
					//echo $iPath."<br>";
					$img = scandir($iPath);//디렉토리에 들어있는 파일들의 정보를 읽어옴
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
//							echo $que2."<br>";
							$sql2=$mysqli->query($que2) or die($mysqli->error);
						}
					}


					if($p[6]){//카테고리정보
						//cate
						$cate=explode(",",$p[6]);
						for($n=0;$n<sizeof($cate);$n++){
							$c1=explode("(",trim($cate[$n]));
							$cate1=$cate2="";
							$cate1=trim($c1[0]);
							$cate2=trim(substr($c1[1],0,-1));
							$que="insert into ptest_cate value ('','$pnum','$cate1','$cate2','$cate3','$cate4')";
//							echo $que."<br>";
							$sql=$mysqli->query($que) or die($mysqli->error);
						}
					}

					if($p[16]){//컬러정보
						//color
						$color=trim($p[16]);
						$color_en=trim($p[17]);
						if($color and $color_en){
							$que="insert into ptest_color value ('','$pnum','$color','$color_ch','$color_en')";
							//echo $que."<br>";
							$sql=$mysqli->query($que) or die($mysqli->error);
						}
					}

					if($p[18]!="X" and $p[18]!="x" and $p[18]){//혼용율

						//material
						$mate=explode(",",$p[18]);

						for($m=0;$m<sizeof($mate);$m++){
							$m1=explode("(",trim($mate[$m]));
							$perc=substr($m1[1],0,-1);
							$que2="select MATR_CODE from material_code where MATR_NAME like '".$m1[0]."%'";
							$result2 = $mysqli->query($que2) or die("1:".$mysqli->error);
							$rs2 = $result2->fetch_array();

							$que="insert into ptest_mate value ('','$pnum','".$rs2[0]."','".$perc."')";
							//echo $que."<br>";
							$sql=$mysqli->query($que) or die($mysqli->error);
						}
					}
				}
			}
	}

return $toDay;

}
​?>