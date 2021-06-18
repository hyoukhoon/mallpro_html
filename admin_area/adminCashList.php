<?php include $_SERVER['DOCUMENT_ROOT']."/admin_area/inc/admin_top.php";

	$page=$_GET['page'];
	$step=$_GET['step'];
	$f_no=$_GET['f_no'];
	$startDate=$_GET['startDate'];
	$endDate=$_GET['endDate'];

	if($startDate){
		$where.=" and regDate>='".$startDate."'";
	}

	if($endDate){
		$where.=" and regDate<'".$endDate." 23:59:59'";
	}

	$que="select * from adminCashList where 1=1 $where";
//	echo $que."<br>";
	$que3="select count(1) from adminCashList where 1=1 $where";
	$result3 = $mysqli->query($que3) or die("1:".$mysqli->error);
	$rs3 = $result3->fetch_array();
	$total=$rs3[0];

	$que3="select sum(income) from adminCashList where 1=1 $where";
	$result3 = $mysqli->query($que3) or die("1:".$mysqli->error);
	$rs3 = $result3->fetch_array();
	$amt=$rs3[0];
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

	$limit_query=" order by num desc limit $start_page, $end_page";
	$last_query=$que.$limit_query;
	echo "LQ:".$last_query."<br>";
	$result4 = $mysqli->query($last_query) or die("3:".$mysqli->error);
	while($rs4 = $result4->fetch_object()){
			$rsc[]=$rs4;
	}

?>
<link rel="stylesheet" href="//code.jquery.com/ui/1.11.4/themes/smoothness/jquery-ui.css">
<script src="//code.jquery.com/jquery.min.js"></script>
<script src="//code.jquery.com/ui/1.11.4/jquery-ui.min.js"></script>
<script>
$(function() {
  $( "#datepicker1,#datepicker2" ).datepicker({
    dateFormat: 'yy-mm-dd',
    prevText: '이전 달',
    nextText: '다음 달',
    monthNames: ['1월','2월','3월','4월','5월','6월','7월','8월','9월','10월','11월','12월'],
    monthNamesShort: ['1월','2월','3월','4월','5월','6월','7월','8월','9월','10월','11월','12월'],
    dayNames: ['일','월','화','수','목','금','토'],
    dayNamesShort: ['일','월','화','수','목','금','토'],
    dayNamesMin: ['일','월','화','수','목','금','토'],
    showMonthAfterYear: true,
    changeMonth: true,
    changeYear: true,
    yearSuffix: '년'
  });
});
</script>
      <!-- **********************************************************************************************************************************************************
      MAIN CONTENT
      *********************************************************************************************************************************************************** -->
      <!--main content start-->
      <section id="main-content">
          <section class="wrapper">
          	<h3><i class="fa fa-angle-right"></i> 관리자캐쉬 : 총 <?echo number_format($amt);?></h3>
		  		<div class="row mt">
			  		<div class="col-lg-12">
                      <div class="content-panel">

                      <h4><i class="fa fa-angle-right"></i> 리스트</h4>

<div class="row mt">
          		<div class="col-lg-12">
          			<div class="form-panel">
<form class="form-inline" role="form" name="sform" method="get" action="<?=$_SERVER['PHP_SELF']?>">
							<div class="input_area">
								<input type="text" name="startDate" id="datepicker1"  class="form-control" style="width:120px;"  value="<?=$startDate?>" />
									 ~ 
								<input type="text" name="endDate" id='datepicker2'   class="form-control" style="width:120px;"  value="<?=$endDate?>" />
								<button type="submit" class="btn btn-theme">검색</button>
							</div>
							
</form>
</div>
</div>
</div>
                          <section id="unseen">
                            <table class="table table-bordered table-striped table-condensed">
                              <thead>
                              <tr>
                                  <th>번호</th>
                                  <th>수입</th>
                                  <th>구분</th>
                                  <th>날짜</th>

                              </tr>
                              </thead>
                              <tbody>
<?php
foreach($rsc as $p){
?>
                              <tr>
                                  <td><?=$no?></td>
                                  <td><?echo number_format($p->income);?></td>
                                  <td><?=$p->gubun?></td>
                                  <td><?=$p->regDate?></td>
                              </tr>
<?
$no--;
}?>                              
                              
                              </tbody>
                          </table>
                          </section>
                  </div><!-- /content-panel -->
               </div><!-- /col-lg-4 -->			
		  	</div><!-- /row -->
		  	
		  	<div class="row mt">
              <div class="col-lg-12">

<!-- 페이징 -->
					<nav aria-label="Page navigation example">
					  <ul class="pagination">
						<li class="page-item">
						  <a class="page-link" href="<?=$PHP_SELF?>?endDate=<?=$endDate?>&startDate=<?=$startDate?>&page=<?=$p_f_no?>&f_no=<?=$p_f_no?>" aria-label="Previous">
							<span aria-hidden="true">&laquo;</span>
							<span class="sr-only">Previous</span>
						  </a>
						</li>
						<? for($i=$f_no;$i<=$l_no;$i++){?>
                                <?if($i==$page){?>
									<li class="page-item active"><a class="page-link" href="#"><?=$i?> <span class="sr-only">(current)</span></a></li>
								<?} else {?>
									<li class="page-item"><a class="page-link" href="<?=$PHP_SELF?>?endDate=<?=$endDate?>&startDate=<?=$startDate?>&page=<?=$i?>&f_no=<?=$f_no?>&multi=<?=$multi?>&sort=<?=$sort?>&s_key=<?=$s_key?>"><?=$i?></a></li>
								<?}?>
                        <?}?>
						<li class="page-item">
						  <a class="page-link" href="<?=$PHP_SELF?>?endDate=<?=$endDate?>&startDate=<?=$startDate?>&page=<?=$n_f_no?>&f_no=<?=$n_f_no?>" aria-label="Next">
							<span aria-hidden="true">&raquo;</span>
							<span class="sr-only">Next</span>
						  </a>
						</li>
					  </ul>
					</nav>
<!-- 페이징 -->

                  </div><!-- /col-lg-12 -->
              </div><!-- /row -->

		</section><!--wrapper -->
      </section><!-- /MAIN CONTENT -->

      <!--main content end-->
      <!--footer start-->
      <footer class="site-footer">
          <div class="text-center">
              2014 - Alvarez.is
              <a href="responsive_table.html#" class="go-top">
                  <i class="fa fa-angle-up"></i>
              </a>
          </div>
      </footer>
      <!--footer end-->
  </section>

    <!-- js placed at the end of the document so the pages load faster -->

    <script src="assets/js/bootstrap.min.js"></script>
    <script class="include" type="text/javascript" src="assets/js/jquery.dcjqaccordion.2.7.js"></script>
    <script src="assets/js/jquery.scrollTo.min.js"></script>
    <script src="assets/js/jquery.nicescroll.js" type="text/javascript"></script>


    <!--common script for all pages-->
    <script src="assets/js/common-scripts.js"></script>

    <!--script for this page-->
    

  </body>
</html>
