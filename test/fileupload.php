<?php
// Edit upload location here
$valid_formats = array("jpg", "png", "gif", "bmp");
$max_file_size = 1024*100; //100 kb
$upload_path='uploads/';
$count = 0;
if(isset($_POST) and $_SERVER['REQUEST_METHOD'] == "POST"){
	foreach ($_FILES['files']['name'] as $i => $name) {
		if ($_FILES['files']['error'][$i] == 4) { // 파일이 전송되지 않았습니다
			continue;
		}
		if ($_FILES['files']['error'][$i] == 0) { // 오류 없이 파일 업로드 성공
			if ($_FILES['files']['size'][$i] > $max_file_size) {
				$message[] = "$name is too large!.";
				continue;
			}elseif( ! in_array(pathinfo($name, PATHINFO_EXTENSION), $valid_formats) ){
				$message[] = "$name 은 허용된 파일 포멧이 아닙니다";
				continue;
			}else{ // 에러가 없으면
				$tmpname = $_FILES['files']['tmp_name'][$i];
				$realname = $_FILES['files']['name'][$i];
				$filesize = $_FILES['files']['size'][$i];
				$fileExt = getExt($realname);
				$rename = md5(uniqid($tmpname)) .round(microtime(true)).'.'.$fileExt;
				$uploadFile = $upload_path . $rename;
				if(move_uploaded_file($tmpname, $uploadFile)){
					@chmod($readFile,0606);
					//echo 'index:'.$i.'<br />';
					//$sql = "update tablename set file{$i}='$rename', file{$i}_size='$filesize' where uid='$uid'";
					//myquery($sql) or die(mysql_error()); 
					$count++; // 업로드 성공한 파일 숫자
				}
			}
		}
	}
}

echo json_encode(array('count' => $count));
//echo $count;

// 확장자 추출 함수
function getExt($filename){ 
	$ext = substr(strrchr($filename,"."),1); 
	$ext = strtolower($ext);
	return $ext;
}

?>