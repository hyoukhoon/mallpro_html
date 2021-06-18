<?php session_start();
include $_SERVER["DOCUMENT_ROOT"]."/inc/dbcon.php";
$ID=$_GET['ID'];

if($ID){
$que="select * from mediapic_user where ID='".$ID."'";
$result = $mysqli->query($que) or die("2:".$mysqli->error);
$rs = $result->fetch_object();
	$action="adme_ok.php";
}else{
	$action="admu_ok.php";
}

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
     <li><span>BackOffice 회원 등록</span></li>
    </ul>
  </div>
  <!-- 상단 head로고 E-->
  
  <!-- 컨텐츠 S -->
<div class="pop_content">
<form method="post" action="<?=$action?>" name="sf" enctype="multipart/form-data">
<input type="hidden" name="ID" value="<?=$ID?>">
	  <!-- GRID S-->
              <div class="list_table_list01">
                <table width="100%" border="0" >
                  <colgroup>
                  <col width=100/>
                  <col width="*"/>
                  </colgroup>
                 
                  <tbody>
					<tr>
                      <th class="color_ch" scope="row"><font color="red">*</font>아이디</th>
                      <td><input type="text" name="ID" size="30" id='admId'  value="<?=$rs->ID?>" <?if($rs->ID){?>readonly<?}?>> <?if(!$rs->ID){?><button type="button" class="button03_5">중복검사</button><?}?></td>
                    </tr>
<?if($rs->ID){?>
					<tr id="newpw1">
                      <th class="color_ch" scope="row"><font color="red">*</font>기존비밀번호</th>
                      <td><input type="password" name="OLD_PW" id="oldpw" size="30"> <input type="checkbox" name="passchange" value="1" id="passchange">비밀번호변경</td>
                    </tr>
					<tr id="pwtr1" style="display:none;">
                      <th class="color_ch" scope="row"><font color="red">*</font>새비밀번호</th>
                      <td><input type="password" name="PW" id="pw1" size="30"></td>
                    </tr>
					<tr  id="pwtr2" style="display:none;">
                      <th class="color_ch" scope="row"><font color="red">*</font>새비밀번호확인</th>
                      <td><input type="password" name="PW1" id="pw2" size="30" onblur="passcheck();"></td>
                    </tr>
<?}?>
<?if(!$rs->ID){?>
					<tr>
                      <th class="color_ch" scope="row"><font color="red">*</font>비밀번호</th>
                      <td><input type="password" name="PW" id="pw1" size="30" <?if($rs->ID){?>readonly<?}?>></td>
                    </tr>
					<tr>
                      <th class="color_ch" scope="row"><font color="red">*</font>비밀번호확인</th>
                      <td><input type="password" name="PW1" id="pw2" size="30" onblur="passcheck();" <?if($rs->ID){?>readonly<?}?>></td>
                    </tr>
<?}?>
					<tr>
                      <th class="color_ch" scope="row"><font color="red">*</font>상태</th>
                      <td>
						<select name="IS_DEL">
							<option value="Y" <?if($rs->IS_DEL=="Y"){?>selected<?}?>>사용중지</option>
							<option value="N" <?if($rs->IS_DEL=="N"){?>selected<?}?>>사용중</option>
						</select>
					</td>
                    </tr>
					<tr>
                      <th class="color_ch" scope="row"><font color="red">*</font>권한</th>
                      <td>
						<select name="AUTH">
							<option value="999" <?if($rs->AUTH=="999"){?>selected<?}?>>관리자</option>
							<option value="199" <?if($rs->AUTH=="199"){?>selected<?}?>>일반</option>
						</select>
					</td>
                    </tr>
					<tr>
                      <th class="color_ch" scope="row">비고</th>
                      <td><textarea name="DESCRIPTION" rows="5" cols="40"><?echo stripslashes($rs->DESCRIPTION)?></textarea></td>
                    </tr>

                  </tbody>
                </table>
              </div>
      <!-- GRID E-->



   <!-- 하단 버튼 S-->
  
   <div class="bottom_bu_area mt5">
	<ul>
		<li><button type="submit" class="button03">저장</a></li>
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

$('#passchange').on('click', function() {

	if($("input:checkbox[id='passchange']").is(":checked") == true){
		$("#pwtr1").show();
		$("#pwtr2").show();
	}else{
		$("#pwtr1").hide();
		$("#pwtr2").hide();
	}

	});

$('.button03_5').on('click', function() {

		var id =$("#admId").val();
		if(!id){
			alert('아이디를 입력하세요.');
			return;
		}
		var params = "ID="+id;
		$.ajax({
			  type: 'get'
			, url: 'admid_check.php'
			,data : params
			, dataType : 'html'
			, success: function(data) {
					alert(data);
			  }
		});	

	});

function passcheck(){
		a = document.sf;

		if(a.PW.value!=a.PW1.value){
			alert('비밀번호가 서로 다릅니다.');
			return false;
		}
	}

</script>