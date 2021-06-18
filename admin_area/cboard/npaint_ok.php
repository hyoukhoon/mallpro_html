<?include "$DOCUMENT_ROOT/db.php";
	$image = explode(",",$_GET['image']); 	// 편집된 이미지 저장 경로
	$thum = explode(",",$_GET['thum']);	 	// 썸네일 이미지 저장 경로.

	
	for($i=0;$i<sizeof($image);$i++){

		$upfile_detail_name[$i] = strtolower(substr(strrchr($image[$i],"."),1));
		$today = getdate(); 
		$rnd_name = sprintf("%04d%02d%02d%02d%02d%02d%02d%02d%02d", 
													$today['year'], 
													$today['mon'],
													$today['mday'],
													$today['hours'],
													$today['minutes'],
													$today['seconds'],
													rand(10,99),
													rand(10,99),
													rand(10,99));
		$local_path = "$DOCUMENT_ROOT/img/data/".$rnd_name.".".$upfile_detail_name[$i];
		$local_path2 = "$DOCUMENT_ROOT/img/small/".$rnd_name.".".$upfile_detail_name[$i];
		
		//echo "img : $image[$i] <br>";
		//echo "local : $local_path <br>";
		//echo "thum : $thum[$i] <br>";
		//echo "local2 : $local_path2 <br>";
		$img_name="";
		copy($image[$i],$local_path);
		copy($thum[$i],$local_path2);
		$img_name=$rnd_name.".".$upfile_detail_name[$i];

		$sql=mysql_query("insert into img_table values ('','$buffer_num','$img_name','$gubun',now())") or die(mysql_error());

	}

//	$return_url = "http://www.carntrue.com/img/data/$rnd_name.jpg";
	
	
	$script = "<script>alert('등록했습니다'); window.close();</script>";	
	echo $script;

?>