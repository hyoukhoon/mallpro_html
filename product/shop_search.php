<?php session_start();
include $_SERVER["DOCUMENT_ROOT"]."/inc/dbcon.php";

$mode=$_GET['mode'];
$s_word=$_GET['s_word'];
$SHOP_CODE=$_GET['SHOP_CODE'];
//$s_word="파인";

?>
<!doctype html>
<html>
<head>
<meta charset="utf-8">
<title>Mediapic Back-office</title>
<link href="/admin_page/css/dcg_tmall.css" rel="stylesheet" type="text/css" />
<script type="text/javascript" src="/asset/js/jquery-1.11.3.min.js"></script>
</head>

<body class="bg_popup" onload="document.sf.s_word.focus();">

<!-- 전체 넓이 S-->
<div id="pop_wrap">
  <!-- 상단 head로고 S-->
  <div class="pop_top_bg">
    <ul>
     <li><span>셀러매장조회</span></li>
    </ul>
  </div>
  <!-- 상단 head로고 E-->
  
  <!-- 컨텐츠 S -->
  <div class="pop_content">
<form method="get" action="<?=$_SERVER['PHP_SELF']?>" name="sf">
<input type="hidden" name="mode" value="s">

  <!-- GRID S-->
              <div class="list_table_list01">
                <table width="100%" border="0" >
                  <colgroup>
                  <col width="*"/>
                  </colgroup>
                 
                  <tbody>
				  <tr>
                      <th class="color_ch" scope="row">
						<select name="SHOP_CODE">
							<option value="">상가선택</option>
							<?echo shop_code_val('ko',$SHOP_CODE)?>
						</select>
						&nbsp;
						<input type="text" name="s_word" value="<?=$s_word?>">
						&nbsp;
						<button type="submit" class="button03_4">검색</button>
					  </th>
                    </tr>
                  </tbody>
                </table>
              </div>
      <!-- GRID E-->
</form>
<br>
	  <!-- GRID S-->
              <div class="list_table_list01">
                <table width="100%" border="0" >
                  <colgroup>
                  <col width=50/>
                  <col width="*"/>
				  <col width="*"/>
                  </colgroup>
                 
                  <tbody>
					<tr>
                      <th class="color_ch" scope="row" style="text-align:center;">No</th>
					  <th class="color_ch" scope="row" style="text-align:center;">상가명</th>
					  <th class="color_ch" scope="row" style="text-align:center;">매장명</th>
                    </tr>

<?

if($mode=="s"){

	if($SHOP_CODE){
		$where.=" and SHOP_CODE='".$SHOP_CODE."'";
}

	if($s_word){
		$where.=" and SNAME like '%".$s_word."%'";
}

	$que2="select count(1) from seller where 1=1";
	$que2.=$where;
	$result2 = $mysqli->query($que2) or die("2:".$mysqli->error);
	$rs2 = $result2->fetch_array();
	$total=$rs2[0];


$no=$total;//번호매기기

	$que="select * 
	from seller  where 1=1";
	$que.=$where;
	$que.=$order;
	$que.=$limit_query;
//	echo $que;
	$result = $mysqli->query($que) or die("3:".$mysqli->error);
	while($rs = $result->fetch_object()){
			$rsc[]=$rs;
	}


foreach($rsc as $p){
?>
                    <tr class="sid" shop_code="<?=$p->SHOP_CODE?>" sname="<?=$p->SNAME?>" seller_code="<?=$p->SELLER_CODE?>" style="cursor:pointer;">
                      <td style="text-align:center;"><?=$no?></td>
					  <td style="text-align:center;"><?echo shop_name_is('ko',$p->SHOP_CODE);?></td>
					  <td style="text-align:center;"><?=$p->SNAME?></td>
                    </tr>
<?
$no--;
}
}
?>
<?if(!$total){?>
					<tr>
                      <td colspan="3" style="text-align:center;">검색결과가 없습니다.</td>
                    </tr>
<?}?>


                  </tbody>
                </table>
              </div>
      <!-- GRID E-->

   <!-- 하단 버튼 S-->

  <!-- 하단 버튼 E-->


   
</div>
  <!-- 컨텐츠 E --> 
 
   
  </div>
 <!-- 전체 넓이 E-->

</body>
</html>
<script>

	$('.sid').on('click', function() {

		var shop_code = $(this).attr('shop_code');
		var seller_code = $(this).attr('seller_code');
		var sname = $(this).attr('sname');
		$("#admin",opener.document).val(shop_code);
		$("#seller_code",opener.document).val(seller_code);
		$("#sname",opener.document).val(sname);
		window.close();

	});

</script>
