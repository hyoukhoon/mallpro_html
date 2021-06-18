<?php include $_SERVER["DOCUMENT_ROOT"]."/admin_page/inc/top.php";

?>

<!-- 메인메뉴 S -->
    <div id="wrap_tmall_content">
     
     <ul class="top_title_area">
       <li class="top_title">환경설정 > 소재 관리</li>
	   <div class="midle_bu_area ml20">
			<ul class="left_bu_area">
			<li ><button type="button" class="button05" id="add1" onclick="window.open('ma_up.php','mas1','width=500,height=400,scrollbars=yes')">+소재등록</button></li>
			</ul>
		</div>
     </ul>
     
     
              <!-- GRID S-->
              <div class="gridTable_list01">
                <table width="100%" border="0" >

                  <colgroup>
                  <col width=5%/>
                  <col width=10%/>
                  <col width=10% />
                  <col width=10%/>
				  <col width=10% />
                  <col width=10%/>
				  <col width="*"/>
				  <col width=10%/>
                  <col width=10% />

                  </colgroup>
                  <thead>
                    <tr>
                      <th scope="col">No</th>
					  <th scope="col">소재코드</th>
					  <th scope="col">코드명</th>
                      <th scope="col">소재명(한국어)</th>
					  <th scope="col">소재명(중국어)</th>
					  <th scope="col">소재명(영어)</th>
					  <th scope="col">설명</th>
					  <th scope="col">수정</th>
					  <th scope="col">삭제</th>
                    </tr>
                  </thead>
                  <tbody>
<?
	if(!$order){
		$order=" order by MATR_CODE asc";
	}
	$que="select * 
	from material_code";
	$que.=$where;
	$que.=$order;
	$que.=$limit_query;
//	echo $que;
	$result = $mysqli->query($que) or die("2:".$mysqli->error);
	while($rs = $result->fetch_object()){
			$rsc[]=$rs;
	}

$no=1;
foreach($rsc as $p){
?>
                    <tr>
                      <td><?=$no?></td>
                      <td><?=$p->MATR_CODE?></td>
                      <td><?=$p->CODE_NAME?></td>
					  <td><?=$p->MATR_NAME?></td>
					  <td><?=$p->MATR_NAME_CH?></td>
					  <td><?=$p->MATR_NAME_EN?></td>
					  <td><?echo stripslashes($p->DESCRIPTION);?></td>
					  <td><button type="button" style="width:80px;height:25px;margin:0 4px; font-size:13px;line-height:26px; font-weight:bold; color:black;background-color:#e0e0e0" onclick="window.open('ma_up.php?MATR_CODE=<?=$p->MATR_CODE?>','ae1','width=600,height=500,scrollbars=yes')">수정</button></td>
					  <td><button type="button" style="width:80px;height:25px;margin:0 4px; font-size:13px;line-height:26px; font-weight:bold; color:black;background-color:#e0e0e0" onclick="ma_del('<?=$p->MATR_CODE?>');">삭제</button></td>
                    </tr>
<?
$no++;
}?>

                  </tbody>
                </table>
              </div>
    <!-- GRID E-->
       
     

<script>
	function ma_del(n){

		if(confirm('삭제하시겠습니까?')){
			location.href="ma_del.php?MATR_CODE="+n;
		}else{
			return false;
		}	

}
</script>

<?php include $_SERVER["DOCUMENT_ROOT"]."/admin_page/inc/bot.php";
?>