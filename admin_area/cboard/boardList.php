<?php include $_SERVER['DOCUMENT_ROOT']."/admin_area/inc/admin_top.php";

$ps=$_GET['ps'];
$multi=$_POST['multi']?$_POST['multi']:$_GET['multi'];
$s_key=$_POST['s_key']?$_POST['s_key']:$_GET['s_key'];
$s_word=$_POST['s_word']?$_POST['s_word']:$_GET['s_word'];
$fromDate=$_POST['fromDate']?$_POST['fromDate']:$_GET['fromDate'];
$toDate=$_POST['toDate']?$_POST['toDate']:$_GET['toDate'];
$page_no=$_POST['page_no']?$_POST['page_no']:$_GET['page_no'];
$f_no=$_POST['f_no']?$_POST['f_no']:$_GET['f_no'];

if(!$ps){
	$ps=50;
}





?>
      
      <!-- **********************************************************************************************************************************************************
      MAIN CONTENT
      *********************************************************************************************************************************************************** -->
      <!--main content start-->
      <section id="main-content">
          <section class="wrapper">
          	<h3><i class="fa fa-angle-right"></i> 게시판 </h3>
		  		<div class="row mt">
			  		<div class="col-lg-12">
                      <div class="content-panel" style="padding:20px;">
					  <button type="button" class="btn btn-theme" onclick="location.href='<?=$_SERVER['PHP_SELF']?>'">전체</button> 

					  <button type="button" class="btn btn-theme" onclick="location.href='<?=$_SERVER['PHP_SELF']?>?multi=qna'">1:1문의</button> 

				<br /><br />

							<table width="100%" border="0" cellpadding="0" cellspacing="0">
							<form method="get" action="<?=$PHP_SELF?>" name="f">
							<input type="hidden" name="multi" value="<?=$multi?>">
											<tr>
												<td class="te_le te_gray2">
													<select name="s_key" class="select">
														<option value="">선택</option>
														<option value="id" <?if($s_key=="id"){echo "selected";}?>>아이디</option>
														<option value="name" <?if($s_key=="name"){echo "selected";}?>>이름</option>
														<option value="subject" <?if($s_key=="subject"){echo "selected";}?>>제목</option>
														<option value="content" <?if($s_key=="content"){echo "selected";}?>>내용</option>
													</select>
													<input type="text" name="s_word" class="input" size="30">
													<button type="input" class="btn btn-primary">검색</button>
												</td>
												<td align="right" class="te_le te_gray2">
														<button type="button" class="btn btn-primary" onclick="location.href='boardWrite.php?multi=<?=$multi?>'">글쓰기</button>
												</td>
											</tr>
											<tr><td colspan="2" style="height:10px;"></td></tr>
											<tr><td colspan="2" style="height:1px;background-color:#ddd"></td></tr>
											<tr><td colspan="2" style="height:10px;"></td></tr>
							</form>
										</table>
                            <table class="table table-bordered table-striped table-condensed">
                              <thead>
                              <tr>
									<th>No</th>
									<th>ID</th>
									<th>제목</th>
									<th>작성일</th>
									<th>조회수</th>
                              </tr>
                              </thead>
                              <tbody>
<?

	
	if($multi){
		$where.=" and multi='$multi'";
	}

		if($gubun){
		$where.=" and gubun='$gubun'";
	}



//검색 구분자

	if($s_word){

		if(!$s_key){
			$s_key="id";
		}

		$where.=" and $s_key like '%$s_word%'";

	}

	if($fromDate){
	$where.=" and substring(reg_date,1,10)>='$fromDate'";
	}

	if($toDate){
		$where.=" and substring(reg_date,1,10)<='$toDate'";
	}


//	echo $where."<br>";

$result = $mysqli->query("select count(*) from cboard where num>0 $where");
$rs_list = $result->fetch_array();
$total=$rs_list[0];
$result->free();

$page_size=$ps;//한페이지에 몇개를 표시할지
$sub_size=10;//아래에 나오는 페이징은 몇개를 할지
$total_page=ceil($total/$page_size);//몇페이지


//page_no이 없거나 1보다 작으면 무조건 1
if(!$page_no or $page_no<1){
	$page_no=1;
}


//페이징의 첫 숫자
if(!$f_no or $f_no<1){
	$f_no=1;
}


//페이징의 마지막 숫자
$l_no=$f_no+$sub_size-1;

//l_no 이 토탈 페이지보다 크면
if($l_no>$total_page){
	$l_no=$total_page;
}


//어디부터
$t_no=$page_size*($page_no-1);

//어디까지
$b_no=$page_size;

$no=$total-($page_no-1)*$page_size;//번호매기기

$result = $mysqli->query("select * from cboard where num>0 $where order by  num desc limit $t_no,$b_no");
while ($rs = $result->fetch_object()) {

$memo_date=strtotime($rs->memo_date)+86400;


?>

                              <tr>
								<td class="td_01"><?echo $no?></td>
								<td class="td_01"><?echo $rs->uid?></td>
								<td class="td_02">
								<?if($rs->multi=="faq"){?>
									[<?=$rs->cate?>]
								<?}?>
								  <?if($rs->isReply){?>
								  	[답변완료]
								  <?}else{?>
									<font color="red">[답변전]</font>
								  <?}?>
								<a href="boardView.php?num=<?=$rs->num?>&multi=<?=$rs->multi?>&gubun=<?=$rs->gubun?>&page_no=<?=$page_no?>&f_no=<?=$f_no?>&s_key=<?=$s_key?>&s_word=<?=$s_word?>&fromDate=<?=$fromDate?>&toDate=<?=$toDate?>">
								<?
								//답글
								if($rs->level>0){
									for($i=0;$i<=$rs->level;$i++){
								?>
								&nbsp;
								<?}?>
								<b>RE:</b>
								<?}?>
								<?echo stripslashes($rs->subject)?><?if($now<=$memo_date){?><font color="red"><?}?>[<?echo $rs->memo_cnt;?>]</font></a>
								<?if($rs->file_list){?>&nbsp;♬<?}?>
								</td>
								<td class="td_01">
									<?echo $rs->reg_date;?>
								</td>
								<td class="td_01">
									<?echo number_format($rs->cnt);?>
								</td>
								
							</tr>
							  
<?
	$no--;
}

	$n_f_no=$f_no+$sub_size;
	$p_f_no=$f_no-$sub_size;
?>
                              
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
						  <a class="page-link" href="<?=$PHP_SELF?>?n=<?=$n?>&level=<?=$level?>&gubun=<?=$gubun?>&page_no=<?=$p_f_no?>&f_no=<?=$p_f_no?>&multi=<?=$multi?>&sort=<?=$sort?>&s_key=<?=$s_key?>&s_word=<?=$s_word?>&fromDate=<?=$fromDate?>&toDate=<?=$toDate?>" aria-label="Previous">
							<span aria-hidden="true">&laquo;</span>
							<span class="sr-only">Previous</span>
						  </a>
						</li>
						<? for($i=$f_no;$i<=$l_no;$i++){?>
							<?if($i==$page_no){?>
									<li class="page-item active"><a class="page-link" href="#"><?=$i?> <span class="sr-only">(current)</span></a></li>
								<?} else {?>
									<li class="page-item"><a class="page-link" href="<?=$PHP_SELF?>?n=<?=$n?>&level=<?=$level?>&gubun=<?=$gubun?>&page_no=<?=$i?>&f_no=<?=$f_no?>&multi=<?=$multi?>&sort=<?=$sort?>&s_key=<?=$s_key?>&s_word=<?=$s_word?>&fromDate=<?=$fromDate?>&toDate=<?=$toDate?>"><?=$i?></a></li>
								<?}?>
                        <?}?>
						<li class="page-item">
						  <a class="page-link" href="<?=$PHP_SELF?>?n=<?=$n?>&level=<?=$level?>&gubun=<?=$gubun?>&page_no=<?=$n_f_no?>&f_no=<?=$n_f_no?>&multi=<?=$multi?>&sort=<?=$sort?>&s_key=<?=$s_key?>&s_word=<?=$s_word?>&fromDate=<?=$fromDate?>&toDate=<?=$toDate?>" aria-label="Next">
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
    <script src="/admin_area/assets/js/jquery.js"></script>
    <script src="/admin_area/assets/js/bootstrap.min.js"></script>
    <script class="include" type="text/javascript" src="/admin_area/assets/js/jquery.dcjqaccordion.2.7.js"></script>
    <script src="/admin_area/assets/js/jquery.scrollTo.min.js"></script>
    <script src="/admin_area/assets/js/jquery.nicescroll.js" type="text/javascript"></script>


    <!--common script for all pages-->
    <script src="/admin_area/assets/js/common-scripts.js"></script>

    <!--script for this page-->

  </body>
</html>
