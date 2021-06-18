<?php include $_SERVER['DOCUMENT_ROOT']."/admin_area/inc/admin_top.php";

	$page=$_GET['page'];
	$step=$_GET['step'];
	$f_no=$_GET['f_no'];

	$que="select *, (select count(1) from pickAdmin b where a.uid=b.uid and b.istate='100' group by b.uid) as total, (select sum(iswin) from pickAdmin b where a.uid=b.uid and b.istate='100' group by b.uid) as totalWin, (select count(1) from pickAdmin b where a.uid=b.uid and b.istate='100' and isWin='2') as realWin from pickAdmin a where istate<3 and dateLimit>'$now4'";
//	$que="select *.(select count(1) from pickAdmin where uid=uid group by uid) from pickAdmin";
//	echo $que."<br>";
	$que3="select count(1) from pickAdmin where istate<3 and dateLimit>'$now4'";
	$result3 = $mysqli->query($que3) or die("1:".$mysqli->error);
	$rs3 = $result3->fetch_array();
	$total=$rs3[0];
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
	$limit_query=" order by num desc limit $start_page, $end_page";
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
          <section class="wrapper">
          	<h3><i class="fa fa-angle-right"></i> 픽 목록</h3>
		  		<div class="row mt">
			  		<div class="col-lg-12">
                      <div class="content-panel">
                      <h4><i class="fa fa-angle-right"></i> 리스트 : <?echo $total;?> <!-- <button type="button" onclick="autoPickView()"> 픽뷰 등록</button> --></h4>
                          <section id="unseen">
                            <table class="table table-bordered table-striped table-condensed">
                              <thead>
                              <tr>
							  	<th>아이디</th>
									<th>기록(전체/리얼)</th>
                                  <th>gameRound</th>
                                  <th>state</th>
                                  <th>아이템</th>
                                  <th>성공여부</th>
                                  <th>조회수</th>
								  <th>경기정보</th>
                              </tr>
                              </thead>
                              <tbody>
<?php
foreach($rsc as $p){

	$totalPick=$p->total;
	$totalWin=$p->totalWin;
	
	$realWin=$p->realWin;
	$realLose=$totalPick-$realWin;
	$twR=($totalWin/($totalPick*2));//전체승률
	$rwR=($realWin/$totalPick);//리얼승률

?>

                              <tr <?if($p->istate<=2){?>onclick="viewPick('<?=$p->num?>')"<?}else{?>onclick="javascript:alert('볼수없는 픽입니다.');"<?}?>>
                                  <td><?=$p->uid?></td>
								  <td><?
								  echo number_format($twR,3)."/".number_format($rwR,3)."(W:".$realWin." / L:".$realLose.")";
									if($p->pickGubun==1){echo "<br><font color='red'>스페셜픽</font>";}
							  ?>

								  </td>
								  <td><?=$p->gameRound?></td>
                                  <td><?=$p->istate?></td>
                                  <td><?=$p->sitem?></td>
                                  <td><?=$p->isWin?></td>
                                  <td class="numeric"><?=$p->clickCnt?></td>
								  <td>
	
								  	<?php
										$oddsVal=array();
										$que2="select * from pickTable a, proto b where a.gnum=b.num and  a.pnum='".$p->num."' order by gnum asc";
										$result2 = $mysqli->query($que2) or die("2:".$mysqli->error);
										while($rs2 = $result2->fetch_object()){	
											$oddsVal[]=$rs2->odds;
											if($rs2->handi==9){echo "<font color='blue'>[U/O]</font>";}
											if($rs2->handi==2){echo "<font color='red'>[Handi]</font>";}
											echo $rs2->home." : ".$rs2->away." - ".$rs2->gamePreview." ( ".$rs2->odds." ) - ".$rs2->iday." <br>";

										}
										$ov=$oddsVal[0]*$oddsVal[1];

?>		
										배당률 : <?echo ceil(($ov)*10)/10;?>
								  </td>

                              </tr>
							  
<?}?>                              
                              
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
						  <a class="page-link" href="<?=$PHP_SELF?>?step=<?=$step?>&page=<?=$p_f_no?>&f_no=<?=$p_f_no?>" aria-label="Previous">
							<span aria-hidden="true">&laquo;</span>
							<span class="sr-only">Previous</span>
						  </a>
						</li>
						<? for($i=$f_no;$i<=$l_no;$i++){?>
                                <?if($i==$page){?>
									<li class="page-item active"><a class="page-link" href="#"><?=$i?> <span class="sr-only">(current)</span></a></li>
								<?} else {?>
									<li class="page-item"><a class="page-link" href="<?=$PHP_SELF?>?step=<?=$step?>&page=<?=$i?>&f_no=<?=$f_no?>&multi=<?=$multi?>&sort=<?=$sort?>&s_key=<?=$s_key?>"><?=$i?></a></li>
								<?}?>
                        <?}?>
						<li class="page-item">
						  <a class="page-link" href="<?=$PHP_SELF?>?step=<?=$step?>&page=<?=$n_f_no?>&f_no=<?=$n_f_no?>" aria-label="Next">
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
    
	<script>

	function autoPickView(){
		location.href='/autoPickView.php';
	}


		function viewPick(n){
			
			var params='num='+n;
			alert('픽을 볼 수 없습니다.');
			return;
			$.ajax({
					  type: 'post'
					, url: '/admin_area/pickView.php'
					,data : params
					, dataType : 'html'
					, success: function(data) {
						if(data==1){
							alert('캐쉬를 사용했습니다..');
						}else if(data==-1){
							alert('적립금이 부족합니다.');
						}else if(data==-2){
							alert('이미 보신 픽입니다.');
						}else if(data==-3){
							alert('이미 보신 픽과 결과가 같은 픽입니다.');
						}else{
							alert('다시 시도해주십시오.');
						}
					  }
				});	
	}
	</script>
  </body>
</html>
