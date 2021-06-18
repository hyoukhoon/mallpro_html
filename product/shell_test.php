<?php include $_SERVER["DOCUMENT_ROOT"]."/inc/dbcon.php";
//error_reporting(E_ERROR | E_WARNING | E_PARSE);
//ini_set('error_reporting', E_ERROR | E_WARNING | E_PARSE);
//ini_set("display_errors", 1);
$data1 = shell_exec("/script/test.sh");


if($data1=="job is done"){
	location_is('','','입력했습니다.');
	exit;
}else{
	location_is('','','새로운 파일을 업로드중입니다. 시간이 걸릴 수 있으니 폴더가 나타나더라도 조금 기다려주십시오.');
	exit;
}
?>