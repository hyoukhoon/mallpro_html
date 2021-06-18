<?php session_start();
include $_SERVER["DOCUMENT_ROOT"]."/inc/dbcon.php";

$RETAILER_CODE=$_GET['RETAILER_CODE'];

$que="select * from retailer where RETAILER_CODE='".$RETAILER_CODE."'";
$result = $mysqli->query($que) or die("2:".$mysqli->error);
$rs = $result->fetch_object();
$rc= (int)$rs->RETAILER_CODE; 

$ipath="/media/RETAILER/".$rc."/";
?>
<!doctype html>
<html>
<head>
<meta charset="utf-8">
<title>Mediapic Back-office</title>
<link href="/admin_page/css/dcg_tmall.css" rel="stylesheet" type="text/css" />
<script type="text/javascript" src="/asset/js/jquery-1.11.3.min.js"></script>
</head>

<body class="bg_popup">

<!-- 전체 넓이 S-->
<div id="pop_wrap">
  <!-- 상단 head로고 S-->
  <div class="pop_top_bg">
    <ul>
     <li><span>소매사업자상세정보</span></li>
    </ul>
  </div>
  <!-- 상단 head로고 E-->
  
  <!-- 컨텐츠 S -->
  <div class="pop_content">
  <!-- 타이틀 S--> 
     <ul class="top_title_area">
       <li class="top_title">회원기본정보</li>
     </ul>
  <!-- 타이틀 E--> 
  
  
  <!-- GRID S-->
              <div class="list_table_list01">

<form method="post" action="rv_ok.php" name="sf">
<input type="hidden" name="RETAILER_CODE" value="<?=$RETAILER_CODE?>">

                <table width="100%" border="0" >
                  <colgroup>
                  <col width=200/>
                  <col width="*"/>
                  </colgroup>
                 
                  <tbody>
                    <tr>
                      <th class="color_ch" scope="row">회원구분</th>
                      <td>소매사업자회원</td>
                    </tr>
                     <tr>
                      <th class="color_ch" scope="row">회원상태</th>
                      <td>
						<select name="STS_CODE">
							<option value="0" <?if(!$rs->STS_CODE){?> selected<?}?>>사용중</option>
							<option value="1" <?if($rs->STS_CODE){?> selected<?}?>>사용안함</option>
						</select>
					  </td>
                    </tr>
                  </tbody>
                </table>
              </div>
      <!-- GRID E-->

  <!-- 타이틀 S--> 
     <ul class="top_title_area">
       <li class="top_title">회원상태</li>
     </ul>
  <!-- 타이틀 E--> 

	  <!-- GRID S-->
              <div class="list_table_list01">
                <table width="100%" border="0" >
                  <colgroup>
                  <col width=200/>
                  <col width="*"/>
                  </colgroup>
                 
                  <tbody>
                    <tr>
                      <th class="color_ch" scope="row">아이디</th>
                      <td>
							<?=$rs->RETAILER_ID?>
					  </td>
                    </tr>
					<tr>
                      <th class="color_ch" scope="row">대표자</th>
                      <td><?=$rs->RETAILER_NAME?></td>
                    </tr>

					<tr>
                      <th class="color_ch" scope="row">매장명</th>
                      <td>
							<?=$rs->RNAME?>
					  </td>
                    </tr>
					<tr>
                      <th class="color_ch" scope="row">매장주소</th>
                      <td>
							<?=$rs->ADDRESS?>
					  </td>
                    </tr>
					<tr>
                      <th class="color_ch" scope="row">매장주소</th>
                      <td>
							<?=$rs->L1?> / <?=$rs->L2?>&nbsp;
					  <?if($rs->L1 && $rs->L2){?><a href="/html/retailer_map.php?retailer_id=<?=$rs->RETAILER_ID?>">지도보기</a><?}?>
					  </td>
                    </tr>
					<tr>
                      <th class="color_ch" scope="row">휴대폰번호</th>
                      <td>
							<?=$rs->CELLPHONE?>
					  </td>
                    </tr>
					<tr>
                      <th class="color_ch" scope="row">이메일</th>
                      <td><?=$rs->EMAIL?></td>
                    </tr>
					<tr>
                      <th class="color_ch" scope="row">사업자등록번호</th>
                      <td><?=$rs->BUSINESS_REGISTERED_NUMBER?></td>
                    </tr>
					<tr>
                      <th class="color_ch" scope="row">사업자구분</th>
                      <td><input type="radio" name="CORPORATE_PERSONAL" value="0" <?if(!$rs->CORPORATE_PERSONAL){?>checked<?}?>>개인, <input type="radio" name="CORPORATE_PERSONAL" value="1" <?if($rs->CORPORATE_PERSONAL==1){?>checked<?}?>>법인</td>
                    </tr>
					<?if($rs->BUSINESS_REGISTERED_IMG){?>
					<tr>
                      <th class="color_ch" scope="row">사업자등록증</th>
                      <td><img src="<?echo $ipath.$rs->BUSINESS_REGISTERED_IMG?>" style="max-width:600px;"></td>
                    </tr>
					<?}?>
                  </tbody>
                </table>
              </div>
      <!-- GRID E-->
</form>

  
 <div class="bottom_bu_area mt5">
	<ul>
		<li><button type="button" class="button03" onclick="return sendform();">저장</button></li>
		<li><a href="javascript:reset();" class="button03_1">취소</a></li>
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
function sendform(){
	a=document.sf;

			a.submit();

	return true;
}



	function chk_id(){

		a=document.sf;
		if(!a.SELLER_ID.value){
			alert('아이디를 입력하세요.');
		}
		var params = "sid="+a.SELLER_ID.value;
		$.ajax({
			  type: 'get'
			, url: 'checkId.php'
			,data : params
			, dataType : 'html'
			, success: function(data) {
				alert(data);
			  }
		});	
}
</script>
