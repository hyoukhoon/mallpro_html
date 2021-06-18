<?php session_start();
//error_reporting(E_ALL);
//ini_set("display_errors", 1);
include $_SERVER['DOCUMENT_ROOT']."/admin_area/inc/admin_top.php";

echo "<meta http-equiv=\"content-type\" content=\"text/html; charset=utf-8\">";

$ps=$_GET['ps'];
$multi=$_POST['multi']?$_POST['multi']:$_GET['multi'];
$subject=$_POST['subject']?$_POST['subject']:$_GET['subject'];
$ir1=$_POST['ir1']?$_POST['ir1']:$_GET['ir1'];

$level=$_POST['level']?$_POST['level']:$_GET['level'];
$step=$_POST['step']?$_POST['step']:$_GET['step'];
$list=$_POST['list']?$_POST['list']:$_GET['list'];
$mode=$_POST['mode']?$_POST['mode']:$_GET['mode'];
$num=$_POST['num']?$_POST['num']:$_GET['num'];

if(!$_SESSION["MMS_ID"]){
	location_is('/admin_area/login.php','','관리자만 들어올수 있습니다.');
	exit;
}



		$result = $mysqli->query("select * from cboard where num='$num'");
		$rs = $result->fetch_object();

				if($rs->num){


				if($rs->fn1){
						$del_file=$_SERVER['DOCUMENT_ROOT']."/data/".$rs->fn1;
						unlink($del_file);
				}

				if($rs->fn2){
						$del_file=$_SERVER['DOCUMENT_ROOT']."/data/".$rs->fn2;
						unlink($del_file);
				}

				if($rs->file_list){

					$fl=explode("||",$rs->file_list);
						for($f=0;$f<sizeof($fl);$f++){

									$del_file=$_SERVER['DOCUMENT_ROOT']."/se2/upload/".$fl[$f];
									unlink($del_file);
									$del_file=$_SERVER['DOCUMENT_ROOT']."/se2/small/".$fl[$f];
									unlink($del_file);

						}
				}


			$sql=$mysqli->query("delete from cboard where num='$num'") or die(mysqli_error());

			location_is('boardList.php','num='.$num.'&page_no='.$page_no.'&f_no='.$f_no.'&s_key='.$s_key.'&s_word='.$s_word.'&multi='.$multi.'&gubun='.$gubun,'삭제하였습니다.');
		}else{
			location_is('boardView.php','num='.$num.'&page_no='.$page_no.'&f_no='.$f_no.'&s_key='.$s_key.'&s_word='.$s_word.'&multi='.$multi.'&gubun='.$gubun,'삭제할 대상이 존재 하지 않습니다..');
		}


?>
