<?php include $_SERVER["DOCUMENT_ROOT"]."/inc/dbcon.php";

$num=$_GET['num'];

//print_r($num);

$sq="";
	foreach($num as $n){
		$sq.="'".$n."',";
	}
	$sq=substr($sq,0,-1);


	$que="update popular_searches set SEARCHES_DEL='1' where POPULAR_SERCHES_SEQ in (".$sq.")";//상태값만 변경


//echo $que;

$sql=$mysqli->query($que) or die($mysqli->error);

if($sql){
	location_is('','','삭제했습니다.');
}else{
	location_is('','','디비입력에 실패했습니다. 다시 입력해주십시오.');
}

?>

