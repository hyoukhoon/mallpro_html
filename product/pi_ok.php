<?php include $_SERVER["DOCUMENT_ROOT"]."/inc/dbcon.php";

include $_SERVER["DOCUMENT_ROOT"]."/admin_page/product/product_lib.php";

	$sd=$_GET['sd'];
	$mode=$_GET['mode'];

	foreach($sd as $n){
		echo $n."<br>";
	}

$wfile=array();
$rimg1=array();
$rimg2=array();
$n="2017-07-11";

//디비에서 날짜별 입력된 제품들 불러오기
$que14="select * from ptest  where reg_date='$n' and gubun='0'";
//$que14="select * from ptest  where seller_id='MERCY' and gubun='0'";//gubun, 0:입력전, 1:입력완료, 2:셀러가없는경우, -1:폴더매칭실패, -2:폴더는 있지만 파일이 없는경우
//$que14="select * from ptest  where num='65'";//gubun, 0:입력전, 1:입력완료, 2:셀러가없는경우
//	echo $que14;
	$result14 = $mysqli->query($que14) or die("15:".$mysqli->error);
	while($rsc = $result14->fetch_object()){

		$shop_code="";
		$SELLER_CODE="";
		$que3="select SHOP_CODE, SELLER_CODE from seller where SELLER_ID='$rsc->seller_id'";//제품의 샵코드와 셀러코드 찾기
		$result3 = $mysqli->query($que3) or die("25:".$mysqli->error);
		$rs3 = $result3->fetch_array();
		$shop_code=$rs3[0];
		$SELLER_CODE=$rs3[1];

		if(!$SELLER_CODE){//셀러테이블에 없는 셀러인경우

			$que="update ptest set gubun='2' where num='$rsc->num'";//gubun, 0:입력전, 1:입력완료, 2:셀러가없는경우
			$sql = $mysqli->query($que) or die("33:".$mysqli->error);

		}else{

			//product 테이블에 입력

			$que3="select CNY from common_exchange_rate where IS_USE='0' order by ER_SEQ desc limit 1";
			$result3 = $mysqli->query($que3) or die("40:".$mysqli->error);
			$rs3 = $result3->fetch_array();
			$CNY=$rs3[0];
			$WHOLESALE_PRICE_CH=round(($rsc->price/$CNY),2);


			$ADMIN=$shop_code;
			$SELLER_CODE=$SELLER_CODE;
			$DISPLAY_CODE=$_POST['DISPLAY_CODE'];//?
			$PRODUCT_NAME=removeHackTag($rsc->pname);
			$PRODUCT_NAME_CH=removeHackTag($rsc->pname_ch);
			$SHORTINFO=removeHackTag(addslashes($rsc->content));
			$SHORTINFO_CH=removeHackTag(addslashes($rsc->content_ch));
			$cate1=$rsc->cate1;
			$cate2=$rsc->cate2;
			$WHOLESALE_PRICE=$rsc->price;
			$WHOLESALE_PRICE_CH=$WHOLESALE_PRICE_CH;
			$DISP=0;//금액노출 0:노출 1:비노출
			$DISPLAY_START_DATE=$_POST['DISPLAY_START_DATE'];
			$DISPLAY_END_DATE="9999-12-31 00:00:00";
			$DISPLAY_YN="Y";

			//PRODUCT_CODE
			$PRODUCT_CODE="";
			$cn="";
			$Pcode="01".$ADMIN;
			$que3="select max(PRODUCT_CODE) from product where left(PRODUCT_CODE,4)='".$Pcode."'";
			$result3 = $mysqli->query($que3) or die("65:".$mysqli->error);
			$rs3 = $result3->fetch_array();
			$pi=substr($rs3[0],4)+1;
			$c0=5-strlen($pi);
			for($k=0;$k<$c0;$k++){
				$cn.="0";
			}
			$PRODUCT_CODE=$Pcode.$cn.$pi;

//제품을 불러와서 product 테이블에 입력

			//엑셀의 등록일과 업체, 제품명을 조회해서 없는 제품만 등록한다.
			$que84="select PRODUCT_ID from product where ADMIN='$SELLER_CODE' and PRODUCT_NAME='$PRODUCT_NAME' and ETC2='$rsc->reg_date' and IS_DELETE='0'";
			$result84 = $mysqli->query($que84) or die("84:".$mysqli->error);
			$rs84 = $result84->fetch_array();
			$PRODUCT_ID=$rs84[0];

			if(!$PRODUCT_ID){//제품아이디가 없으면 등록

				$ETC3=$rsc->num;
				$que84="insert into product values ('',
				'',
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
				'$rsc->reg_date',
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
				now(),
				'$DISPLAY_END_DATE')";

				//echo $que84."<br>";

				$sql=$mysqli->query($que84) or die("259:".$mysqli->error);
				$insert_id=$mysqli->insert_id;
				$PRODUCT_ID="";
				$cn1="";
				$c1=10-strlen($insert_id);
				for($k1=0;$k1<$c1;$k1++){
					$cn1.="0";
				}
				$PRODUCT_ID=$cn1.$insert_id;

	//입력한 제품들 입력처리
				$que278="update ptest set gubun='1',pid='$PRODUCT_ID' where num='$rsc->num'";//gubun, 0:입력전, 1:입력완료, 2:셀러가없는경우
				//echo $que278."<br>";
				$sql = $mysqli->query($que278) or die("266:".$mysqli->error);

	// 카테고리 입력
				$que="select * from ptest_cate  where pnum='$rsc->num'";
				$result = $mysqli->query($que) or die("270:".$mysqli->error);
				while($rs = $result->fetch_object()){

					$que11="SELECT CATEGORY_ID FROM mediapic.category_info where CATEGORY_NAME='$rs->cate2' and left(CATEGORY_ID,3) in (select left(CATEGORY_ID,3) from category_info where DEPTH='0' and CATEGORY_NAME='$rs->cate1')";
					$result11 = $mysqli->query($que11) or die("274:".$mysqli->error);
					$rs11 = $result11->fetch_array();
					$ca=$rs11[0];
					if(!$ca){
						$ca="005000000000000";
					}

					$que295="insert into category_relation values ('','$ca',
					'$PRODUCT_ID',
					'1',
					'$BASIC',
					'$INSERT_YN',
					now())";
					//echo $que295."<br>";
					$sql=$mysqli->query($que295) or die("285:".$mysqli->error);
				}


	// 컬러 입력
				$que="select * from ptest_color  where pnum='$rsc->num'";
				$result = $mysqli->query($que) or die("292:".$mysqli->error);
				while($rs = $result->fetch_object()){

					$que311="insert into product_color values ('','$PRODUCT_ID','$rs->color','$rs->color_en','$rs->color_en',now(),now())";
					//echo $que311."<br>";
					$sql=$mysqli->query($que311) or die("297:".$mysqli->error);
				}

	// 혼용율 입력
				$que319="select * from ptest_mate  where pnum='$rsc->num'";
				$result = $mysqli->query($que319) or die("303:".$mysqli->error);
				while($rs = $result->fetch_object()){

					$que321="insert into product_material_info values ('','$PRODUCT_ID','$rs->MATR_CODE','$rs->PERCENTAGE',now(),now())";
					//echo $que321."<br>";
					$sql=$mysqli->query($que321) or die("308:".$mysqli->error);
				}

	//파일 복사하고 디비에 넣기

				$oPath=$_SERVER["DOCUMENT_ROOT"]."media/SHOP/".$shop_code."/".$SELLER_CODE."/MOBILE/".$PRODUCT_ID."/IMG/";
				$vPath=$_SERVER["DOCUMENT_ROOT"]."media/SHOP/".$shop_code."/".$SELLER_CODE."/MOBILE/".$PRODUCT_ID."/MOV/";

		//		echo $oPath."<br>";
	//폴더없으면 폴더 생성
				if(!is_dir($oPath)){
					@umask(0);
					@mkdir($oPath,0777,true);
				}

				if(!is_dir($vPath)){
					@umask(0);
					@mkdir($vPath,0777,true);
				}

	//제품별 이미지 불러오기
				$fo=1;//file_order
				$que1="SELECT num, pnum, file_name, path,itype, seed, CASE WHEN seed > 0 THEN seed ELSE 999999999 END AS sort
								FROM
								(
									SELECT num, pnum, file_name, path,itype, 
									CAST(REPLACE(REPLACE(REPLACE(REPLACE(REPLACE(file_name, 'md', '60'), 'mm', '7'), 'm', ''), 'z', '90'), 'md', '60') AS UNSIGNED) AS seed 
									FROM ptest_file where pnum='$rsc->num'
								) A
								ORDER BY sort";
				$result1 = $mysqli->query($que1) or die("336:".$mysqli->error);
				while($rs1 = $result1->fetch_object()){

					if($rs1->itype==0){//이미지
						$ext="";
						$nf=$PRODUCT_ID."_".date("YmdHis").substr(rand(),0,4).$fo;//복사할 파일명
						$fileinfo = pathinfo($rs1->file_name);
						$ext = $fileinfo['extension'];
						$nf=$nf.".".$ext;
						$path=iconv('UTF-8','EUC-KR',$rs1->path);
						$oldfile=$_SERVER["DOCUMENT_ROOT"].$path."/".$rs1->file_name;
						$newfile=$oPath.$nf;
						$iPath="media/SHOP/".$shop_code."/".$SELLER_CODE."/MOBILE/".$PRODUCT_ID."/IMG/";
						$IMGVOD_FLAG=0;// 일반이미지
						//echo $oldfile.",".$newfile."<br>";
					}else if($rs1->itype==1){//동영상
						$ext="";
						$nf=$PRODUCT_ID."_".date("YmdHis").substr(rand(),0,4).$fo;//복사할 파일명
						$fileinfo = pathinfo($rs1->file_name);
						$ext = $fileinfo['extension'];
						$nf=$nf.".".$ext;
						$path=iconv('UTF-8','EUC-KR',$rs1->path);
						$oldfile=$_SERVER["DOCUMENT_ROOT"].$path."/".$rs1->file_name;
						$newfile=$vPath.$nf;
						$iPath="media/SHOP/".$shop_code."/".$SELLER_CODE."/MOBILE/".$PRODUCT_ID."/MOV/";
						$IMGVOD_FLAG=1;// 동영상 0:이미지파일, 1:동영상파일,2:동영상 스틸컷 이미지,3:썸네일이미지,4:스틸컷을 축소한 이미지
						//echo $oldfile.",".$newfile."<br>";
					}		

					if($rs1->itype==1){
						$fo=1;
					 }

					$imgsize=filesize($oldfile);
					$USE_FLAG=0;//모바일
					if($fo==1){
						$rep_flag=1;
					}else{
						$rep_flag=0;
					}

//product_file_info 등록된 값인지 확인
$que400="select FILE_ID from product_file_info where PRODUCT_ID='$PRODUCT_ID' and FILENM_ORG='$rs1->file_name' and IMGVOD_FLAG='0'";
$result400 = $mysqli->query($que400) or die("400:".$mysqli->error);
$rs400 = $result400->fetch_array();
echo $que400."//".$rs400[0]."<br>";
if(!$rs400[0]){//없으면 입력

					$que392="insert into product_file_info values ('',
					'$PRODUCT_ID',
					'".$fo."',
					'".$rs1->file_name."',
					'".$nf."',
					'',
					'$iPath',
					'$imgsize',
					'$USE_FLAG',
					'$IMGVOD_FLAG',
					'".$rep_flag."',
					'0',
					now(),
					now()
					)";
					//echo $que392."<br>";
					$sql417="";
					$sql417=$mysqli->query($que392) or die("393:".$mysqli->error);
					$FILE_ID_PARENT=$mysqli->insert_id;

}

				if($sql417){

					copy($oldfile, $newfile);//복사하고

					//watermark($newfile,$newfile);//워터마크
					if($rs1->itype==0){
						$wfile[]=$newfile;
					}


					if($fo==2){//스틸컷 등록
							
							$IMGVOD_FLAG=2;// 스틸컷
							$nef=$PRODUCT_ID."_".date("YmdHis").substr(rand(),0,4).".".$ext;
							$newfile2=$oPath.$nef;
							copy($oldfile, $newfile2);//복사하고

							$imgsize=0;
							//watermark($newfile2,$newfile2);//워터마크
							$wfile[]=$newfile2;
							$que411="insert into product_file_info values ('',
							'$PRODUCT_ID',
							'1',
							'$rs1->file_name',
							'$nef',
							'',
							'$iPath',
							'$imgsize',
							'$USE_FLAG',
							'$IMGVOD_FLAG',
							'1',
							'0',
							now(),
							now())";
							//echo $que411."<br>";
							$sql=$mysqli->query($que411) or die("426:".$mysqli->error);
					}


	if($rs1->itype==0){//이미지인 경우에만 썸네일

//					if(!file_exists($oPath."T_".$nf)) { //썸네일이미지 확인하고

							//resizeimage(1080,$oPath."T_".$nf,$oPath.$nf);
							$rimg1[]=$oPath."T_".$nf;
							$rimg2[]=$oPath.$nf;
							$nef2="T_".$nf;
							//$imgsize=filesize($oPath."T_".$nf);
							$imgsize=0;
							$IMGVOD_FLAG=3;// 썸네일
							
							$que451="insert into product_file_info values ('',
							'$PRODUCT_ID',
							'$fo',
							'".$rs1->file_name."',
							'".$nef2."',
							'$FILE_ID_PARENT',
							'$iPath',
							'$imgsize',
							'$USE_FLAG',
							'$IMGVOD_FLAG',
							'".$rep_flag."',
							'0',
							now(),
							now()
							)";
							//echo $que451."<br>";
							$sql=$mysqli->query($que451) or die("446:".$mysqli->error);

//					}

				}

	//				if(file_exists($newfile)) {//파일이 만들어졌으면 기존 파일 삭제
	//					@unlink($oldfile);
	//				}

					$fo++;

				}//sql417

			}//ptest_file while

			}else{//같은 제품이 등록돼 있으면 product는 update 다른 테이블은 삭제후 다시 등록

				$que494="update product set 
				PRODUCT_NAME='$PRODUCT_NAME',
				PRODUCT_NAME__EN='$PRODUCT_NAME__EN',
				PRODUCT_NAME_CH='$PRODUCT_NAME_CH',
				SHORTINFO='$SHORTINFO',
				SHORTINFO_EN='$SHORTINFO_EN',
				SHORTINFO_CH='$SHORTINFO_CH',
				WHOLESALE_PRICE='$WHOLESALE_PRICE',
				WHOLESALE_SELLPRICE='$WHOLESALE_SELLPRICE',
				PROMOTION_YN='$PROMOTION_YN',
				PROMOTION_CONTENTS='$PROMOTION_CONTENTS',
				PROMOTION_COLOR='$PROMOTION_COLOR',
				LISTPRICE='$LISTPRICE',
				SELLPRICE='$SELLPRICE',
				PREMIUMPRICE='$PREMIUMPRICE',
				COPRICE='$COPRICE',
				WHOLESALE_YN='$WHOLESALE_YN',
				OFFLINE_YN='$OFFLINE_YN',
				WHOLESALE_RESERVE_YN='$WHOLESALE_RESERVE_YN',
				WHOLESALE_RESERVE='$WHOLESALE_RESERVE',
				WHOLESALE_RESERVE_RATE='$WHOLESALE_RESERVE_RATE',
				WHOLESALE_RATE_TYPE='$WHOLESALE_RATE_TYPE',
				RESERVE_YN='$RESERVE_YN',
				RESERVE='$RESERVE',
				RESERVE_RATE='$RESERVE_RATE',
				RATE_TYPE='$RATE_TYPE',
				DISP='$DISP',
				MOVIE='$MOVIE',
				VIEWORDER='$VIEWORDER',
				ADMIN='$SELLER_CODE',
				TRADE_ADMIN='$TRADE_ADMIN',
				ETC2='$rsc->reg_date',
				IS_DELETE='0',
				PRICE_DISP_YN='$PRICE_DISP_YN',
				DISPLAY_YN='$DISPLAY_YN',
				DISPLAY_START_DATE=now(),
				DISPLAY_END_DATE='$DISPLAY_END_DATE' 
				where PRODUCT_ID='".$PRODUCT_ID."'
				";
				//echo $que494."<br>";
				$sql=$mysqli->query($que494) or die("533:".$mysqli->error);

				//입력한 제품들 입력처리
				$que278="update ptest set gubun='1',pid='$PRODUCT_ID' where num='$rsc->num'";//gubun, 0:입력전, 1:입력완료, 2:셀러가없는경우
				//echo $que278."<br>";
				$sql = $mysqli->query($que278) or die("266:".$mysqli->error);


				// 카테고리를 삭제하고 다시 입력
				$que="delete from category_relation where PRODUCT_ID='$PRODUCT_ID'";
				$sql = $mysqli->query($que) or die("540:".$mysqli->error);

				$que="select * from ptest_cate  where pnum='$rsc->num'";
				$result = $mysqli->query($que) or die("270:".$mysqli->error);
				while($rs = $result->fetch_object()){

					$que11="SELECT CATEGORY_ID FROM mediapic.category_info where CATEGORY_NAME='$rs->cate2' and left(CATEGORY_ID,3) in (select left(CATEGORY_ID,3) from category_info where DEPTH='0' and CATEGORY_NAME='$rs->cate1')";
					$result11 = $mysqli->query($que11) or die("274:".$mysqli->error);
					$rs11 = $result11->fetch_array();
					$ca=$rs11[0];
					if(!$ca){
						$ca="005000000000000";
					}

					$que295="insert into category_relation values ('','$ca',
					'$PRODUCT_ID',
					'1',
					'$BASIC',
					'$INSERT_YN',
					now())";
					//echo $que295."<br>";
					$sql=$mysqli->query($que295) or die("285:".$mysqli->error);
				}


	// 컬러를 삭제하고 다시 입력
				$que="delete from product_color where PRODUCT_ID='$PRODUCT_ID'";
				$sql = $mysqli->query($que) or die("567:".$mysqli->error);

				$que="select * from ptest_color  where pnum='$rsc->num'";
				$result = $mysqli->query($que) or die("292:".$mysqli->error);
				while($rs = $result->fetch_object()){

					$que311="insert into product_color values ('','$PRODUCT_ID','$rs->color','$rs->color_en','$rs->color_en',now(),now())";
					//echo $que311."<br>";
					$sql=$mysqli->query($que311) or die("297:".$mysqli->error);
				}

	// 혼용율을 삭제하고 다시 입력
				$que="delete from product_material_info where PRODUCT_ID='$PRODUCT_ID'";
				$sql = $mysqli->query($que) or die("580:".$mysqli->error);

				$que319="select * from ptest_mate  where pnum='$rsc->num'";
				$result = $mysqli->query($que319) or die("303:".$mysqli->error);
				while($rs = $result->fetch_object()){

					$que321="insert into product_material_info values ('','$PRODUCT_ID','$rs->MATR_CODE','$rs->PERCENTAGE',now(),now())";
					//echo $que321."<br>";
					$sql=$mysqli->query($que321) or die("308:".$mysqli->error);
				}

					//파일 복사하고 디비에 넣기

						$oPath=$_SERVER["DOCUMENT_ROOT"]."media/SHOP/".$shop_code."/".$SELLER_CODE."/MOBILE/".$PRODUCT_ID."/IMG/";
						$vPath=$_SERVER["DOCUMENT_ROOT"]."media/SHOP/".$shop_code."/".$SELLER_CODE."/MOBILE/".$PRODUCT_ID."/MOV/";

			//제품별 테이블에서 삭제하고 다시 입력
						
						$que="delete from product_file_info where PRODUCT_ID='$PRODUCT_ID'";
						$sql = $mysqli->query($que) or die("598:".$mysqli->error);

						$dirt = opendir($oPath); // 기존 파일을 불러와서 모두 삭제
						while ($file = readdir($dirt)) {
								@unlink($oPath.$file);
						}
						closedir($dirt);

						$dirt2 = opendir($vPath); // 기존 파일을 불러와서 모두 삭제
						while ($file = readdir($dirt2)) {
								@unlink($vPath.$file);
						}
						closedir($dirt2);


						$fo=1;//file_order
						$que1="SELECT num, pnum, file_name, path,itype, seed, CASE WHEN seed > 0 THEN seed ELSE 999999999 END AS sort
										FROM
										(
											SELECT num, pnum, file_name, path,itype, 
											CAST(REPLACE(REPLACE(REPLACE(REPLACE(REPLACE(file_name, 'md', '60'), 'mm', '7'), 'm', ''), 'z', '90'), 'md', '60') AS UNSIGNED) AS seed
											FROM ptest_file where pnum='$rsc->num'
										) A
										ORDER BY sort";
						$result1 = $mysqli->query($que1) or die("336:".$mysqli->error);
						while($rs1 = $result1->fetch_object()){

							if($rs1->itype==0){//이미지
								$ext="";
								$nf=$PRODUCT_ID."_".date("YmdHis").substr(rand(),0,4).$fo;//복사할 파일명
								$fileinfo = pathinfo($rs1->file_name);
								$ext = $fileinfo['extension'];
								$nf=$nf.".".$ext;
								$path=iconv('UTF-8','EUC-KR',$rs1->path);
								$oldfile=$_SERVER["DOCUMENT_ROOT"].$path."/".$rs1->file_name;
								$newfile=$oPath.$nf;
								$iPath="media/SHOP/".$shop_code."/".$SELLER_CODE."/MOBILE/".$PRODUCT_ID."/IMG/";
								$IMGVOD_FLAG=0;// 일반이미지
								//echo $oldfile.",".$newfile."<br>";
							}else if($rs1->itype==1){//동영상
								$ext="";
								$nf=$PRODUCT_ID."_".date("YmdHis").substr(rand(),0,4).$fo;//복사할 파일명
								$fileinfo = pathinfo($rs1->file_name);
								$ext = $fileinfo['extension'];
								$nf=$nf.".".$ext;
								$path=iconv('UTF-8','EUC-KR',$rs1->path);
								$oldfile=$_SERVER["DOCUMENT_ROOT"].$path."/".$rs1->file_name;
								$newfile=$vPath.$nf;
								$iPath="media/SHOP/".$shop_code."/".$SELLER_CODE."/MOBILE/".$PRODUCT_ID."/MOV/";
								$IMGVOD_FLAG=1;// 동영상 0:이미지파일, 1:동영상파일,2:동영상 스틸컷 이미지,3:썸네일이미지,4:스틸컷을 축소한 이미지
								//echo $rs1->path.",".$oldfile.",".$newfile."<br>";
							}		

							if($rs1->itype==1){
								$fo=1;
							 }

							$imgsize=filesize($oldfile);
							$USE_FLAG=0;//모바일
							if($fo==1){
								$rep_flag=1;
							}else{
								$rep_flag=0;
							}

							$que392="insert into product_file_info values ('',
							'$PRODUCT_ID',
							'".$fo."',
							'".$rs1->file_name."',
							'".$nf."',
							'',
							'$iPath',
							'$imgsize',
							'$USE_FLAG',
							'$IMGVOD_FLAG',
							'".$rep_flag."',
							'0',
							now(),
							now()
							)";
							//echo $que392."<br>";
							$sql=$mysqli->query($que392) or die("393:".$mysqli->error);
							$FILE_ID_PARENT=$mysqli->insert_id;

							copy($oldfile, $newfile);//복사하고

							//watermark($newfile,$newfile);//워터마크
							if($rs1->itype==0){
								$wfile[]=$newfile;
							}

							if($fo==2){//스틸컷 등록
									
									$IMGVOD_FLAG=2;// 스틸컷
									$nef=$PRODUCT_ID."_".date("YmdHis").substr(rand(),0,4).".".$ext;
									$newfile2=$oPath.$nef;
									copy($oldfile, $newfile2);//복사하고

									//watermark($newfile2,$newfile2);//워터마크
									$imgsize=0;
									$wfile[]=$newfile2;
									$que411="insert into product_file_info values ('',
									'$PRODUCT_ID',
									'1',
									'$rs1->file_name',
									'$nef',
									'',
									'$iPath',
									'$imgsize',
									'$USE_FLAG',
									'$IMGVOD_FLAG',
									'1',
									'0',
									now(),
									now())";
									//echo $que411."<br>";
									$sql=$mysqli->query($que411) or die("426:".$mysqli->error);
							}


			if($rs1->itype==0){//이미지인 경우에만 썸네일

							if(!file_exists($oPath."T_".$nf)) { //썸네일이미지 확인하고

									//resizeimage(1080,$oPath."T_".$nf,$oPath.$nf);
									$rimg1[]=$oPath."T_".$nf;
									$rimg2[]=$oPath.$nf;
									$nef2="T_".$nf;
									//$imgsize=filesize($oPath."T_".$nf);
									$imgsize=0;
									$IMGVOD_FLAG=3;// 썸네일
									
									$que451="insert into product_file_info values ('',
									'$PRODUCT_ID',
									'$fo',
									'".$rs1->file_name."',
									'".$nef2."',
									'$FILE_ID_PARENT',
									'$iPath',
									'$imgsize',
									'$USE_FLAG',
									'$IMGVOD_FLAG',
									'".$rep_flag."',
									'0',
									now(),
									now()
									)";
									//echo $que451."<br>";
									$sql=$mysqli->query($que451) or die("446:".$mysqli->error);

							}

						}

			//				if(file_exists($newfile)) {//파일이 만들어졌으면 기존 파일 삭제
			//					@unlink($oldfile);
			//				}

							$fo++;

					}//ptest_file while



			}

		}//셀러유무

	}

//echo "<pre>";
//print_r($wfile);
//echo "</pre>";

foreach($wfile as $w){
//	echo $w."<br>";
	watermark($w,$w);//워터마크
	$wn="";
	$wx=explode("/IMG/",$w);
	$wn=$wx[0]."/IMG/"."T_".$wx[1];
	resizeimage(720,$wn,$w);
	set_time_limit(10);
	flush();
}
echo "ok";
/*
echo "<pre>";
print_r($rimg1);
echo "</pre>";
echo "<pre>";
print_r($rimg2);
echo "</pre>";

echo "count:".count($rimg1)."<br>";

for($g=0;$g<count($rimg1);$g++){
		resizeimage(720,$rimg1[$g],$rimg2[$g]);
		set_time_limit(10);
		flush();
}
*/

//location_is('','','입력했습니다.');



?>
