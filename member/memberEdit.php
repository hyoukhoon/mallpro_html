<?php session_start();
include $_SERVER["DOCUMENT_ROOT"]."/inc/dbcon.php";


if(!$_SESSION['AID']){
	location_is_close('로그인이 필요한 메뉴입니다.');
	exit;
}

$que="select * from member where uid='".$_SESSION['AID']."'";
$result = $mysqli->query($que) or die($mysqli->error);
$rs = $result->fetch_object();

$title="정보수정";
?>
<!doctype html>
<html>
<head>
<meta charset="utf-8">
<title>Mediapic Back-office</title>
<link href="/css/dcg_tmall.css" rel="stylesheet" type="text/css" />
<link rel="stylesheet" href="http://code.jquery.com/ui/1.8.18/themes/base/jquery-ui.css" type="text/css" />  
<script src="http://ajax.googleapis.com/ajax/libs/jquery/1.7.1/jquery.min.js"></script>  
<script src="http://code.jquery.com/ui/1.8.18/jquery-ui.min.js"></script>  
<script>
	$(function(){
	
	$( "#start_date, #end_date" ).datepicker({
				showOn:"both"
				,buttonImage:"/images/calendar_Ico.png"
				,buttonImageOnly:true
				,dateFormat:'yy-mm-dd'
			});

	$( "#cont_date" ).datepicker({
				showOn:"both"
				,buttonImage:"/images/calendar_Ico.png"
				,buttonImageOnly:true
				,dateFormat:'yy-mm-dd'
			});

});
</script>
<style>
.ui-datepicker-trigger { position:relative;top:7px ;left:0px ; }
 /* {} is the value according to your need */
</style>
</head>

<body class="bg_popup">

<!-- 전체 넓이 S-->
<div id="pop_wrap">
  <!-- 상단 head로고 S-->
  <div class="pop_top_bg">
    <ul>
     <li><span><?=$title?></span></li>
    </ul>
  </div>
  <!-- 상단 head로고 E-->
  
  <!-- 컨텐츠 S -->
  <div class="pop_content">
	  <!-- GRID S-->

<form name="signup">
															<input type="hidden" name="isCheckId" id="isCheckId" value="0">
															<input type="hidden" name="isCheckNickname" id="isCheckNickname" value="0">

              <div class="list_table_list01">
                <table width="100%" border="0" >
                  <colgroup>
                  <col width=120/>
                  <col width="*"/>
                  </colgroup>
                 
                  <tbody>

					<tr>
                      <th class="color_ch" scope="row"><font color="red">*</font>아이디</th>
                      <td ><?echo $rs->uid;?></td>
                    </tr>
					<tr>
                      <th class="color_ch" scope="row"><font color="red">*</font>기존비밀번호</th>
                      <td >
								<input type="password" name="oldPasswd" id="oldPasswd" size="50" placeholder="기존 고객님의 비밀번호를 입력해주세요.">
					  </td>
                    </tr>
					<tr>
                      <th class="color_ch" scope="row"><font color="red">*</font>변경할비밀번호</th>
                      <td >
								<input type="password" name="passwd" id="passwd" size="50" placeholder="8자이상 영문자,특수문자,숫자를 모두 포함해주세요">
					  </td>
                    </tr>
					<tr>
                      <th class="color_ch" scope="row"><font color="red">*</font>비밀번호확인</th>
                      <td >
								<input type="password" name="passwd2" id="passwd2" size="50" placeholder="비밀번호를 한번더 입력해주세요">
					  </td>
                    </tr>

					<tr>
                      <th class="color_ch" scope="row"><font color="red">*</font>이메일</th>
                      <td id="pprice">
							<input type="text" name="email" id="email" size="50" value="<?=$rs->email?>">
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
		<li><button type="button" class="button03" onclick="signUp();">저장</button></li>
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

function CheckId(str){
   var reg1 = /^[A-Za-z0-9+]{4,16}$/; 
   return(reg1.test(str));
};

function CheckPass(str){
   var reg1 = /^[A-Za-z0-9!~@#$%^&*()?+=\/]{8,16}$/; 
   var reg2 = /[A-Za-z]/g;    
   var reg3 = /[0-9]/g;
   var reg4 = /[!~@#$%^&*()?+=\/]/g;
   return(reg1.test(str) &&  reg2.test(str) && reg3.test(str) && reg4.test(str));
};

function CheckEmail(str){
   var reg1 = /^([A-Za-z0-9_\.-]+)@([\da-z\.-]+)\.([a-z\.]{2,6})$/; 
   return(reg1.test(str));
};


function signUp(){

		var oldPasswd=$("#oldPasswd").val();
		var passwd=$("#passwd").val();
		var passwd2=$("#passwd2").val();
		var email=$("#email").val();



		if(CheckPass(passwd) == false){
			alert("비밀번호는 영문자,숫자,특수문자를 포함해\n8자 이상 16자이하로 입력해주세요.");
			return;
		}

		if(passwd!=passwd2){
			alert("비밀번호화 비밀번호확인이 다릅니다.\n다시 한번 입력해주십시오.");
			return;
		}

		if(CheckEmail(email) == false){
			alert("이메일을 정확히 입력해주세요.");
			return;
		}


		var params = "passwd="+passwd+"&email="+email+"&oldPasswd="+oldPasswd;
		//console.log(params);

		$.ajax({
			  type: 'post'
			, url: 'meOk.php'
			,data : params
			, dataType : 'json'
			, success: function(data) {
				//console.log(data.result);

				if(data.result==1){
					alert('수정했습니다.');
					window.close();
					opener.location.reload();
				}else if(data.result==-1){
					alert('필수값이 누락됐습니다. 다시 확인해주십시오.');
					return;
				}else if(data.result==-2){
					alert('이미 가입된 사용자의 이메일입니다. 다시 확인해주십시오.');
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
<script>
$('#cp').change( function() {
	var val=$('#cp').val();

	var params = "SERVICE_ID="+val;
		$.ajax({
			  type: 'get'
			, url: 'cp.php'
			,data : params
			, dataType : 'html'
			, success: function(data) {
					$("#pprice").html(data);
			  }
		});	


	});
</script>