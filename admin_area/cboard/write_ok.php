<?php session_start();
error_reporting(E_ALL);
ini_set("display_errors", 1);
include $_SERVER['DOCUMENT_ROOT']."/inc/dbcon.php";

$ps=$_GET['ps'];
$multi=$_POST['multi']?$_POST['multi']:$_GET['multi'];
$subject=$_POST['subject']?$_POST['subject']:$_GET['subject'];
$ir1=$_POST['ir1']?$_POST['ir1']:$_GET['ir1'];

$level=$_POST['level']?$_POST['level']:$_GET['level'];
$step=$_POST['step']?$_POST['step']:$_GET['step'];
$list=$_POST['list']?$_POST['list']:$_GET['list'];
$mode=$_POST['mode']?$_POST['mode']:$_GET['mode'];
$num=$_POST['num']?$_POST['num']:$_GET['num'];


if(!$_SESSION["MMS_ID"]){
	location_is('/admin_area/login.php','','관리자만 들어올수 있습니다.');
	exit;
}



$content=$ir1;

if($_FILES["upfile"]["name"]){

	$target_dir = $_SERVER['DOCUMENT_ROOT']."/data/";
	$target_file = $target_dir . basename($_FILES["upfile"]["name"]);
	$imageFileType = pathinfo($target_file,PATHINFO_EXTENSION);
	$fn=date("YmdHis").substr(rand(),0,6).".".$imageFileType;
	$fn_save=$target_dir.$fn;

	if($imageFileType != "jpg" && $imageFileType != "png" && $imageFileType != "jpeg"
	&& $imageFileType != "gif" ) {
		location_is('','','이미지파일만 업로드할 수 있습니다.');
		exit;
	}

	if ($_FILES["upfile"]["size"] > 2048000) {
		location_is('','','이미지파일만의 크기는 2M가 이하이어야합니다.');
		exit;
	}

	if (move_uploaded_file($_FILES["upfile"]["tmp_name"], $fn_save)) {
			$fn_name=basename($_FILES["upfile"]["name"]);
		}

}

if($list){

			$sql=$mysqli->query("update cboard set step=step+1 where list='$list' and step>'$step'");
			$level=$level+1;
			$step=$step+1;
			$reply="n";

		}else{

			$result = $mysqli->query("select max(num) from cboard");
			$dat = $result->fetch_array();


			if(!$dat[0]){

			$list=1;

			}else{

			$list=$dat[0]+1;

			}
			$level=0;
			$step=0;
			$reply="y";

		}


preg_match_all("@[a-z0-9/_]{1,}\.(jpg|gif|bmp|png)@i", $content, $match); 

for($k=0;$k<sizeof($match[0]);$k++){
			if(!strpos($match[0][$k], "/upload/")){
				$is.=$match[0][$k]."||";
			}
		}


		$subject=addslashes($subject);
		$content=addslashes($content);
		$main_content=addslashes($main_content);

		$link1=addslashes($link1);
		$link2=addslashes($link2);
		$head_text=addslashes($head_text);
		$stream=addslashes($stream);
		if($multi=="notice"){
			$gubun="공지";
		}

		if($level){
			$gubun="답변";
		}
$que="insert into cboard values ('','$car_num','".$_SESSION["MMS_NAME"]."','".$_SESSION["MMS_ID"]."','$good','$bad','$re_email','$subject','$content','$stream','$fn_name','$upfile_name[1]','$is','$fn','$upfile_file[1]','$upfile_file[2]',now(),'1','$list','$level','$step','$multi','$html','0','','$notice','$best_level','$REMOTE_ADDR','$mileage_point','$gubun','$give_yn',now(),'$passwd','$point','$cate','$secret','$isdisp','$main_content')";
//echo $que."<br>";
//exit;
$sql=$mysqli->query($que);
$go_num=$mysqli->insert_id;


location_is('boardView.php','num='.$go_num.'&multi='.$multi,'');

?>
