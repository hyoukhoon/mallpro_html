<?php session_start();
include $_SERVER["DOCUMENT_ROOT"]."/inc/dbcon.php";

$SERVICE_ID=$_GET['SERVICE_ID'];

$que="select * from service_product where SERVICE_ID='".$SERVICE_ID."'";
$result = $mysqli->query($que) or die("2:".$mysqli->error);
$rs = $result->fetch_object();


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
     <li><span>서비스상품등록</span></li>
    </ul>
  </div>
  <!-- 상단 head로고 E-->
  
  <!-- 컨텐츠 S -->
  <div class="pop_content">
<form method="post" action="sw_ok.php" name="sf" enctype="multipart/form-data">
<input type="hidden" name="SERVICE_ID" value="<?=$SERVICE_ID?>">

	  <!-- GRID S-->
              <div class="list_table_list01">
                <table width="100%" border="0" >
                  <colgroup>
                  <col width=200/>
                  <col width="*"/>
                  </colgroup>
                 
                  <tbody>

                      <th class="color_ch" scope="row"><font color="red">*</font>상품명</th>
	                      <td><input type="text" name="SERVICE_PRODUCT_NAME" value="<?=$rs->SERVICE_PRODUCT_NAME?>"> </td>
                    </tr>
					<tr>
                      <th class="color_ch" scope="row"><font color="red">*</font>기간</th>
                      <td>
							<select name="DURATION">
								<option value="">선택</option>
								<option value="1" <?if($rs->DURATION=="1"){?> selected<?}?>>1달</option>
								<option value="12" <?if($rs->DURATION=="12"){?> selected<?}?>>1년</option>
								<option value="24" <?if($rs->DURATION=="24"){?> selected<?}?>>2년</option>
							</select>
					  </td>
                    </tr>
					<tr>
                      <th class="color_ch" scope="row"><font color="red">*</font>사용여부</th>
                      <td>
							<select name="SERVICE_STS_CODE">
								<option value="0" <?if($rs->SERVICE_STS_CODE=="0"){?> selected<?}?>>사용함</option>
								<option value="1" <?if($rs->SERVICE_STS_CODE=="1"){?> selected<?}?>>사용안함</option>
							</select>
					  </td>
                    </tr>
					<tr>
                      <th class="color_ch" scope="row">사진촬영수량</th>
                      <td><input type="text" name="QUANTITY" size="50" value="<?=$rs->QUANTITY?>"></td>
                    </tr>
					<tr>
                      <th class="color_ch" scope="row"><font color="red">*</font>상품내용</th>
                      <td><input type="text" name="CONTENTS" value="<?=$rs->CONTENTS?>" size="60"></td>
                    </tr>
					
					<tr>
                      <th class="color_ch" scope="row">상품조건</th>
                      <td><input type="text" name="PRODUCT_CONDITION" size="60" value="<?=$rs->PRODUCT_CONDITION?>"></td>
                    </tr>
					<tr>
                      <th class="color_ch" scope="row"><font color="red">*</font>가격</th>
                      <td><input type="text" name="PRICE" value="<?=$rs->PRICE?>" size="20"></td>
                    </tr>
					<tr>
                      <th class="color_ch" scope="row">비고</th>
                      <td><input type="text" name="REMARK" size="60" value="<?=$rs->REMARK?>"></td>
                    </tr>
					<tr>
                      <th class="color_ch" scope="row">약정여부</th>
                      <td><input type="checkbox" name="STIPULATION" value="1" <?if($rs->STIPULATION){?> checked<?}?>>약정</td>
                    </tr>
					<tr>
                      <th class="color_ch" scope="row"><font color="red">*</font>구분</th>
                      <td><input type="radio" id="gubun" name="DIVISION_CODE" value="1" <?if($rs->DIVISION_CODE==1){?> checked<?}?>>사이니지  <input type="radio" id="gubun" name="DIVISION_CODE" value="2"  <?if($rs->DIVISION_CODE==2){?> checked<?}?>>스튜디오</td>
                    </tr>

                  </tbody>
                </table>
              </div>
      <!-- GRID E-->

   

</form>
   <!-- 하단 버튼 S-->
  
   <div class="bottom_bu_area">
	<ul>
		<li><a href="javascript:;" class="button03" onclick="return sendform();">저장</a></li>
		<li><a href="javascript:window.close();" class="button03_1">닫기</a></li>
		<li><a href="sw_ok.php?mode=del&SERVICE_ID=<?=$rs->SERVICE_ID?>" class="button03_6" onclick="return confirm('삭제하시겠습니까?');">삭제</a></li>
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

			if(!a.SERVICE_PRODUCT_NAME.value){
				alert("상품명을 입력하세요.");
				a.SERVICE_PRODUCT_NAME.focus();
				return;
			}

			if(!a.DURATION.value){
				alert("기간을 선택하세요.");
				a.DURATION.focus();
				return;
			}

			if(!a.CONTENTS.value){
				alert("상품내용을 입력하세요.");
				a.CONTENTS.focus();
				return;
			}

			if(!a.PRICE.value){
				alert("가격을 입력하세요.");
				a.PRICE.focus();
				return;
			}

			var gubunCheck = $('input:radio[name="DIVISION_CODE"]:checked').length;
				if(!gubunCheck){
				alert("구분을 선택하세요.");
				return false;
				}

			a.submit();

	return true;
}


</script>
