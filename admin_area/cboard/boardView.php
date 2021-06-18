<?php include $_SERVER['DOCUMENT_ROOT']."/admin_area/inc/admin_top.php";


$ps=$_GET['ps'];
$multi=$_POST['multi']?$_POST['multi']:$_GET['multi'];
$subject=$_POST['subject']?$_POST['subject']:$_GET['subject'];
$ir1=$_POST['ir1']?$_POST['ir1']:$_GET['ir1'];

$level=$_POST['level']?$_POST['level']:$_GET['level'];
$step=$_POST['step']?$_POST['step']:$_GET['step'];
$list=$_POST['list']?$_POST['list']:$_GET['list'];
$mode=$_POST['mode']?$_POST['mode']:$_GET['mode'];
$num=$_POST['num']?$_POST['num']:$_GET['num'];

$result = $mysqli->query("select * from cboard where num='$num'");
$rs = $result->fetch_object();
$multi=$rs->multi;

if($multi){
		$where.=" and multi='$multi'";
	}

//검색 구분자

	if($s_word){

		if(!$s_key){
			$s_key="uid";
		}

		$where.=" and $s_key like '%$s_word%'";

	}

	if($fromDate){
	$where.=" and substring(reg_date,1,10)>='$fromDate'";
	}

	if($toDate){
		$where.=" and substring(reg_date,1,10)<='$toDate'";
	}


$result2 = $mysqli->query("select max(num) from cboard where num<'$num' $where order by num desc");
$rs2 = $result2->fetch_array();
$next_num=$rs2[0];

$result2 = $mysqli->query("select min(num) from cboard where num>'$num' $where order by num desc");
$rs2 = $result2->fetch_array();
$pre_num=$rs2[0];

?>
      <!-- **********************************************************************************************************************************************************
      MAIN CONTENT
      *********************************************************************************************************************************************************** -->
      <!--main content start-->
      <section id="main-content">
          <section class="wrapper">
          	<h3><i class="fa fa-angle-right"></i> <?echo comm_title_is($multi);?> 보기</h3>

			<div class="row mt">
			  		<div class="col-lg-12">
                      <div class="content-panel" style="padding:20px;">

			<table class="table table-bordered table-striped table-condensed">
                 <tbody>

				<tr>
					<td class="th_01" width="10%">제목</td>
					<td class="td_02"><?echo stripslashes($rs->subject);?></td>
					<td class="td_02" align="right" width="15%"><?echo substr($rs->reg_date,0,10);?></td>
				</tr>
				<tr>
					<td class="th_01" width="10%">URL</td>
					<td class="td_02" colspan="2"><a href="<?echo $rs->url;?>" target="_blank"><?echo $rs->url;?></a></td>
				</tr>
				<tr>
					<td class="td_02" colspan="3">

									<a href="boardList.php?multi=<?=$multi?>&num=<?=$rs->num?>&page_no=<?=$page_no?>&f_no=<?=$p_f_no?>&s_key=<?=$s_key?>&s_word=<?=$s_word?>&fromDate=<?=$fromDate?>&toDate=<?=$toDate?>&gubun=<?=$gubun?>">목록</a>

									<a href="boardEdit.php?multi=<?=$multi?>&num=<?=$num?>&f_no=<?=$f_no?>&page_no=<?=$page_no?>&s_key=<?=$s_key?>&s_word=<?=$s_word?>&multi=<?=$multi?>&gubun=<?=$gubun?>">수정</a>

									<a href="boardDel.php?multi=<?=$multi?>&num=<?=$rs->num?>&f_no=<?=$f_no?>&page_no=<?=$page_no?>&s_key=<?=$s_key?>&s_word=<?=$s_word?>&multi=<?=$multi?>&gubun=<?=$gubun?>" onclick="return confirm('정말 삭제하시겠습니까?');">삭제</a>
					</td>
				</tr>
				<tr>
					<td class="td_02" colspan="3"  style="font:15px 굴림; color:#333">

					<?echo content_is2($rs->content);?>
					<?php
						if($rs->fn1){
					?>
					<br>
					첨부파일 : <a href="/data/<?=$rs->fn1?>" target="_blank"><?php echo $rs->fn_name1;?></a>
					<?
					}
					?>
					</td>
				</tr>

			</table>

			<br>
			<?if($multi!="market"){?>
			<a href="boardWrite.php?multi=<?=$multi?>&num=<?=$rs->num?>&page_no=<?=$page_no?>&f_no=<?=$p_f_no?>&s_key=<?=$s_key?>&s_word=<?=$s_word?>&fromDate=<?=$fromDate?>&toDate=<?=$toDate?>">등록</a>
			<?}?>
<a href="boardWrite.php?list=<?=$rs->list?>&level=<?=$rs->level?>&step=<?=$rs->step?>&multi=<?=$multi?>&num=<?=$rs->num?>&page_no=<?=$page_no?>&f_no=<?=$p_f_no?>&s_key=<?=$s_key?>&s_word=<?=$s_word?>&fromDate=<?=$fromDate?>&toDate=<?=$toDate?>">답글</a>

			<a href="boardList.php?multi=<?=$multi?>&num=<?=$rs->num?>&page_no=<?=$page_no?>&f_no=<?=$p_f_no?>&s_key=<?=$s_key?>&s_word=<?=$s_word?>&fromDate=<?=$fromDate?>&toDate=<?=$toDate?>&gubun=<?=$gubun?>">목록</a>

			<a href="boardEdit.php?multi=<?=$multi?>&num=<?=$num?>&f_no=<?=$f_no?>&page_no=<?=$page_no?>&s_key=<?=$s_key?>&s_word=<?=$s_word?>&multi=<?=$multi?>&gubun=<?=$gubun?>">수정</a>

			<a href="boardDel.php?multi=<?=$multi?>&num=<?=$rs->num?>&f_no=<?=$f_no?>&page_no=<?=$page_no?>&s_key=<?=$s_key?>&s_word=<?=$s_word?>&multi=<?=$multi?>&gubun=<?=$gubun?>" onclick="return confirm('정말 삭제하시겠습니까?');">삭제</a>
			<br><br>
<?
$result3 = $mysqli->query("select * from cboard where multi='$multi' and num='$pre_num'");
$rs3 = $result3->fetch_object();

$result4 = $mysqli->query("select * from cboard where multi='$multi' and num='$next_num'");
$rs4 = $result4->fetch_object();
?>
			<table class="table table-bordered table-striped table-condensed">
				<tr>
					<td class="th_02" width="100">이전글</td>
					<td class="td_02">
					<?if($rs3->num){?>
					<a href="boardView.php?multi=<?=$multi?>&num=<?=$rs3->num?>&page_no=<?=$i?>&f_no=<?=$p_f_no?>&s_key=<?=$s_key?>&s_word=<?=$s_word?>&fromDate=<?=$fromDate?>&toDate=<?=$toDate?>"><?echo stripslashes($rs3->subject);?></a>
					<?}else{?>
						이전글이 없습니다.
					<?}?>
					</td>
				</tr>
				<tr>
					<td class="th_02" width="100">다음글</td>
					<td class="td_02">
						<?if($rs4->num){?>
							<a href="boardView.php?multi=<?=$multi?>&num=<?=$rs4->num?>&page_no=<?=$i?>&f_no=<?=$p_f_no?>&s_key=<?=$s_key?>&s_word=<?=$s_word?>&fromDate=<?=$fromDate?>&toDate=<?=$toDate?>"><?echo stripslashes($rs4->subject);?></a>
							<?}else{?>
								다음글이 없습니다.
							<?}?>
					</td>
				</tr>
				</tbody>
			</table>

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


    <!--script for this page-->

  </body>
</html>
    <script src="../assets/js/jquery.js"></script>
    <script src="../assets/js/bootstrap.min.js"></script>
    <script class="include" type="text/javascript" src="../assets/js/jquery.dcjqaccordion.2.7.js"></script>
    <script src="../assets/js/jquery.scrollTo.min.js"></script>
    <script src="../assets/js/jquery.nicescroll.js" type="text/javascript"></script>


    <!--common script for all pages-->
    <script src="../assets/js/common-scripts.js"></script>