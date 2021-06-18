<?php session_start();

include $_SERVER['DOCUMENT_ROOT']."/inc/dbcon.php";


	$email=removeHackTag($_POST['email']);
	$passwd=removeHackTag($_POST['passwd']);
	$oldPasswd=removeHackTag($_POST['oldPasswd']);



	if(!$email or !$passwd or !$oldPasswd){
//		echo "uid:".$uid.",email:".$email.",passwd:".$passwd.",memberGubun:".$memberGubun.",nickname:".$nickname;
		$data=array("result"=>-1,"val"=>"no Value");
		echo json_encode($data);
		exit;
	}

	$passwd=hash('sha512',$passwd);
	$oldPasswd=hash('sha512',$oldPasswd);

		$uid=$_SESSION['AID'];

		$que="select * from member where uid='".$uid."' and passwd='".$oldPasswd."'";
		$result = $mysqli->query($que) or die($mysqli->error);
		$rs = $result->fetch_object();

		if(!$rs->num){
			$data=array("result"=>-3,"val"=>"기존 비밀번호가 맞지 않습니다. 다시 확인해주세요.");
			echo json_encode($data);
			exit;
		}



	$loginIp=$_SERVER["REMOTE_ADDR"];

	$mysqli->autocommit(FALSE);

	$query="update member set email='$email', passwd='$passwd',passUpDate=now() where uid='$uid'";
	$sql1=$mysqli->query($query) or die("3:".$mysqli->error);


	if($sql1){

		$mysqli->commit();
		$data=array("result"=>1,"val"=>"성공"); 
	}else{
		$data=array("result"=>0,"val"=>"실패"); 
	}

	echo json_encode($data);
?>