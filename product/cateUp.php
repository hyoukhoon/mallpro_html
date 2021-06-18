<?php session_start();
include $_SERVER["DOCUMENT_ROOT"]."/inc/dbcon.php";

if(!$_SESSION['AID']){
	location_is_close('로그인이 필요한 메뉴입니다.');
	exit;
}


$jsonCheck=$_GET['jsonCheck'];
$jsonArray=json_decode($jsonCheck);
if(sizeof($jsonArray)<1){
	location_is_close('카테고리에 등록할 제품을 선택하세요.');
	exit;
}
?>
<!doctype html>
<html>
<head>
<meta charset="utf-8">
<title>Mediapic Back-office</title>
<link href="/css/dcg_tmall.css" rel="stylesheet" type="text/css" />
<script type="text/javascript" src="/js/jquery.min.js"></script>
	<script type="text/javascript" src="/js/jquery-ui.min.js"></script>
</head>

<body class="bg_popup">

<!-- 전체 넓이 S-->
<div id="pop_wrap">
  <!-- 상단 head로고 S-->
  <div class="pop_top_bg">
    <ul>
     <li><span>카테고리 등록/수정</span></li>
    </ul>
  </div>
  <!-- 상단 head로고 E-->
  
  <!-- 컨텐츠 S -->
  <div class="pop_content">
	  <!-- GRID S-->
              <div class="list_table_list01">
                <table width="100%" border="0" >
                  <tbody>
                    <tr>
					  <th class="color_ch" scope="row" style="width:100px;">분류선택으로등록</th>
                      <td  style="vertical-align:top;">

								<table width="100%" border="0" id="cate_table">
							 
								  <tbody>
									<tr>
									  <th class="color_ch" scope="row" style="text-align:center;width:150px;">1차</th>
									  <th class="color_ch" scope="row" style="text-align:center;width:150px;">2차</th>
									  <th class="color_ch" scope="row" style="text-align:center;width:150px;">3차</th>
									  <th class="color_ch" scope="row" style="text-align:center;width:150px;">4차</th>
									</tr>

									<tr class="csic">
									  <td>
									  <select name="cate1" class="big_cate" id="cate1" onchange="cateSel(1)"><option value="">1차선택</option>
										<?
										$que1="select * from naver_category group by cate1  order by cate1 asc";
										$result1 = $mysqli->query($que1) or die("2:".$mysqli->error);
										while($rs1 = $result1->fetch_object()){
				?>
										<option value="<?=$rs1->cate1?>"><?=$rs1->cate1?></option>
										<?}?>
									  </select>
									  </td>
									  <td>
										<select name="cate2" class="small_cate" id="cate2" onchange="cateSel(2)"><option value="">1차분류를 선택하세요</option>
										</select>
									  </td>
									  <td>
										<select name="cate3" class="small_cate" id="cate3" onchange="cateSel(3)"><option value="">2차분류를 선택하세요</option>
										</select>
									  </td>
									  <td>
										<select name="cate4" class="small_cate" id="cate4" onchange="cateSel(4)"><option value="">3차분류를 선택하세요</option>
										</select>
									  </td>
									</tr>

									
								  </tbody>
								</table>
						</td>
                    </tr>
					<tr>
					  <th class="color_ch" scope="row" style="width:100px;">상품검색으로등록</th>
                      <td  style="vertical-align:top;">
								검색어 : <input type="text" name="sword" id="sword"> <button type="button"  class="button03_5" onclick="search()">검색</button>
								<div id="sresult" style="line-height: 20px;">
								</div>
						</td>
                    </tr>

                  </tbody>
                </table>
              </div>
      <!-- GRID E-->

   <!-- 하단 버튼 S-->
  
   <div class="bottom_bu_area mt5">
	<ul>
		<li><button type="button" class="button03" onclick="send()">저장</a></li>
		<li><a href="javascript:reset();" class="button03_1">취소</a></li>
	</ul>
</div>    
            
  <!-- 하단 버튼 E-->
</form>

   
</div>
  <!-- 컨텐츠 E --> 
 
   
  </div>
 <!-- 전체 넓이 E-->

</body>
</html>
<script>

function search(n){
	var sword=$('input:text[id="sword"]').val();

	if(!sword){
		alert('검색어를 입력하세요.');
		return;
	}

	var params = "sword="+sword;

	$.ajax({
		  type: 'post'
		, url: 'sresult.php'
		,data : params
		, dataType : 'html'
		, success: function(data) {
			$("#sresult").html(data);
		  }
	});	
}


function cateSel(n){
	$("#sword").val("");
	$("#sresult").html("");
	var cate1=$("#cate1 option:selected").val();
	var cate2=$("#cate2 option:selected").val();
	var cate3=$("#cate3 option:selected").val();
	var cate4=$("#cate4 option:selected").val();
	var categoryCode=$("input[id='categoryCode']:checked").val();
	var k=parseInt(n)+1;
	var params = "cate1="+cate1+"&cate2="+cate2+"&cate3="+cate3+"&cate4="+cate4+"&n="+n+"&categoryCode="+categoryCode;
//	console.log(params);
//	return;
	$.ajax({
		  type: 'post'
		, url: 'cate_ajax.php'
		,data : params
		, dataType : 'html'
		, success: function(data) {
			//console.log(data);
			$("#cate"+k).html(data);
		  }
	});	
}

function send(){
		var sword=$('input:text[id="sword"]').val();
		var cate1=$("#cate1 option:selected").val();
		var cate2=$("#cate2 option:selected").val();
		var cate3=$("#cate3 option:selected").val();
		var cate4=$("#cate4 option:selected").val();
		var jsonCheck=<?=$jsonCheck?>;
		var categoryCode=$("input[id='categoryCode']:checked").val();
		var params = "cate1="+cate1+"&cate2="+cate2+"&cate3="+cate3+"&cate4="+cate4+"&categoryCode="+categoryCode+"&sword="+sword+"&jsonCheck=<?echo urlencode($jsonCheck)?>";

		if(!cate1 && !categoryCode){
			alert('분류를 선택하거나 검색해서 선택하세요.');
			return;
		}
	console.log(params);
//	return;
		$.ajax({
			  type: 'post'
			, url: '/product/cuOK.php'
			,data : params
			, dataType : 'json'
			, success: function(data) {
				if(data.result==1){
					alert(data.val);
					window.close();
					opener.location.reload();
				}else if(data.result==-1){
					alert(data.val);
				}else{
					alert('다시 시도하세요');
				}
			  }
		});


}

</script>

