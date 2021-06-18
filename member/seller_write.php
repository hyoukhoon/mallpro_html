<?php session_start();
include $_SERVER["DOCUMENT_ROOT"]."/inc/dbcon.php";

$SELLER_CODE=$_GET['SELLER_CODE'];
/*
$que="select * from seller where SELLER_CODE='".$SELLER_CODE."'";
$result = $mysqli->query($que) or die("2:".$mysqli->error);
$rs = $result->fetch_object();
*/
$img_dir="/media/SHOP/".$rs->SHOP_CODE."/".$rs->SELLER_CODE."/COMMON/";
?>
<!doctype html>
<html>
<head>
<meta charset="utf-8">
<title>Mediapic Back-office</title>
<link href="/css/dcg_tmall.css" rel="stylesheet" type="text/css" />
<script type="text/javascript" src="/asset/js/jquery-1.11.3.min.js"></script>
<script>
$(window).load(function() {
 
  var strWidth;
  var strHeight;
 
  //innerWidth / innerHeight / outerWidth / outerHeight 지원 브라우저 
  if ( window.innerWidth && window.innerHeight && window.outerWidth && window.outerHeight ) {
    strWidth = $('#pop_wrap').outerWidth() + (window.outerWidth - window.innerWidth);
    strHeight = $('#pop_wrap').outerHeight() + (window.outerHeight - window.innerHeight);
  }
  else {
    var strDocumentWidth = $(document).outerWidth();
    var strDocumentHeight = $(document).outerHeight();
 
    window.resizeTo ( strDocumentWidth, strDocumentHeight );
 
    var strMenuWidth = strDocumentWidth - $(window).width();
    var strMenuHeight = strDocumentHeight - $(window).height();
 
    strWidth = $('#pop_wrap').outerWidth() + strMenuWidth;
    strHeight = $('#pop_wrap').outerHeight() + strMenuHeight;
  }
 
  //resize 
  window.resizeTo( strWidth, strHeight );
 
}); 
</script>
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
<form method="post" action="sw_ok.php" name="sf" enctype="multipart/form-data">
<input type="hidden" name="SELLER_CODE" value="<?=$SELLER_CODE?>">
  <!-- 타이틀 S--> 
     <ul class="top_title_area tabHere">
       <li class="top_title"><span>회원기본정보</span></li>
	   <li class="top_title"><a href="/member/seller_contract.php?SELLER_CODE=<?=$SELLER_CODE?>">계약내역</a></li>
     </ul>
  <!-- 타이틀 E--> 
  
  
  <!-- GRID S-->
              <div class="list_table_list01">
                <table width="100%" border="0" >
                  <colgroup>
                  <col width=200/>
                  <col width=30%/>
                  <col width=200/>
                  <col width="*"/>
                  </colgroup>
                 
                  <tbody>
                    <tr>
                      <th class="color_ch" scope="row">회원구분</th>
                      <td>도매사업자회원</td>
                      <th class="color_ch"  scope="row" rowspan="2">마이샵 QR코드</th>
                      <td rowspan="2">
					  <?if($SELLER_CODE){?>
					  <img src="http://www.mediapic.net/qrcode/php/qr_img.php?d=http://www.mediapic.net/html/Myshop_Product.php?seller_code=<?=$SELLER_CODE?>&e=M&s=3" alt="QR code" width="70"><?}?></td>
                    </tr>
                     <tr>
                      <th class="color_ch" scope="row"><font color="red">*</font>상태</th>
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
                      <th class="color_ch" scope="row">프로필사진</th>
                      <td>
					  <?if($rs->PROFIL_IMG){?>
						<img src="<?echo $img_dir.$rs->PROFIL_IMG?>" style="max-width:50px;">
					  <?}?>
					  <input type="file" name="fn">
					  <?if($rs->PROFIL_IMG){?>
						(* 프로필 사진을 변경하는 경우에만 이미지를 첨부하세요)
					  <?}?>
					  </td>
                    </tr>
					<tr>
                      <th class="color_ch" scope="row"><font color="red">*</font>아이디</th>
                      <td><input type="text" name="SELLER_ID" value="<?=$rs->SELLER_ID?>" <?if($rs->SELLER_ID){?>readonly<?}?>> <?if(!$rs->SELLER_ID){?><button type="button" class="button04_1" onclick="return chk_id();">중복체크</button><?}?><?if($rs->SELLER_ID){?>(* 아이디는 변경할 수 없습니다.)<?}?></td>
                    </tr>
					<tr>
                      <th class="color_ch" scope="row"><font color="red">*</font>비밀번호</th>
                      <td>
							<input type="password" name="PASSWD"><?if($rs->PASSWD){?>(* 비밀번호를 입력하면 변경됩니다.)<?}?>
					  </td>
                    </tr>
					<tr>
                      <th class="color_ch" scope="row"><font color="red">*</font>상가명</th>
                      <td>
							<select name="shop_code">
								<option value="">선택</option>
								<?//echo shop_code_val($ccode,$rs->SHOP_CODE);?>
							</select>
					  </td>
                    </tr>
					<tr>
                      <th class="color_ch" scope="row"><font color="red">*</font>매장속성</th>
                      <td>
							<select name="sp">
								<option value="">선택</option>
								<?//echo store_property_is($ccode,$rs->STORE_PROPERTY_SEQ);?>
							</select>
					  </td>
                    </tr>
					<tr>
                      <th class="color_ch" scope="row"><font color="red">*</font>매장명(사업자명)</th>
                      <td>
						<table border=0>
							<tr>
								<td width="50">
									한국어
								</td>
								<td>
									<input type="text" name="SNAME" value="<?=$rs->SNAME?>">&nbsp;&nbsp;<input type="text" name="FLOOR" value="<?=$rs->FLOOR?>" size="10">층
									&nbsp;&nbsp;<input type="text" name="FLOOR_ROW" value="<?=$rs->FLOOR_ROW?>" size="10">열
									&nbsp;&nbsp;<input type="text" name="FLOOR_HO" value="<?=$rs->FLOOR_HO?>" size="10">호
								</td>
							</tr>
							<tr>
								<td width="50">
									중국어
								</td>
								<td>
									<input type="text" name="SNAME_CH" value="<?=$rs->SNAME_CH?>">
								</td>
							</tr>
							<tr>
								<td width="50">
									영어
								</td>
								<td>
									<input type="text" name="SNAME_EN" value="<?=$rs->SNAME_EN?>">
								</td>
							</tr>
						</table>
						
					  </td>
                    </tr>
					<tr>
                      <th class="color_ch" scope="row">매장주소</th>
                      <td><input type="text" name="ADDRESS" size="50" value="<?=$rs->ADDRESS?>"></td>
                    </tr>
					<tr>
                      <th class="color_ch" scope="row"><font color="red">*</font>사업자등록번호</th>
                      <td><input type="text" name="BUSINESS_REGISTERED_NUMBER" value="<?=$rs->BUSINESS_REGISTERED_NUMBER?>" size="30" placeholder="'-'를 넣어서 입력해주세요."> &nbsp;<input type="radio" name="CORPORATE_PERSONAL" value="0" <?if(!$rs->CORPORATE_PERSONAL){?>checked<?}?>>개인, <input type="radio" name="CORPORATE_PERSONAL" value="1" <?if($rs->CORPORATE_PERSONAL==1){?>checked<?}?>>법인</td>
                    </tr>
					<tr>
                      <th class="color_ch" scope="row"><font color="red">*</font>사업자등록증</th>
                      <td>
					  <?if($rs->BUSINESS_REGISTERED_IMG){?>
						<img src="<?echo $img_dir.$rs->BUSINESS_REGISTERED_IMG?>" style="max-width:50px;">
					  <?}?>
					  <?if($rs->BUSINESS_REGISTERED_IMG){?>
						(* 사업자등록증을 변경하는 경우에만 이미지를 첨부하세요)
					  <?}?>
					  <input type="file" id="bizfile" name="bizfile"></td>
                    </tr>
					<tr>
                      <th class="color_ch" scope="row">전화번호</th>
                      <td><input type="text" name="TEL" size="20" value="<?=$rs->TEL?>" placeholder="'-' 없이 입력해주세요."></td>
                    </tr>
					<tr>
                      <th class="color_ch" scope="row"><font color="red">*</font>휴대폰</th>
                      <td><input type="text" name="CELLPHONE" value="<?=$rs->CELLPHONE?>" size="20" placeholder="'-' 없이 입력해주세요."></td>
                    </tr>
					<tr>
                      <th class="color_ch" scope="row"><font color="red">*</font>이메일</th>
                      <td><input type="text" name="EMAIL" value="<?=$rs->EMAIL?>" size="20"></td>
                    </tr>

                  </tbody>
                </table>
              </div>
      <!-- GRID E-->


 <!-- 타이틀 S--> 
     <ul class="top_title_area">
       <li class="top_title">계좌정보</li>
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
                      <th class="color_ch" scope="row">은행명</th>
                      <td>
							<select name="BANK_CODE">
								<?//echo bank_code_is($rs->BANK_CODE);?>
							</select>
					  </td>
                    </tr>
					<tr>
                      <th class="color_ch" scope="row">계좌번호</th>
                      <td><input type="text" name="ACCOUNT_NUMBER" size="30" value="<?=$rs->ACCOUNT_NUMBER?>"></td>
                    </tr>
					<tr>
                      <th class="color_ch" scope="row">예금주</th>
                      <td><input type="text" name="ACCOUNT_HOLDER" size="20" value="<?=$rs->ACCOUNT_HOLDER?>"></td>
                    </tr>
					<tr>
                      <th class="color_ch" scope="row">납부일자</th>
                      <td>
						<select name="PAYMENT_DATE">
							<?for($k=1;$k<=31;$k++){?>
								<option value="<?=$k?>" <?if($rs->PAYMENT_DATE==$k){?>selected<?}?>><?=$k?>일</option>
							<?}?>
						</select>
					  </td>
                    </tr>

                  </tbody>
                </table>
              </div>
      <!-- GRID E-->
   

</form>
   <!-- 하단 버튼 S-->
  
   <div class="bottom_bu_area mt5">
	<ul>
		<li><a href="javascript:;" class="button03" onclick="return sendform();">저장</a></li>
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

	if(!a.SELLER_ID.value){
		alert('아이디를 입력하세요.');
		a.SELLER_ID.focus();
		return;
	}

<?if(!$SELLER_CODE){?>

			if(!a.PASSWD.value){
				alert("비밀번호를 입력하세요.");
				a.PASSWD.focus();
				return;
			}

<?}?>

			if(!a.shop_code.value){
				alert("상가를 선택하세요.");
				a.shop_code.focus();
				return;
			}

			if(!a.sp.value){
				alert("매장속성을 선택하세요.");
				a.sp.focus();
				return;
			}

			if(!a.SNAME.value){
				alert("매장명을 입력하세요.");
				a.SNAME.focus();
				return;
			}

			if(!a.BUSINESS_REGISTERED_NUMBER.value){
				alert("사업자등록번호를 입력하세요.");
				a.BUSINESS_REGISTERED_NUMBER.focus();
				return;
			}

<?if(!$SELLER_CODE){?>
			var fileCheck = document.getElementById("bizfile").value;
				if(!fileCheck){
				alert("사업자등록증을 등록하세요");
				return false;
				}
<?}?>

			if(!a.CELLPHONE.value){
				alert("휴대폰을 입력하세요.");
				a.CELLPHONE.focus();
				return;
			}

			if(!a.EMAIL.value){
				alert("이메일을 입력하세요.");
				a.EMAIL.focus();
				return;
			}

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
