<?php include $_SERVER["DOCUMENT_ROOT"]."/admin_page/inc/top.php";

?>

<!-- 메인메뉴 S -->
    <div id="wrap_tmall_content">
     
     <ul class="top_title_area">
       <li class="top_title">환경설정 > 매장속성 관리</li>
	   <div class="midle_bu_area ml20">
			<ul class="left_bu_area">
			<li ><button type="button" class="button05" id="add1" onclick="window.open('sh_up.php','mas1','width=500,height=400,scrollbars=yes')">+매장속성등록</button></li>
			</ul>
		</div>
     </ul>

     
              <!-- GRID S-->
              <div class="gridTable_list01">
                <table width="100%" border="0" >

                  <colgroup>
                  <col width=10%/>
                  <col width=20%/>
                  <col width=20% />
                  <col width=20%/>
				  <col width=10% />
                  <col width=10%/>

                  </colgroup>
                  <thead>
                    <tr>
                      <th scope="col">No</th>
                      <th scope="col">매장속성(한국어)</th>
					  <th scope="col">매장속성(중국어)</th>
					  <th scope="col">매장속성(영어)</th>
					  <th scope="col">수정</th>
					  <th scope="col">삭제</th>
                    </tr>
                  </thead>
                  <tbody>
<?
	if(!$order){
		$order=" order by STORE_PROPERTY_SEQ desc";
	}
	$que="select * 
	from store_property where PROPERTY_DEL='0'";
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
					  <td><?=$p->PROPERTY_NAME?></td>
					  <td><?=$p->PROPERTY_NAME_EN?></td>
					  <td><?=$p->PROPERTY_NAME_CH?></td>
					  <td><button type="button" style="width:80px;height:25px;margin:0 4px; font-size:13px;line-height:26px; font-weight:bold; color:black;background-color:#e0e0e0" onclick="window.open('sh_up.php?STORE_PROPERTY_SEQ=<?=$p->STORE_PROPERTY_SEQ?>','ae1','width=600,height=500,scrollbars=yes')">수정</button></td>
					  <td><button type="button" style="width:80px;height:25px;margin:0 4px; font-size:13px;line-height:26px; font-weight:bold; color:black;background-color:#e0e0e0" onclick="sh_del('<?=$p->STORE_PROPERTY_SEQ?>');">삭제</button></td>
                    </tr>
<?
$no++;
}?>

                  </tbody>
                </table>
              </div>
    <!-- GRID E-->
       
     

<script>
	function sh_del(n){

		if(confirm('삭제하시겠습니까?')){
			location.href="sh_del.php?STORE_PROPERTY_SEQ="+n;
		}else{
			return false;
		}	

}
</script>

<?php include $_SERVER["DOCUMENT_ROOT"]."/admin_page/inc/bot.php";
?>