<?php include $_SERVER['DOCUMENT_ROOT']."/admin_area/inc/admin_top.php";

	$page=$_GET['page'];
	$step=$_GET['step'];
	$f_no=$_GET['f_no'];

	$que="select * from proto where istate='2' and odds1>0 and gameResult='None'";
//	echo $que."<br>";
	$que3="select count(1) from proto where istate='2' and odds1>0 and gameResult='None'";
	$result3 = $mysqli->query($que3) or die("1:".$mysqli->error);
	$rs3 = $result3->fetch_array();
	$total=$rs3[0];
//exit;
	//페이징
	$LIMIT=$_GET['LIMIT']??20;
	$page=$_GET['page']??1;
	$start_page=($page-1)*$LIMIT;
	$end_page=$LIMIT;
	$ps=$LIMIT;//한페이지에 몇개를 표시할지
	$sub_size=10;//아래에 나오는 페이징은 몇개를 할지
	$total_page=ceil($total/$ps);//몇페이지
	$f_no=$_GET['f_no']??1;//첫페이지
	if($f_no<1)$f_no=1;
	$l_no=$f_no+$sub_size-1;//마지막페이지
	if($l_no>$total_page)$l_no=$total_page;
	$n_f_no=$f_no+$sub_size;//다음첫페이지
	$p_f_no=$f_no-$sub_size;//이전첫페이지
	$no=$total-($page-1)*$ps;//번호매기기

//echo "l_no:".$l_no;
	$limit_query="  order by iday asc";
	$last_query=$que.$limit_query;
	$result4 = $mysqli->query($last_query) or die("3:".$mysqli->error);
	while($rs4 = $result4->fetch_object()){
			$rsc[]=$rs4;
	}

?>
<style>
#sidebox { background-color:#F0F0F0; position:absolute; width:120px; top:433px; right:420px; padding: 3px 10px }

</style>
      <!-- **********************************************************************************************************************************************************
      MAIN CONTENT
      *********************************************************************************************************************************************************** -->
      <!--main content start-->
      <section id="main-content">
          <section class="wrapper">
          	<h3><i class="fa fa-angle-right"></i> Basic Table Examples</h3>

              <div class="row mt">
                  <div class="col-md-12">
                      <div class="content-panel">
                          <table class="table table-striped table-advance table-hover">
	                  	  	  <h4><i class="fa fa-angle-right"></i> Advanced Table</h4>
	                  	  	  <hr>
                              <thead>
                              <tr>
								<th><i class="fa fa-bullhorn"></i> iDAY</th>
                                  <th><i class="fa fa-bullhorn"></i> HOME</th>
								  <th><i class="fa fa-bullhorn"></i> AWAY</th>
                                  <th colspan="3"><i class="fa fa-bullhorn"></i> 배당</th>
                              </tr>
                              </thead>
                              <tbody>
<?php
foreach($rsc as $p){
?>
                              <tr id="tr<?=$p->gubun?>">
							  		<td><?=$p->iday?></td>
                                  <td><?=$p->home?><?if($p->handi==2){?><font color="red">(H<?if($p->handi1>0){?>+<?}?><?=$p->handi1?>)</font><?}else if($p->handi==9){?><font color="blue">(U/O<?=$p->handi1?>)</font><?}?></td>
								  <td><?=$p->away?></td>
								  <td>승(<?=$p->odds1?>)<input type="checkbox" inum="<?=$p->num?>" class="chkbx" title="<?=$p->gameTitle?>" islip="<?=$p->islip?>" id="checkId[]" name="isCheck[<?=$p->islip?>]" value="1"></td>
								  <td><?if($p->odds2>0){?>무(<?=$p->odds2?>)<input type="checkbox" inum="<?=$p->num?>" class="chkbx" title="<?=$p->gameTitle?>" islip="<?=$p->islip?>" id="checkId[]" name="isCheck[<?=$p->islip?>]" value="0"><?}?></td>
								  <td>패(<?=$p->odds3?>)<input type="checkbox" inum="<?=$p->num?>" class="chkbx" title="<?=$p->gameTitle?>" islip="<?=$p->islip?>" id="checkId[]" name="isCheck[<?=$p->islip?>]" value="-1"></td>
                              </tr>
<?}?>  

                              </tbody>
                          </table>
                      </div><!-- /content-panel -->
                  </div><!-- /col-md-12 -->
              </div><!-- /row -->

		</section><! --/wrapper -->
      </section><!-- /MAIN CONTENT -->

      <!--main content end-->
      <!--footer start-->
      <footer class="site-footer">
          <div class="text-center">
              <a href="basic_table.html#" class="go-top">
                  <i class="fa fa-angle-up"></i>
              </a>
          </div>
      </footer>
      <!--footer end-->
  </section>


<script>

$(".chkbx").click(function() {

		var n=$(this).attr("islip");
		var tt=$(this).attr("title");
		var num=$(this).attr("inum");
		var val=$(this).val();


		if($(this).is(":checked")==true){

			$('input[type="checkbox"][name="isCheck['+n+']"]').prop('checked', false);
            $(this).prop('checked', true);

				$('input:checkbox[class="chkbx"]').each(function() {
					//console.log($(this).is(":checked"));
					
					if($(this).attr("title")==tt && $(this).attr("islip")!= n){
						$(this).prop('disabled', 'disabled');
					}

				});


		}else{
//			console.log("unchecked");
			$('input:checkbox[class="chkbx"]').each(function() {
				if($(this).attr("title")==tt){
						$(this).prop('disabled', false);
					}
			});

			$('input[type="checkbox"][name="isCheck['+n+']"]').prop('checked', false);
		}

		var cnt=$("input[class='chkbx']:checked").length;

		if(cnt>=2){

			var checkArray=new Array();
			var numArray=new Array();
			var k=0;
			$('input:checkbox[class="chkbx"]').each(function() {
				if($(this).is(":checked")==false){
					$(this).prop('disabled', 'disabled');
				}else{
					checkArray[k]=$(this).attr("inum");
					numArray[k]=$(this).val();
					k++;
				}
			});

			var jsonCheck = JSON.stringify(checkArray);//json으로 바꿈
			var jsonNum = JSON.stringify(numArray);//json으로 바꿈

			window.open('betting.php?jsonCheck='+jsonCheck+'&jsonNum='+jsonNum,'lg','width:600px,height:400px,scrollbars=yes');
			
		}else{

			$('input:checkbox[class="chkbx"]').each(function() {
					$(this).prop('disabled', false);
			});

			$('input:checkbox[class="chkbx"]').each(function() {

				if($(this).is(":checked")==true ){
					var tt2=$(this).attr("title");
					var n2=$(this).attr("islip");
					$('input:checkbox[class="chkbx"]').each(function() {
					
						if($(this).attr("title")==tt2 && $(this).attr("islip")!= n2){
							$(this).prop('disabled', 'disabled');
						}

					});
				}

			});

		}

		

});


</script>
    <!-- js placed at the end of the document so the pages load faster -->

    <script src="/admin_area/assets/js/bootstrap.min.js"></script>
    <script class="include" type="text/javascript" src="/admin_area/assets/js/jquery.dcjqaccordion.2.7.js"></script>
    <script src="/admin_area/assets/js/jquery.scrollTo.min.js"></script>
    <script src="/admin_area/assets/js/jquery.nicescroll.js" type="text/javascript"></script>


    <!--common script for all pages-->
    <script src="/admin_area/assets/js/common-scripts.js"></script>


  </body>
</html>
