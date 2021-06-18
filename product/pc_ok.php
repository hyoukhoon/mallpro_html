<?php include $_SERVER["DOCUMENT_ROOT"]."/inc/dbcon.php";

$SUBJECT=$_GET['SUBJECT'];
$start_date=$_GET['start_date'];
$end_date=$_GET['end_date'];
$CONTENT_DISPLAY=$_GET['CONTENT_DISPLAY'];
$CATEGORY_SEQ=$_GET['CATEGORY_SEQ'];

$gubun=$_GET['gubun'];
$url=$_GET['url'];
$num=$_GET['num'];


$sq="";
	foreach($num as $n){
		$sq.="'".$n."',";
	}
	$sq=substr($sq,0,-1);

if($gubun==2){//진열함

	$que="update product set DISPLAY_YN='Y' where PRODUCT_ID in (".$sq.")";

}else if($gubun==3){//진열안함

	$que="update product set DISPLAY_YN='N' where PRODUCT_ID in (".$sq.")";

}else if($gubun==4){//삭제

	$que="update product set IS_DELETE='1' where PRODUCT_ID in (".$sq.")";//상태값만 변경
	$sql=$mysqli->query($que) or die($mysqli->error);

	$que="update ptest set gubun='0' where pid in (".$sq.")";//상태값만 변경
	$sql=$mysqli->query($que) or die($mysqli->error);

	foreach($num as $p){

		$que3="select FILE_ORDER,PRODUCT_ID,FILEPATH,FILENM_SYS,REP_FLAG from product_file_info where PRODUCT_ID='".$p."'";
		$result3 = $mysqli->query($que3) or die("1:".$mysqli->error);
		while($rs3 = $result3->fetch_array()){

			$del_file=$_SERVER["DOCUMENT_ROOT"].$rs3[2].$rs3[3];
			$del_file2=$_SERVER["DOCUMENT_ROOT"].$rs3[2]."T_".$rs3[3];

			$que="update product_file_info set DEL_FLAG='1' where PRODUCT_ID='".$p."'";
			$sql2 = $mysqli->query($que) or die("3:".$mysqli->error);
			if($sql2){
				unlink($del_file);
				unlink($del_file2);
			}

		}

	}

}

$sql=$mysqli->query($que) or die($mysqli->error);

if($sql){
	location_is('','','처리했습니다.');
}else{
	location_is('','','디비입력에 실패했습니다. 다시 입력해주십시오.');
}

?>

