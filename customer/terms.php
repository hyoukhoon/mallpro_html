<?php include $_SERVER["DOCUMENT_ROOT"]."/admin_page/inc/top.php";
?>

<!-- 메인메뉴 S -->
    <div id="wrap_tmall_content">
     
     <ul class="top_title_area">
       <li class="top_title">콘텐츠관리 > 약관관리</li>
	   <div class="midle_bu_area ml20">
			<ul class="left_bu_area">
			<li ><button type="button" class="button05" id="add1" onclick="window.open('terms_write.php','s1','width=800,height=600,scrollbars=yes')">+약관등록</button></li>
			</ul>
		</div>
     </ul>
<?

	if($CATEGORY_SEQ){
		$where.=" and a.CATEGORY_SEQ='".$CATEGORY_SEQ."'";
	}

	if(!$order){
		$order=" order by a.CONTENT_SEQ desc";
	}

	$LIMIT=$_GET['LIMIT']??30;
	$page=$_GET['page']??1;


	$que2="select count(1) from bbs_content a, bbs_category b 
	where 
	a.CATEGORY_SEQ=b.CATEGORY_SEQ 
	and  b.BBS_TYPE in ('T','Q','S') 
	and b.CATEGORY_USE='1' and a.CONTENT_DEL='0'";
	$que2.=$where;
	$result2 = $mysqli->query($que2) or die("1:".$mysqli->error);
	$rs2 = $result2->fetch_array();
	$total=$rs2[0];
?>

       <!-- sub title영역 S -->
      <div class="sub_title_area">
      <dl>

       <dd>
	   <div class="midle_bu_area ml20">
		  <ul class="left_bu_area">
			<li style="vertical-align:text-bottom;">선택한 상품을 </li>
			<li><a class="button05" href="javascript:;" id='c1' val='ds' onclick="sdForm(1)">노출함</a></li>
			<li><a class="button05" href="javascript:;" id='c2' val='nd' onclick="sdForm(2)">노출안함</a></li>
			<li><a class="button05" href="javascript:;" id='c3' val='dd' onclick="sdForm(3)">삭제</a></li>
		</ul>
		 </div>
	   
	   </dd>
      </dl>
      </div>
       <!-- sub title영역 E -->
       
     
              <!-- GRID S-->
              <div class="gridTable_list01">

<form method="get" action="nl_ok.php" name="af">
<input type="hidden" name="CATEGORY_SEQ" value="<?=$CATEGORY_SEQ?>">
<input type="hidden" name="gubun" value="<?=$gubun?>">
<input type="hidden" name="url" value="<?=$_SERVER['PHP_SELF']?>">

                <table width="100%" border="0" >
                  <colgroup>
                  <col width=3%/>
                  <col width=5%/>
                  <col width="*"/>
                  <col width=10% />
                  <col width=10%/>
                  <col width=10%/>
                  <col width=10%/>
                  </colgroup>
                  <thead>
                    <tr>
                      <th scope="col"><input type="checkbox" id="checkAll"></th>
                      <th scope="col">NO</th>
					  <th scope="col">제목</th>
                      <th scope="col">카테고리</th>
                      <th scope="col">게시상태</th>
					  <th scope="col">등록일</th>
					  <th scope="col">등록자</th>
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
	$que="select *,a.WRITER as WT , a.REG_DATE as RD
	from bbs_content a, bbs_category b 
	where 
	a.CATEGORY_SEQ=b.CATEGORY_SEQ 
	and  b.BBS_TYPE in ('T','Q','S') 
	and b.CATEGORY_USE='1' and a.CONTENT_DEL='0'";
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
                      <td><input type="checkbox" name="num[]" id="chkId" value="<?=$p->CONTENT_SEQ?>"></td>
                      <td><?=$no?></td>
					  <td class="pl20"><a href="javascript:;" onclick="window.open('terms_write.php?CONTENT_SEQ=<?=$p->CONTENT_SEQ?>&BBS_TYPE=<?=$p->BBS_TYPE?>','s1','width=800,height=600,scrollbars=yes')"><?=$p->SUBJECT?></a></td>
					  <td><?=$p->CATEGORY_NAME?></td>
                      <td><?if($p->CONTENT_DISPLAY==0){?>미노출<?}else{?>노출<?}?></td>
					  <td><?=$p->RD?></td>
					  <td><?=$p->WT?></td>
                    </tr>
<?
$no--;
}?>
                  </tbody>
                </table>
</form>
              </div>
    <!-- GRID E-->
       
     

<!-- page_skip -->
<div class="page_skip_area">
	<div class="page_skip">
		<?if($f_no!=1){?><a href="<?=$PHP_SELF?>?mode=<?=$mode?>&page=<?=$p_f_no?>&f_no=<?=$p_f_no?>&multi=<?=$multi?>&ord=<?=$ord?>&s_key=<?=$s_key?>&s_word=<?=$s_word?>&start_date=<?=$start_date?>&end_date=<?=$end_date?>&CATEGORY_SEQ=<?=$CATEGORY_SEQ?>&CONTENT_DISPLAY=<?=$CONTENT_DISPLAY?>&gubun=<?=$gubun?>"><img src="/admin_page/images/btn_prev02.gif" alt="이전 목록" class="btn01" /></a><?}?>

				<? for($i=$f_no;$i<=$l_no;$i++){?>
					<?if($i==$page){?>
						<strong><?=$i?></strong>&nbsp;
					<?} else {?>
						<a href="<?=$PHP_SELF?>?mode=<?=$mode?>&page=<?=$i?>&f_no=<?=$f_no?>&multi=<?=$multi?>&sort=<?=$sort?>&s_key=<?=$s_key?>&s_word=<?=$s_word?>&start_date=<?=$start_date?>&end_date=<?=$end_date?>&CATEGORY_SEQ=<?=$CATEGORY_SEQ?>&CONTENT_DISPLAY=<?=$CONTENT_DISPLAY?>&gubun=<?=$gubun?>">
						<?=$i?>&nbsp;</a>
					<?}?>
				<?}?>

		<?if($l_no<$total_page){?><a href="<?=$PHP_SELF?>?mode=<?=$mode?>&page=<?=$n_f_no?>&f_no=<?=$n_f_no?>&multi=<?=$multi?>&ord=<?=$ord?>&s_key=<?=$s_key?>&s_word=<?=$s_word?>&start_date=<?=$start_date?>&end_date=<?=$end_date?>&CATEGORY_SEQ=<?=$CATEGORY_SEQ?>&CONTENT_DISPLAY=<?=$CONTENT_DISPLAY?>&gubun=<?=$gubun?>"><img src="/admin_page/images/btn_next02.gif" alt="다음 목록" class="btn02" /></a><?}?>

	</div>       
</div>     
  <!-- 메인메뉴 E -->

<script>
$(document).ready(function(){
  $("#checkAll").on("click",function(){
   var _value = $(this).is(":checked");
   $('input:checkbox[id="chkId"]').each(function () { 
    this.checked = _value; 
   });
  });
 });

function sdForm(n){

	a=document.af;

	a.gubun.value=n;

	a.submit();

}
</script>
<?php include $_SERVER["DOCUMENT_ROOT"]."/admin_page/inc/bot.php";
?>