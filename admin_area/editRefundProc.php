<?php include $_SERVER['DOCUMENT_ROOT']."/inc/dbcon.php";

//ini_set('display_errors', 1);
//ini_set('display_startup_errors', 1);
//error_reporting(E_ALL);

$status=json_decode(trim($_POST['status']));
$num=json_decode(trim($_POST['num']));


for($i=0;$i<count($num);$i++){

	$query1 = "SELECT * FROM refund WHERE num = '".$num[$i]."'";
	$result = $mysqli->query($query1) or die($mysqli->error);
	$rs= $result->fetch_object();
	$memberGubun=$rs->memberGubun;

		$query5="UPDATE refund 
						SET
						`status` = '".$status[$i]."'
						WHERE `num` = '".$num[$i]."'";
		$sql=$mysqli->query($query5) or die($mysqli->error);

		if($status[$i]==2){
			//쪽지
							$subject="환불처리가 완료됐습니다.";
							$content="안녕하세요. ".$rs->uid."고객님.<br>고객님께서 신청하신 ".number_format($rs->amt)."원에 대한 환불처리가 완료됐습니다.<br>수수료는 ".number_format($refundFee)."원 입니다.<br>
							감사합니다.
							";
							$isRead=0;
							$isReply=0;
							$isAttach=0;
							$isDelete=0;
							$query2="INSERT INTO `propick`.`memo`
											(`fromId`,
											`toId`,
											`subject`,
											`content`,
											`regDate`,
											`readDate`,
											`isRead`,
											`isReply`,
											`isAttach`,
											`isDelete`)
											VALUES
											('admin',
											'".$rs->uid."',
											'$subject',
											'$content',
											now(),
											'$readDate',
											'$isRead',
											'$isReply',
											'$isAttach',
											'$isDelete')";
							//$sql2=$mysqli->query($query2) or die("3:".$mysqli->error);
		}


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