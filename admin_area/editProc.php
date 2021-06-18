<?php include $_SERVER['DOCUMENT_ROOT']."/dbcon.php";

//ini_set('display_errors', 1);
//ini_set('display_startup_errors', 1);
//error_reporting(E_ALL);

$uname=json_decode(trim($_POST['uname']));
$email=json_decode(trim($_POST['email']));
$token=json_decode(trim($_POST['token']));
$vesting=json_decode(trim($_POST['vesting']));
$num=json_decode(trim($_POST['num']));

if(count($uname)<1){
	$data=array("result"=>-1,"val"=>"빈값이 있습니다.");
	echo json_encode($data);
	exit;
}

//$passwd=md5("11111111");

for($i=0;$i<count($num);$i++){

//		$pass=md5($passwd[$i]);

		$mysqli->autocommit(FALSE);

		$query="UPDATE `donocle`.`member`
						SET
						`email` = '".$email[$i]."',
						`uname` = '".$uname[$i]."',
						`vesting` = '".$vesting[$i]."'
						WHERE `num` = '".$num[$i]."'";
		$sql=$mysqli->query($query) or die($mysqli->error);


		$sql2 = "SELECT count(*) FROM useramt WHERE uname = '".trim($uname[$i])."'";
		$result2 = $mysqli->query($sql2) or die($mysqli->error);
		$rs2= $result2->fetch_array();

		if($rs2[0]){
			$query2="UPDATE `donocle`.`useramt`
								SET
								`amt` = '".$token[$i]."' 
								WHERE `uname` = '".$uname[$i]."'";
			$sql2=$mysqli->query($query2) or die($mysqli->error);

		}else{

			$query2="INSERT INTO `donocle`.`useramt`
							(`uname`,
							`amt`,
							`rname`,
							`email`)
							VALUES
							('$uname[$i]',
							'$token[$i]',
							'$rname',
							'$email[$i]')";
			$sql2=$mysqli->query($query2) or die($mysqli->error);

		}

		if($sql && $sql2){
			$mysqli->commit();
			$qresult=1;
		}else{
			$mysqli->rollback();
			$qresult=0;
		}

}

	if($qresult){
		$data=array("result"=>1,"val"=>"수정했습니다.");
		echo json_encode($data);
		exit;
	}else{
		$data=array("result"=>-2,"val"=>"다시 시도하십시오.");
		echo json_encode($data);
		exit;
	}


$mysqli->close();
?>