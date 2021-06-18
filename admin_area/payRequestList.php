<?php include $_SERVER['DOCUMENT_ROOT']."/admin_area/inc/admin_top.php";

	$page=$_GET['page'];
	$step=$_GET['step'];
	$f_no=$_GET['f_no'];
	$memberGubun=$_GET['memberGubun'];

	if($memberGubun){
		$where=" and memberGubun='$memberGubun'";
	}

	$que="select * from memberCoupon where gubun='2' $where";
//	echo $que."<br>";
	$que3="select count(1) from memberCoupon where gubun='2' $where";
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
          	<h3><i class="fa fa-angle-right"></i> 결제 신청 목록</h3>
		  		<div class="row mt">
			  		<div class="col-lg-12">
                      <div class="content-panel" style="padding:20px;">

                      <h4><i class="fa fa-angle-right"></i> 전체신청건수 : <?echo number_format($total);?>건</h4>
            
						  <button type="button" onclick="changeStatus();">상태변경</button>
                            <table class="table table-bordered table-striped table-condensed">
                              <thead>
                              <tr>
							  	<!-- <th>아이디</th> -->
                                  <th>결제금액</th>
								  <th>상태</th>
                                  <th>신청자</th>
								  <th>신청일</th>
								  
                              </tr>
                              </thead>
                              <tbody>
<?php
foreach($rsc as $p){

?>
								<input type="hidden" name="num[]" value="<?=$p->num?>">
                              <tr>
                                  <!-- <td><?=$p->uid?></td> -->
								  <td><?echo number_format($p->price);?>원</td>
								  <td>
									<select name="isuse[]">
										<option value="0" <?if($p->isuse==0){?>selected<?}?>>신청중</option>
										<option value="1" <?if($p->isuse==1){?>selected<?}?>>처리완료</option>

									</select>
								  </td>
                                  <td><?=$p->uid?></td>

								  <td><?=$p->regDate?></td>
								  

                              </tr>
							  
<?}?>                              
                              <tr>
                                  <td colspan="8" style="text-align:right;">
										<button type="button" onclick="changeStatus();">상태변경</button>
								  </td>
                              </tr>
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

	<script>
		function changeStatus(){
				
			var chkdata=new Array();
			chkdata[0] = new Array();
			chkdata[1] = new Array();

			$("select[name='isuse[]'] option:selected").each(function(){
				 chkdata[0].push($(this).val());
			});

			$('input[name="num[]"]').each(function() {
				if($(this).val()){
					 chkdata[1].push($(this).val());
				}
			});

			var params = "isuse="+JSON.stringify(chkdata[0])+"&num="+JSON.stringify(chkdata[1]);

				$.ajax({
					  type: 'post'
					, url: '/admin_area/editPayProc.php'
					,data : params
					, dataType : 'json'
					, success: function(data) {
						if(data.result==1){
							alert(data.val);
							location.reload();
						}else if(data.result==-1){
							alert(data.val);
						}else{
							alert('다시 시도해주십시오.');
						}
					  }
				});	
	}
	</script>

  </body>
</html>
