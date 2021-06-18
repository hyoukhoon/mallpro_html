<?php include $_SERVER["DOCUMENT_ROOT"]."/admin_page/inc/top.php";
include $_SERVER["DOCUMENT_ROOT"]."/admin_page/product/product_lib.php";

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
<script src="/inc/jquery.simplemodal.js" type="text/javascript"></script>
<script src="/inc/ProgressBar.js" type="text/javascript"></script> 
<script>
var progressbar = new Object();
progressbar.enable = true; // 사용여부
progressbar.image = "/image/loading2.gif"; // 사용할 이미지 파일
/* Progress Bar 함수 */
function Progressbar() {
    if (progressbar.enable) {
        $("#imgProgressbar").modal({
            overlayCss: { "background-color": "#000", "cursor": "wait" },
            containerCss: { "background-color": "#fff", "border": "0px solid #ccc" },
            close: false,
            closeHTML: ''
        });
    }
}
    
$(function(){
    // 크롬과 사파리에서 beforeunload 이벤트가 실행되는 동안
    // 동적으로 생성된 img 엘리먼트가가 정상적으로 로딩되지 않아 미리 img 엘리먼트를 생성한다. 
    $("body").append('<img id ="imgProgressbar" src="' + progressbar.image + '" alt="progressbar" />');
     $("#imgProgressbar").hide();
     $.modal.close();
    
    // IE에서 애니메이션 gif가 멈춰있는 현상으로 인하여 setTimeout을 이용하여 Progressbar function 실행
    $(window).bind("beforeunload", function(){  setTimeout("Progressbar()", 0);});
});
</script>
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
       <li class="top_title">상품관리 > 상품관리</li>
	   <div class="midle_bu_area ml20">
			<ul class="left_bu_area">
			<li ><button type="button" class="button05" id="add1" onclick="window.open('product_up.php','s1','width=1200,height=800,scrollbars=yes')">+상품등록</button></li>
			
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
                               <td scope="col" class="title1">검색분류</td>
                               <td>
									<select name="s_key">
										<option value="PRODUCT_NAME" <?if($s_key=="PRODUCT_NAME"){?>selected<?}?>>상품명</option>
										<option value="PRODUCT_CODE" <?if($s_key=="PRODUCT_CODE"){?>selected<?}?>>상품코드</option>
										<option value="ADMIN" <?if($s_key=="ADMIN"){?>selected<?}?>>매장명</option>
									</select>
									&nbsp;&nbsp;
									<input type="text" name="s_word" value="<?=$s_word?>">
                              </td>
                               <td style="padding-left:30px;">
								*상가명 
									<select name="SHOP_CODE">
										<option value="">전체</option>
										<?echo shop_code_val('ko',$SHOP_CODE);?>
									</select>
                              </td>
                             </tr>
							 <tr>
                               <td scope="col" class="title1">카테고리</td>
                               <td>
									<select name="cate1" onchange="catesel(this.value)">
										<option value="">대분류</option>
										<?
												$que3="select CATEGORY_ID,CATEGORY_NAME from category_info where DEPTH='0' and CATEGORY_USE='1' order by LEVEL1 asc";
												$result3 = $mysqli->query($que3) or die("3:".$mysqli->error);
												while($rs3 = $result3->fetch_object()){
											?>
												<option value="<?=$rs3->CATEGORY_ID?>" <?if($rs3->CATEGORY_ID==$cate1){?> selected<?}?>><?=$rs3->CATEGORY_NAME?></option>
											<?}?>
									</select>
									&nbsp;&nbsp;
									<span id="t2">
									<select name="cate2">
										<option value="">세분류</option>
										<?
											if($cate1){
												$cid=substr($cate1,0,3);
												$que3="select CATEGORY_ID,CATEGORY_NAME from category_info where DEPTH='1' and CATEGORY_USE='1' and left(CATEGORY_ID,3)='".$cid."' order by LEVEL2 asc";
												$result3 = $mysqli->query($que3) or die("3:".$mysqli->error);
												while($rs3 = $result3->fetch_object()){
											?>
												<option value="<?=$rs3->CATEGORY_ID?>" <?if($rs3->CATEGORY_ID==$cate2){?> selected<?}?>><?=$rs3->CATEGORY_NAME?></option>
											<?}
									}
											?>
									</select>
									</span>
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
                               <td scope="col" class="title1">진열기간</td>
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
									<li><a <?if($sq=="none"){?>class="tt button06"<?}else{?> class="tt button05"<?}?> href="javascript:;" val='none'>전체</a></li>

								</ul>
                                 </div>                               </td>
                             </tr>

							 <tr>
                               <td scope="col" class="title1">등록상태</td>
                               <td>
									<input type="checkbox" id="disp1" name="DYN[]" onclick="scheck_none();" value="0" <?if(!$DYN || in_array("0",$DYN)){?> checked<?}?>>전체&nbsp;
									<input type="checkbox" id="disp2" name="DYN[]" onclick="scheck_none1();" value="1" <?if(in_array("1",$DYN)){?> checked<?}?>>진열중&nbsp;
									<input type="checkbox" id="disp3" name="DYN[]" onclick="scheck_none1();" value="2" <?if(in_array("2",$DYN)){?> checked<?}?>>진열마감&nbsp;
									<input type="checkbox" id="disp4" name="DYN[]" onclick="scheck_none1();" value="3" <?if(in_array("3",$DYN)){?> checked<?}?>>진열안함&nbsp;
                              </td>
                               <td style="padding-left:30px;">
								*상품파일 
								<input type="radio" name="IMGVOD_FLAG" value="all" <?if($IMGVOD_FLAG=="all"){?>checked<?}?>>전체&nbsp;
								<input type="radio" name="IMGVOD_FLAG" value="1" <?if($IMGVOD_FLAG=="1"){?>checked<?}?>>동영상포함상품&nbsp;
								<input type="radio" name="IMGVOD_FLAG" value="0" <?if($IMGVOD_FLAG=="0"){?>checked<?}?>>동영상미포함상품&nbsp;
                              </td>
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
	$que3="select count(1) from product where IS_DELETE='0'";
	$result3 = $mysqli->query($que3) or die("1:".$mysqli->error);
	$rs3 = $result3->fetch_array();
	$total_product=$rs3[0];

	if($s_key && $s_word){
		if($s_key=="ADMIN"){
			$where=" and ADMIN in (select SELLER_CODE from seller where SNAME like '%".$s_word."%')";
		}else{
			$where=" and $s_key like '%".$s_word."%'";
		}
	}

	if($SHOP_CODE){
		$where.=" and ADMIN in (select SELLER_CODE from seller where SHOP_CODE='".$SHOP_CODE."')";
	}

	if($cate1 && !$cate2){
		$cate1=substr($cate1,0,3);
		$where.=" and PRODUCT_ID in (select PRODUCT_ID from category_relation where left(CATEGORY_ID,3)='".$cate1."')";
	}

	if($cate2){
		$cate2=substr($cate2,0,6);
		$where.=" and PRODUCT_ID in (select PRODUCT_ID from category_relation where left(CATEGORY_ID,6)='".$cate2."')";
	}

	if(in_array("1",$DYN)){
		$wh1="DISPLAY_YN='Y'";
	}

	if(in_array("2",$DYN)){
		$wh2="DISPLAY_END_DATE<'".$today."'";
	}

	if(in_array("3",$DYN)){
		$wh3=" DISPLAY_YN='N'";
	}

	if($wh1 and !$wh2 and !$wh3){
		$where.=" and $wh1";
	}

	if(!$wh1 and $wh2 and !$wh3){
		$where.=" and $wh2";
	}

	if(!$wh1 and !$wh2 and $wh3){
		$where.=" and $wh3";
	}

	if($wh1 and $wh2 and !$wh3){
		$where.=" and ($wh1 or $wh2)";
	}

	if(!$wh1 and $wh2 and $wh3){
		$where.=" and ($wh2 or $wh3)";
	}

	if($wh1 and !$wh2 and $wh3){
		$where.=" and ($wh1 or $wh3)";
	}

//	if($wh1 and $wh2 and $wh3){
//		$where.=" and ($wh1 or $wh2 or $wh3)";
//	}

	

	if($IMGVOD_FLAG!="all"){
		//USE_FLAG : 0:모바일, 1:사이니지
		//IMGVOD_FLAG : 0:이미지파일, 1:동영상파일,2:동영상 스틸컷 이미지,3:썸네일이미지,4:스틸컷을 축소한 이미지
		$where.=" and PRODUCT_ID in (select PRODUCT_ID from product_file_info where USE_FLAG='0' and DEL_FLAG
='0' and IMGVOD_FLAG='".$IMGVOD_FLAG."')";
	}

	if($mode=="up" and $start_date and $end_date){
		$where.=" and DISPLAY_START_DATE>='".$start_date."' and DISPLAY_END_DATE<='".$end_date." 23:59:59'";
	}

	if($mode=="up" and $start_date2 and $end_date2){
		$where.=" and REGDATE between '".$start_date2."' and '".$end_date2." 23:59:59'";
	}





	if(!$order){
		$order=" order by PRODUCT_ID desc";
	}

	$LIMIT=$_GET['LIMIT']??30;
	$page=$_GET['page']??1;


	$que2="select count(1) from product where IS_DELETE='0'";
	$que2.=$where;
	$result2 = $mysqli->query($que2) or die("2:".$mysqli->error);
	$rs2 = $result2->fetch_array();
	$total=$rs2[0];
?>
       <!-- sub title영역 S -->
      <div class="sub_title_area">
      <dl>
       <dt>총상품건수 <?echo number_format($total_product);?>건  |  검색결과    <?echo number_format($total);?>건</dt>
       <dd>
	   
	   <div class="midle_bu_area ml20">
		  <ul class="left_bu_area">
			<li style="vertical-align:text-bottom;">선택한 상품을 </li>
			<li><a class="button05" href="javascript:;" id='c1' val='cc' onclick="rewrite()">다시등록</a></li>
			<li><a class="button05" href="javascript:;" id='c2' val='ds' onclick="sdForm(2)">진열함</a></li>
			<li><a class="button05" href="javascript:;" id='c3' val='nd' onclick="sdForm(3)">진열안함</a></li>
			<li><a class="button05" href="javascript:;" id='c4' val='dd' onclick="sdForm(4)">삭제</a></li>
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
                  <col width=3%/>
                  <col width=5%/>
                  <col width=9%/>
                  <col width="*"/>
                  <col width=10% />
                  <col width=10%/>
                  <col width=10%/>
                  <col width=10%/>
                  <col width=9% />
                  <col width=5% />
                  <col width=5% />
                  </colgroup>
                  <thead>
                    <tr>
                      <th scope="col"><input type="checkbox" id="checkAll"></th>
                      <th scope="col">NO</th>
					  <th scope="col">상품코드</th>
                      <th scope="col">상품정보</th>
                      <th scope="col">매장명</th>
                      <th scope="col">가격</th>
                      <th scope="col">등록(수정)일</th>
                      <th scope="col">진열상태</th>
					  <th scope="col">진열기간</th>
					  <th scope="col">조회수</th>
					  <th scope="col">찜수</th>
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
	from product  where  IS_DELETE='0'";
	$que.=$where;
	$que.=$order;
	$que.=$limit_query;
//	echo $que;
	$result = $mysqli->query($que) or die("3:".$mysqli->error);
	while($rs = $result->fetch_object()){
			$rsc[]=$rs;
	}


foreach($rsc as $p){

	$cn=category_is('ko',$p->PRODUCT_ID);
	if(!$cn[1]){
		$cn=array("카테고리없음","카테고리없음");
	}


if($p->ETC3){
	$que12="select count(1) from ptest_file where pnum='$p->ETC3'";
	$result12 = $mysqli->query($que12) or die("12:".$mysqli->error);
	$rs12 = $result12->fetch_array();
	$que14="select count(1),FILEPATH from product_file_info where PRODUCT_ID='$p->PRODUCT_ID' and DEL_FLAG='0' and IMGVOD_FLAG in (0,1)";
	$result14 = $mysqli->query($que14) or die("14:".$mysqli->error);
	$rs14 = $result14->fetch_array();
	
	$path=$rs14[1];
//	echo $path."<br>";
}
		$que15="select FILENM_SYS from product_file_info where PRODUCT_ID='$p->PRODUCT_ID' and DEL_FLAG='0' and IMGVOD_FLAG='0'";
		$result15 = $mysqli->query($que15) or die("15:".$mysqli->error);
        while($rs15 = $result15->fetch_array()) {
                $img[] = $rs15[0];
        }

//        for($i=0;$i<sizeof($img);$i++) {
//                if(!file_exists($_SERVER['DOCUMENT_ROOT'].$path."T_".$img[$i])) { 
//                        resizeimage(720,$_SERVER['DOCUMENT_ROOT'].$path."T_".$img[$i],$_SERVER['DOCUMENT_ROOT'].$path.$img[$i]); 
//                        set_time_limit(10);
//                        flush();
//               }                
//        }
?>
                    <tr >
                      <td><input type="checkbox" name="num[]" id="chkId" value="<?=$p->PRODUCT_ID?>"></td>
                      <td><?=$no?><?if($rs12[0]!=$rs14[0]){?>//<font color="red">오류</font><?}?></td>
                      <td><a href="javascript:;" onclick="window.open('product_up.php?PRODUCT_ID=<?=$p->PRODUCT_ID?>','s<?=$no?>','width=1300,height=800,scrollbars=yes')"><?=$p->PRODUCT_CODE?></td>
                      <td class="pl20"><img src="/<?echo thumb_is($p->PRODUCT_ID);?>" width="30"><a href="javascript:;" onclick="window.open('product_up.php?PRODUCT_ID=<?=$p->PRODUCT_ID?>','s<?=$no?>','width=1300,height=800,scrollbars=yes')"><?=$p->PRODUCT_NAME?> :  <?echo $cn[0];?> > <?echo $cn[1];?></a></td>
                      <td><?echo seller_name_is('ko',$p->ADMIN);?></td>
                      <td><?echo number_format($p->WHOLESALE_PRICE);?></td>
                      <td><?=$p->REGDATE?></td>
					  <td><?if($p->DISPLAY_YN=="Y" && $p->DISPLAY_END_DATE>=$today){?>진열중<?}else{?>진열마감<?}?></td>
					  <td><?=$p->DISPLAY_START_DATE?> ~ <?=$p->DISPLAY_END_DATE?></td>
					  <td><?=$p->VIEW_CNT?></td>
					  <td><?=$p->WISH_CNT?></td>
                    </tr>
<?
$no--;
}?>
<?if(!$total){?>
					<tr>
                      <td colspan="11">데이타가 없습니다.</td>
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

	if(n==2){
		var msg="진열하시겠습니까?";
	}else if(n==3){
		var msg="진열 안하시겠습니까?";
	}else if(n==4){
		var msg="삭제하시겠습니까?";
	}

	if(confirm(msg)){

	a.gubun.value=n;

	a.submit();

	}

}

function rewrite(){

	a=document.pf;

	a.action='rewrite.php';

	a.submit();



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