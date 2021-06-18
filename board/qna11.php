<?php include $_SERVER["DOCUMENT_ROOT"]."/admin_page/inc/top.php";

$sq=$_GET['sq']??"none";
$mode=$_GET['mode'];
$s_key=$_GET['s_key'];
$s_word=$_GET['s_word'];
$m1=$_GET['m1'];
$m2=$_GET['m2'];
$m3=$_GET['m3'];
$mobile=$m1.$m2.$m3;
$GUBUN=$_GET['GUBUN']??"all";
$REPLY_YN=$_GET['REPLY_YN']??"all";
$service_product=$_GET['service_product']??json_decode(urldecode($_GET['spa']));
//print_r($service_product);
$spa=urlencode(json_encode($service_product));

$d7=date("Y-m-d", mktime(date("H"), date("i"), date("s"), date("m"), date("d")-7, date("Y")));
$d14=date("Y-m-d", mktime(date("H"), date("i"), date("s"), date("m"), date("d")-14, date("Y")));
$today=date("Y-m-d");

$start_date=$_GET['start_date'];
$end_date=$_GET['end_date'];

$start_date2=$_GET['start_date2'];
$end_date2=$_GET['end_date2'];

if(!$mode and !$start_date){
//	$start_date=$d7;
}

if(!$mode and !$end_date){
//	$end_date=$today;
}


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

			  // 1년 가져오기
			function get1YearDay(){
				var today = new Date();
				var month = today.getMonth()+1;
				var day = today.getDate();
				var year = today.getFullYear()-1;
				 if (day<10)  day = '0'+day;
				 if (month<10)  month = '0'+month;
				return year + '-' + month + '-' + day ;
			}

			$('.tt').on('click', function() {
				var val = $(this).attr('val');
				var today = getToday();
				var start = '';

				

				$(".button06").addClass("button05").removeClass("button06");

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
					case 'year1':
						start = get1YearDay();
					break;
					case 'none':
						start = "";
						today="";
					break;

				}

					$('#start_date').val(start);
					$('#end_date').val(today);
					$('#sq').val(val);
					
					if(val=='sa'){
						$('#aa').val(1);
					}

			});

		});

		$.addDays = function(day) {
			var val = $(this).val();
			return new Date(val + day * 24 * 60 * 60 * 1000 );
		};
</script>
<!-- 메인메뉴 S -->
    <div id="wrap_tmall_content">
     
     <ul class="top_title_area">
       <li class="top_title">문의관리 > 1:1 문의관리</li>
     </ul>
     
    
    <!-- 조회영역 S -->
       <div class="search_area">
   	     <div class="search_box">

<form method="get" action="<?=$_SERVER['PHP_SELF']?>" name="sf">
<input type="hidden" name="mode" value="up">
<input type="hidden" name="sq" id="sq" value="<?=$sq?>">


   	       <table>
			     	       <colgroup>
                           <col width="170" />
                           <col width="88" />
                           <col width="*" />
                           </colgroup>
							 <tr>
                               <td scope="col" class="title1">검색분류</td>
                               <td>
									<select name="s_key">
										<option value="EMAIL"<?if($s_key=="EMAIL"){?> selected<?}?>>이메일</option>
										<option value="TITLE"<?if($s_key=="TITLE"){?> selected<?}?>>제목</option>
										<option value="CONTENTS"<?if($s_key=="CONTENTS"){?> selected<?}?>>내용</option>
									</select>
									<input type="text"  name="s_word" value="<?=$s_word?>" size="50">
                              </td>
                               <td style="padding-left:30px;">
                              </td>
                             </tr>
                      
                             <tr>
                               <td scope="col" class="title1">등록일자</td>
                               <td>
                                <div class="input_area">
								<input type="text" name="start_date" id="start_date" title="입력" class="input_form01"  style="width:80px;"  value="<?=$start_date?>" />
								 ~
								<input type="text" name="end_date" id='end_date' title="입력" class="input_form01" style="width:80px;"  value="<?=$end_date?>" />                               
								</div>                
								</td>
                               <td>
                                <div class="midle_bu_area ml20">
                                  <ul class="left_bu_area">
									<li><a <?if($sq=="today"){?>class="tt button06"<?}else{?>class="tt button05"<?}?> href="javascript:;" id='today' val='today'>오늘</a></li>
									<li><a <?if($sq=="lastweek"){?>class="tt button06"<?}else{?> class="tt button05"<?}?> href="javascript:;" val='lastweek'>~1주일</a></li>
									<li><a <?if($sq=="lastmonth"){?>class="tt button06"<?}else{?> class="tt button05"<?}?> href="javascript:;" val='lastmonth'>~1개월</a></li>
									<li><a <?if($sq=="month3"){?>class="tt button06"<?}else{?> class="tt button05"<?}?> href="javascript:;" val='month3'>~3개월</a></li>
									<li><a <?if($sq=="month6"){?>class="tt button06"<?}else{?> class="tt button05"<?}?> href="javascript:;" val='month6'>~6개월</a></li>
									<li><a <?if($sq=="year1"){?>class="tt button06"<?}else{?> class="tt button05"<?}?> href="javascript:;" val='year1'>~1년</a></li>
									<li><a <?if($sq=="none"){?>class="tt button06"<?}else{?> class="tt button05"<?}?> href="javascript:;" val='none'>전체</a></li>
								</ul>
                                 </div>                               </td>
                             </tr>


							 <tr>
                               <td scope="col" class="title1">처리상태</td>
                               <td>
									<input type="radio" name="REPLY_YN" value="all"  <?if($REPLY_YN=="all"){?> checked<?}?>>전체&nbsp;
									<input type="radio" name="REPLY_YN" value="N" <?if($REPLY_YN=="N"){?> checked<?}?>>처리중&nbsp;
									<input type="radio" name="REPLY_YN" value="Y" <?if($REPLY_YN=="Y"){?> checked<?}?>>처리완료&nbsp;
                              </td>
                               <td style="text-align:right;">
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
	$que3="select count(1) from inquiry where 1=1";
	$result3 = $mysqli->query($que3) or die("1:".$mysqli->error);
	$rs3 = $result3->fetch_array();
	$total_inquiry=$rs3[0];

	if($s_key && $s_word){
		$where=" and $s_key like '%".$s_word."%'";
	}

	if($REPLY_YN!="all"){
		$where.=" and REPLY_YN='".$REPLY_YN."'";
	}

	if($mode=="up" and $start_date and $end_date){
		$where.=" and REG_DATE between '".$start_date."' and '".$end_date." 23:59:59'";
	}

	if(!$order){
		$order=" order by INQUIRY_ID desc";
	}

	$LIMIT=$_GET['LIMIT']??30;
	$page=$_GET['page']??1;


	$que2="select count(1) from inquiry where 1=1";
	$que2.=$where;
	$result2 = $mysqli->query($que2) or die("1:".$mysqli->error);
	$rs2 = $result2->fetch_array();
	$total=$rs2[0];
?>
       <!-- sub title영역 S -->
      <div class="sub_title_area">
      <dl>
       <dt>총 게시물수 <?echo number_format($total_inquiry);?>건  |  검색결과    <?echo number_format($total);?>건</dt>
       <dd>
	   
	   </dd>
      </dl>
      </div>
       <!-- sub title영역 E -->
       
     
              <!-- GRID S-->
              <div class="gridTable_list01">
                <table width="100%" border="0" >

                  <colgroup>
                  <col width=5%/>
                  <col width="*"/>
                  <col width=10% />
                  <col width=10%/>
                  <col width=10%/>
                  <col width=10% />
                  </colgroup>
                  <thead>
                    <tr>
                      <th scope="col">NO</th>
					  <th scope="col">제목</th>
                      <th scope="col">이메일</th>
                      <th scope="col">아이디</th>
					  <th scope="col">처리여부</th>
					  <th scope="col">등록일</th>
                    </tr>
                  </thead>
                  <tbody>
<?

//페이징
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


	$limit_query=" limit $start_page, $end_page";
	$que="select * 
	from inquiry  where 1=1";
	$que.=$where;
	$que.=$order;
	$que.=$limit_query;
//	echo $que;
	$result = $mysqli->query($que) or die("2:".$mysqli->error);
	while($rs = $result->fetch_object()){
			$rsc[]=$rs;
	}


foreach($rsc as $p){
?>
                    <tr onclick="window.open('iq_up.php?INQUIRY_ID=<?=$p->INQUIRY_ID?>','q1','width=800,height=600,scrollbars=yes')" style="cursor:pointer;">
                      <td><?=$no?></td>
                      <td class="pl20"><?=$p->TITLE?></td>
                      <td><?=$p->EMAIL?></td>
                      <td><?=$p->ID?></td>
					  <td><?if($p->REPLY_YN=="Y"){?>처리완료<?}else{?>처리중<?}?></td>
					  <td><?=$p->REG_DATE?></td>
                    </tr>
<?
$no--;
}?>
                  </tbody>
                </table>
              </div>
    <!-- GRID E-->
       
     

<!-- page_skip -->
<div class="page_skip_area">
	<div class="page_skip">
		<?if($f_no!=1){?><a href="<?=$PHP_SELF?>?mode=<?=$mode?>&page=<?=$p_f_no?>&f_no=<?=$p_f_no?>&multi=<?=$multi?>&ord=<?=$ord?>&s_key=<?=$s_key?>&s_word=<?=$s_word?>&start_date=<?=$start_date?>&end_date=<?=$end_date?>&SUBJECT=<?=$SUBJECT?>&REPLY_YN=<?=$REPLY_YN?>&gubun=<?=$gubun?>"><img src="/admin_page/images/btn_prev02.gif" alt="이전 목록" class="btn01" /></a><?}?>

				<? for($i=$f_no;$i<=$l_no;$i++){?>
					<?if($i==$page){?>
						<strong><?=$i?></strong>&nbsp;
					<?} else {?>
						<a href="<?=$PHP_SELF?>?mode=<?=$mode?>&page=<?=$i?>&f_no=<?=$f_no?>&multi=<?=$multi?>&sort=<?=$sort?>&s_key=<?=$s_key?>&s_word=<?=$s_word?>&start_date=<?=$start_date?>&end_date=<?=$end_date?>&SUBJECT=<?=$SUBJECT?>&REPLY_YN=<?=$REPLY_YN?>&gubun=<?=$gubun?>">
						<?=$i?>&nbsp;</a>
					<?}?>
				<?}?>

		<?if($l_no<$total_page){?><a href="<?=$PHP_SELF?>?mode=<?=$mode?>&page=<?=$n_f_no?>&f_no=<?=$n_f_no?>&multi=<?=$multi?>&ord=<?=$ord?>&s_key=<?=$s_key?>&s_word=<?=$s_word?>&start_date=<?=$start_date?>&end_date=<?=$end_date?>&SUBJECT=<?=$SUBJECT?>&REPLY_YN=<?=$REPLY_YN?>&gubun=<?=$gubun?>"><img src="/admin_page/images/btn_next02.gif" alt="다음 목록" class="btn02" /></a><?}?>


	</div>       
</div>     
  <!-- 메인메뉴 E -->


<?php include $_SERVER["DOCUMENT_ROOT"]."/admin_page/inc/bot.php";
?>