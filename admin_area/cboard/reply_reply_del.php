<?session_start();
include "$DOCUMENT_ROOT/db.php";
if(!$MMS_ID){
	location_is('/admin_area/login.php','','관리자만 들어올수 있습니다.');
	exit;
}

echo "<meta http-equiv=\"Content-Type\" content=\"text/html; charset=utf-8\" />";

		$sql5=mysql_query("delete from cboard_memo_memo where num='$num'") or die(mysql_error());

	if($sql5){
		$sql2=mysql_query("update cboard set memo_cnt=memo_cnt-1 where num='$pa_pa_num'") or die(mysql_error());
	}

			location_is('reply_reply_list.php','num='.$num.'&page_no='.$page_no.'&f_no='.$f_no.'&s_key='.$s_key.'&s_word='.$s_word.'&multi='.$multi,'');


?>
