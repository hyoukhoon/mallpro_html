<?php session_start();
include $_SERVER["DOCUMENT_ROOT"]."/inc/dbcon.php";
$reg_date=$_GET['reg_date'];
?>
<!doctype html>
<html>
<head>
<meta charset="utf-8">
<title>Mediapic Back-office</title>
<link href="/admin_page/css/dcg_tmall.css" rel="stylesheet" type="text/css" />
<script type="text/javascript" src="/asset/js/jquery-1.11.3.min.js"></script>

</head>
<div class="list_table_list01">
<table border="1" style="table-layout:fixed; word-break:break-all;">
						<?
							$que="select * 
							from ptest  where reg_date='$reg_date'";
							$result = $mysqli->query($que) or die("1:".$mysqli->error);
							while($rs = $result->fetch_object()){
?>
							<tr>
								<td width="100">
									<?=$rs->sname?>
								</td>
								<td width="100">
									<?=$rs->pname?>(<?=$rs->pname_ch?>)
								</td>
								<td width="100" style="text-align:right">
									<?echo number_format($rs->price);?>원
								</td>
								<td width="100">
									<?
										$que2="select * 
										from ptest_cate  where pnum='$rs->num'";
										$result2 = $mysqli->query($que2) or die("2:".$mysqli->error);
										while($rs2 = $result2->fetch_object()){
									?>
										*<?=$rs2->cate1?> > <?=$rs2->cate2?><br>
									<?}?>
								</td>
								<td width="100">
									<?
										$que3="select * 
										from ptest_color  where pnum='$rs->num'";
										$result3 = $mysqli->query($que3) or die("3:".$mysqli->error);
										while($rs3 = $result3->fetch_object()){
									?>
										*<?=$rs3->color?>, <?=$rs3->color_en?><br>
									<?}?>
								</td>
								<td width="100">
									<?
										$que4="select * 
										from ptest_mate where pnum='$rs->num'";
										$result4 = $mysqli->query($que4) or die("4:".$mysqli->error);
										while($rs4 = $result4->fetch_object()){
									?>
										*<?echo material_is('ko',$rs4->MATR_CODE);?>(<?=$rs4->PERCENTAGE?>%)<br>
									<?}?>
								</td>
								<td width="400">
									<?
										$que5="select * 
										from ptest_file where pnum='$rs->num' order by file_name asc";
										$result5 = $mysqli->query($que5) or die("5:".$mysqli->error);
										while($rs5 = $result5->fetch_object()){
									?>
										*<?echo "/".$rs5->path."/".$rs5->file_name;?><br>
									<?}?>
								</td>
								<td>
									<?echo stripslashes($rs->content);?>
								</td>
								<td>
									<?echo stripslashes($rs->content_ch);?>
								</td>
							</tr>
<?}?>
						</table>
</div>