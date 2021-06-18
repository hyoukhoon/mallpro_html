<?php include $_SERVER['DOCUMENT_ROOT']."/admin_area/inc/admin_top.php";

	$que3="select count(1) from pickAdmin where pickCnt='2' and istate<3 and dateLimit>'$now4'";
	$result3 = $mysqli->query($que3) or die("1:".$mysqli->error);
	$rs3 = $result3->fetch_array();
	$pickTotal=$rs3[0];


	$page=$_GET['page'];
	$step=$_GET['step'];
	$f_no=$_GET['f_no'];
	$selecDay=$_GET['selecDay']?$_GET['selecDay']:$now5;

	$que="select * from proto where istate in (1,2) and odds1<>'1.00'  and iday>'$now3' and odds1>0 and (gameResult is null or gameResult='None')";
//	echo $que."<br>";
	$que3="select count(1) from proto where istate='2' and odds1>0 and (gameResult is null or gameResult='None')";
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
			$gameRound=$rs4->gameRound;
	}

?>
<!-- <style>
#sidebox { background-color:#F0F0F0; position:absolute; width:380px; top:133px; right:100px; padding: 3px 3px }


</style> -->

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
							<h4>등록:<?echo $pickTotal?></h4>
	                  	  	  <h4><i class="fa fa-angle-right"></i> 등록가능한 경기 목록  / 
							  <select name="iday" id="iday">
							  <?php
									$result5 = $mysqli->query("select * from protoTimeTable where turn='$gameRound'") or die("5:".$mysqli->error);
									$rs5 = $result5->fetch_object();
									$startTime=date("Ymd",strtotime($rs5->startTime));
									$endTime=date("Ymd",strtotime($rs5->endTime));

									for($k=0;$k<=5;$k++){

									$dk=date("Ymd",strtotime($rs5->startTime.'+'.$k.' days'));
							  ?>
								<option value="<?=$dk?>" <?if($dk==$selecDay){?>selected<?}?>><?=$dk?></option>
								<?}?>
							  </select>
							  <button type="button" onclick="autoPickRight()"> 정배 자동 등록</button> / <button type="button" onclick="autoPickReverse()"> 역배 자동 등록</button> <button type="button" onclick="autoPick()"> 일반 자동 등록</button></h4>
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
	$gameRound=$p->gameRound;
	if($p->handi==9){
		$value1=7;
		$value3=8;
	}else{
		$value1=1;
		$value2=0;
		$value3=-1;
	}

	if(substr($p->iday,0,8)==$selecDay){
		$color="color:blue;";
	}else{
		$color="color:#000;";
	}
?>
<tr id="tr<?=$p->gubun?>">
	<td style="<?=$color?>">[<?=$p->gameGubun?>]<?=$p->iday?></td>
	  <td><?=$p->home?><?if($p->handi==2 or $p->handi==12){?><font color="red">(H<?if($p->handi1>0){?>+<?}?><?=$p->handi1?>)</font><?}else if($p->handi==9){?><font color="blue">(U/O<?=$p->handi1?>)</font><?}?></td>
	  <td><?=$p->away?></td>
	  <td><?if($p->handi==9){?>U<?}else{?>승<?}?>(<?=$p->odds1?>)<input type="checkbox" odds="<?=$p->odds1?>" home="<?=$p->home?>"  away="<?=$p->away?>"  inum="<?=$p->num?>" class="chkbx" title="<?=$p->gameTitle?>" islip="<?=$p->islip?>" id="checkId[]" name="isCheck[<?=$p->islip?>]" value="<?=$value1?>"></td>
	  <td><?if($p->odds2>0){?>무(<?=$p->odds2?>)<input type="checkbox" odds="<?=$p->odds2?>" home="<?=$p->home?>"  away="<?=$p->away?>" inum="<?=$p->num?>" class="chkbx" title="<?=$p->gameTitle?>" islip="<?=$p->islip?>" id="checkId[]" name="isCheck[<?=$p->islip?>]" value="<?=$value2?>"><?}?></td>
	  <td><?if($p->handi==9){?>O<?}else{?>패<?}?>(<?=$p->odds3?>)<input type="checkbox" odds="<?=$p->odds3?>" home="<?=$p->home?>"  away="<?=$p->away?>" inum="<?=$p->num?>" class="chkbx" title="<?=$p->gameTitle?>" islip="<?=$p->islip?>" id="checkId[]" name="isCheck[<?=$p->islip?>]" value="<?=$value3?>"></td>
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


<div id="sidebox" class="col-lg-6 col-md-6 col-sm-12" style="display:none">
      				<! -- ALERTS EXAMPLES -->
      				<div class="showback">
						<a href="javascript:;" onclick="closeWindowSidebox();" style="float:right;"><span class="badge bg-primary">X</span></a>
      					<h4><i class="fa fa-angle-right"></i> Alerts Examples</h4>

							<div id="game1" class="alert alert-success"><b>Well done!</b> You successfully read this important alert message.</div>
							<div id="game2" class="alert alert-info"><b>Heads up!</b> This alert needs your attention, but it's not super important.</div>
							<div id="game3" class="alert alert-warning" style="text-align:center"><b>Warning!</b> Better check yourself, you're not looking too good.</div>
							<div class="alert alert-danger" style="text-align:center">최종배당률은 베트맨과 다를 수 있습니다.</div>
							<div class="alert alert-danger" style="text-align:center"><input type="checkbox" name="coupon" value="1">찬스상품권사용</div>
							<div id="game4" style="text-align:center"><button type="button" onclick="sendform()">등록하기</button></div>      				
      				</div><!-- /showback -->
</div><!-- /col-lg-6 -->



<!-- <script>
var currentPosition = parseInt($("#sidebox").css("top")); $(window).scroll(function() { var position = $(window).scrollTop(); $("#sidebox").stop().animate({"top":position+currentPosition+"px"},1000); });


</script>
 -->

<script>

function autoPick(){
	var iday=$("select[name=iday]").val();
	location.href='/autoPick.php?iday='+iday;
}

function autoPickRight(){
	var iday=$("select[name=iday]").val();
	location.href='/autoPickRight.php?iday='+iday;
}

function autoPickReverse(){
	var iday=$("select[name=iday]").val();
	location.href='/autoPickReverse.php?iday='+iday;
}


function closeWindowSidebox(){
	$("#sidebox").hide();
}


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
			var oddsVal=new Array();
			var k=0;
			var i=1;

			$('input:checkbox[class="chkbx"]').each(function() {

				if($(this).is(":checked")==false){
					$(this).prop('disabled', 'disabled');
				}else{
					checkArray[k]=$(this).attr("inum");
					numArray[k]=$(this).val();
					

					var home=$(this).attr("home");
					var away=$(this).attr("away");
					var val=$(this).val();
					var odds=$(this).attr("odds");
					oddsVal[k]=odds;
					if(val==1){
						val="승";
					}else if(val==-1){
						val="패";
					}else if(val==0){
						val="무";
					}else if(val==7){
						val="U";
					}else if(val==8){
						val="O";
					}

					$("#game"+i).text(home+" : "+away+" - "+val + " ( "+odds+" )");
					
					k++;
					i++;
				}

				
			});

			var oddsFinal=oddsVal[0]*oddsVal[1];
			of=Math.ceil(oddsFinal*10)/10;
			$("#game3").text("예상적중배당률 : "+of);
			//$("#game3").text("예상적중배당률 : "+of+"("+oddsFinal+")");


			var jsonCheck = JSON.stringify(checkArray);//json으로 바꿈
			var jsonNum = JSON.stringify(numArray);//json으로 바꿈

			//window.open('betting.php?jsonCheck='+jsonCheck+'&jsonNum='+jsonNum,'lg','width:600px,height:400px,scrollbars=yes');
			$("#sidebox").show();
			
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

function sendform(){

			var checkArray=new Array();
			var numArray=new Array();
			var k=0;


			$('input:checkbox[class="chkbx"]').each(function() {

				if($(this).is(":checked")==true){

					checkArray[k]=$(this).attr("inum");
					numArray[k]=$(this).val();
					k++;
				}
			});

			var jsonCheck = JSON.stringify(checkArray);//json으로 바꿈
			var jsonNum = JSON.stringify(numArray);//json으로 바꿈

			var coupon=$("input[name='coupon']:checked").val();
//			console.log(coupon);
//			return;

			console.log(jsonCheck + " , "+jsonNum);
//			return;
			var params='jsonCheck='+jsonCheck+'&jsonNum='+jsonNum+'&coupon='+coupon+'&gameRound=<?=$gameRound?>';

			$.ajax({
					  type: 'post'
					, url: '/admin_area/saveBet.php'
					,data : params
					, dataType : 'html'
					, success: function(data) {
//						console.log(data);
						if(data==1){
							alert('등록했습니다.');
							$("#sidebox").hide();
						}else if(data==-2){
							alert('같은 게임에 대해 같은 결과는 하나만 등록할 수 있습니다.');
							$("#sidebox").hide();
						}else if(data==-3){
							alert('찬스상품권이 없습니다.');
							$("#sidebox").hide();
						}else{
							alert('다시 시도해주십시오.');
						}
					  }
				});	
}

</script>
    <!-- js placed at the end of the document so the pages load faster -->

    <!-- js placed at the end of the document so the pages load faster -->
    <script src="assets/js/jquery.js"></script>
    <script src="assets/js/bootstrap.min.js"></script>
    <script class="include" type="text/javascript" src="assets/js/jquery.dcjqaccordion.2.7.js"></script>
    <script src="assets/js/jquery.scrollTo.min.js"></script>
    <script src="assets/js/jquery.nicescroll.js" type="text/javascript"></script>


    <!--common script for all pages-->
    <script src="assets/js/common-scripts.js"></script>


  </body>
</html>
