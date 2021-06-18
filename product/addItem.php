<?php session_start();
include $_SERVER["DOCUMENT_ROOT"]."/inc/dbcon.php";

if(!$_SESSION['AID']){
	location_is_close('로그인이 필요한 메뉴입니다.');
	exit;
}

$uid=$_SESSION['AID'];
$num=$_GET['num'];
$cny=cnyIs();

	$que="select b.num as tNum, a.price as myPrice, b.price as itemPrice, a.regDate as myregDate,itemName,b.optionType as optionType  
	from myItem a, taobao b where a.pnum=b.num and a.uid='$uid' and optionCount<='2' and itemName<>'' order by tNum desc";
	$que.=$where;
	$que.=$limit_query;
//	echo $que;
	$result = $mysqli->query($que) or die("3:".$mysqli->error);
	while($rs = $result->fetch_object()){
			$rsc[]=$rs;
	}

?>
<!doctype html>
<html>
<head>
<meta charset="utf-8">
<title>Mallpro Back-office</title>
<link href="/css/dcg_tmall.css" rel="stylesheet" type="text/css" />
<script type="text/javascript" src="/js/jquery.min.js"></script>

</head>

<body class="bg_popup">

<!-- 전체 넓이 S-->
<div id="pop_wrap">
  <!-- 상단 head로고 S-->
  <div class="pop_top_bg">
    <ul>
     <li><span>추가상품등록</span></li>
    </ul>
  </div>
  <!-- 상단 head로고 E-->
  
  <!-- 컨텐츠 S -->
  <div class="pop_content">

	  <!-- GRID S-->
              <div class="list_table_list01">
			  
                <table width="100%" border="0" >
                  <tbody>
				  <thead>
                    <tr>
					  <th scope="col" width="100">추가상품</th>
                      <th scope="col">
					  <select name="addItem" onchange="sItem(this.value)">
							<option value="">선택</option>
							<?php
							foreach($rsc as $p){
							?>
								<option value="<?=$p->tNum?>">[<?=$p->optionType?>]<?echo substr(stripslashes($p->itemName),0,100);?></option>
							<?}?>
						</select>
					  </th>
					  <th width="30">
						
					  </th>
                    </tr>
					<tr id="opt1" style="display:none;">
					  <th scope="col" width="100">옵션1</th>
                      <th scope="col">
					  <select name="itemOption1" id="itemOption1" onchange="seItem1(this.value)">
							<option value="">선택</option>
						</select>
					  </th>
					  <th width="30">
					  </th>
                    </tr>
					<tr id="opt2" style="display:none;">
					  <th scope="col" width="100">옵션2</th>
                      <th scope="col">
					  <select name="itemOption2" id="itemOption2" onchange="seItem2(this.value)">
							<option value="">선택</option>
						</select>
					  </th>
					  <th width="30">
					  </th>
                    </tr>
                  </thead>

					<tr>
                      <th class="color_ch" scope="row" style="text-align:center">추가상품</th>
                      <td style="text-align:right;"></td>
					  <td>삭제</td>
                    </tr>


                  </tbody>
                </table>
              </div>
      <!-- GRID E-->

   <!-- 하단 버튼 S-->
  
   <div class="bottom_bu_area mt5">
	<ul>
		<li><a href="javascript:;" class="button03" onclick="sendform();">저장</a></li>
		<li><a href="javascript:" class="button03_1" onclick="window.close();">취소</a></li>
	</ul>
</div>    
            
  <!-- 하단 버튼 E-->


   
</div>
  <!-- 컨텐츠 E --> 
 
   
  </div>
 <!-- 전체 넓이 E-->

</body>
</html>

<script>


function sItem(num){

		var params = "num="+num;
		console.log(params);
		$.ajax({
			  type: 'post'
			, url: 'sItem.php'
			,data : params
			, dataType : 'json'
			, success: function(data) {

				if(data.optionType==2){
					$("#itemOption1").html("");
					$("#opt1").show();
					$("#itemOption1").append(data.val);
				}else if(data.result==-1){
					alert(data.val);
					return;
				}else if(data.result==-3){
					alert(data.val);
					return;
				}else{
					alert('다시 시도해 주십시오.');
					return;
				}

			  }
		});	

}

</script>

