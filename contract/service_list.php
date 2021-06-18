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
       <li class="top_title">계약관리 > 서비스상품관리</li>
	   <div class="midle_bu_area ml20">
			<ul class="left_bu_area">
			<li ><button type="button" class="button05" id="add1" onclick="window.open('service_write.php','s1','width=800,height=600,scrollbars=yes')">+서비스상품등록</button></li>
			</ul>
		</div>
     </ul>

       
     
              <!-- GRID S-->
              <div class="gridTable_list01">
                <table width="100%" border="0" >

                  <colgroup>
                  <col width=10%/>
                  <col width="*"/>
                  <col width=10%/>
                  <col width=10% />
                  <col width=10%/>
                  <col width=10%/>
                  </colgroup>
                  <thead>
                    <tr>
                      <th scope="col">NO</th>
					  <th scope="col">계약상품명</th>
                      <th scope="col">상품금액</th>
                      <th scope="col">생성일</th>
					  <th scope="col">사용여부</th>
					  <th scope="col">수정/삭제</th>
                    </tr>
                  </thead>
                  <tbody>

<?
$kk=1;
$que1="select * 
	from service_product order by SERVICE_ID";
	$result1 = $mysqli->query($que1) or die($mysqli->error);
	while($rs1 = $result1->fetch_object()){
?>
                    <tr>
                      <td><?=$kk?></td>
                      <td><?echo stripslashes($rs1->SERVICE_PRODUCT_NAME."[".$rs1->CONTENTS."]");?></td>
                      <td><?echo number_format($rs1->PRICE);?>원</td>
                      <td><?echo $rs1->REG_DATE;?></td>
					  <td><?if($rs1->SERVICE_STS_CODE==0){?>사용중<?}else{?>사용중지<?}?></td>
					  <td><button type="button" class="button05" onclick="window.open('service_write.php?SERVICE_ID=<?=$rs1->SERVICE_ID?>','s1','width=800,height=600,scrollbars=yes')">변경</button></td>
                    </tr>
<?
$kk++;
}?>
                  </tbody>
                </table>
              </div>
    <!-- GRID E-->
       
     
  <!-- 메인메뉴 E -->


<?php include $_SERVER["DOCUMENT_ROOT"]."/admin_page/inc/bot.php";
?>