<?php session_start();
include $_SERVER['DOCUMENT_ROOT']."/inc/dbcon.php";

if(!$_SESSION['AID']){
	$data=array("result"=>-1,"val"=>"로그인하십시오."); 
	echo "로그인하십시오";
	exit;
}

$uid=$_SESSION["AID"];
$multi="qna";

		if($_FILES['file']['size']>1024000){
			echo "-1";
			exit;
		}
		$ext = substr(strrchr($_FILES['file']['name'],"."),1);
		$ext = strtolower($ext);
		if ($ext != "jpg" and $ext != "png" and $ext != "jpeg" and $ext != "gif")
		{
			echo "-1";
			exit;
		}

        $name = "mp_".$now3.substr(rand(),0,4);
        $filename = $name.'.'.$ext;
        $destination = '/var/www/mallpro/public_html/member/upImages/'.$filename;
        $location =  $_FILES["file"]["tmp_name"];
        move_uploaded_file($location,$destination);
        echo '/member/upImages/'.$filename;

?>