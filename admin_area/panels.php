<?php include $_SERVER['DOCUMENT_ROOT']."/admin_area/inc/admin_top.php";


	$page=$_GET['page'];
	$step=$_GET['step'];
	$f_no=$_GET['f_no'];

	$que="select * from pick_table where istate='1'";
//	echo $que."<br>";
	$que3="select count(1) from pick_table where istate='1'";
	$result3 = $mysqli->query($que3) or die("1:".$mysqli->error);
	$rs3 = $result3->fetch_array();
	$total=$rs3[0]/2;
//	echo $total."<br>";
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
	$limit_query=" group by setNum  order by num desc";
	$last_query=$que.$limit_query;
	$result = $mysqli->query($last_query) or die("3:".$mysqli->error);
	while($rs = $result->fetch_object()){
	
		$rsc[]=$rs;
		
			
	}
?>
      
      <!-- **********************************************************************************************************************************************************
      MAIN CONTENT
      *********************************************************************************************************************************************************** -->
      <!--main content start-->
      <section id="main-content">
          <section class="wrapper site-min-height">
          	<h3><i class="fa fa-angle-right"></i> Discover Our Panels</h3>
          	<div class="row mt">
          		<div class="col-lg-12">
          		
					<! -- 1st ROW OF PANELS -->
					<div class="row">

						
<?php
foreach($rsc as $p){

	$gameRound=$p->gameRound;
	if($p->handi==9){
		$value1=7;
		$value3=8;
	}else{
		$value1=1;
		$value2=0;
		$value3=-1;
	}

?>
						<div class="col-lg-4 col-md-4 col-sm-4 mb">
							<!-- WHITE PANEL - TOP USER -->
							<div class="white-panel pn">
								<div class="white-header">
									<h5>Pickster</h5>
								</div>
								<p><img src="assets/img/ui-zac.jpg" class="img-circle" width="50"></p>
								<p><b><?=$p->uid?></b></p>
									<div class="row">
		<?php
		$result2 = $mysqli->query("select * from pick_table a,proto b where a.pnum=b.num and a.setNum='".$p->setNum."'") or die("3:".$mysqli->error);
		while($rs2 = $result2->fetch_object()){
							?>
										<div class="col-md-6">
											<p class="small mt" style="font-size:12px;color:black;"><?echo $rs2->home." : ".$rs2->away;?></p>
											<p style="color:blue;"><?php echo gameResult_is($rs2->gamePreview);?></p>
										</div>
		<?}?>

									</div>
							</div>
						</div><!-- /col-md-4 -->
						
<?}?>





					</div><! --/END 1ST ROW OF PANELS -->

					


					
          		</div>
          	</div>
			
		</section><! --/wrapper -->
      </section><!-- /MAIN CONTENT -->

      <!--main content end-->
      <!--footer start-->
      <footer class="site-footer">
          <div class="text-center">
              2014 - Alvarez.is
              <a href="panels.html#" class="go-top">
                  <i class="fa fa-angle-up"></i>
              </a>
          </div>
      </footer>
      <!--footer end-->
  </section>

    <!-- js placed at the end of the document so the pages load faster -->
    <script src="assets/js/jquery.js"></script>
    <script src="assets/js/bootstrap.min.js"></script>
    <script class="include" type="text/javascript" src="assets/js/jquery.dcjqaccordion.2.7.js"></script>
    <script src="assets/js/jquery.scrollTo.min.js"></script>
    <script src="assets/js/jquery.nicescroll.js" type="text/javascript"></script>
    <script src="assets/js/jquery.sparkline.js"></script>

    <!--common script for all pages-->
    <script src="assets/js/common-scripts.js"></script>

    <!--script for this page-->
    <script src="assets/js/sparkline-chart.js"></script>    
    
    
  <script>
      //custom select box

      $(function(){
          $('select.styled').customSelect();
      });

  </script>

  </body>
</html>
