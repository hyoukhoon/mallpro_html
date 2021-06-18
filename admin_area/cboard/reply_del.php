<?session_start();
include "$DOCUMENT_ROOT/db.php";
if(!$MMS_ID){
	location_is('/admin_area/login.php','','관리자만 들어올수 있습니다.');
	exit;
}

echo "<meta http-equiv=\"Content-Type\" content=\"text/html; charset=utf-8\" />";

	$result2=mysql_query("select count(1) from cboard_memo_memo where pa_num='$num'") or die(mysql_error());
	$rs2=mysql_fetch_array($result2);

	if($rs2[0]){
		$sql=mysql_query("update cboard_memo set m_content='삭제된 글입니다.' where num='$num'") or die(mysql_error());
			location_is('','','댓글이 있으므로 내용만 삭제했습니다. 양해 부탁드립니다.');
			exit;
	}else{
		$sql5=mysql_query("delete from cboard_memo where num='$num'") or die(mysql_error());
	}

	if($sql5){
		$sql2=mysql_query("update cboard set memo_cnt=memo_cnt-1 where num='$pa_num'") or die(mysql_error());
	}

			location_is('reply_list.php','num='.$num.'&page_no='.$page_no.'&f_no='.$f_no.'&s_key='.$s_key.'&s_word='.$s_word.'&multi='.$multi,'');


?>
