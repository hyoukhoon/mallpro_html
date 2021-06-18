<?php include $_SERVER["DOCUMENT_ROOT"]."/inc/dbcon.php";

$BBS_TYPE=$_GET['BBS_TYPE'];

$val="<select name='CATEGORY_SEQ'><option value=''>하위분류</option>";

$que="select CATEGORY_SEQ,CATEGORY_NAME from bbs_category where BBS_TYPE='".$BBS_TYPE."' and CATEGORY_USE='1' order by SORT asc";
$result = $mysqli->query($que) or die("2:".$mysqli->error);
while($rs = $result->fetch_object()){
	$val.="<option value='".$rs->CATEGORY_SEQ."'>".$rs->CATEGORY_NAME."</option>";
}

$val.="</select>";

echo $val;
?>

