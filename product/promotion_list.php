<?php include $_SERVER["DOCUMENT_ROOT"]."/admin_page/inc/top.php";

$d7=date("Y-m-d", mktime(date("H"), date("i"), date("s"), date("m"), date("d")-7, date("Y")));
$d14=date("Y-m-d", mktime(date("H"), date("i"), date("s"), date("m"), date("d")-14, date("Y")));
$today=date("Y-m-d");

$start_date=$_GET['start_date'];
$end_date=$_GET['end_date'];

$start_date2=$_GET['start_date2'];
$end_date2=$_GET['end_date2'];

if(!$start_date){
	$start_date=$d7;
}

if(!$end_date){
	$end_date=$today;
}

if(!$start_date2){
	$start_date2=$d7;
}

if(!$end_date2){
	$end_date2=$today;
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
       <li class="top_title">상품관리 > 프로모션관리</li>
	   <div class="midle_bu_area ml20">
			<ul class="left_bu_area">
			<li ><button type="button" class="button05" id="add1">+프로모션등록</button></li>
			</ul>
		</div>
     </ul>
     
    
    <!-- 조회영역 S -->
       <div class="search_area">
					
   	     <div class="search_box">
   	       <table>
			     	       <colgroup>
                           <col width="170" />
                           <col width="88" />
                           <col width="*" />
                           </colgroup>
						   <tr>
                               <td scope="col" class="title1">프로모션타입</td>
                               <td>
									<input type="radio" name="pmtype" value="0" checked>전체&nbsp;
									<input type="radio" name="pmtype" value="1">매장종합&nbsp;
									<input type="radio" name="pmtype" value="2">매장단독&nbsp;
									<input type="radio" name="pmtype" value="3">DCG단독&nbsp;
                              </td>
                               <td style="padding-left:30px;">

                              </td>
                             </tr>
							 <tr>
                               <td scope="col" class="title1">프로모션명</td>
                               <td>
									<input type="text" name="promotion_name" size="50">
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
									<li><a <?if($sq=="today"){?>class="button06"<?}else{?>class="button05"<?}?> href="javascript:;" id='today' val='today'>오늘</a></li>
									<li><a <?if($sq=="lastweek"){?>class="button06"<?}else{?> class="button05"<?}?> style="color:red;" href="javascript:;" val='lastweek'>~1주일</a></li>
									<li><a <?if($sq=="lastmonth"){?>class="button06"<?}else{?> class="button05"<?}?> href="javascript:;" val='lastmonth'>~1개월</a></li>
									<li><a <?if($sq=="month3"){?>class="button06"<?}else{?> class="button05"<?}?> href="javascript:;" val='month3'>~3개월</a></li>
									<li><a <?if($sq=="month6"){?>class="button06"<?}else{?> class="button05"<?}?> href="javascript:;" val='month6'>~6개월</a></li>

								</ul>
                                 </div>                               </td>
                             </tr>

							 <tr>
                               <td scope="col" class="title1">진열기간</td>
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
									<li><a <?if($sq=="today"){?>class="button06"<?}else{?>class="button05"<?}?> href="javascript:;" id='today' val='today'>오늘</a></li>
									<li><a <?if($sq=="lastweek"){?>class="button06"<?}else{?> class="button05"<?}?> style="color:red;" href="javascript:;" val='lastweek'>~1주일</a></li>
									<li><a <?if($sq=="lastmonth"){?>class="button06"<?}else{?> class="button05"<?}?> href="javascript:;" val='lastmonth'>~1개월</a></li>
									<li><a <?if($sq=="month3"){?>class="button06"<?}else{?> class="button05"<?}?> href="javascript:;" val='month3'>~3개월</a></li>
									<li><a <?if($sq=="month6"){?>class="button06"<?}else{?> class="button05"<?}?> href="javascript:;" val='month6'>~6개월</a></li>

								</ul>
                                 </div>                               </td>
                             </tr>

							 <tr>
                               <td scope="col" class="title1">노출상태</td>
                               <td>
									<input type="checkbox" name="st" value="0">전체&nbsp;
									<input type="checkbox" name="st" value="1" checked>노출중&nbsp;
									<input type="checkbox" name="st" value="2">노출종료&nbsp;
									<input type="checkbox" name="st" value="3">노출안함&nbsp;
                              </td>
                               <td style="padding-left:30px;">
								*파일형태 
								<input type="radio" name="pf" value="0" checked>전체&nbsp;
								<input type="radio" name="pf" value="1">동영상포함상품&nbsp;
								<input type="radio" name="pf" value="2">동영상미포함상품&nbsp;
                              </td>
                             </tr>
           </table>
                         
           
   	     </div>
	      </div>
     
     
      <!-- 조회영역 E -->
      
     
     
       <!-- sub title영역 S -->
      <div class="sub_title_area">
      <dl>
       <dt>총 프로모션건수 2건  |  검색결과    0건</dt>
       <dd>
	   
	   <div class="midle_bu_area ml20">
		  <ul class="left_bu_area">
			<li style="vertical-align:text-bottom;">선택한 상품을 </li>
			<li><a class="button05" href="javascript:;" id='c1' val='ds'>노출함</a></li>
			<li><a class="button05" href="javascript:;" id='c2' val='nd'>노출안함</a></li>
			<li><a class="button05" href="javascript:;" id='c3' val='dd'>삭제</a></li>
		</ul>
		 </div>
	   
	   </dd>
      </dl>
      </div>
       <!-- sub title영역 E -->
       
     
              <!-- GRID S-->
              <div class="gridTable_list01">
                <table width="100%" border="0" >

                  <colgroup>
                  <col width=3%/>
                  <col width=5%/>
                  <col width="*"/>
                  <col width=10% />
                  <col width=10%/>
                  <col width=10%/>
                  <col width=10%/>
                  <col width=10% />
                  </colgroup>
                  <thead>
                    <tr>
                      <th scope="col"><input type="checkbox"></th>
                      <th scope="col">NO</th>
					  <th scope="col">프로모션명</th>
                      <th scope="col">프로모션타입</th>
                      <th scope="col">노출상태</th>
					  <th scope="col">노출기간</th>
					  <th scope="col">등록일</th>
                    </tr>
                  </thead>
                  <tbody>
                    <tr>
                      <td><input type="checkbox"></td>
                      <td>0</td>
                      <td class="pl20">Women>메인동영상</td>
                      <td>상품</td>
                      <td>체크 BBY Women>자켓/코트</td>
					  <td>2017-03-21 ~ 2017-12-31</td>
					  <td>2017-03-21</td>
                    </tr>
       
                      <tr>
                      <td><input type="checkbox"></td>
                      <td>0</td>
                      <td class="pl20">Women>메인동영상</td>
                      <td>상품</td>
                      <td>체크 BBY Women>자켓/코트</td>
					  <td>2017-03-21 ~ 2017-12-31</td>
					  <td>2017-03-21</td>
                    </tr>
                  </tbody>
                </table>
              </div>
    <!-- GRID E-->
       
     

       <!-- page_skip -->
<div class="page_skip_area">
<div class="page_skip">
  <a href="#"><img src="/admin_page/images/btn_prev02.gif" alt="이전 목록" class="btn01" /></a>   
   <strong>11</strong>  <a href="#">12</a>  <a href="#">13</a>  <a href="#">14</a> <a href="#">15</a>  <a href="#">16</a>  <a href="#">17</a>  <a href="#">18</a>  <a href="#">19</a> <a href="#">20</a> 
  <a href="#"><img src="/admin_page/images/btn_next02.gif" alt="다음 목록" class="btn02" /></a>  

</div>       
    </div>     
  <!-- 메인메뉴 E -->


<?php include $_SERVER["DOCUMENT_ROOT"]."/admin_page/inc/bot.php";
?>