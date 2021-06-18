<?php include $_SERVER["DOCUMENT_ROOT"]."/inc/dbcon.php";

$SUBJECT=$_GET['SUBJECT'];
$start_date=$_GET['start_date'];
$end_date=$_GET['end_date'];
$CONTENT_DISPLAY=$_GET['CONTENT_DISPLAY'];
$CATEGORY_SEQ=$_GET['CATEGORY_SEQ'];

$gubun=$_GET['gubun'];
$url=$_GET['url'];
$num=$_GET['num'];

//print_r($num);

$sq="";
	foreach($num as $n){
		$sq.="'".$n."',";
	}
	$sq=substr($sq,0,-1);

if($gubun==1){//노출함

	$que="update bbs_content set CONTENT_DISPLAY='1' where CONTENT_SEQ in (".$sq.")";

}else if($gubun==2){//노출안함

	$que="update bbs_content set CONTENT_DISPLAY='0' where CONTENT_SEQ in (".$sq.")";

}else{//삭제

	$que="update bbs_content set CONTENT_DEL='1' where CONTENT_SEQ in (".$sq.")";//상태값만 변경

}

//echo $que;

$sql=$mysqli->query($que) or die($mysqli->error);

if($sql){
	location_is($url,'SUBJECT='.$SUBJECT.'&start_date='.$start_date.'&end_date='.$end_date.'&CONTENT_DISPLAY='.$CONTENT_DISPLAY.'&CATEGORY_SEQ='.$CATEGORY_SEQ,'');
}else{
	location_is('','','디비입력에 실패했습니다. 다시 입력해주십시오.');
}

?>

