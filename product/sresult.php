<?php include $_SERVER["DOCUMENT_ROOT"]."/inc/dbcon.php";

$sword=$_POST['sword'];
$data="";
$que="select * from naver_category where  cate3 like'%".$sword."%' or cate4 like '%".$sword."%'";
$result = $mysqli->query($que) or die("2:".$mysqli->error);
while($rs = $result->fetch_object()){
	$data.="- <input type='radio' id='categoryCode' name='categoryCode' value='".$rs->categoryCode."'> ".$rs->cate1.">".$rs->cate2.">".$rs->cate3.">".$rs->cate4."<br>";
}

if($data){
	echo $data;
}else{
	echo	$data="<font color='red'> - 검색결과가 없습니다</font>";
}
?>

