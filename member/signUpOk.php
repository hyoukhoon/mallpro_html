<?php include $_SERVER['DOCUMENT_ROOT']."/inc/dbcon.php";

	$uid=removeHackTag($_POST['uid']);
	$email=removeHackTag($_POST['email']);
	$passwd=removeHackTag($_POST['passwd']);
	$referee=removeHackTag($_POST['referee']);



	if(!$uid or !$email or !$passwd){
//		echo "uid:".$uid.",email:".$email.",passwd:".$passwd.",memberGubun:".$memberGubun.",nickname:".$nickname;
		$data=array("result"=>-1,"val"=>"no Value");
		echo json_encode($data);
		exit;
	}

	$passwd=hash('sha512',$passwd);
	$isAuth=0;
	$mLevel=0;


	if($_POST['email']){

		$que3="SELECT count(*) FROM member WHERE email = '".$email."'";
		$result3 = $mysqli->query($que3) or die("2:".$mysqli->error);
		$rs3 = $result3->fetch_array();

		if($rs3[0]){
			$data=array("result"=>-2,"val"=>"no Value");
			echo json_encode($data);
			exit;
		}

	}

	$loginIp=$_SERVER["REMOTE_ADDR"];

	$mysqli->autocommit(FALSE);

	$isAuth=1;
	$query="INSERT INTO `mallpro`.`member`
					(`uid`,
					`email`,
					`passwd`,
					`regDate`,
					`lastLogin`,
					`isAuth`,
					`mLevel`,
					`passUpDate`,
					`loginIp`,
					`referee`)
					VALUES
					('$uid',
					'$email',
					'$passwd',
					now(),
					now(),
					'$isAuth',
					'$mLevel',
					now(),
					'$loginIp',
					'$referee')";

	$sql1=$mysqli->query($query) or die("3:".$mysqli->error);


	if($sql1){

		//다운갯수와 쿠폰수 조정
		$totalDownCnt=5;
		$nowDownCnt=0;
		$buyCoupon=0;
		$nowCoupon=0;
		$isuse=0;
		$gubun=1;//회원가입
		$query2="INSERT INTO `mallpro`.`memberCoupon`
					(`uid`,
					`totalDownCnt`,
					`nowDownCnt`,
					`buyCoupon`,
					`nowCoupon`,
					`regDate`,
					`startDate`,
					`endDate`,
					`isuse`,
					`gubun`)
					VALUES
					('$uid',
					'$totalDownCnt',
					'$nowDownCnt',
					'$buyCoupon',
					'$nowCoupon',
					now(),
					now(),
					date_add(now(),INTERVAL 1 MONTH),
					'$isuse',
					'$gubun')
					";
		$sql2=$mysqli->query($query2) or die("3:".$mysqli->error);



		$mysqli->commit();
		
		

		$data=array("result"=>1,"val"=>"성공"); 
	}else{
		$data=array("result"=>0,"val"=>"실패"); 
	}

	echo json_encode($data);
?>