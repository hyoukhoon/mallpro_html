<?session_start();
include "$DOCUMENT_ROOT/db.php";

if(!$MMS_ID){
	location_is('/admin_area/login.php','','관리자만 들어올수 있습니다.');
	exit;
}




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
						}

					}

				}


		$subject=addslashes($subject);
		$content=addslashes($content);
		$isuse=1;//1이면 사용자페이지 나타내기.

$que="insert into event values ('','$gubun','$title','$target_member','$subject','$MMS_ID','$fdate','$tdate','$upfile_file[0]','$upfile_file[1]','$content','$try_cnt','$winner_cnt','$memo_cnt','$memo_date','$isuse',now(),'$upfile_file[2]','0','$item_id','$istry','$iscart','$html','$html_url','$cnt','$recom','$istail')";


//echo $que."<br>";
//exit;
$sql=mysql_query($que) or die(mysql_error());
$go_num=mysql_insert_id();

location_is('event_list.php','num='.$go_num.'&multi='.$multi,'');

?>
