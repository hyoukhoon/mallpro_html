<?php include $_SERVER["DOCUMENT_ROOT"]."/inc/top.php";
include $_SERVER["DOCUMENT_ROOT"]."/product/product_lib.php";

$uid=$_SESSION['AID'];
$today=date("Y-m-d");
$sq=$_GET['sq']??"none";
$sq2=$_GET['sq2']??"none";
$mode=$_GET['mode'];
$s_key=$_GET['s_key'];
$s_word=$_GET['s_word'];
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
       <li class="top_title">상품관리 > 전체리스트</li>
	   <!-- <div class="midle_bu_area ml20">
			<ul class="left_bu_area">
			<li ><button type="button" class="button05" id="add1" onclick="window.open('searchUp.php','s1','width=600,height=400,left=200,top=100,scrollbars=yes')">+검색어등록</button></li>
			<li ><button type="button" class="button05" id="add1" onclick="window.open('searchUp2.php','s2','width=600,height=400,left=200,top=100,scrollbars=yes')">+URL등록</button></li>
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
										<option value="subject" <?if($s_key=="subject"){?>selected<?}?>>상품명</option>
										<option value="tag" <?if($s_key=="tag"){?>selected<?}?>>태그</option>
										<!-- <option value="PRODUCT_CODE" <?if($s_key=="PRODUCT_CODE"){?>selected<?}?>>상품코드</option>
										<option value="ADMIN" <?if($s_key=="ADMIN"){?>selected<?}?>>매장명</option> -->
									</select>
									&nbsp;&nbsp;
									<input type="text" name="s_word" value="<?=$s_word?>">
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

							 <!-- <tr>
                               <td scope="col" class="title1">표시갯수</td>
                               <td>
									<select name="LIMIT" style="width:100px;" onchange="location.href='<?echo $_SERVER['PHP_SELF']?>?LIMIT='+this.value+'&s_key=<?=$s_key?>&s_word=<?=$s_word?>&start_date=<?=$start_date?>&end_date=<?=$end_date?>'">
										<option value="30" <?if($LIMIT==30){?>selected<?}?>>30</option>
										<option value="60" <?if($LIMIT==60){?>selected<?}?>>60</option>
										<option value="100" <?if($LIMIT==100){?>selected<?}?>>100</option>
										<option value="300" <?if($LIMIT==300){?>selected<?}?>>300</option>
										<option value="500" <?if($LIMIT==500){?>selected<?}?>>500</option>
									</select>
                              </td>
                               <td style="padding-left:30px;">
								
                              </td>
                             </tr>  -->
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
<?PHP
	$que3="select count(1) from taobao where uid='$uid' and price is not Null and isDisplay='1'";
	$result3 = $mysqli->query($que3) or die("1:".$mysqli->error);
	$rs3 = $result3->fetch_array();
	$total_product=$rs3[0];

	if($s_key && $s_word){
			$where=" and $s_key like '%".$s_word."%'";
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
		$where.=" and regDate>='".$start_date."' and regDate<='".$end_date." 23:59:59'";
	}

//	if($mode=="up" and $start_date2 and $end_date2){
//		$where.=" and REGDATE between '".$start_date2."' and '".$end_date2." 23:59:59'";
//	}





	if(!$order){
		$order=" order by num desc";
	}




	$que2="select count(1) from taobao  where uid='$uid'  and isDisplay='1' $where";
	$que2.=$where;
	$result2 = $mysqli->query($que2) or die("2:".$mysqli->error);
	$rs2 = $result2->fetch_array();
	$total=$rs2[0];
/*
if($s_word){
	$query="INSERT INTO `mallpro`.`searchWord`
					(`uid`,
					`kw`,
					`searchCnt`)
					VALUES
					('$uid',
					'$s_word',
					'$total') ON     DUPLICATE KEY UPDATE cnt=cnt+1, searchCnt='$total', regDate=now()";
	$sql = $mysqli->query($query) or die("33:".$mysqli->error);
}
*/

$cny=cnyIs();

?>
       <!-- sub title영역 S -->
      <div class="sub_title_area">
      <dl>
       <dt style="padding-left:0px;">- 총상품건수 <?echo number_format($total_product);?>건  |  검색결과    <?echo number_format($total);?>건 / 현재환율 : <?echo number_format($cny,2);?></dt>
       <dd>
	   
		<div class="midle_bu_area ml20">
			<ul class="left_bu_area">
				<li style="vertical-align:bottom;">선택한 상품을 </li>
				<li><button type="button" id='myUp' val='cc'  class="button03_4" style="width:150px;height:30px;padding:4px 20px;">내상품에등록</button></li>
				<li><button type="button" id='hid' val='hid' class="button03_4" style="width:120px;height:30px;padding:4px 20px;">삭제하기</button></li>
				<li style="vertical-align:bottom;font-weight:bold;">리스트 갯수 변경</li>
				<li>
					<select name="LIMIT" style="width:100px;" onchange="location.href='<?echo $_SERVER['PHP_SELF']?>?LIMIT='+this.value+'&s_key=<?=$s_key?>&s_word=<?=$s_word?>&start_date=<?=$start_date?>&end_date=<?=$end_date?>'">
										<option value="30" <?if($LIMIT==30){?>selected<?}?>>30</option>
										<option value="60" <?if($LIMIT==60){?>selected<?}?>>60</option>
										<option value="100" <?if($LIMIT==100){?>selected<?}?>>100</option>
										<option value="300" <?if($LIMIT==300){?>selected<?}?>>300</option>
										<option value="500" <?if($LIMIT==500){?>selected<?}?>>500</option>
									</select>
				</li>
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

                  <!-- <colgroup>
                  <col width=3%/>
                  <col width=5%/>
                  <col width=9%/>
				  <col width=5%/>
                  <col width="*"/>
				  <col width=20% />
                  <col width=10% />
                  <col width=10%/>
                  <col width=10%/>
                  </colgroup> -->
                  <thead>
                    <tr>
                      <th scope="col" width="3%"><input type="checkbox" id="checkAll"></th>
                      <th scope="col" width="5%">NO</th>
					  <th scope="col" width="5%">링크</th>
					  <th scope="col" width="110">대표사진</th>
					  <th scope="col" width="3%">동영상</th>
                      <th scope="col">상품명</th>
					  <th scope="col" width="50">상세</th>
                      <th scope="col">가격</th>
					  <th scope="col">옵션</th>
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
	$que="select * from taobao   where uid='$uid'  and isDisplay='1'";
	$que.=$where;
	$que.=$order;
	$que.=$limit_query;
//echo $que;
	$result = $mysqli->query($que) or die("3:".$mysqli->error);
	while($rs = $result->fetch_object()){
			$rsc[]=$rs;
	}

$ingGet=0;
foreach($rsc as $p){

	$tf=explode(",",$p->thumbFile);
	$vUrl=$p->videoUrl;
	$vUrl=str_replace("e/1","e/6",$vUrl);
	$vUrl=str_replace("t/8","t/1",$vUrl);
	$vUrl=str_replace(".swf",".mp4",$vUrl);
	$vUrl="http:".$vUrl;

?>
                    <tr style="overflow: hidden;">
                      <td>

						  <input type="checkbox" name="num[]" id="pnum" value="<?=$p->num?>">

						  </td>
                      <td><?=$no?><!-- /<?=$p->pid?> --></td>
                      <td><a href="<?=$p->url?>" target="_blank">링크보기</a></td>
					  <td style="text-align:center;">
					  <?php 
							
						  if($p->subject){
							  ?>
							<a href="javascript:;" onclick="window.open('slider.php?img=<?=$p->thumbFile?>','slp','width=400,height=640');"><img src="/thumb/<?echo $tf[0]?>" width="100"></a>
						<?}else{
								  $ingGet++;
								  ?>
							<img src="/images/loading.gif" width="100">
						<?}?>
					  </td>
					  <td style="text-align:center;">
						<?if($p->videoUrl){?>
							有
						<?}else{?>
							無
						<?}?>
					  </td>
                      <td style="text-align:left;line-height:25px;">

						  <?echo $p->subject??"제품 정보를 가져오는 중입니다. 잠시 후에 확인하십시오.";?><br>
						  <font color="blue">Tag</font> : <?echo $p->tag;?>

					  </td>
					  <td>
							<a href="javascript:;" onclick="window.open('/product/itemView.php?num=<?=$p->num?>','iv','width=850,height=800,scrollbars=yes')">보기</a><br>
					  </td>
                      <td style="line-height:25px;"><?echo $p->price;?>위안 / 
						<?php
							$cn=explode("-",$p->price);
							$cn1=trim($cn[0]);
							$cn2=trim($cn[1]);
							if($cn2){
								echo "약 ".number_format($cn1*$cny)." ~ ".number_format($cn2*$cny)." 원";
							}else{
								echo "약 ".number_format($cn1*$cny)." 원";
							}
							
							$cnp=explode("-",$p->promoPrice);
							$cnp1=trim($cnp[0]);
							$cnp2=trim($cnp[1]);
				?>
						<?if($cnp1>0 and $cnp1<$cn1){?>
							<br><font color="red">(할인가: <?=$p->promoPrice?>위안 / 약 <?echo number_format($cnp1*$cny)?><?if($cnp2>0){echo " ~ ".number_format($cnp2*$cny);}?>원)</font>
						<?}?>
					  </td>
					  <td>
						<?if($p->optionCount>3){?>
							옵션이 네개이상인 상품은 네이버에서 직접 옵션을 등록하셔야합니다
						<?}else{

							$optMix=array();
							$result2 = $mysqli->query("select * from optiontable where pnum='".$p->num."'") or die("725:".$mysqli->error);
							$rs2 = $result2->fetch_object();
	
							$optionName="";
							if($rs2->optionName1)$optionName=$rs2->optionName1.",";
							if($rs2->optionName2)$optionName.=$rs2->optionName2.",";
							if($rs2->optionName3)$optionName.=$rs2->optionName3.",";
							$optionName=substr($optionName,0,-1);
							$opn=explode(",",$optionName);
//							echo $optionName."<br>";

							$optionValue="";
							if($rs2->optionValue1)$optionValue=$rs2->optionValue1."||";
							if($rs2->optionValue2)$optionValue.=$rs2->optionValue2."||";
							if($rs2->optionValue3)$optionValue.=$rs2->optionValue3."<br>";
//							echo $optionValue;
							$optionValue=substr($optionValue,0,-2);
							$opv=explode("||",$optionValue);


				
					  ?>
					<table>
<?php
				$p=0;
				foreach($opn as $pn){
					  ?>
							<tr>
								<td style="background-color:#fff;width:60px;">
									<?echo $pn;?>
								</td>
								<td>
									<?echo $opv[$p];?>
								</td>
							</tr>
<?
					$p++;
					  }?>
						</table>
					  
					  <?}?>
					  </td>
                    </tr>
<?
$no--;
}?>
<?if(!$total){?>
					<tr>
                      <td colspan="9">데이타가 없습니다.</td>
                    </tr>
<?}?>
                  </tbody>
                </table>
</form>
              </div>
    <!-- GRID E-->
       
     
		<div class="midle_bu_area ml20">
			<ul class="left_bu_area">
				<!-- <a href="javascript:;" id="checkAll2">전체선택</a> -->
				<li style="vertical-align:text-bottom;">선택한 상품을 </li>
				<li><button type="button" id='myUp2' val='cc'  class="button03_4" style="width:150px;height:30px;padding:4px 20px;">내상품에등록</button></li>
				<!-- <li><button type="button" id='reget2' val='reget' class="button03_4" style="width:150px;height:30px;padding:4px 20px;">데이타다시받기</button></li> -->
				<li><button type="button" id='hid2' val='hid' class="button03_4" style="width:120px;height:30px;padding:4px 20px;">삭제하기</button></li>
			</ul>
		</div>
<!-- page_skip -->
<div class="page_skip_area" style="float:clear;">
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
<div id="wrap-loading" style="display:none;"><img src="/images/loading.gif"></div>
<script>

  $("#checkAll, #checkAll2").on("click",function(){
	   var _value = $(this).is(":checked");
	   $('input:checkbox[id="pnum"]').each(function () { 
	    this.checked = _value; 
	   });
  });



function rewrite(){

	a=document.pf;
	a.action='rewrite.php';
	a.submit();

}
</script>
<script>

jQuery.fn.center = function () {
    this.css("position","absolute");
    this.css("top", Math.max(0, (($(window).height() - $(this).outerHeight()) / 2) + $(window).scrollTop()) + "px");
    this.css("left", Math.max(0, (($(window).width() - $(this).outerWidth()) / 2) + $(window).scrollLeft()) + "px");
    return this;
}

$("#reget, #reget2").click(function(){

	var total_cnt=0;
	var checkArray=new Array();

	$('input:checkbox[id="pnum"]').each(function() {
		if(this.checked){//checked 처리된 항목의 값
			checkArray[total_cnt]=this.value;//배열로 저장
			total_cnt++;
		}
	});
//	console.log(total_cnt);

	if(total_cnt==0){
		alert('다시 등록할 제품을 선택하세요.');
		return;
	}
	var jsonCheck = JSON.stringify(checkArray);//json으로 바꿈

	var params = "jsonCheck="+jsonCheck;
//	console.log(jsonCheck);
	$.ajax({
		  type: 'post'
		, url: '/product/regetOk.php'
		,data : params
		, dataType : 'json'
		, success: function(data) {
//			console.log(data);
			if(data.result==1){
					alert('등록했습니다. 잠시후에 확인해주세요.');
					window.close();
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

$("#myUp, #myUp2").click(function(){

	var total_cnt=0;
	var checkArray=new Array();

	$('input:checkbox[id="pnum"]').each(function() {
		if(this.checked){//checked 처리된 항목의 값
			checkArray[total_cnt]=this.value;//배열로 저장
			total_cnt++;
		}
	});
//	console.log(total_cnt);

	if(total_cnt==0){
		alert('등록할 제품을 선택하세요.');
		return;
	}
	var jsonCheck = JSON.stringify(checkArray);//json으로 바꿈

	var params = "jsonCheck="+jsonCheck;
//	console.log(jsonCheck);
	$.ajax({
		  type: 'post'
		, url: '/product/myUpOk.php'
		,data : params
		, dataType : 'json'
		, success: function(data) {
//			console.log(data);
			if(data.result==1){
					alert('등록했습니다.');
					window.close();
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

$("#hid, #hid2").click(function(){

	var total_cnt=0;
	var checkArray=new Array();

	$('input:checkbox[id="pnum"]').each(function() {
		if(this.checked){//checked 처리된 항목의 값
			checkArray[total_cnt]=this.value;//배열로 저장
			total_cnt++;
		}
	});
//	console.log(total_cnt);

	if(total_cnt==0){
		alert('삭제할 제품을 선택하세요.');
		return;
	}
	var jsonCheck = JSON.stringify(checkArray);//json으로 바꿈

	var params = "jsonCheck="+jsonCheck;
//	console.log(jsonCheck);
	$.ajax({
		  type: 'post'
		, url: '/product/hiddenItem.php'
		,data : params
		, dataType : 'json'
		, success: function(data) {
//			console.log(data.val);
//			return;
			if(data.result==1){
					alert('처리했습니다.');
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

<?if($ingGet){?>

$( document ).ready(function() {
    setTimeout('location.reload()',30000); 
});

<?}?>

</script>

<?php include $_SERVER["DOCUMENT_ROOT"]."/inc/bot.php";
?>
