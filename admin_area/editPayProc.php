<?php include $_SERVER['DOCUMENT_ROOT']."/inc/dbcon.php";

//ini_set('display_errors', 1);
//ini_set('display_startup_errors', 1);
//error_reporting(E_ALL);

$isuse=json_decode(trim($_POST['isuse']));
$num=json_decode(trim($_POST['num']));


for($i=0;$i<count($num);$i++){

	$query1 = "SELECT * FROM memberCoupon WHERE num = '".$num[$i]."'";
	$result = $mysqli->query($query1) or die($mysqli->error);
	$rs= $result->fetch_object();
	$memberGubun=$rs->memberGubun;

		$query5="UPDATE memberCoupon 
						SET
						`isuse` = '".$isuse[$i]."'
						WHERE `num` = '".$num[$i]."'";
		$sql=$mysqli->query($query5) or die($mysqli->error);

		if($sql){
			$qresult=1;
		}else{
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