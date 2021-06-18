<?php session_start();
include $_SERVER['DOCUMENT_ROOT']."/inc/dbcon.php";

if(!$_SESSION['AID']){
	location_is('','','로그인하십시오.');
	exit;
}

$uid=$_SESSION["AID"];
$multi="qna";

	$num=$_GET['num'];

if($uid!="hyoukhoon"){
	$where=" and uid='".$uid."'";
}

	$result=$mysqli->query("select * from cboard where num='$num' $where") or die("3:".$mysqli->error);
	$rs = $result->fetch_object();
	$file=$rs->file_list;
	if($file){
		$delFile=explode(",",$file);
		for($i=0;$i<sizeof($delFile);$i++){
			unlink($_SERVER['DOCUMENT_ROOT'].$delFile[$i]);
		}
	}
	
	$query="delete from cboard where num='$num' $where";
	$sql1=$mysqli->query($query) or die("3:".$mysqli->error);


	if($sql1){

		location_is('qna.php','','삭제했습니다');
	}else{
		location_is('','','다시 시도해주십시오.');
	}

	
?>