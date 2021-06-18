<?session_start();
include "$DOCUMENT_ROOT/db.php";

if(!$MMS_ID){
	location_is('/admin_area/login.php','','관리자만 들어올수 있습니다.');
	exit;
}

$result=mysql_query("select * from event where num='$num'") or die(mysql_error());
$rs=mysql_fetch_object($result);

$file_name_addition=$now1.$rander;

			for($i=0; $i<3; $i++)
				{
					if($upfile_name[$i])
					{
						$upfile_detail_name[$i] = strtolower(substr(strrchr($upfile_name[$i],"."),1));
						$upfile_file[$i]="ban".$file_name_addition."_".$i.".".$upfile_detail_name[$i];



						if(eregi("htm",$upfile_detail_name[$i]) ||
						eregi("html",$upfile_detail_name[$i]) ||
						eregi("php",$upfile_detail_name[$i]) ||
						eregi("inc",$upfile_detail_name[$i]) ||
						!$upfile_name[$i])
						{
							// 업로드 금지, 아무것도 안한다.
							$false_file=$false_file+1;
							location_is('','',"잘못된 화일이 있거나 화일이 없습니다. 다시 확인해 주십시오");
							exit;
						}
						else
						{
							// file 저장하기
							$upload_url[$i]="$DOCUMENT_ROOT/board/data/".$upfile_file[$i];
							if(!move_uploaded_file($upfile[$i],$upload_url[$i]))
							{
								$false_file=$false_file+1;
							}
							else
							{
								$insert_upfile_name.=$upfile_name[$i]."●";
								$insert_upfile_file.=$upfile_file[$i]."●";
								$true_file=$true_file+1;
							}

							$del_file1="$DOCUMENT_ROOT/board/data/".$fn[$i];

							if($fn[$i]){
							unlink($del_file1);
							}
						}
					}
					else
					{
						if($upfile_check[$i]){
							$upfile_file[$i]="";
							$del_file1="$DOCUMENT_ROOT/board/data/".$fn[$i];

							if($fn[$i]){
							unlink($del_file1);
							}
						}else{
							$upfile_file[$i]=$fn[$i];
							$upfile_name[$i]=$fn_name[$i];
						}

					}

				}



		$subject=addslashes($subject);
		$content=addslashes($content);
		$winner=addslashes($winner);


			$sql=mysql_query("update event set subject='$subject',content='$content',fn1='$upfile_file[0]',fn2='$upfile_file[1]',fn3='$upfile_file[2]',f_date='$fdate',t_date='$tdate',iswinner='$iswinner',winner='$winner' where num='$num'") or die(mysql_error());
			$go_num=mysql_insert_id();


			location_is('event_view.php','num='.$num.'&page_no='.$page_no.'&f_no='.$f_no.'&s_key='.$s_key.'&s_word='.$s_word.'&multi='.$multi.'&cate='.$cate,'수정하였습니다.');


?>
