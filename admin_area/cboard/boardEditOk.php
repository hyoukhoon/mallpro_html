<?php session_start();

//error_reporting(E_ALL);
//ini_set("display_errors", 1);

include $_SERVER["DOCUMENT_ROOT"]."/inc/dbcon.php";

$ps=$_GET['ps'];

$notice=$_POST['notice'];
$sReply=$_POST['sReply'];
$isdisp=$_POST['isdisp'];
$subject=$_POST['subject'];
$content=$_POST['content'];

$mode=$_POST['mode'];
$num=$_POST['num'];
$isReply=$_POST['isReply'];

if(!$_SESSION["MMS_ID"]){
	$data=array("result"=>0,"val"=>$query); 
	echo json_encode($data);
	exit;
}


$content=$content;


		$subject=addslashes($subject);
		$content=addslashes($content);
		$link1=addslashes($link1);
		$link2=addslashes($link2);
		$main_content=addslashes($main_content);
		$stream=addslashes($stream);


			$query="update cboard set subject='$subject',content='$content',notice='$notice',isdisp='$isdisp',isReply='$isReply' where num='$num'";
			$sql=$mysqli->query($query);

			if($sql){
				$data=array("result"=>1,"val"=>"성공"); 
			}else{
				$data=array("result"=>0,"val"=>"실패"); 
			}

			echo json_encode($data);



?>
