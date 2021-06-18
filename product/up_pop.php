<?php include $_SERVER["DOCUMENT_ROOT"]."/inc/dbcon.php";
error_reporting(E_ERROR | E_WARNING | E_PARSE);
ini_set('error_reporting', E_ERROR | E_WARNING | E_PARSE);
ini_set("display_errors", 1);
$today=date("Y-m-d");
$ud=$_GET['ud'];



?>
<!doctype html>
<html>
<head>
<meta charset="utf-8">
<title>Mediapic Back-office</title>
<link href="/admin_page/css/dcg_tmall.css" rel="stylesheet" type="text/css" />

<link rel="stylesheet" href="http://code.jquery.com/ui/1.8.18/themes/base/jquery-ui.css" type="text/css" />  
<script src="http://ajax.googleapis.com/ajax/libs/jquery/1.7.1/jquery.min.js"></script>  
<script src="http://code.jquery.com/ui/1.8.18/jquery-ui.min.js"></script>  
<script type="text/javascript" src="/asset/js/formplugin.js"></script>
<!-- 메인메뉴 S -->
    <div id="wrap_tmall_content">
     

<?
	$que3="select count(1) from ptest where 1=1 group by reg_idx";
	$result3 = $mysqli->query($que3) or die("1:".$mysqli->error);
	$rs3 = $result3->fetch_array();
	$total_ptest=$result3->num_rows;


	if($ud){
		$where.=" and reg_idx='$ud'";
	}


	if(!$order){
		$order=" order by up_date desc";
	}

	$LIMIT=$_GET['LIMIT']??20;
	$page=$_GET['page']??1;


	$que2="select count(1) from ptest where 1=1";
	$que2.=$where;
	$result2 = $mysqli->query($que2) or die("2:".$mysqli->error);
	$rs2 = $result2->fetch_array();
	$total=$rs2[0];

	$que2="select count(1) from ptest where gubun='1'";
	$que2.=$where;
	$result2 = $mysqli->query($que2) or die("2:".$mysqli->error);
	$rs2 = $result2->fetch_array();
	$win_total=$rs2[0];

	$que2="select count(1) from ptest where gubun not in ('0','1')";
	$que2.=$where;
	$result2 = $mysqli->query($que2) or die("2:".$mysqli->error);
	$rs2 = $result2->fetch_array();
	$lose_total=$rs2[0];

	$que2="select count(1) from ptest where utype='1'";
	$que2.=$where;
	$result2 = $mysqli->query($que2) or die("2:".$mysqli->error);
	$rs2 = $result2->fetch_array();
	$modify_total=$rs2[0];

?>
       <!-- sub title영역 S -->
      <div class="sub_title_area">
      <dl>
       <dt>전체상품수 <font color="red"><?echo number_format($total);?></font> 개</dt>
      </dl>
	  <dl>
       <dt>등록상품수 <font color="red"><?echo number_format($total-$modify_total);?></font> 개, 수정상품수 <font color="red"><?echo number_format($modify_total);?></font> 개</dt>
      </dl>
	  <dl>
       <dt>성공수 <font color="red"><?echo number_format($win_total);?></font> 개, 실패수 <font color="red"><?echo number_format($lose_total);?></font> 개</dt>
	   <dd>
		<div class="midle_bu_area ml20">
		  <ul class="left_bu_area">
			<li><a class="button05" href="excel_out.php?ud=<?=$ud?>">등록정보 엑셀 다운로드</a></li>
		</ul>
		 </div>
	   </dd>
      </dl>
      </div>
       <!-- sub title영역 E -->
              <!-- GRID S-->
              <div class="gridTable_list01">

                <table width="100%" border="0" style="table-layout:fixed; word-break:break-all;">

                  <colgroup>
                  <col width=5%/>
				  <col width=10%/>
                  <col width=15%/>
				  <col width=15%/>
                  <col width=5% />
                  <col width=5%/>
				  <col width="*"/>
                  </colgroup>
                  <thead>
                    <tr>
                      <th scope="col">NO</th>
					  <th scope="col">입고일(엑셀)</th>
					  <th scope="col">매장명</th>
                      <th scope="col">상품명</th>
                      <th scope="col">성공여부</th>
                      <th scope="col">등록수정</th>
					  <th scope="col">실패사유</th>
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
	$que="select * 
	from ptest  where  1=1";
	$que.=$where;
	$que.=$order;
	$que.=$limit_query;
//	echo $que;
	$result = $mysqli->query($que) or die("3:".$mysqli->error);
	while($rs = $result->fetch_object()){
			$rsc[]=$rs;
	}

if($total){

foreach($rsc as $p){

?>
                    <tr >
                      <td><?=$no?></td>
					  <td><?echo $p->reg_date;?></td>
                      <td><?echo $p->sname;?></td>
                      <td>
								<?echo $p->pname;?>
					  </td>
                      <td>
							<?
							switch($p->gubun) {
								case 0:$gb="등록전";
								break;
								case 1:$gb="성공";
								break;
								default:$gb="<font color='red'>실패</font>";
							}
							echo $gb;
?>
					  </td>
					  <td>
							<?
							switch($p->utype) {
								case 0:$gb="등록";
								break;
								case 1:$gb="수정";
								break;
							}
							echo $gb;
?>
					  </td>
                      <td class="pl20">
							<?
							
							switch($p->gubun) {
								case -4:$gb="이미지 등록 실패";
								break;
								case -2:$gb="FTP서버에 제품폴더는 있지만 이미지파일 없음";
								break;
								case -1:$gb="FTP서버에 제품 폴더가 없음";
								break;
								case 0:$gb="등록전";
								break;
								case 1:$gb="등록완료";
								break;
								case 2:$gb="해당 셀러가 없음";
								break;
								case 3:$gb="컬러없음";
								break;
								case 4:$gb="엑셀오류";
								break;
							}
							echo $gb;

							$reason=explode(",",substr($p->reason,0,-1));
							sort($reason);
							//print_r($reason);
							if($p->reason){
								echo " (";
							}
							$rr="";
							foreach($reason as $r){
								if($r){
									$rr.=reason_is($r).",";
								}
							}
							echo substr($rr,0,-1);
							if($p->reason){
								echo ")";
							}


?>

					  </td>

                    </tr>
<?
$no--;
}
}else{?>
					<tr>
                      <td colspan="7">데이타가 없습니다.</td>
                    </tr>
<?}?>
                  </tbody>
                </table>
</form>
              </div>
    <!-- GRID E-->
       
     

<!-- page_skip -->
<br>
	<div style="text-align:center;">
		<?if($f_no!=1){?><a href="<?=$PHP_SELF?>?ud=<?=$ud?>&page=<?=$p_f_no?>&f_no=<?=$p_f_no?>&multi=<?=$multi?>&ord=<?=$ord?>&s_key=<?=$s_key?>&s_word=<?=$s_word?>&start_date=<?=$start_date?>&end_date=<?=$end_date?>&SHOP_CODE=<?=$SHOP_CODE?>&spa=<?=$spa?>&sq=<?=$sq?>&sq2=<?=$sq2?>&cate1=<?=$cate1?>&cate2=<?=$cate2?>&start_date2=<?=$start_date2?>&end_date2=<?=$end_date2?>&IMGVOD_FLAG=<?=$IMGVOD_FLAG?>"><img src="/admin_page/images/btn_prev02.gif" alt="이전 목록" class="btn01" /></a><?}?>

				<? for($i=$f_no;$i<=$l_no;$i++){?>
					<?if($i==$page){?>
						<strong><u><?=$i?></u></strong>&nbsp;
					<?} else {?>
						<a href="<?=$PHP_SELF?>?ud=<?=$ud?>&page=<?=$i?>&f_no=<?=$f_no?>&multi=<?=$multi?>&sort=<?=$sort?>&s_key=<?=$s_key?>&s_word=<?=$s_word?>&start_date=<?=$start_date?>&end_date=<?=$end_date?>&SHOP_CODE=<?=$SHOP_CODE?>&spa=<?=$spa?>&sq=<?=$sq?>&sq2=<?=$sq2?>&cate1=<?=$cate1?>&cate2=<?=$cate2?>&start_date2=<?=$start_date2?>&end_date2=<?=$end_date2?>&IMGVOD_FLAG=<?=$IMGVOD_FLAG?>">
						<?=$i?>&nbsp;</a>
					<?}?>
				<?}?>

		<?if($l_no<$total_page){?><a href="<?=$PHP_SELF?>?ud=<?=$ud?>&page=<?=$n_f_no?>&f_no=<?=$n_f_no?>&multi=<?=$multi?>&ord=<?=$ord?>&s_key=<?=$s_key?>&s_word=<?=$s_word?>&start_date=<?=$start_date?>&end_date=<?=$end_date?>&SHOP_CODE=<?=$SHOP_CODE?>&spa=<?=$spa?>&sq=<?=$sq?>&sq2=<?=$sq2?>&cate1=<?=$cate1?>&cate2=<?=$cate2?>&start_date2=<?=$start_date2?>&end_date2=<?=$end_date2?>&IMGVOD_FLAG=<?=$IMGVOD_FLAG?>"><img src="/admin_page/images/btn_next02.gif" alt="다음 목록" class="btn02" /></a><?}?>


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