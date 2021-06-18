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
       <li class="top_title">환경설정 > 메인메뉴관리</li>
	   <!-- <div class="midle_bu_area ml20">
			<ul class="left_bu_area">
			<li ><button type="button" class="button05" id="add1">+프로모션등록</button></li>
			</ul>
		</div> -->
     </ul>
     
    
     
     
       <!-- sub title영역 S -->
      <div class="sub_title_area">
      <dl>
       <button type="button" style="width:25px;height:25px;font-size:13px;line-height:25px; font-weight:bold; color:black;background-color:#f3f3f3">▼</button>
	   <button type="button" style="width:25px;height:25px;font-size:13px;line-height:25px; font-weight:bold; color:black;background-color:#f3f3f3">▲</button>
	   
       <dd>
	   
	   <div class="midle_bu_area ml20">
		  <ul class="left_bu_area">
			<li><button type="button" style="width:80px;height:25px;margin:0 4px; font-size:13px;line-height:26px; font-weight:bold; color:white;background-color:#3f3f3f">편집완료</button></li>
			<li><button type="button" style="width:80px;height:25px;margin:0 4px; font-size:13px;line-height:26px; font-weight:bold; color:white;background-color:#3f3f3f">리셋</button></li>
			<li><button type="button" style="width:80px;height:25px;margin:0 4px; font-size:13px;line-height:26px; font-weight:bold; color:white;background-color:#3f3f3f">추가</button></li>
			<li><button type="button" style="width:80px;height:25px;margin:0 4px; font-size:13px;line-height:26px; font-weight:bold; color:white;background-color:#3f3f3f">삭제</button></li>
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
                  <col width=5%/>
                  <col width=5%/>
                  <col width="*"/>
                  <col width=10% />
                  <col width=10%/>

                  </colgroup>
                  <thead>
                    <tr>
                      <th scope="col">순서</th>
					  <th scope="col">메뉴코드</th>
                      <th scope="col">메뉴명(한국어)</th>
					  <th scope="col">메뉴명(중국어)</th>
					  <th scope="col">메뉴명(영어)</th>
					  <th scope="col">카테고리</th>
                    </tr>
                  </thead>
                  <tbody>
                    <tr>
                      <td>0</td>
                      <td>0010000000000000</td>
                      <td class="pl20">Todaypick</td>
					  <td>请您输入其他内容。</td>
					  <td></td>
					  <td>
						<select name="sel">
							<option value="">선택</option>
							<option value="Women">Women</option>
							<option value="Men">Men</option>
							<option value="Kids">Kids</option>
							<option value="Event">Event</option>
						</select>
					  </td>
                    </tr>
       

                  </tbody>
                </table>
              </div>
    <!-- GRID E-->
       
     



<?php include $_SERVER["DOCUMENT_ROOT"]."/admin_page/inc/bot.php";
?>