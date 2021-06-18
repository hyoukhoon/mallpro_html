<?php include $_SERVER["DOCUMENT_ROOT"]."/admin_page/inc/top.php";

$sq=$_GET['sq']??"none";
$mode=$_GET['mode'];
$s_key=$_GET['s_key'];
$s_word=$_GET['s_word'];
$m1=$_GET['m1'];
$m2=$_GET['m2'];
$m3=$_GET['m3'];
$mobile=$m1.$m2.$m3;
$STS_CODE=$_GET['STS_CODE']??"all";
$SNS_TYPE=$_GET['SNS_TYPE']??json_decode(urldecode($_GET['ste']));;
//print_r($SNS_TYPE);
$ste=urlencode(json_encode($SNS_TYPE));

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

function scheck_none(){
	$('#sns_type2').attr('checked', false);
	$('#sns_type3').attr('checked', false);
	$('#sns_type4').attr('checked', false);
}

function scheck_none1(){
	$('#sns_type1').attr('checked', false);
}

</script>
<!-- 메인메뉴 S -->
    <div id="wrap_tmall_content">
     
     <ul class="top_title_area">
       <li class="top_title">회원관리 > 탈퇴회원</li>
     </ul>
     
    
    <!-- 조회영역 S -->
       <div class="search_area">
   	     <div class="search_box">

<form method="get" action="<?=$_SERVER['PHP_SELF']?>" name="sf">
<input type="hidden" name="mode" value="up">
<input type="hidden" name="sq" id="sq" value="<?=$sq?>" >

   	       <table>
			     	       <colgroup>
                           <col width="170" />
                           <col width="88" />
                           <col width="*" />
                           </colgroup>
						   <tr>
                               <td scope="col" class="title1">회원정보</td>
                               <td>
									<select name="s_key">
										<option value=""  <?if($s_key==""){?> selected<?}?>>전체</option>
										<option value="NICKNAME" <?if($s_key=="NICKNAME"){?> selected<?}?>>닉네임</option>
										<option value="EMAIL" <?if($s_key=="EMAIL"){?> selected<?}?>>이메일</option>
									</select>
									&nbsp;&nbsp;
									<input type="text" name="s_word" value="<?=$s_word?>">
                              </td>
                               <td style="padding-left:30px;">
                              </td>
                             </tr>
							 
                      
                             <tr>
                               <td scope="col" class="title1">탈퇴일자</td>
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
                               <td scope="col" class="title1">SNS</td>
                               <td>
									<input type="checkbox" id="sns_type1" name="SNS_TYPE[]" onclick="scheck_none();" value="0" <?if(!$SNS_TYPE || in_array("0",$SNS_TYPE)){?> checked<?}?>>전체&nbsp;
									<input type="checkbox" id="sns_type2" name="SNS_TYPE[]" onclick="scheck_none1();" value="1" <?if(in_array("1",$SNS_TYPE)){?> checked<?}?>>카카오톡&nbsp;
									<input type="checkbox" id="sns_type3" name="SNS_TYPE[]" onclick="scheck_none1();" value="2" <?if(in_array("2",$SNS_TYPE)){?> checked<?}?>>위챗&nbsp;
									<input type="checkbox" id="sns_type4" name="SNS_TYPE[]" onclick="scheck_none1();" value="3" <?if(in_array("3",$SNS_TYPE)){?> checked<?}?>>페이스북&nbsp;
                              </td>
							  <td align="right">
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
	$que3="select count(1) from buyer_secede where 1=1";
	$result3 = $mysqli->query($que3) or die("1:".$mysqli->error);
	$rs3 = $result3->fetch_array();
	$total_buyer=$rs3[0];

	if($s_key && $s_word){
		$where=" and $s_key like '%".$s_word."%'";
	}

	if($mobile){
		$where.=" and CELLPHONE like '%".$mobile."%'";
	}

	if($mode=="up" and $start_date and $end_date){
		$where.=" and REG_DATE between '".$start_date."' and '".$end_date." 23:59:59'";
	}

	if($mode=="up" and $SNS_TYPE and !in_array("0",$SNS_TYPE)){
			$spc="(";
		foreach($SNS_TYPE as $sp){
			$spc.="'".$sp."',";
		}
			$spc=substr($spc,0,-1);
			$spc.=")";
		$where.=" and SNS_TYPE in ".$spc;
	}



	if(!$order){
		$order=" order by REG_DATE desc";
	}

	$LIMIT=$_GET['LIMIT']??30;
	$page=$_GET['page']??1;


	$que2="select count(1) from buyer_secede where 1=1";
	$que2.=$where;
//	echo $que2."<br>";
	$result2 = $mysqli->query($que2) or die("2:".$mysqli->error);
	$rs2 = $result2->fetch_array();
	$total=$rs2[0];
?>
       <!-- sub title영역 S -->
      <div class="sub_title_area">
      <dl>
       <dt>총  회원수 <?echo number_format($total_buyer);?>명  |  검색결과    <?echo number_format($total);?>건</dt>
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
                  <col width=10%/>
                  <col width=10%/>
                  <col width=10%/>
                  <col width=10%/>
                  <col width="*" />
				  <col width=10%/>
				  <col width=10%/>
                  </colgroup>
                  <thead>
                    <tr>
                      <th scope="col">NO</th>
					  <th scope="col">가입일</th>
                      <th scope="col">SNS계정</th>
                      <th scope="col">이메일</th>
                      <th scope="col">닉네임</th>
                      <th scope="col">탈퇴사유</th>
					  <th scope="col">SNS</th>
					  <th scope="col">탈퇴일</th>
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
	from buyer_secede  where 1=1";
	$que.=$where;
	$que.=$order;
	$que.=$limit_query;
//	echo $que;
	$result = $mysqli->query($que) or die("3:".$mysqli->error);
	while($rs = $result->fetch_object()){
			$rsc[]=$rs;
	}


?>
<?
foreach($rsc as $p){

		$que5="select * from buyer where BUYER_CODE='$p->BUYER_CODE'";
		$result5 = $mysqli->query($que5) or die("5:".$mysqli->error);
		$rs5 = $result5->fetch_object();

?>

                    <tr>
                      <td><?=$no?></td>
                      <td><?echo $rs5->REG_DATE?$rs5->REG_DATE:"데이타없음";?></td>
                      <td class="pl20"><?=$p->SNS_ACCOUNT?></td>
                      <td><?=$rs5->EMAIL?></td>
                      <td><?=$rs5->NICKNAME?></td>
					  <td><?
					  switch($p->SECEDE_CODE) {
								case 0:$gb="제게 필요한 서비스가 아니에요";
								break;
								case 1:$gb="서비스 이용이 어려워요";
								break;
								case 2:$gb="오류/버그로 사용할 수가 없어요";
								break;
								case 3:$gb="다른 계정으로 재가입할게요";
								break;
								case 4:$gb="기타";
								break;
							}
							echo $gb;

							if($p->SECEDE_CODE=="4"){
								echo " (".$p->SECEDE_EXT.")";
							}
					?></td>
					  <td>
							<?echo sns_is($rs5->SNS_TYPE);?>
					  </td>
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
		<?if($f_no!=1){?><a href="<?=$PHP_SELF?>?mode=<?=$mode?>&page=<?=$p_f_no?>&f_no=<?=$p_f_no?>&multi=<?=$multi?>&ord=<?=$ord?>&s_key=<?=$s_key?>&s_word=<?=$s_word?>&start_date=<?=$start_date?>&end_date=<?=$end_date?>&STS_CODE=<?=$STS_CODE?>&ste=<?=$ste?>&m1=<?=$m1?>&m2=<?=$m2?>&m3=<?=$m3?>"><img src="/admin_page/images/btn_prev02.gif" alt="이전 목록" class="btn01" /></a><?}?>

				<? for($i=$f_no;$i<=$l_no;$i++){?>
					<?if($i==$page){?>
						<strong><?=$i?></strong>&nbsp;
					<?} else {?>
						<a href="<?=$PHP_SELF?>?mode=<?=$mode?>&page=<?=$i?>&f_no=<?=$f_no?>&multi=<?=$multi?>&sort=<?=$sort?>&s_key=<?=$s_key?>&s_word=<?=$s_word?>&start_date=<?=$start_date?>&end_date=<?=$end_date?>&STS_CODE=<?=$STS_CODE?>&ste=<?=$ste?>&m1=<?=$m1?>&m2=<?=$m2?>&m3=<?=$m3?>">
						<?=$i?>&nbsp;</a>
					<?}?>
				<?}?>

		<?if($l_no<$total_page){?><a href="<?=$PHP_SELF?>?mode=<?=$mode?>&page=<?=$n_f_no?>&f_no=<?=$n_f_no?>&multi=<?=$multi?>&ord=<?=$ord?>&s_key=<?=$s_key?>&s_word=<?=$s_word?>&start_date=<?=$start_date?>&end_date=<?=$end_date?>&STS_CODE=<?=$STS_CODE?>&ste=<?=$ste?>&m1=<?=$m1?>&m2=<?=$m2?>&m3=<?=$m3?>"><img src="/admin_page/images/btn_next02.gif" alt="다음 목록" class="btn02" /></a><?}?>


	</div>       
</div>     
  <!-- 메인메뉴 E -->


<?php include $_SERVER["DOCUMENT_ROOT"]."/admin_page/inc/bot.php";
?>