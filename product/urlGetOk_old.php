<?php session_start();
include $_SERVER["DOCUMENT_ROOT"]."/inc/dbcon.php";


$uid=$_SESSION['AID'];
$myLevel=$_SESSION['AMLEVEL'];
$pid=$_POST['pid'];

/*
if(strpos($url,"?id=")){

	$url2=explode("?id=",$url);
	$url3=explode("&",$url2[1]);
	$pid=$url3[0];

}else if(strpos($url,"&id=")){

	$url2=explode("&id=",$url);
	$url3=explode("&",$url2[1]);
	$pid=$url3[0];

}
*/
//$output=exec('cd /home/mallpro/ && sudo -u www-data python3 taoOption.py '.$pid);
//$output=exec('cd /home/mallpro/ && python3 taoOption.py '.$pid.' '.$uid);
//$output=('sudo python3 /home/mallpro/taoOption.py '.$pid.' '.$uid);
//$data=array("result"=>1,"val"=>$output);
//echo json_encode($data);
//exit;
$output=exec('cd /home/mallpro/ && python3 taoOption.py '.$pid.' '.$uid);
$data=array("result"=>-1,"val"=>$output);
echo json_encode($data);
exit;
if($output){

	$que="SELECT count(1) FROM taobao WHERE uid='".$uid."' and pid = '".$pid."' and gubun='2'";
	$result = $mysqli->query($que);
	$rs = $result->fetch_array();


	if(!$rs[0]){
		$data=array("result"=>1,"val"=>$rs[0]);
		echo json_encode($data);
	}else{
		$data=array("result"=>-1,"val"=>$rs[0]);
		echo json_encode($data);
	}
}else{
		$data=array("result"=>-1,"val"=>$rs[0]);
		echo json_encode($data);
}


?>