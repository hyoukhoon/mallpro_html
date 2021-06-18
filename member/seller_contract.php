<?php session_start();
include $_SERVER["DOCUMENT_ROOT"]."/inc/dbcon.php";

$SELLER_CODE=$_GET['SELLER_CODE'];
/*
$que2="select * from seller where SELLER_CODE='".$SELLER_CODE."'";
$result2 = $mysqli->query($que2) or die("2:".$mysqli->error);
$rs2 = $result2->fetch_object();
*/
?>
<!doctype html>
<html>
<head>
<meta charset="utf-8">
<title>Mediapic Back-office</title>
<link href="/css/dcg_tmall.css" rel="stylesheet" type="text/css" />
<script type="text/javascript" src="/asset/js/jquery-1.11.3.min.js"></script>
</head>

<body class="bg_popup">

<!-- 전체 넓이 S-->
<div id="pop_wrap">
  <!-- 상단 head로고 S-->
  <div class="pop_top_bg">
    <ul>
     <li><span>도매사업자상세정보</span></li>
    </ul>
  </div>
  <!-- 상단 head로고 E-->
  
  <!-- 컨텐츠 S -->
  <div class="pop_content">
  <!-- 타이틀 S--> 
	<ul class="top_title_area tabHere">
		<li class="top_title"><a href="/member/seller_write.php?SELLER_CODE=<?=$SELLER_CODE?>">회원기본정보</a></li>
		<li class="top_title"><span>계약내역</span></li>
	</ul>
	<div class="midle_bu_area ml20 tabHere">
		<ul class="left_bu_area">
		<li ><button type="button" class="button05" id="add1" onclick="window.open('cont_up.php?SELLER_CODE=<?=$SELLER_CODE?>','mas1','width=500,height=400,scrollbars=yes')">+계약등록</button></li>
		</ul>
	</div>
  <!-- 타이틀 E--> 

  <!-- GRID S-->
              <div class="gridTable_list01">
                <table width="100%" border="0"  style="table-layout:fixed; word-break:break-all;">

                  <colgroup>
                  <col width=5%/>
                  <col width=10%/>
                  <col width=10%/>
                  <col width="*" />
                  <col width=10%/>
                  <col width=10%/>
                  <col width=10%/>
                  <col width=10% />
                  <col width=10% />
				  <col width=10% />
                  </colgroup>
                  <thead>
                    <tr>
                      <th scope="col">NO</th>
					  <th scope="col">계약코드</th>
                      <th scope="col">계약일자</th>
                      <th scope="col">아이디</th>
                      <th scope="col">업체명</th>
                      <th scope="col">상가명</th>
                      <th scope="col">가입상품</th>
					  <th scope="col">잔여/약정기간</th>
					  <th scope="col">서비스시간</th>
					  <th scope="col">재계약</th>
                    </tr>
                  </thead>
                  <tbody>
<?
/*
	$no=1;
	$que="select * 
	from contract where SELLER_CODE='".$SELLER_CODE."'";
	$que.=$where;
	$que.=$order;
	$que.=$limit_query;
//	echo $que;
	$result = $mysqli->query($que) or die("2:".$mysqli->error);
	while($rs = $result->fetch_object()){
			$rsc[]=$rs;
	}
*/
?>
<?
foreach($rsc as $p){

if($p->SERVICE_END_DATE>date("Y-m-d")){
	$시작일 = new DateTime(date("Y-m-d")); 
	$종료일 = new DateTime($p->SERVICE_END_DATE);
	$df    = date_diff($시작일, $종료일);
	$dday=$df->days;
}else{
	$dday=0;
}

?>
                    <tr>
                      <td><?=$no?></td>
                      <td><a href="javascript:;" onclick="window.open('cont_up.php?mode=edit&SELLER_CODE=<?=$SELLER_CODE?>&CONTRACT_ID=<?=$p->CONTRACT_ID?>','aea<?=$p->CONTRACT_ID?>','width=600,height=500,scrollbars=yes')"><?=$p->CONTRACT_ID?></a></td>
                      <td><?=$p->CONTRACT_DATE?></td>
                      <td><?=$rs2->SELLER_ID?></td>
                      <td><?=$rs2->SNAME?></td>
                      <td><?echo shop_name_is('ko',$rs2->SHOP_CODE);?></td>
					  <td><?echo service_is($p->SERVICE_ID);?></td>
					  <td><?=$dday?>일/<?if($p->STIPULATED_TIME==12){echo "1년";}else if($p->STIPULATED_TIME==24){echo "2년";}else{echo $p->STIPULATED_TIME."개월";}?></td>
					  <td><?=$p->SERVICE_START_DATE?> ~ <?=$p->SERVICE_END_DATE?></td>
					  <td><button type="button" style="width:80px;height:25px;margin:0 4px; font-size:13px;line-height:26px; font-weight:bold; color:black;background-color:#e0e0e0" onclick="window.open('cont_up.php?SELLER_CODE=<?=$SELLER_CODE?>&CONTRACT_ID=<?=$p->CONTRACT_ID?>','ae1','width=600,height=500,scrollbars=yes')">재계약</button></td>
                    </tr>
<?
$no++;
}?>

                  </tbody>
                </table>
              </div>
    <!-- GRID E-->
  
  

   
</div>
  <!-- 컨텐츠 E --> 
 
   
  </div>
 <!-- 전체 넓이 E-->

</body>
</html>
