<?php session_start();
include $_SERVER['DOCUMENT_ROOT']."/inc/dbcon.php";

if(!$_SESSION['AID']){
	$data=array("result"=>-1,"val"=>"로그인하십시오."); 
	echo json_encode($data);
	exit;
}

$uid=$_SESSION["AID"];
$multi="qna";

	$subject=removeHackTag($_POST['subject']);
	$url=removeHackTag($_POST['url']);
	$imgUrl=$_POST['imgUrl'];
	$content=$_POST['content'];
	$content=addslashes($content);

	$mysqli->autocommit(FALSE);

	$query="INSERT INTO `mallpro`.`cboard`
(`uid`,
`subject`,
`url`,
`file_list`,
`content`,
`multi`)
VALUES
('$uid',
'$subject',
'$url',
'$imgUrl',
'$content',
'$multi');";

	$sql1=$mysqli->query($query) or die("3:".$mysqli->error);


	if($sql1){

		$mysqli->commit();
		$data=array("result"=>1,"val"=>"성공"); 
	}else{
		$data=array("result"=>0,"val"=>"실패"); 
	}

	echo json_encode($data);
?>