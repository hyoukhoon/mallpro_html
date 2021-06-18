<?session_start();
include "$DOCUMENT_ROOT/db.php";

echo "<meta charset=\"utf-8\">";


if(!$MMS_ID){
	location_is('/admin_area/login.php','','관리자만 들어올수 있습니다.');
	exit;
}

$result=mysql_query("select * from cboard where num='$num'") or die(mysql_error());
$rs=mysql_fetch_object($result);

$content=$ir1;
$file_list=$rs->file_list;

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

preg_match_all("@[a-z0-9/_]{1,}\.(jpg|gif|bmp|png)@i", $content, $match); 
//print_r($match); 

//echo $content."<br>";


for($k=0;$k<sizeof($match[0]);$k++){
			if(!eregi("/upload/",$match[0][$k])){
				//echo $match[0][$k]."<br>";

						$wid=0;
						$info="";
						$chg_img="";
						$chg_img2="";
						$info = GetImageSize("../../se2/upload/".$match[0][$k]);

						//echo $info[0]."<br>";
						if($info[0]>650){

								$chg_img="title=\"".$match[0][$k]."\"";
								$chg_img2="title=\"".$match[0][$k]."\" width=650";
								$content=str_replace($chg_img,$chg_img2,$content);

								$chg_img=addslashes("title=\"".$match[0][$k]."\"");
								$chg_img2=addslashes("title=\"".$match[0][$k]."\" width=650");
								$content=str_replace($chg_img,$chg_img2,$content);

								$chg_img="title=".$match[0][$k]."";
								$chg_img2="title=".$match[0][$k]." width=650";
								$content=str_replace($chg_img,$chg_img2,$content);

						}
						else{
							$wid=$info[0];
						}



				$is.=$match[0][$k]."||";
			}
		}

//		echo $file_list."<br>".$is."<br>";
//		exit;


		$fl=explode("||",$file_list);
		for($f=0;$f<sizeof($fl);$f++){
				
				if(!eregi($fl[$f],$is)){
					$del_file="$DOCUMENT_ROOT/se2/upload/".$fl[$f];
					unlink($del_file);
				}
		}


		$subject=addslashes($subject);
		$content=addslashes($content);
		$link1=addslashes($link1);
		$link2=addslashes($link2);
		$main_content=addslashes($main_content);
		$stream=addslashes($stream);

		$result01=mysql_query("select * from admin where admin_id='$admin_id'") or die(mysql_error());
		$rs01=mysql_fetch_object($result01);

			$sql=mysql_query("update cboard set subject='$subject',content='$content',notice='$notice',isdisp='$isdisp',file_list='$is' where num='$num'") or die(mysql_error());
			$go_num=mysql_insert_id();


			location_is('view.php','num='.$num.'&page_no='.$page_no.'&f_no='.$f_no.'&s_key='.$s_key.'&s_word='.$s_word.'&multi='.$multi.'&gubun='.$gubun,'수정하였습니다.');
}

?>
