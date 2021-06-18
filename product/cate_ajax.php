<?php include $_SERVER["DOCUMENT_ROOT"]."/inc/dbcon.php";

$cate1=$_POST['cate1'];
$cate2=$_POST['cate2'];
$cate3=$_POST['cate3'];
$cate4=$_POST['cate4'];
$n=$_POST['n'];
$k=$n+1;

if($n==1){
	$where=" cate1='".$cate1."'";
	$groupby=" group by cate2";
	$orderby=" order by cate2";
}else if($n==2){
	$where=" cate1='".$cate1."' and cate2='".$cate2."'";
	$groupby=" group by cate3";
	$orderby=" order by cate3";
}else if($n==3){
	$where=" cate1='".$cate1."' and cate2='".$cate2."' and cate3='".$cate3."'";
	$groupby=" group by cate4";
	$orderby=" order by cate4";
}else{
	exit;
}

$data.="<option value=''>선택하세요</option>";
$que="select * from naver_category where ".$where.$groupby.$orderby;
$result = $mysqli->query($que) or die("2:".$mysqli->error);
while($rs = $result->fetch_object()){
	$data.="<option value='".$rs->{'cate'.$k}."'>".$rs->{'cate'.$k}."</option>";
}

echo $data;
?>

