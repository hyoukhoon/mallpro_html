<?session_start();
include "$DOCUMENT_ROOT/db.php";
if(!$MMS_ID){
	location_is('/admin_area/login.php','','관리자만 들어올수 있습니다.');
	exit;
}
		$result=mysql_query("select * from event where num='$num'") or die(mysql_error());
		$rs=mysql_fetch_object($result);

		if($rs->num){

			

				if($rs->fn1){
						$del_file="$DOCUMENT_ROOT/board/data/".$rs->fn1;
						unlink($del_file);
				}

				if($rs->fn2){
						$del_file="$DOCUMENT_ROOT/board/data/".$rs->fn2;
						unlink($del_file);
				}

				if($rs->fn3){
						$del_file="$DOCUMENT_ROOT/board/data/".$rs->fn3;
						unlink($del_file);
				}

			

			$sql=mysql_query("delete from event where num='$num'") or die(mysql_error());

			location_is('event_list.php','num='.$num.'&page_no='.$page_no.'&f_no='.$f_no.'&s_key='.$s_key.'&s_word='.$s_word.'&multi='.$multi,'삭제하였습니다.');
		}else{
			location_is('event_view.php','num='.$num.'&page_no='.$page_no.'&f_no='.$f_no.'&s_key='.$s_key.'&s_word='.$s_word.'&multi='.$multi,'삭제할 대상이 존재 하지 않습니다..');
		}


?>
