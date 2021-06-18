<?php include $_SERVER['DOCUMENT_ROOT']."/admin_area/inc/admin_top.php";

	$page=$_GET['page'];
	$step=$_GET['step'];
	$f_no=$_GET['f_no'];
	$memberGubun=$_GET['memberGubun'];

	if($memberGubun){
		$where=" and memberGubun='$memberGubun'";
	}

	
	$que3="select count(1) from taobao where 1=1 $where";
	$result3 = $mysqli->query($que3) or die("1:".$mysqli->error);
	$rs3 = $result3->fetch_array();
	$total=$rs3[0];
//	echo $total."<br>";
//exit;
	//페이징

	$LIMIT=$_GET['LIMIT']??50;
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

	$que="select * from taobao where 1=1 $where";
	$limit_query=" order by num desc limit $start_page, $end_page";
	$last_query=$que.$limit_query;
	echo $last_query;
	$result = $mysqli->query($last_query) or die("3:".$mysqli->error);
	while($rs = $result->fetch_object()){
	
		$rsc[]=$rs;
		
			
	}

	$que3="select count(1) from taobao where left(regDate,10)='$now2' ";
	$result3 = $mysqli->query($que3) or die("1:".$mysqli->error);
	$rs3 = $result3->fetch_array();
	$totalToday=$rs3[0];

?>
      
      <!-- **********************************************************************************************************************************************************
      MAIN CONTENT
      *********************************************************************************************************************************************************** -->
      <!--main content start-->
<style>
	th{
	text-align:center;
}
td{
	text-align:center;
	font-size:16px;
}
</style>
      <section id="main-content">
          <section class="wrapper">
          	<h3><i class="fa fa-angle-right"></i> 타오바오 다운 목록</h3>
		  		<div class="row mt">
			  		<div class="col-lg-12">
                      <div class="content-panel" style="padding:20px;">
                      <h4><i class="fa fa-angle-right"></i>전체수집수 : <?echo number_format($total);?>개 / 오늘수집수 : <?echo number_format($totalToday);?>개 </h4>

                            <table class="table table-bordered table-striped table-condensed">
                              <thead>
                              <tr style="font-size:16px;">
								<th width="15%">아이디</th>
                                  <th width="40%">상품명</th>
                                  <th width="30%">URL</th>
								  <th width="15%">등록일</th>
                              </tr>
                              </thead>
                              <tbody>
<?php
foreach($rsc as $p){

?>

                              <tr>
                                  <td><?=$p->uid?></td>
								  <td><?echo $p->subject;?></td>
                                  <td><a href="<?echo $p->url;?>" target="_blank"><?echo $p->url;?></a></td>
								  <td><?=$p->regDate?></td>

                              </tr>
							  
<?}?>                              
                              
                              </tbody>
                          </table>

                  </div><!-- /content-panel -->
               </div><!-- /col-lg-4 -->			
		  	</div><!-- /row -->
		  	
		  	<div class="row mt">
              <div class="col-lg-12">

<!-- 페이징 -->
					<nav aria-label="Page navigation example">
					  <ul class="pagination">
						<li class="page-item">
						  <a class="page-link" href="<?=$PHP_SELF?>?step=<?=$step?>&page=<?=$p_f_no?>&f_no=<?=$p_f_no?>&memberGubun=<?=$memberGubun?>" aria-label="Previous">
							<span aria-hidden="true">&laquo;</span>
							<span class="sr-only">Previous</span>
						  </a>
						</li>
						<? for($i=$f_no;$i<=$l_no;$i++){?>
                                <?if($i==$page){?>
									<li class="page-item active"><a class="page-link" href="#"><?=$i?> <span class="sr-only">(current)</span></a></li>
								<?} else {?>
									<li class="page-item"><a class="page-link" href="<?=$PHP_SELF?>?step=<?=$step?>&page=<?=$i?>&f_no=<?=$f_no?>&memberGubun=<?=$memberGubun?>&sort=<?=$sort?>&s_key=<?=$s_key?>"><?=$i?></a></li>
								<?}?>
                        <?}?>
						<li class="page-item">
						  <a class="page-link" href="<?=$PHP_SELF?>?step=<?=$step?>&page=<?=$n_f_no?>&f_no=<?=$n_f_no?>&memberGubun=<?=$memberGubun?>" aria-label="Next">
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
              2018 - propick
              <a href="responsive_table.html#" class="go-top">
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


    <!--common script for all pages-->
    <script src="assets/js/common-scripts.js"></script>

    <!--script for this page-->

  </body>
</html>
