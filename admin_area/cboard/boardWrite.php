<?php include $_SERVER['DOCUMENT_ROOT']."/admin_area/inc/admin_top.php";

$multi=$_POST['multi']?$_POST['multi']:$_GET['multi'];

if(!$multi){
	location_is('','','게시판을 선택하세요');
	exit;
}

?>
<script type="text/javascript" src="../../se2/js/HuskyEZCreator.js" charset="utf-8"></script>

<script>

function submitContents(elClickedObj) {
	oEditors.getById["ir1"].exec("UPDATE_CONTENTS_FIELD", []);	// 에디터의 내용이 textarea에 적용됩니다.
	
	// 에디터의 내용에 대한 값 검증은 이곳에서 document.getElementById("ir1").value를 이용해서 처리하면 됩니다.


	if(!elClickedObj.subject.value){
		alert('제목을 입력하세요.');
      		elClickedObj.subject.focus();
      		return false;
	}


	if(!elClickedObj.ir1.value){
		alert('내용을 입력하세요.');
      		elClickedObj.ir1.focus();
      		return false;
	}

		return true;
	try {
		elClickedObj.form.submit();
	} catch(e) {}
}

</script>

      <!-- **********************************************************************************************************************************************************
      MAIN CONTENT
      *********************************************************************************************************************************************************** -->
      <!--main content start-->
      <section id="main-content">
          <section class="wrapper">
          	<h3><i class="fa fa-angle-right"></i> <?echo comm_title_is($multi);?> 글쓰기</h3>

				<div class="row mt">
			  		<div class="col-lg-12">
                      <div class="content-panel">

				<table class="table table-bordered table-striped table-condensed">
<form action="boardWriteOk.php"  name="f" method="post" onsubmit="return submitContents(this)" enctype="multipart/form-data">
				<input type=hidden name=mode value="up">
				<input type=hidden name=multi value="<?=$multi?>">
				<input type=hidden name=num value="<?=$num?>">
				<input type=hidden name=buffer_num value="<?=$buffer_num?>">
				<input type=hidden name=list value="<?=$list?>">
				<input type=hidden name=level value="<?=$level?>">
				<input type=hidden name=step value="<?=$step?>">
				<input type=hidden name=secret value="<?=$rs->secret?>">
				<input type=hidden name=passwd value="<?=$rs->passwd?>">
				<tbody>
<?if($multi=="faq"){
$result7 = $mysqli->query("select cate from cboard_admin where multi='faq'");
$rs7 = $result7->fetch_object();
$cate=explode("|",$rs7->cate);
?>
				<tr>
					<td class="th_01" width="10%">분류</td>
					<td class="td_02">
						<select class="form-contro" name="cate" >
							<option value="">선택</option>
							<?php
							foreach($cate as $ct){
							?>
								<option value="<?=$ct?>"><?=$ct?></option>
							<?}?>
						</select>
					</td>
				</tr>
<?}?>

				<tr>
					<td class="th_01" width="10%">제목</td>
					<td class="td_02"><input type="text" name="subject" size="50" value="<?=$subject?>"></td>
				</tr>
				<tr>
					<td class="th_01" width="10%">등록일</td>
					<td class="td_02"><input type="text" name="reg_date" size="50" value="<?echo $now4;?>"></td>
				</tr>
				<tr>
					<td class="th_01">표시여부</td>
					<td class="td_02"><input type=radio name=isdisp value="0" >숨김&nbsp;<input type=radio name=isdisp value="1" checked>표시</td>
				</tr>
				<tr>
					<td class="th_01">메인글</td>
					<td class="td_02"><input type=radio name=notice value="0" checked>일반글&nbsp;<input type=radio name=notice value="1">메인글</td>
				</tr>
				
				<!-- <tr>
					<td class="th_01" width="10%">메인내용</td>
					<td class="td_02"><textarea name="main_content" rows="7" cols="80"></textarea></td>
				</tr>
				-->
				<?if($multi=="stream"){?>
				<tr>
					<td class="th_01" width="10%">동영상</td>
					<td class="td_02"><textarea name="stream" rows="7" cols="80"></textarea></td>
				</tr>
				<?}?>
				<tr>
					<td class="th_01" width="10%">내용</td>
					<td class="td_02" height="680" style="word-break:break-all;"><textarea name="ir1" id="ir1" style="width:740px; height:680px; display:none;"><?echo $content;?></textarea></td>
				</tr>
				<tr>
					<td class="th_01" width="10%">대표이미지</td>
					<td class="td_02"><input type="file" name="upfile" size="50"></td>
				</tr>
				</tbody>
			</table>
			<div style="text-align:center;">
				<button type="input"  class="btn btn-primary">등록</button>
			</div>

	                  </div><!-- /content-panel -->
               </div><!-- /col-lg-4 -->			
		  	</div><!-- /row -->


		</section><!--wrapper -->
      </section><!-- /MAIN CONTENT -->

      <!--main content end-->
      <!--footer start-->
      <footer class="site-footer">
          <div class="text-center">
              2018 - propick
              <a href="responsive_table.html#" class="go-top">
                  <i class="fa fa-angle-up"></i>
              </a>
          </div>
      </footer>
      <!--footer end-->
  </section>
<script type="text/javascript">
var oEditors = [];
nhn.husky.EZCreator.createInIFrame({
oAppRef: oEditors,
elPlaceHolder: "ir1",
sSkinURI: "../../se2/SmartEditor2Skin.html",
fCreator: "createSEditor2"
});
</script>
    <!-- js placed at the end of the document so the pages load faster -->
    <script src="assets/js/jquery.js"></script>
    <script src="assets/js/bootstrap.min.js"></script>
    <script class="include" type="text/javascript" src="assets/js/jquery.dcjqaccordion.2.7.js"></script>
    <script src="assets/js/jquery.scrollTo.min.js"></script>
    <script src="assets/js/jquery.nicescroll.js" type="text/javascript"></script>


    <!--common script for all pages-->
    <script src="assets/js/common-scripts.js"></script>

    <!--script for this page-->

  </body>
</html>
