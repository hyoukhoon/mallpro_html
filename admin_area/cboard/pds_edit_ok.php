<?session_start();
include "$DOCUMENT_ROOT/db.php";

echo "<meta charset=\"utf-8\">";


if(!$MMS_ID){
	location_is('/admin_area/login.php','','관리자만 들어올수 있습니다.');
	exit;
}

$result=mysql_query("select * from pds where num='$num'") or die(mysql_error());
$rs=mysql_fetch_object($result);


if($mode=="up"){



			for($i=0; $i<3; $i++)
				{
					if($upfile_name[$i])
					{

						$rander=substr(rand(),-2);
						$file_name_addition=$now1.$rander;
						$upfile_detail_name[$i] = strtolower(substr(strrchr($upfile_name[$i],"."),1));
						$upfile_file[$i]="cnt".$file_name_addition."_".$i.".".$upfile_detail_name[$i];



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


		$company1=addslashes($company1);
		$pname=addslashes($pname);
		$model=addslashes($model);



			$sql=mysql_query("update pds set company='$company1',pname='$pname',model='$model',fn_name1='$upfile_name[0]',fn1='$upfile_file[0]' where num='$num'") or die(mysql_error());
			$go_num=mysql_insert_id();


			location_is('pds_list.php','num='.$num.'&page_no='.$page_no.'&f_no='.$f_no.'&s_key='.$s_key.'&s_word='.$s_word.'&multi='.$multi.'&cate='.$cate,'수정하였습니다.');
}

?>
