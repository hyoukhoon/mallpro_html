<?php include $_SERVER["DOCUMENT_ROOT"]."/inc/top.php";
include $_SERVER["DOCUMENT_ROOT"]."/product/product_lib.php";

$today=date("Y-m-d");
$sq=$_GET['sq']??"none";
$sq2=$_GET['sq2']??"none";
$mode=$_GET['mode'];
$s_key=$_GET['s_key'];
$s_word=$_GET['s_word'];
$sendBasicFee=$_GET['sendBasicFee'];
$cate1=$_GET['cate1'];
$cate2=$_GET['cate2'];
$LIMIT=$_GET['LIMIT']??30;
$page=$_GET['page']??1;

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


$uid=$_SESSION['AID'];


?>
<script src="/inc/jquery.simplemodal.js" type="text/javascript"></script>

<script>
$(function() {

			//$( document ).tooltip();
			$('#today').trigger('click');

			$('#search_all01').change(function() {		
				$("input[name='status']").prop('checked', this.checked);		
			});

			$( "#start_date, #end_date" ).datepicker({
				showOn:"button"
				,buttonImage:"/images/calendar_Ico.png"
				,buttonImageOnly:true
				,dateFormat:'yy-mm-dd'
			});

			$( "#start_date2, #end_date2" ).datepicker({
				showOn:"button"
				,buttonImage:"/images/calendar_Ico.png"
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
			if (month<0) {
				  year = year-1;
				  month = month+12;
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

<style>
nav::after {
  dispaly: block;
  content: '';
  clear: both;
}
</style>

<!-- 메인메뉴 S -->
    <div id="wrap_tmall_content">
     
     <ul class="top_title_area">
       <li class="top_title">상품관리 > 내상품리스트</li>
	   <!-- <div class="midle_bu_area ml20">
			<ul class="left_bu_area">
			<li ><button type="button" class="button05" id="add1" onclick="window.open('searchUp.php','s1','width=600,height=400,left=200,top=100,scrollbars=yes')">+검색어등록</button></li>
			<li ><button type="button" class="button05" id="add1" onclick="window.open('searchUp2.php','s1','width=600,height=400,left=200,top=100,scrollbars=yes')">+URL등록</button></li>
			</ul>
		</div> -->
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
										<option value="itemName" <?if($s_key=="itemName"){?>selected<?}?>>상품명</option>
										<option value="tag" <?if($s_key=="tag"){?>selected<?}?>>태그</option>
										<!-- <option value="PRODUCT_CODE" <?if($s_key=="PRODUCT_CODE"){?>selected<?}?>>상품코드</option>
										<option value="ADMIN" <?if($s_key=="ADMIN"){?>selected<?}?>>매장명</option> -->
									</select>
									&nbsp;&nbsp;
									<input type="text" name="s_word" value="<?=$s_word?>">
									<!-- &nbsp;&nbsp;
									배송비:
									&nbsp;&nbsp;
									<input type="text" name="sendBasicFee" value="<?=$sendBasicFee?>">원 초과 -->
                              </td>
                               <td style="padding-left:30px;">
								<!-- *상가명 
									<select name="SHOP_CODE">
										<option value="">전체</option>
									
									</select> -->
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
									<li><a <?if($sq=="none"){?>class="tt button06"<?}else{?> class="tt button05"<?}?> href="javascript:;" val='none'>전체</a></li>

								</ul>
                                 </div>                               </td>
                             </tr>
<tr>
                               <td scope="col" class="title1">표시갯수</td>
                               <td>
									<select name="LIMIT" style="width:100px;" onchange="location.href='<?echo $_SERVER['PHP_SELF']?>?LIMIT='+this.value+'&s_key=<?=$s_key?>&s_word=<?=$s_word?>&sendBasicFee=<?=$sendBasicFee?>&start_date=<?=$start_date?>&end_date=<?=$end_date?>'">
										<option value="30" <?if($LIMIT==30){?>selected<?}?>>30</option>
										<option value="60" <?if($LIMIT==60){?>selected<?}?>>60</option>
										<option value="100" <?if($LIMIT==100){?>selected<?}?>>100</option>
										<option value="300" <?if($LIMIT==300){?>selected<?}?>>300</option>
										<option value="500" <?if($LIMIT==500){?>selected<?}?>>500</option>
									</select>
                              </td>
                               <td style="padding-left:30px;">
								
                              </td>
                             </tr> 

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
	$que3="select count(1) 
	from myItem a, taobao b where a.pnum=b.num and a.uid='$uid'";
	$result3 = $mysqli->query($que3) or die("1:".$mysqli->error);
	$rs3 = $result3->fetch_array();
	$total_product=$rs3[0];

	if($s_key && $s_word){
			$where=" and $s_key like '%".$s_word."%'";
	}

	if($sendBasicFee){
			$where.=" and sendBasicFee > ".$sendBasicFee."";
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
		$where.=" and a.regDate>='".$start_date."' and a.regDate<='".$end_date." 23:59:59'";
	}

	if($mode=="up" and $start_date2 and $end_date2){
		$where.=" and REGDATE between '".$start_date2."' and '".$end_date2." 23:59:59'";
	}





	if(!$order){
		$order=" order by a.num desc";
	}

	$LIMIT=$_GET['LIMIT']??30;
	$page=$_GET['page']??1;


	$que2="select count(1) 
	from myItem a, taobao b where a.pnum=b.num and a.uid='$uid' $where";
	$que2.=$where;
	$result2 = $mysqli->query($que2) or die("2:".$mysqli->error);
	$rs2 = $result2->fetch_array();
	$total=$rs2[0];

$cny=cnyIs();
?>
<style>
#floatMenu { position:fixed; bottom:0px; z-index:55;width:95%;background-color:#fff; padding:10px; border:1px solid #000;}
</style>



       <!-- sub title영역 S -->
      <div class="sub_title_area" id="floatMenu">
      <dl>
       <dt style="padding-left:0px;">
	   </dt>
	   <button type="button"  class="button03_5" id='mySave' style="width:120px;height:35px;">수정내용저장</button>
       <dd>

	   <div class="midle_bu_area ml20">
		  <ul class="left_bu_area">
			<li style="vertical-align:text-bottom;font-weight:bold;">선택한 상품을 </li>
			<li style="margin-left:0px;margin-right:0px;"><a class="button03_4" href="javascript:;" id='myDel' style="padding:5px 10px;">삭제</a></li>
			<li style="margin-left:0px;margin-right:0px;"><a class="button03_4" href="javascript:;" id='myCate' style="padding:5px 10px;">카테고리선택</a></li>
			<li style="margin-left:0px;margin-right:0px;"><a class="button03_4" href="javascript:;" id='zipSave' style="padding:5px 10px;">대표이미지 ZIP로저장</a></li>
			<!-- <li style="margin-left:0px;margin-right:0px;"><a class="button03_4" href="javascript:;" id='zipSaveView' style="padding:5px 10px;">상세이미지 ZIP로저장</a></li> -->
			<li style="margin-left:0px;margin-right:0px;"><a class="button03_4" href="javascript:;" id='excelSave' style="padding:5px 10px;"><img src="/images/excel_ico01.png" alt="Excel">엑셀로저장
			</a></li>
			<li style="margin-left:0px;margin-right:0px;"><a class="button03_4" href="javascript:;" id='mallSave' style="padding:5px 10px;">쇼핑몰등록</a></li>
		</ul>
		 </div>
	   
	   </dd>
      </dl>
      </div>
       <!-- sub title영역 E -->
       
     <div class="sub_title_area">
      <dl>
       <dt style="padding-left:0px;">- 총상품건수 <?echo number_format($total_product);?>건  |  검색결과    <?echo number_format($total);?>건 / 중국환율 : <?echo number_format($cny,2);?>&nbsp;
	   <button type="button"  class="button03_5" id='calEx' onclick="calEx()" style="width:120px;height:35px;">환률계산기</button>
<?php if($uid=="kawaiko" or $uid=="hyoukhoon"){?>
	   <button type="button"  class="button03_5" id='calAmt' onclick="calAmt()" style="width:120px;height:35px;">순수익계산기</button>
<?}?>
	   </dt>
		</dl>
      </div>
              <!-- GRID S-->
              <div class="gridTable_list01">

<form method="post" action="pc_ok.php" name="pf">
<input type="hidden" name="gubun" value="<?=$gubun?>">
                <table width="100%" border="0" style="table-layout:fixed; word-break:break-all;">


                  <thead>
                    <tr>
                      <th scope="col" style="width:30px;"><input type="checkbox" id="checkAll"></th>
                      <th scope="col" style="width:50px;">NO</th>
					  <th scope="col" style="width:50px;">링크</th>
					  <th scope="col" style="width:80px;">카테고리</th>
					  <th scope="col" style="width:110px;">대표사진</th>
                      <th scope="col">상품명</th>
					  <th scope="col" style="width:160px;">배송방법/배송비유형</th>
                      <th scope="col" style="width:120px;">배송비설정 <!-- <a href="javascript:;" onclick="allSend();">▼</a> --></th>
					  <th scope="col" style="line-height:16px;">옵션<br><font color="red">※옵션과 옵션은 반드시 , 로 구분합니다<br>표시된옵션을 지우지 마십시오.<br>특수문자(/*?"<>)를 사용하지마십시오.</font> 
					  </th>
					  <th scope="col" style="width:180px;">가격
						<select name="priceAuto" onchange="changePrice(this.value)">
							<option value="0">선택</option>
							<option value="-10">-10%</option>
							<option value="10">10%</option>
							<option value="20">20%</option>
							<option value="30">30%</option>
							<option value="40">40%</option>
							<option value="50">50%</option>
							<option value="60">60%</option>
							<option value="70">70%</option>
							<option value="80">80%</option>
							<option value="90">90%</option>
							<option value="100">100%</option>
						</select>
						 / 할인
					  </th>
					  <th scope="col" width="50">상세</th>
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
	$que="select * , a.num as myNum, a.price as myPrice, b.price as itemPrice, a.regDate as myregDate 
	from myItem a, taobao b where a.pnum=b.num and a.uid='$uid'";
	$que.=$where;
	$que.=$order;
	$que.=$limit_query;
//	echo $que;
	$result = $mysqli->query($que) or die("3:".$mysqli->error);
	while($rs = $result->fetch_object()){
			$rsc[]=$rs;
	}


foreach($rsc as $p){
	$tf=explode(",",$p->thumbFile);
	$vUrl="";
	$vUrl=$p->videoUrl;
	$vUrl=str_replace("e/1","e/6",$vUrl);
	$vUrl=str_replace("t/8","t/1",$vUrl);
	$vUrl=str_replace(".swf",".mp4",$vUrl);
	$vUrl="http:".$vUrl;
	if($vUrl)$vtext="[동영상참조]";
?>
                    <tr style="overflow: hidden;">
                      <td><input type="checkbox" name="num[]" id="pnum" value="<?=$p->myNum?>"></td>
                      <td><?=$no?>/<?=$p->pnum?></td>
					  <td><a href="<?=$p->url?>" target="_blank">URL</a></td>
                      <td><?if($p->cateId){echo cateIs($p->cateId);}else{?><font color="red">카테고리를 선택해주세요.</font><?}?></td>
					  <td style="text-align:center;"><a href="javascript:;" onclick="window.open('slider.php?img=<?=$p->thumbFile?>','slp','width=400,height=640');"><img src="/thumb/<?echo $tf[0]?>" width="100"></a></td>
                      <td style="text-align:left;line-height:25px;">
							<table>
							<tr>
								<td style="width:50%;background-color:#fff;">
									<textarea name="itemName_<?=$p->num?>" id="itemName" placeholder="상품명을 입력하세요." style="width:100%;height:80px;font-size:14px;"><?echo stripslashes($p->itemName);?></textarea>
								</td>
							</tr>
							<tr>
								<td style="font-size:8px;">
									<a href="javascript:;" onclick="inputText('<?=$p->num?>');">▲</a>
									<span style="font-size:10px;" id="subjectCn_<?=$p->num?>"><?echo $p->subject;?></span>
								</td>
							</tr>
						</table>
					  </td>
					  
                      
					  <td>
							<select name="sendMethod" id="sendMethod">
								<option value="택배‚ 소포‚ 등기" <?if($p->sendMethod=="택배‚ 소포‚ 등기"){?>selected<?}?>>택배‚ 소포‚ 등기</option>
								<option value="직접배송(화물배달)" <?if($p->sendMethod=="직접배송(화물배달)"){?>selected<?}?>>직접배송(화물배달)</option>
							</select>
							<br>
							<select name="sendFeePayType" id="sendFeePayType">
								<option value="선결제" <?if($p->sendFeePayType=="선결제"){?>selected<?}?>>선결제</option>
								<option value="착불" <?if($p->sendFeePayType=="착불"){?>selected<?}?>>착불</option>
								<option value="착불 또는 선결제" <?if($p->sendFeePayType=="착불 또는 선결제"){?>selected<?}?>>착불 또는 선결제</option>
							</select>
							<br><br>
							<?php
							$sendFeeType=$p->sendFeeType?$p->sendFeeType:"수량별";
							$sendFeeFreeLimit=$p->sendFeeFreeLimit?$p->sendFeeFreeLimit:100000;
							//$sendFeeEachCnt=$p->sendFeeEachCnt?$p->sendFeeEachCnt:1;
							$sendFeeEachCnt=1;
					  ?>
							<select name="sendFeeType" id="sendFeeType" onchange="selcon(this.value,'<?=$p->num?>')">
								<option value="조건부 무료" <?if($sendFeeType=="조건부 무료"){?>selected<?}?>>조건부 무료</option>
								<option value="수량별" <?if($sendFeeType=="수량별"){?>selected<?}?>>수량별</option>
								<option value="유료" <?if($sendFeeType=="유료"){?>selected<?}?>>유료</option>
								<option value="무료" <?if($sendFeeType=="무료"){?>selected<?}?>>무료</option>
							</select>
							<span id="sf1_<?=$p->num?>" <?if($sendFeeType=="조건부 무료"){?>style="display:block;"<?}else{?>style="display:none;"<?}?>><input type="text" name="sendFeeFreeLimit" id="sendFeeFreeLimit" value="<?=$sendFeeFreeLimit?>" size="6" style="text-align:right;">원</span>
							<span id="sf2_<?=$p->num?>" <?if($sendFeeType=="수량별"){?>style="display:block;"<?}else{?>style="display:none;"<?}?>><input type="text" name="sendFeeEachCnt" id="sendFeeEachCnt" value="<?=$sendFeeEachCnt?>" size="6" style="text-align:right;">개</span>
							
					  </td>

					  <?php
						if(!$p->sendBasicFee){
							$sendBasicFee=10000;
					  }else{
							$sendBasicFee=$p->sendBasicFee;
					  }
					  if(!$p->retunSendFee){
							$retunSendFee=30000;
					  }else{
							$retunSendFee=$p->retunSendFee;
					  }
					  if(!$p->changeSendFee){
							$changeSendFee=60000;
					  }else{
							$changeSendFee=$p->changeSendFee;
					  }
					  ?>
                      <td>
							기본 : <input type="text" name="sendBasicFee" id="sendBasicFee" value="<?=$sendBasicFee?>" style="width:60px;text-align:right;">원<br>
							반품 : <input type="text" name="retunSendFee" id="retunSendFee" value="<?=$retunSendFee?>" style="width:60px;text-align:right;">원<br>
							교환 : <input type="text" name="changeSendFee" id="changeSendFee" value="<?=$changeSendFee?>" style="width:60px;text-align:right;">원
					  </td>
					  <td>
<?php

		if($p->optionCount>3){
		
?>
	<!-- <button type="button" class="button03_4" style="width:150px;padding:0px 10px;" id="optButton_<?=$p->num?>" onclick="optionRegist('<?=$p->pnum?>')">옵션직접등록</button> -->
	<br>
	(※ 옵션이 4개 이상인 상품은 네이버에서 옵션을 등록하십시오.)
	<textarea name="optCont1" id="optCont1" style="width:100px;height:60px;display:none" ></textarea>
	<textarea name="optCont2" id="optCont2" style="width:100px;height:60px;display:none" ></textarea>
<?}else{?>


<?php
							$optMix=array();
							$result2 = $mysqli->query("select * from optiontable where pnum='".$p->pnum."'") or die("725:".$mysqli->error);
							$rs2 = $result2->fetch_object();

					  ?>


					  <?if($rs2->optionName1){
						
					  ?>
						<table>
							<tr>
								<td style="background-color:#fff;width:100px;">
									<?echo $rs2->optionName1;?>
								</td>
								<td rowspan="2">
									<textarea name="optCont1_<?=$p->num?>" id="optCont1" style="width:100%;height:90px;" ><?echo $rs2->optionValue1;?></textarea>
								</td>
							</tr>
							<tr>
								<td style="font-size:8px;">
									<!-- <span id="optText1_<?=$p->num?>"><?echo $rs2->optionValue1;?></span>
									<a href="javascript:;" onclick="trans1('<?=$p->num?>');">▶</a><br> -->
								
								
									<?php
										$typeA="";
										$opv=explode(",",$rs2->optionValue1);
										$t=1;
										foreach($opv as $o){
											$typeA.="TypeA-".$t.",";
											$t++;
										}
										
					  ?>
									<span id="optTextType1_<?=$p->num?>"><?echo substr($typeA,0,-1);?></span>
									<a href="javascript:;" onclick="transt1('<?=$p->num?>');">▶</a>
								</td>
							</tr>
						</table>
								
						  
					  <?}else{?>
							<textarea name="optCont1" id="optCont1" style="width:100px;height:60px;display:none" ><?echo $rs2->optionValue1;?></textarea>
					  <?}?>


					  <?if($rs2->optionName2){
					  ?>
						  <table>
							<tr>
								<td style="background-color:#fff;width:100px;">
									<?echo $rs2->optionName2;?>
								</td>
								<td rowspan="2" >
									<textarea name="optCont2_<?=$p->num?>" id="optCont2" style="width:100%;height:100px;" ><?echo $rs2->optionValue2;?></textarea>
								</td>
							</tr>
							<tr>
								<td style="font-size:8px;">
									<!-- <span id="optText2_<?=$p->num?>"><?echo $rs2->optionValue2;?></span>
									<a href="javascript:;" onclick="trans2('<?=$p->num?>');">▶</a> -->
									<br>
									<?php
										$typeB="";
										$opv2=explode(",",$rs2->optionValue2);
										$t=1;
										foreach($opv2 as $o2){
											$typeB.="TypeB-".$t.",";
											$t++;
										}
										
					  ?>
									<span id="optTextType2_<?=$p->num?>"><?echo substr($typeB,0,-1);?></span>
									<a href="javascript:;" onclick="transt2('<?=$p->num?>');">▶</a>
								</td>
								</td>
							</tr>
						</table>
					   <?}else{?>
							<textarea name="optCont2" id="optCont2" style="width:100px;height:60px;display:none" ><?echo $rs2->optionValue2;?></textarea>
					  <?}?>

					  <?if($rs2->optionName3){
					  ?>
						  <table>
							<tr>
								<td style="background-color:#fff;width:100px;">
									<?echo $rs2->optionName3;?>
								</td>
								<td rowspan="2" >
									<textarea name="optCont3_<?=$p->num?>" id="optCont3" style="width:100%;height:100px;" ><?echo $rs2->optionValue3;?></textarea>
								</td>
							</tr>
							<tr>
								<td style="font-size:8px;">
									<!-- <span id="optText2_<?=$p->num?>"><?echo $rs2->optionValue2;?></span>
									<a href="javascript:;" onclick="trans2('<?=$p->num?>');">▶</a> -->
									<br>
									<?php
										$typeC="";
										$opv2=explode(",",$rs2->optionValue3);
										$t=1;
										foreach($opv2 as $o2){
											$typeC.="typeC-".$t.",";
											$t++;
										}
										
					  ?>
									<span id="optTextType3_<?=$p->num?>"><?echo substr($typeC,0,-1);?></span>
									<a href="javascript:;" onclick="transt3('<?=$p->num?>');">▶</a>
								</td>
								</td>
							</tr>
						</table>
					   <?}else{?>
							<textarea name="optCont3" id="optCont3" style="width:100px;height:60px;display:none" ><?echo $rs2->optionValue3;?></textarea>
					  <?}?>
<?}?>

					  </td>
					  <td style="line-height:20px;text-align:left;">
					   <?php
						$itemPrice=$p->promoPrice?$p->promoPrice:$p->itemPrice;
						$cn=explode("-",$itemPrice);
						$cn1=trim($cn[0]);
						$cn2=trim($cn[1]);
						$krw1=$cn1*$cny;
						$krw2=$cn2*$cny;
						if($cn2){
							$exPrice=number_format($krw1)." ~ ".number_format($krw2)." 원";
							$hiddenPrice=$krw1;
						}else{
							$exPrice=number_format($krw1)." 원";
							$hiddenPrice=$krw1;
						}

						$upRatio=$p->myPrice/$krw1;
						$upRatio=round($upRatio,2);

						$originPrice=$p->itemPrice;
						$ocn=explode("-",$originPrice);
						$ocn1=trim($ocn[0]);
						$ocn2=trim($ocn[1]);
						$okrw1=$ocn1*$cny;
						$okrw2=$ocn2*$cny;
						if($ocn2){
							$oexPrice=number_format($okrw1)." ~ ".number_format($okrw2)." 원";
						}else{
							$oexPrice=number_format($okrw1)." 원";
						}
?>
						<input type="hidden" name="hiddenPrice" id="hiddenPrice" value="<?=$hiddenPrice?>">
						<ul>
							<li><span style="font-weight:bold;">정상가</span> : <?echo number_format($originPrice);?>위안</li>
							<li><span style="font-weight:bold;">환율가</span> : <?echo $oexPrice;?></li>
							<li><span style="font-weight:bold;">할인가</span> : <?echo number_format($itemPrice);?>위안</li>
							<li><span style="font-weight:bold;">환율가</span> : <?echo $exPrice;?></li>
							<li><span style="font-weight:bold;">판매가</span> : <input type="text" numberOnly name="myPrice" id="myPrice" <?if($p->optionType==2 and $p->optionCount<4){?>readonly alt="opt" onclick="alert('옵션가수정 버튼을 눌러 수정하세요.');"<?}?> value="<?=$p->myPrice?>" style="width:80px;text-align:right;">원</li>
							<li><span style="font-weight:bold;color:red">할인설정</span> : <input type="text" numberOnly style="width:60px;text-align:right;" style="text-align:right;" name="nowFee" id="nowFee" value="<?=$p->nowFee?>">
							<select name="nowUnit" id="nowUnit">
								<option value="원" <?if($p->nowUnit=="원"){?>selected<?}?>>원</option>
								<option value="%" <?if($p->nowUnit=="%"){?>selected<?}?>>%</option>
							</select></li>
							<?php
							$salePrice=0;
							if($p->nowFee){
								if($p->nowUnit=="원"){
									$salePrice=$p->myPrice-$p->nowFee;
								}else if($p->nowUnit=="%"){
									$salePrice=$p->myPrice-($p->myPrice*($p->nowFee/100));
								}
								?>
								<li><span style="font-weight:bold;">할인가</span> : <?echo number_format($salePrice);?>원</li>
							<?}?>
							<?if($p->myPrice){
									if($salePrice){
										$myPrice=$salePrice;
									}else{
										$myPrice=$p->myPrice;
									}

									//echo $myPrice.",".$krw1."<br>";
							?>
								<li><span style="font-weight:bold;color:blue">마진 : <?echo number_format($myPrice-$krw1);?>원</span></li>
							<?}?>
						</ul>
						<div style="text-align:center;">
						<?php

						if($p->optionType==2 and $p->optionCount<4){

					  ?>

						<br>
						<button type="button" class="button03_4" id="optButton_<?=$p->num?>" onclick="optionPrice('<?=$p->pnum?>')">옵션가수정</button>
						<?
						
						}?>
						</div>
					  <!-- <?if($p->promoPrice){?>
							<br><font color="red">(할인가: <?=$p->promoPrice?>)</font>
						<?}?> -->

					  </td>
					  <td style="text-align:center;line-height:25px;">
						<a href="javascript:;" onclick="window.open('/product/myItemView.php?num=<?=$p->myNum?>','iv','width=900,height=1000,scrollbars=yes')">미리보기</a>
						<br>
						<a href="javascript:;" onclick="window.open('/product/myItemEdit.php?num=<?=$p->myNum?>','vn','width=900,height=1000,scrollbars=yes')">편집</a>
						<!-- <br>
						<a href="javascript:;" onclick="window.open('/product/codeView.php?num=<?=$p->myNum?>','cv','width=1000,height=800,scrollbars=yes')">코드</a> -->
					  </td>
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
		<?if($f_no!=1){?><a href="<?=$PHP_SELF?>?mode=<?=$mode?>&page=<?=$p_f_no?>&f_no=<?=$p_f_no?>&LIMIT=<?=$LIMIT?>&ord=<?=$ord?>&s_key=<?=$s_key?>&s_word=<?=$s_word?>&start_date=<?=$start_date?>&end_date=<?=$end_date?>&SHOP_CODE=<?=$SHOP_CODE?>&spa=<?=$spa?>&sq=<?=$sq?>&sq2=<?=$sq2?>&cate1=<?=$cate1?>&cate2=<?=$cate2?>&start_date2=<?=$start_date2?>&end_date2=<?=$end_date2?>&IMGVOD_FLAG=<?=$IMGVOD_FLAG?>"><img src="/images/btn_prev02.gif" alt="이전 목록" class="btn01" /></a><?}?>

				<? for($i=$f_no;$i<=$l_no;$i++){?>
					<?if($i==$page){?>
						<strong><?=$i?></strong>&nbsp;
					<?} else {?>
						<a href="<?=$PHP_SELF?>?mode=<?=$mode?>&page=<?=$i?>&f_no=<?=$f_no?>&LIMIT=<?=$LIMIT?>&sort=<?=$sort?>&s_key=<?=$s_key?>&s_word=<?=$s_word?>&start_date=<?=$start_date?>&end_date=<?=$end_date?>&SHOP_CODE=<?=$SHOP_CODE?>&spa=<?=$spa?>&sq=<?=$sq?>&sq2=<?=$sq2?>&cate1=<?=$cate1?>&cate2=<?=$cate2?>&start_date2=<?=$start_date2?>&end_date2=<?=$end_date2?>&IMGVOD_FLAG=<?=$IMGVOD_FLAG?>">
						<?=$i?>&nbsp;</a>
					<?}?>
				<?}?>

		<?if($l_no<$total_page){?><a href="<?=$PHP_SELF?>?mode=<?=$mode?>&page=<?=$n_f_no?>&f_no=<?=$n_f_no?>&LIMIT=<?=$LIMIT?>&ord=<?=$ord?>&s_key=<?=$s_key?>&s_word=<?=$s_word?>&start_date=<?=$start_date?>&end_date=<?=$end_date?>&SHOP_CODE=<?=$SHOP_CODE?>&spa=<?=$spa?>&sq=<?=$sq?>&sq2=<?=$sq2?>&cate1=<?=$cate1?>&cate2=<?=$cate2?>&start_date2=<?=$start_date2?>&end_date2=<?=$end_date2?>&IMGVOD_FLAG=<?=$IMGVOD_FLAG?>"><img src="/images/btn_next02.gif" alt="다음 목록" class="btn02" /></a><?}?>


	</div>       
</div>     
  <!-- 메인메뉴 E -->
<br><br>


<div id="wrap-loading" style="display:none;"><img src="/images/loading.gif"></div>

<script>

$( document ).ready(function() {
    $("input:text[numberOnly]").on("keyup", function() {
		$(this).val($(this).val().replace(/[^0-9\\-]/g,""));
	});
});

jQuery.fn.center = function () {
    this.css("position","absolute");
    this.css("top", Math.max(0, (($(window).height() - $(this).outerHeight()) / 2) + $(window).scrollTop()) + "px");
    this.css("left", Math.max(0, (($(window).width() - $(this).outerWidth()) / 2) + $(window).scrollLeft()) + "px");
    return this;
}

function inputText(n){
	var textCn=$("#subjectCn_"+n).text();
	$('textarea[name=itemName_'+n+']').val(textCn);
}

function trans1(n){
	var textCn=$("#optText1_"+n).text();
	$('textarea[name=optCont1_'+n+']').val(textCn);
}

function transt1(n){
	var textCn=$("#optTextType1_"+n).text();
	$('textarea[name=optCont1_'+n+']').val(textCn);
}

function trans2(n){
	var textCn=$("#optText2_"+n).text();
	$('textarea[name=optCont2_'+n+']').val(textCn);
}

function transt2(n){
	var textCn=$("#optTextType2_"+n).text();
	$('textarea[name=optCont2_'+n+']').val(textCn);
}

function transt3(n){
	var textCn=$("#optTextType3_"+n).text();
	$('textarea[name=optCont3_'+n+']').val(textCn);
}

function optionPrice(n){
	window.open('/product/optionPriceEdit.php?num='+n,'pte','width=500,height=640,scrollbars=yes');
}

function optionRegist(n){
	window.open('/product/optionRegist.php?num='+n,'pte','width=500,height=340,scrollbars=yes');
}

function calEx(){
	window.open('/product/calEx.php','pte1','width=500,height=640,scrollbars=yes');
}

function calAmt(){
	window.open('/product/calAmt.php','pte2','width=500,height=640,scrollbars=yes');
}

function otchange(n,num){
		if(n==2){
			$("#optButton_"+num).show();
		}else{
			$("#optButton_"+num).hide();
		}
}

function changePrice(n){

	if(n>0){
		var an=n/100;
		var cnt=0;
		$('input:text[id="myPrice"]').each(function() {
				var hp=parseInt($('input:hidden[id="hiddenPrice"]')[cnt].value);
				price=hp+(hp*an)
				if($(this).attr("alt")!="opt"){
					this.value=Math.ceil(price/100)*100;
				}
				cnt++;
		});
	}else{
		var an=Math.abs(n)/100;
		var cnt=0;
		$('input:text[id="myPrice"]').each(function() {
				var hp=parseInt($('input:hidden[id="hiddenPrice"]')[cnt].value);
				price=hp-(hp*an)
				this.value=Math.ceil(price/100)*100;
				cnt++;
		});
	}

}

function allSend(){
	var sendBasicFee=$("#sendBasicFee").val();
	var retunSendFee=$("#retunSendFee").val();
	var changeSendFee=$("#changeSendFee").val();

	$('input:text[id="sendBasicFee"]').each(function() {
			this.value=sendBasicFee;
	});
	$('input:text[id="retunSendFee"]').each(function() {
			this.value=retunSendFee;
	});
	$('input:text[id="changeSendFee"]').each(function() {
			this.value=changeSendFee;
	});

}


function selcon(n,m){
	if(n=="수량별"){
		$("#sf2_"+m).show();
		$("#sf1_"+m).hide();
	}else if(n=="조건부 무료"){
		$("#sf1_"+m).show();
		$("#sf2_"+m).hide();
	}else if(n=="유료"){
		$("#sf1_"+m).hide();
		$("#sf2_"+m).hide();
	}else if(n=="무료"){
		$("#sf1_"+m).hide();
		$("#sf2_"+m).hide();
	}
}

  $("#checkAll").on("click",function(){
	   var _value = $(this).is(":checked");
	   $('input:checkbox[id="pnum"]').each(function () { 
	    this.checked = _value; 
	   });
  });

$("#myDel, #myDel2").click(function(){

	if(!confirm('삭제하면 복구할 수 없습니다. 삭제하시겠습니까?')){
		return;
	}

	var total_cnt=0;
	var checkArray=new Array();

	$('input:checkbox[id="pnum"]').each(function() {
		if(this.checked){//checked 처리된 항목의 값
			checkArray[total_cnt]=this.value;//배열로 저장
			total_cnt++;
		}
	});

	var jsonCheck = encodeURIComponent(JSON.stringify(checkArray));//json으로 바꿈
	var params = "jsonCheck="+jsonCheck;

	//	console.log(params);
//	return;
	$.ajax({
			  type: 'post'
			, url: '/product/myItemDel.php'
			,data : params
			, dataType : 'json'
			, success: function(data) {
				if(data.result==1){
					alert(data.val);
					location.reload();
				}else if(data.result==-1){
					alert(data.val);
				}else{
					alert('다시 시도하세요');
				}
			  }
		});

});

$("#mallSave").click(function(){

	if(!confirm('쇼핑몰에 등록하시겠습니까??')){
		return;
	}

	var total_cnt=0;
	var checkArray=new Array();

	$('input:checkbox[id="pnum"]').each(function() {
		if(this.checked){//checked 처리된 항목의 값
			checkArray[total_cnt]=this.value;//배열로 저장
			total_cnt++;
		}
	});

	var jsonCheck = encodeURIComponent(JSON.stringify(checkArray));//json으로 바꿈
	var params = "jsonCheck="+jsonCheck;

	//	console.log(params);
//	return;
	$.ajax({
			  type: 'post'
			, url: '/product/myItemMall.php'
			,data : params
			, dataType : 'json'
			, success: function(data) {
				if(data.result==1){
					alert(data.val);
					location.reload();
				}else if(data.result==-1){
					alert(data.val);
				}else{
					alert('다시 시도하세요');
				}
			  }
		});

});

$("#trans, #trans2").click(function(){

	var total_cnt=0;
	var checkArray=new Array();

	$('input:checkbox[id="pnum"]').each(function() {
		if(this.checked){//checked 처리된 항목의 값
			checkArray[total_cnt]=this.value;//배열로 저장
			total_cnt++;
		}
	});

	var jsonCheck = encodeURIComponent(JSON.stringify(checkArray));//json으로 바꿈
	var params = "jsonCheck="+jsonCheck;
//	console.log(params);
	$.ajax({
				  type: 'post'
				, url: '/product/trans.php'
				,data : params
				, dataType : 'json'
				, success: function(data) {
					if(data.result==1){
						alert(data.val);
						location.reload();
					}else if(data.result==-1){
						alert(data.val);
					}else{
						alert('다시 시도하세요');
					}
				  }
				 ,beforeSend:function(){
						$('#wrap-loading').show();
						$('#wrap-loading').center();
				}
				,complete:function(){
						$('#wrap-loading').hide();
				}

			});
	
});


$("#myCate, #myCate2").click(function(){

	var total_cnt=0;
	var checkArray=new Array();

	$('input:checkbox[id="pnum"]').each(function() {
		if(this.checked){//checked 처리된 항목의 값
			checkArray[total_cnt]=this.value;//배열로 저장
			total_cnt++;
		}
	});
//	console.log(total_cnt);
	var jsonCheck = JSON.stringify(checkArray);//json으로 바꿈

	var params = "jsonCheck="+jsonCheck;
//	console.log(jsonCheck);
	window.open('cateUp.php?'+params,'cs','width=1000,height=400');
});


$("#mySave, #mySave2").click(function(){

	var total_cnt=0;
	var checkArray=new Array();
	$('input:checkbox[id="pnum"]').each(function() {
			checkArray[total_cnt]=this.value;//배열로 저장
			total_cnt++;
	});

	var total_cnt=0;
	var nameArray=new Array();
	$('textarea[id="itemName"]').each(function() {
			nameArray[total_cnt]=this.value;//배열로 저장
			total_cnt++;
	});

	var total_cnt=0;
	var priceArray=new Array();
	$('input:text[id="myPrice"]').each(function() {

			priceArray[total_cnt]=this.value;//배열로 저장
			total_cnt++;
	});

	var total_cnt=0;
	var sendMethodArray=new Array();
	$('select[id="sendMethod"]').each(function() {
//			console.log(this.value);
			sendMethodArray[total_cnt]=this.value;//배열로 저장
			total_cnt++;
	});

	var total_cnt=0;
	var sendFeePayTypeArray=new Array();
	$('select[id="sendFeePayType"]').each(function() {
//			console.log(this.value);
			sendFeePayTypeArray[total_cnt]=this.value;//배열로 저장
			total_cnt++;
	});


	var total_cnt=0;
	var sendFeeTypeArray=new Array();
	$('select[id="sendFeeType"]').each(function() {
//			console.log(this.value);
			sendFeeTypeArray[total_cnt]=this.value;//배열로 저장
			total_cnt++;
	});

	var total_cnt=0;
	var sendFeeFreeLimitArray=new Array();
	$('input:text[id="sendFeeFreeLimit"]').each(function() {
			sendFeeFreeLimitArray[total_cnt]=this.value;//배열로 저장
			total_cnt++;
	});

	var total_cnt=0;
	var sendFeeEachCntArray=new Array();
	$('input:text[id="sendFeeEachCnt"]').each(function() {
			sendFeeEachCntArray[total_cnt]=this.value;//배열로 저장
			total_cnt++;
	});

	var total_cnt=0;
	var sendBasicFeeArray=new Array();
	$('input:text[id="sendBasicFee"]').each(function() {
			sendBasicFeeArray[total_cnt]=this.value;//배열로 저장
			total_cnt++;
	});

	var total_cnt=0;
	var retunSendFeeArray=new Array();
	$('input:text[id="retunSendFee"]').each(function() {
			retunSendFeeArray[total_cnt]=this.value;//배열로 저장
			total_cnt++;
	});

	var total_cnt=0;
	var changeSendFeeArray=new Array();
	$('input:text[id="changeSendFee"]').each(function() {
			changeSendFeeArray[total_cnt]=this.value;//배열로 저장
			total_cnt++;
	});


	var total_cnt=0;
	var optContArray1=new Array();
	$('textarea[id="optCont1"]').each(function() {
			//console.log($.trim(this.value));
			optContArray1[total_cnt]=$.trim(this.value);//배열로 저장
			total_cnt++;
	});


	var total_cnt=0;
	var optContArray2=new Array();
	$('textarea[id="optCont2"]').each(function() {
			optContArray2[total_cnt]=$.trim(this.value);//배열로 저장
			total_cnt++;
	});

	var total_cnt=0;
	var optContArray3=new Array();
	$('textarea[id="optCont3"]').each(function() {
			optContArray3[total_cnt]=$.trim(this.value);//배열로 저장
			total_cnt++;
	});

	var total_cnt=0;
	var nowFeeArray=new Array();
	$('input:text[id="nowFee"]').each(function() {
//			console.log(this.value);
			nowFeeArray[total_cnt]=this.value;//배열로 저장
			total_cnt++;
	});

	var total_cnt=0;
	var nowUnitArray=new Array();
	$('select[id="nowUnit"]').each(function() {
			nowUnitArray[total_cnt]=this.value;//배열로 저장
//			console.log(this.value);
			total_cnt++;
	});

		var total_cnt=0;
	var upRatioArray=new Array();
	$('select[id="upRatio"]').each(function() {
			upRatioArray[total_cnt]=this.value;//배열로 저장
//			console.log(this.value);
			total_cnt++;
	});


	var total_cnt=0;
	var optionTypeArray=new Array();
	$('select[id="optionType"]').each(function() {
			optionTypeArray[total_cnt]=this.value;//배열로 저장
//			console.log(this.value);
			total_cnt++;
	});


	


//	console.log(total_cnt);
	var jsonCheck = encodeURIComponent(JSON.stringify(checkArray));//json으로 바꿈
	var jsonName = encodeURIComponent(JSON.stringify(nameArray));//json으로 바꿈
	var jsonPrice = encodeURIComponent(JSON.stringify(priceArray));//json으로 바꿈
	var jsonSendMethod = encodeURIComponent(JSON.stringify(sendMethodArray));//json으로 바꿈
	var jsonSendFeePayType = encodeURIComponent(JSON.stringify(sendFeePayTypeArray));//json으로 바꿈
	var jsonSendFeeType = encodeURIComponent(JSON.stringify(sendFeeTypeArray));//json으로 바꿈
	var jsonSendFeeFreeLimit = encodeURIComponent(JSON.stringify(sendFeeFreeLimitArray));//json으로 바꿈
	var jsonSendFeeEachCnt = encodeURIComponent(JSON.stringify(sendFeeEachCntArray));//json으로 바꿈

	var jsonSendBasicFee = encodeURIComponent(JSON.stringify(sendBasicFeeArray));//json으로 바꿈
	var jsonRetunSendFee = encodeURIComponent(JSON.stringify(retunSendFeeArray));//json으로 바꿈
	var jsonChangeSendFee = encodeURIComponent(JSON.stringify(changeSendFeeArray));//json으로 바꿈
	var jsonOptCont1 = encodeURIComponent(JSON.stringify(optContArray1));//json으로 바꿈
	var jsonOptCont2 = encodeURIComponent(JSON.stringify(optContArray2));//json으로 바꿈
	var jsonOptCont3 = encodeURIComponent(JSON.stringify(optContArray3));//json으로 바꿈

	var jsonNowFee = encodeURIComponent(JSON.stringify(nowFeeArray));//json으로 바꿈
	var jsonNowUnit = encodeURIComponent(JSON.stringify(nowUnitArray));//json으로 바꿈
	var jsonupRatio = encodeURIComponent(JSON.stringify(upRatioArray));//json으로 바꿈
	var jsonoptionType = encodeURIComponent(JSON.stringify(optionTypeArray));//json으로 바꿈


	var params = "jsonCheck="+jsonCheck+"&jsonName="+jsonName+"&jsonPrice="+jsonPrice+"&jsonSendMethod="+jsonSendMethod+"&jsonSendFeePayType="+jsonSendFeePayType+"&jsonSendFeeType="+jsonSendFeeType+"&jsonSendFeeFreeLimit="+jsonSendFeeFreeLimit+"&jsonSendFeeEachCnt="+jsonSendFeeEachCnt+"&jsonSendBasicFee="+jsonSendBasicFee+"&jsonRetunSendFee="+jsonRetunSendFee+"&jsonChangeSendFee="+jsonChangeSendFee+"&jsonOptCont1="+jsonOptCont1+"&jsonOptCont2="+jsonOptCont2+"&jsonOptCont3="+jsonOptCont3+"&jsonNowFee="+jsonNowFee+"&jsonNowUnit="+jsonNowUnit+"&jsonupRatio="+jsonupRatio;

//	console.log(params);
//	return;

	$.ajax({
			  type: 'post'
			, url: '/product/itemUpOk.php'
			,data : params
			, dataType : 'json'
			, success: function(data) {

				if(data.result==1){
					alert(data.val);
					location.reload();
				}else if(data.result==-1){
					alert(data.val);
				}else{
					alert('다시 시도하세요');
				}
			  }
			  ,beforeSend:function(){
						$('#wrap-loading').show();
						$('#wrap-loading').center();
				}
				,complete:function(){
						$('#wrap-loading').hide();
				}
		});

});


$("#excelSave, #excelSave2").click(function(){

	var total_cnt=0;
	var checkArray=new Array();
	$('input:checkbox[id="pnum"]').each(function() {
		if(this.checked){//checked 처리된 항목의 값
			checkArray[total_cnt]=this.value;//배열로 저장
			total_cnt++;
		}
	});


//	console.log(total_cnt);
	var jsonCheck = encodeURIComponent(JSON.stringify(checkArray));//json으로 바꿈

	location.href='/product/excelSave.php?jsonCheck='+jsonCheck;
	return

});


$("#zipSave, #zipSave2").click(function(){

	<?if(!isCouponCnt($_SESSION['AID'])){?>
		alert('대표이미지 저장은 유료회원만 가능합니다.');
		return;
	<?}?>

	var total_cnt=0;
	var checkArray=new Array();
	$('input:checkbox[id="pnum"]').each(function() {
		if(this.checked){//checked 처리된 항목의 값
			checkArray[total_cnt]=this.value;//배열로 저장
			total_cnt++;
		}
	});

	var jsonCheck = encodeURIComponent(JSON.stringify(checkArray));//json으로 바꿈
/*
	window.open('/thumb/zipSave.php?jsonCheck='+jsonCheck,'wp','width=500,height=200');
	return
*/
	var params ='jsonCheck='+jsonCheck
	$.ajax({
			  type: 'post'
			, url: '/thumb/zipSave.php'
			,data : params
			, dataType : 'json'
			, success: function(data) {

				if(data.result==1){
					alert(data.val);
					location.href="/thumb/"+data.rs;
				}else if(data.result==-1){
					alert(data.val);
				}else{
					alert('다시 시도하세요');
				}
			  }
			  ,beforeSend:function(){
						$('#wrap-loading').show();
						$('#wrap-loading').center();
				}
				,complete:function(){
						$('#wrap-loading').hide();
				}
		});

});


$("#zipSaveView, #zipSaveView2").click(function(){

	var total_cnt=0;
	var checkArray=new Array();
	$('input:checkbox[id="pnum"]').each(function() {
		if(this.checked){//checked 처리된 항목의 값
			checkArray[total_cnt]=this.value;//배열로 저장
			total_cnt++;
		}
	});

	var jsonCheck = encodeURIComponent(JSON.stringify(checkArray));//json으로 바꿈

	var params ='jsonCheck='+jsonCheck
	$.ajax({
			  type: 'post'
			, url: '/itemImage/zipSaveView.php'
			,data : params
			, dataType : 'json'
			, success: function(data) {

				if(data.result==1){
					alert(data.val);
					location.href="/itemImage/"+data.rs;
				}else if(data.result==-1){
					alert(data.val);
				}else{
					alert('다시 시도하세요');
				}
			  }
			  ,beforeSend:function(){
						$('#wrap-loading').show();
						$('#wrap-loading').center();
				}
				,complete:function(){
						$('#wrap-loading').hide();
				}
		});

});


</script>

<?php include $_SERVER["DOCUMENT_ROOT"]."/inc/bot.php";
?>