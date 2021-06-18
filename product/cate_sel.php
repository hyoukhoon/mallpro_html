<?php include $_SERVER["DOCUMENT_ROOT"]."/inc/dbcon.php";

$CATEGORY_ID=$_GET['CATEGORY_ID'];
$CID=substr($CATEGORY_ID,0,3);

$val="<tr><td><select name='cate1[]' class='big_cate' onChange11='selCate(this,this.value)'>";
$val.="<option value=''>대분류</option>";

$order=" order by LEVEL1 asc";
$que="select * 
from category_info  where CATEGORY_USE='1' and DEPTH='0'";
$que.=$where;
$que.=$order;
$result = $mysqli->query($que) or die("2:".$mysqli->error);
while($rs = $result->fetch_object()){
	$val.="<option value='".$rs->CATEGORY_ID."'>".$rs->CATEGORY_NAME."</option>";
}

$val.="</select></td>";
$val.="<td><select name='cate2[]' class='small_cate'>";
$val.="<option value=''>소분류</option>";
$val.="</select></td></tr>";

echo $val;
?>
