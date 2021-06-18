<?php include $_SERVER["DOCUMENT_ROOT"]."/admin_page/inc/top.php";
//error_reporting(E_ALL);
//ini_set("display_errors", 1);
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
       <li class="top_title">환경설정 > APP 버전관리</li>
	   <div class="midle_bu_area ml20">
			<ul class="left_bu_area">
			<li ><button type="button" class="button05" id="add1" onclick="window.open('app_up.php','as1','width=600,height=500,scrollbars=yes')">+APP버전등록</button></li>
			</ul>
		</div>
     </ul>
     
              <!-- GRID S-->
              <div class="gridTable_list01">
                <table width="100%" border="0" >

                  <colgroup>
                  <col width=5%/>
                  <col width=5%/>
                  <col width=10%/>
                  <col width=10% />
                  <col width="*"/>
                  <col width=10%/>
                  <col width=10%/>
                  <col width=10% />
                  </colgroup>
                  <thead>
                    <tr>
                      <th scope="col">플랫폼</th>
					  <th scope="col">버전</th>
                      <th scope="col">업로드일자</th>
                      <th scope="col">마켓등록상태</th>
					  <th scope="col">마켓URL</th>
					  <th scope="col">업데이트표시옵션</th>
					  <th scope="col">수정</th>
					  <th scope="col">삭제</th>
                    </tr>
                  </thead>
                  <tbody>
<?
//페이징

	$que="select * 
	from app_version 
	order by UPLOAD_DATE desc";
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
                    <tr>
                      <td><?if($p->MOBILE_OS=="A"){echo "Android";}else if($p->MOBILE_OS=="I"){echo "iOS";}?></td>
                      <td><?=$p->APP_VERSION?></td>
                      <td><?=$p->UPLOAD_DATE?></td>
                      <td><?if($p->REG_YN=="Y"){echo "등록완료";}else if($p->REG_YN=="N"){echo "미등록";}?></td>
					  <td class="pl20"><?=$p->MARKET_URL?></td>
					  <td><?if($p->IS_MAN=="Y"){echo "필수업데이트";}else if($p->IS_MAN=="N"){echo "권장업데이트";}?></td>
					  <td><button type="button" style="width:80px;height:25px;margin:0 4px; font-size:13px;line-height:26px; font-weight:bold; color:black;background-color:#f3f3f3" onclick="window.open('app_up.php?APP_VERSION_SEQ=<?=$p->APP_VERSION_SEQ?>','ae1','width=600,height=500,scrollbars=yes')">수정</button></td>
					  <td><button type="button" style="width:80px;height:25px;margin:0 4px; font-size:13px;line-height:26px; font-weight:bold; color:black;background-color:#f3f3f3" onclick="app_del('<?=$p->APP_VERSION_SEQ?>');">삭제</button></td>
                    </tr>
<?
$no--;
}?>
                  </tbody>
                </table>
              </div>
    <!-- GRID E-->
       
<script>
	function app_del(n){

		if(confirm('삭제하시겠습니까?')){
			location.href="app_del.php?APP_VERSION_SEQ="+n;
		}else{
			return false;
		}	

}
</script>

<?php include $_SERVER["DOCUMENT_ROOT"]."/admin_page/inc/bot.php";
?>