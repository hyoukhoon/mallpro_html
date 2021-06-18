<?php include $_SERVER['DOCUMENT_ROOT']."/inc/dbcon.php";


	$page=$_GET['page'];
	$step=$_GET['step'];
	$f_no=$_GET['f_no'];

	$que="select * from pick_table where istate='1'";
//	echo $que."<br>";
	$que3="select count(1) from pick_table where istate='1'";
	$result3 = $mysqli->query($que3) or die("1:".$mysqli->error);
	$rs3 = $result3->fetch_array();
	$total=$rs3[0]/2;
	echo $total."<br>";
//exit;
	//페이징
	$LIMIT=$_GET['LIMIT']??20;
	$page=$_GET['page']??1;
	$start_page=($page-1)*$LIMIT;
	$end_page=$LIMIT;
	$ps=$LIMIT;//한페이지에 몇개를 표시할지
	$sub_size=10;//아래에 나오는 페이징은 몇개를 할지
	$total_page=ceil($total/$ps);//몇페이지
	$f_no=$_GET['f_no']??1;//첫페이지
	if($f_no<1)$f_no=1;
	$l_no=$f_no+$sub_size-1;//마지막페이지
	if($l_no>$total_page)$l_no=$total_page;
	$n_f_no=$f_no+$sub_size;//다음첫페이지
	$p_f_no=$f_no-$sub_size;//이전첫페이지
	$no=$total-($page-1)*$ps;//번호매기기

//echo "l_no:".$l_no;
	$limit_query=" group by setNum  order by num desc";
	$last_query=$que.$limit_query;
	$result = $mysqli->query($last_query) or die("3:".$mysqli->error);
	while($rs = $result->fetch_object()){
	
		$result2 = $mysqli->query("select * from pick_table where setNum='".$rs->setNum."'") or die("3:".$mysqli->error);
		while($rs2 = $result2->fetch_object()){
			echo $rs2->setNum.":".$rs2->uid.":".$rs2->pnum."-".$rs2->gamePreview." , ";
		}

		echo "<br>";
			
	}


?>