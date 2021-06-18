<?php include $_SERVER["DOCUMENT_ROOT"]."/inc/dbcon.php";

$CATEGORY_ID=$_GET['CATEGORY_ID'];
$CID=substr($CATEGORY_ID,0,3);
$val="<select name='cate2[]' class='small_cate'><option value=''>소분류</option>";
$que="select CATEGORY_ID,CATEGORY_NAME from category_info where DEPTH='1' and left(CATEGORY_ID,3)='".$CID."' and CATEGORY_USE='1' order by LEVEL2 asc";
$result = $mysqli->query($que) or die("2:".$mysqli->error);
while($rs = $result->fetch_object()){
	$val.="<option value='".$rs->CATEGORY_ID."'>".$rs->CATEGORY_NAME."</option>";
}
$val.="</select>";

echo $val;
?>

