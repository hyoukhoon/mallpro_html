<?session_start();
include "$DOCUMENT_ROOT/db.php";

if(!$MMS_ID){
	location_is('/admin_area/login.php','','관리자만 들어올수 있습니다.');
	exit;
}

//echo $num."<br>";
//echo ${"reply_content".$num}."<br>";
//exit;

$content=addslashes(${"reply_content".$num});


$que="update kboard set reply_content='$content' where num='$num'";
//echo $que."<br>";
//exit;
$sql=mysql_query($que) or die(mysql_error());

location_is('qna_list.php','num='.$num.'&page_no='.$page_no.'&f_no='.$f_no.'&s_key='.$s_key.'&s_word='.$s_word.'&multi='.$multi.'&cate='.$cate,'입력하였습니다.');

?>
