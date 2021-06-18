<?include "$DOCUMENT_ROOT/admin_page/inc/top.php";
$buffer_num=substr(rand(),0,10);
?>

<meta http-equiv="content-type" content="text/html; charset=utf-8">
<script type="text/javascript" src="../../se2/js/HuskyEZCreator.js" charset="utf-8"></script>

			<table width="100%" border="0" cellpadding="0" cellspacing="0">
				<tr><td class="title">데이타 등록</td></tr>
				<tr><td style="height:10px;"></td></tr>
			</table>



			<table width="100%" border="0" cellpadding="0" cellspacing="1" class="tab_01" style="table-layout:fixed">
<form action="pds_write_ok.php"  method="post" name="f" enctype="multipart/form-data">
				<input type=hidden name=mode value="up">
				<input type=hidden name=multi value="<?=$multi?>">
				<input type=hidden name=num value="<?=$num?>">
				<input type=hidden name=buffer_num value="<?=$buffer_num?>">

				<tr>
					<td class="th_01" width="10%">회사명</td>
					<td class="td_02"><input type="text" name="company1" size="50"></td>
				</tr>
				<tr>
					<td class="th_01" width="10%">제품명</td>
					<td class="td_02"><input type="text" name="pname" size="50"></td>
				</tr>
				<tr>
					<td class="th_01" width="10%">모델명</td>
					<td class="td_02"><input type="text" name="model" size="50"></td>
				</tr>
				<tr>
					<td class="th_01" width="10%">첨부파일</td>
					<td class="td_02"><input type="file" name="upfile[0]" size="50">[2M미만]</td>
				</tr>

			</table>

			<br><br>

			<input type="image" src="/admin_page/img/btn_insert.gif"  style=cursor:hand>
</form>
		</td>
	</tr>
</table>

</body>
</html>
