<?php include $_SERVER["DOCUMENT_ROOT"]."/admin_page/inc/top.php";

$today=date("Y-m-d");
$sq=$_GET['sq']??"none";
$sq2=$_GET['sq2']??"none";
$mode=$_GET['mode'];
$s_key=$_GET['s_key'];
$s_word=$_GET['s_word'];
$cate1=$_GET['cate1'];
$cate2=$_GET['cate2'];

$SHOP_CODE=$_GET['SHOP_CODE'];
$IMGVOD_FLAG=$_GET['IMGVOD_FLAG']??"all";
$DYN=$_GET['DYN']??json_decode(urldecode($_GET['spa']));
//print_r($DYN);
$spa=urlencode(json_encode($DYN));

$d7=date("Y-m-d", mktime(date("H"), date("i"), date("s"), date("m"), date("d")-7, date("Y")));
$d14=date("Y-m-d", mktime(date("H"), date("i"), date("s"), date("m"), date("d")-14, date("Y")));
$today=date("Y-m-d");

$start_date=$_GET['start_date'];
$end_date=$_GET['end_date'];

$start_date2=$_GET['start_date2'];
$end_date2=$_GET['end_date2'];


?>
<script>
$(function() {

			//$( document ).tooltip();
			$('#today').trigger('click');

			$('#search_all01').change(function() {		
				$("input[name='status']").prop('checked', this.checked);		
			});

			$( "#start_date, #end_date" ).datepicker({
				showOn:"button"
				,buttonImage:"/admin_page/images/calendar_Ico.png"
				,buttonImageOnly:true
				,dateFormat:'yy-mm-dd'
			});

			$( "#start_date2, #end_date2" ).datepicker({
				showOn:"button"
				,buttonImage:"/admin_page/images/calendar_Ico.png"
				,buttonImageOnly:true
				,dateFormat:'yy-mm-dd'
			});

			function getToday()
			{
				var today = new Date();

				// Display the month, day, and year. getMonth() returns a 0-based number.
				var month = today.getMonth()+1;
				var day = today.getDate();
				var year = today.getFullYear();
				 if (day<10)  day = '0'+day;
				 if (month<10)  month = '0'+month;
				return year + '-' + month + '-' + day ;
			}

			// 어제 날짜 가져오기
			function getYesterDay(){
			  var today = new Date();
			  var yesterday = new Date(today.valueOf() - (24*60*60*1000));
			  var year = yesterday.getFullYear();
			  var month = yesterday.getMonth() + 1;
			  var day = yesterday.getDate();
			  if (day<10)  day = '0'+day;
			  if (month<10)  month = '0'+month;
			  return year + '-' + month + '-' + day ;
			}

			// 일주일전 날짜 가져오기
			function getWeekDay(){
			  var today = new Date();
			  var yesterday = new Date(today.valueOf() - (7*24*60*60*1000));
			  var year = yesterday.getFullYear();
			  var month = yesterday.getMonth() + 1;
			  var day = yesterday.getDate();
			  if (day<10)  day = '0'+day;
			  if (month<10)  month = '0'+month;
			  return year + '-' + month + '-' + day ;
			}

			// 한달전 가져오기
			function getMonthDay(){
			  var today = new Date();
			  var yesterday = new Date(today.valueOf());
			  var year = yesterday.getFullYear();
			  var month = yesterday.getMonth();
			  var day = yesterday.getDate();
			  if (month=='0') {
				  year = year-1;
				  month = '12';
			  }

			  if (month<10)  month = '0'+month;
			  if (day<10)  day = '0'+day;
			  return year + '-' + month + '-' + day ;
			}

			function get3MonthDay(){
			  var today = new Date();
			  var yesterday = new Date(today.valueOf());
			  var year = yesterday.getFullYear();
			  var month = yesterday.getMonth()-2;
			  var day = yesterday.getDate();
			  if (month>=11 || month==0) {
				  year = year-1;
				  if(month==0)month = '12';
			  }

			  if (month<10)  month = '0'+month;
			  if (day<10)  day = '0'+day;
			  return year + '-' + month + '-' + day ;
			}

			function get6MonthDay(){
			  var today = new Date();
			  var yesterday = new Date(today.valueOf());
			  var year = yesterday.getFullYear();
			  var month = yesterday.getMonth()-5;
			  var day = yesterday.getDate();
				if (month>=7 || month==0) {
				  year = year-1;
				  if(month==0)month = '12';
			  }

			  if (month<10)  month = '0'+month;
			  if (day<10)  day = '0'+day;
			  return year + '-' + month + '-' + day ;
			}

			function getNone(){
			  return "";
			}

			$('.tt').on('click', function() {
				var val = $(this).attr('val');
				var today = getToday();
				var start = '';

				$(".tt.button06").addClass("button05").removeClass("button06");

				$(this).addClass("button06");

				switch(val)
				{
					case 'today':
						start = getToday();
					break;
					case 'oneday':
						start = getYesterDay();
					break;
					case 'lastweek':
						start = getWeekDay();
					break;
					case 'lastmonth':
						start = getMonthDay();
					break;
					case 'month3':
						start = get3MonthDay();
					break;
					case 'month6':
						start = get6MonthDay();
					break;
					case 'none':
						start = getNone();
						today=getNone();
					break;

				}

					$('#start_date').val(start);
					$('#end_date').val(today);
					$('#sq').val(val);
					
					if(val=='sa'){
						$('#aa').val(1);
					}

			});


			$('.tt2').on('click', function() {
				var val = $(this).attr('val');
				var today = getToday();
				var start = '';

				$(".tt2.button06").addClass("button05").removeClass("button06");

				$(this).addClass("button06");

				switch(val)
				{
					case 'today':
						start = getToday();
					break;
					case 'oneday':
						start = getYesterDay();
					break;
					case 'lastweek':
						start = getWeekDay();
					break;
					case 'lastmonth':
						start = getMonthDay();
					break;
					case 'month3':
						start = get3MonthDay();
					break;
					case 'month6':
						start = get6MonthDay();
					break;
					case 'none':
						start = getNone();
						today=getNone();
					break;

				}

					$('#start_date2').val(start);
					$('#end_date2').val(today);
					$('#sq2').val(val);
					
					if(val=='sa'){
						$('#aa').val(1);
					}

			});

		});

		$.addDays = function(day) {
			var val = $(this).val();
			return new Date(val + day * 24 * 60 * 60 * 1000 );
		};

function scheck_none(){
	$('#disp2').attr('checked', false);
	$('#disp3').attr('checked', false);
	$('#disp4').attr('checked', false);
}

function scheck_none1(){
if($("input:checkbox[id='disp2']").is(":checked")== true && $("input:checkbox[id='disp3']").is(":checked")== true && $("input:checkbox[id='disp4']").is(":checked")== true){
		$('#disp1').attr('checked', true);
		$('#disp2').attr('checked', false);
		$('#disp3').attr('checked', false);
		$('#disp4').attr('checked', false);
	}else{
		$('#disp1').attr('checked', false);
	}
}
</script>
<!-- 메인메뉴 S -->
    <div id="wrap_tmall_content">
     
     <ul class="top_title_area">
       <li class="top_title">상품관리 > 일괄등록 관리</li>
	   <div class="midle_bu_area ml20">
			<ul class="left_bu_area">
			<li ><button type="button" class="button05" id="add1" onclick="window.open('folder_list.php','f1','width=600,height=500,scrollbars=yes')">+일괄등록</button></li>
			</ul>
		</div>
     </ul>
     
    
    <!-- 조회영역 S -->
       <div class="search_area">
   	     <div class="search_box">

<form method="get" action="<?=$_SERVER['PHP_SELF']?>" name="sf">
<input type="hidden" name="mode" value="up">
<input type="hidden" name="sq" id="sq" value="<?=$sq?>">
<input type="hidden" name="sq2" id="sq2" value="<?=$sq2?>">

   	       <table>
			     	       <colgroup>
                           <col width="170" />
                           <col width="88" />
                           <col width="*" />
                           </colgroup>
						   <tr>
                               <td scope="col" class="title1">폴더검색</td>
                               <td>
									<input type="text" name="s_word" value="<?=$s_word?>">
                              </td>
                               <td style="padding-left:30px;">

                              </td>
                             </tr>
							 
                      
                             <tr>
                               <td scope="col" class="title1">등록일자</td>
                               <td>
                                <div class="input_area">
								<input type="text" name="start_date2" id="start_date2" title="입력" class="input_form01"  style="width:80px;"  value="<?=$start_date2?>" />
								 ~
								<input type="text" name="end_date2" id='end_date2' title="입력" class="input_form01" style="width:80px;"  value="<?=$end_date2?>" />                               
								</div>                
								</td>
                               <td>
                                <div class="midle_bu_area ml20">
                                  <ul class="left_bu_area">
									<li><a <?if($sq2=="today"){?>class="tt2 button06"<?}else{?>class="tt2 button05"<?}?> href="javascript:;" id='today' val='today'>오늘</a></li>
									<li><a <?if($sq2=="lastweek"){?>class="tt2 button06"<?}else{?> class="tt2 button05"<?}?> href="javascript:;" val='lastweek'>~1주일</a></li>
									<li><a <?if($sq2=="lastmonth"){?>class="tt2 button06"<?}else{?> class="tt2 button05"<?}?> href="javascript:;" val='lastmonth'>~1개월</a></li>
									<li><a <?if($sq2=="month3"){?>class="tt2 button06"<?}else{?> class="tt2 button05"<?}?> href="javascript:;" val='month3'>~3개월</a></li>
									<li><a <?if($sq2=="month6"){?>class="tt2 button06"<?}else{?> class="tt2 button05"<?}?> href="javascript:;" val='month6'>~6개월</a></li>
									<li><a <?if($sq2=="none"){?>class="tt2 button06"<?}else{?> class="tt2 button05"<?}?> href="javascript:;" val='none'>전체</a></li>

								</ul>
                                 </div>                               </td>
                             </tr>
							 <tr>
                               <td colspan="3" align="right">
							   <div class="midle_bu_area ml20">
                                  <ul class="right_bu_area">
									<li><button type="submit" class="button03_4">조회</button></li>
									<li><button type="button" class="button03_5" onclick="location.href='<?=$_SERVER['PHP_SELF']?>'">초기화</button></li>
									</ul>
								</div>
                              </td>
                             </tr>
           </table>
                         
</form>
   	     </div>
	      </div>
     
     
      <!-- 조회영역 E -->
<?
	$que3="select count(1) from ptest where 1=1 group by reg_idx";
	$result3 = $mysqli->query($que3) or die("1:".$mysqli->error);
	$rs3 = $result3->fetch_array();
	$total_ptest=$result3->num_rows;

	if($s_word){
			$where=" and reg_date='".$s_word."' or folder_name='".$s_word."'";
	}


	if($mode=="up" and $start_date and $end_date){
		$where.=" and DISPLAY_START_DATE>='".$start_date."' and DISPLAY_END_DATE<='".$end_date." 23:59:59'";
	}

	if($mode=="up" and $start_date2 and $end_date2){
		$where.=" and up_date between '".$start_date2."' and '".$end_date2." 23:59:59'";
	}


	$group=" group by reg_idx";


	if(!$order){
		$order=" order by reg_idx desc";
	}

	$LIMIT=$_GET['LIMIT']??50;
	$page=$_GET['page']??1;


	$que2="select count(1) from ptest where 1=1";
	$que2.=$where;
	$que2.=$group;
	$result2 = $mysqli->query($que2) or die("2:".$mysqli->error);
	$rs2 = $result2->fetch_array();
	$total=$result2->num_rows;

?>
       <!-- sub title영역 S -->
      <div class="sub_title_area">
      <dl>
       <dt>총등록건수 <?echo number_format($total_ptest);?>건  |  검색결과    <?echo number_format($total);?>건</dt>
	   <dd>
	   
	   <div class="midle_bu_area ml20">
		  <ul class="left_bu_area">
			<li><a class="button05" href="javascript:;" onclick="window.open('folder_list.php','f1','width=600,height=500,scrollbars=yes')">+일괄등록</a></li>
		</ul>
		 </div>
	   
	   </dd>
      </dl>
      </div>
       <!-- sub title영역 E -->
       
     
              <!-- GRID S-->
              <div class="gridTable_list01">

<form method="get" action="pc_ok.php" name="pf">
<input type="hidden" name="gubun" value="<?=$gubun?>">
                <table width="100%" border="0" style="table-layout:fixed; word-break:break-all;">

                  <colgroup>
                  <col width=5%/>
                  <col width=10%/>
                  <col width="*"/>
                  <col width=10% />
                  <col width=10%/>
                  </colgroup>
                  <thead>
                    <tr>
                      <th scope="col">NO</th>
					  <th scope="col">등록일</th>
                      <th scope="col">선택폴더</th>
                      <th scope="col">성공수</th>
                      <th scope="col">실패수</th>
                    </tr>
                  </thead>
                  <tbody>

<?

//페이징
$start_page=($page-1)*$LIMIT;
$end_page=$LIMIT;
$ps=$LIMIT;//한페이지에 몇개를 표시할지
$sub_size=20;//아래에 나오는 페이징은 몇개를 할지
$total_page=ceil($total/$ps);//몇페이지
$f_no=$_GET['f_no']??1;//첫페이지
if($f_no<1)$f_no=1;
$l_no=$f_no+$sub_size-1;//마지막페이지
if($l_no>$total_page)$l_no=$total_page;
$n_f_no=$f_no+$sub_size;//다음첫페이지
$p_f_no=$f_no-$sub_size;//이전첫페이지
$no=$total-($page-1)*$ps;//번호매기기


	$limit_query=" limit $start_page, $end_page";
	$que="select reg_idx as ud,up_date 
	from ptest  where  1=1";
	$que.=$where;
	$que.=$group;
	$que.=$order;
	$que.=$limit_query;
//	echo $que;
	$result = $mysqli->query($que) or die("3:".$mysqli->error);
	while($rs = $result->fetch_object()){
			$rsc[]=$rs;
	}


foreach($rsc as $p){

?>
                    <tr >
                      <td><?=$no?></td>
                      <td><?echo substr($p->up_date,0,10);?></td>
                      <td class="pl20">
							<?
								$que="select folder_name,count(*) as cnt 
								from ptest  where  1=1";
								$que.=" and reg_idx='$p->ud' group by folder_name order by folder_name desc";
							//	echo $que;
								$result = $mysqli->query($que) or die("3:".$mysqli->error);
								while($rs = $result->fetch_object()){

?>
								<?echo substr($rs->folder_name,0,6)." > ".$rs->folder_name;?> 폴더에서 <?echo number_format($rs->cnt);?>개 상품<br>
<?}?>
					  </td>
                      <td>
						<?
						$que2="select count(1) as win from ptest where reg_idx='$p->ud' and gubun='1'";
						$result2 = $mysqli->query($que2) or die("3:".$mysqli->error);
						$rs2 = $result2->fetch_object();
						$win=$rs2->win;
?>
						<a href="javascript:;" onclick="window.open('up_pop.php?ud=<?=$p->ud?>','s1','width=1100,height=800,scrollbars=yes')"><?=$win?></a>
					  </td>
                      <td>
						<?
						$que3="select count(1) as lose from ptest where reg_idx='$p->ud' and gubun not in ('0','1')";
						$result3 = $mysqli->query($que3) or die("3:".$mysqli->error);
						$rs3 = $result3->fetch_object();
						$lose=$rs3->lose;
?>
						<a href="javascript:;" onclick="window.open('up_pop.php?ud=<?=$p->ud?>','s1','width=1100,height=800,scrollbars=yes')"><?=$lose?></a>
					  </td>

                    </tr>
<?
$no--;
}?>
<?if(!$total){?>
					<tr>
                      <td colspan="5">데이타가 없습니다.</td>
                    </tr>
<?}?>
                  </tbody>
                </table>
</form>
              </div>
    <!-- GRID E-->
       
     

<!-- page_skip -->
<div class="page_skip_area">
	<div class="page_skip">
		<?if($f_no!=1){?><a href="<?=$PHP_SELF?>?mode=<?=$mode?>&page=<?=$p_f_no?>&f_no=<?=$p_f_no?>&multi=<?=$multi?>&ord=<?=$ord?>&s_key=<?=$s_key?>&s_word=<?=$s_word?>&start_date=<?=$start_date?>&end_date=<?=$end_date?>&SHOP_CODE=<?=$SHOP_CODE?>&spa=<?=$spa?>&sq=<?=$sq?>&sq2=<?=$sq2?>&cate1=<?=$cate1?>&cate2=<?=$cate2?>&start_date2=<?=$start_date2?>&end_date2=<?=$end_date2?>&IMGVOD_FLAG=<?=$IMGVOD_FLAG?>"><img src="/admin_page/images/btn_prev02.gif" alt="이전 목록" class="btn01" /></a><?}?>

				<? for($i=$f_no;$i<=$l_no;$i++){?>
					<?if($i==$page){?>
						<strong><?=$i?></strong>&nbsp;
					<?} else {?>
						<a href="<?=$PHP_SELF?>?mode=<?=$mode?>&page=<?=$i?>&f_no=<?=$f_no?>&multi=<?=$multi?>&sort=<?=$sort?>&s_key=<?=$s_key?>&s_word=<?=$s_word?>&start_date=<?=$start_date?>&end_date=<?=$end_date?>&SHOP_CODE=<?=$SHOP_CODE?>&spa=<?=$spa?>&sq=<?=$sq?>&sq2=<?=$sq2?>&cate1=<?=$cate1?>&cate2=<?=$cate2?>&start_date2=<?=$start_date2?>&end_date2=<?=$end_date2?>&IMGVOD_FLAG=<?=$IMGVOD_FLAG?>">
						<?=$i?>&nbsp;</a>
					<?}?>
				<?}?>

		<?if($l_no<$total_page){?><a href="<?=$PHP_SELF?>?mode=<?=$mode?>&page=<?=$n_f_no?>&f_no=<?=$n_f_no?>&multi=<?=$multi?>&ord=<?=$ord?>&s_key=<?=$s_key?>&s_word=<?=$s_word?>&start_date=<?=$start_date?>&end_date=<?=$end_date?>&SHOP_CODE=<?=$SHOP_CODE?>&spa=<?=$spa?>&sq=<?=$sq?>&sq2=<?=$sq2?>&cate1=<?=$cate1?>&cate2=<?=$cate2?>&start_date2=<?=$start_date2?>&end_date2=<?=$end_date2?>&IMGVOD_FLAG=<?=$IMGVOD_FLAG?>"><img src="/admin_page/images/btn_next02.gif" alt="다음 목록" class="btn02" /></a><?}?>


	</div>       
</div>     
  <!-- 메인메뉴 E -->

<script>

  $("#checkAll").on("click",function(){
	   var _value = $(this).is(":checked");
	   $('input:checkbox[id="chkId"]').each(function () { 
	    this.checked = _value; 
	   });
  });


function sdForm(n){

	a=document.pf;

	if(confirm('삭제하시겠습니까?')){

	a.gubun.value=n;

	a.submit();

	}

}
</script>
<script>
function catesel(CATEGORY_ID){

	var params = "CATEGORY_ID="+CATEGORY_ID;
	$.ajax({
		  type: 'get'
		, url: 'cate_ajax.php'
		,data : params
		, dataType : 'html'
		, success: function(data) {
			$("#t2").html(data);
		  }
	});	
}
</script>

<?php include $_SERVER["DOCUMENT_ROOT"]."/admin_page/inc/bot.php";
?>