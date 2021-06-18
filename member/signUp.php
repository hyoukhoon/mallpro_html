<?php session_start();
include $_SERVER["DOCUMENT_ROOT"]."/inc/dbcon.php";

$mode=$_GET['mode'];
$SELLER_CODE=$_GET['SELLER_CODE'];
$CONTRACT_ID=$_GET['CONTRACT_ID'];

/*
$que2="select * from seller where SELLER_CODE='".$SELLER_CODE."'";
$result2 = $mysqli->query($que2) or die("2:".$mysqli->error);
$rs2 = $result2->fetch_object();

if($CONTRACT_ID){
	$que="select * from contract where CONTRACT_ID='".$CONTRACT_ID."'";
	$result = $mysqli->query($que) or die("2:".$mysqli->error);
	$rs = $result->fetch_object();
}
*/
$title="회원가입";
?>
<!doctype html>
<html>
<head>
<meta charset="utf-8">
<title>몰프로</title>
<link href="/css/dcg_tmall.css" rel="stylesheet" type="text/css" />
<link rel="stylesheet" href="http://code.jquery.com/ui/1.8.18/themes/base/jquery-ui.css" type="text/css" />  
<script src="http://ajax.googleapis.com/ajax/libs/jquery/1.7.1/jquery.min.js"></script>  
<script src="http://code.jquery.com/ui/1.8.18/jquery-ui.min.js"></script>  
<script type="text/javascript" src="/js/jquery.min.js"></script>
	<script type="text/javascript" src="/js/jquery-ui.min.js"></script>
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
                  <col width=100/>
                  <col width="*"/>
                  </colgroup>
                 
                  <tbody>

					<tr>
                      <th class="color_ch" scope="row"><font color="red">*</font>아이디</th>
                      <td ><input type="text" name="uid" id="uid" size="35" style="IME-MODE: disabled" placeholder="4자이상 16자이하 영문자로 입력해주세요"> <button type="button" class="button03_4"  onclick="checkId()">중복확인</button></td>
                    </tr>
					<tr>
                      <th class="color_ch" scope="row"><font color="red">*</font>비밀번호</th>
                      <td >
								<input type="password" name="passwd" id="passwd" size="60" placeholder="8자이상 영문자,특수문자,숫자를 모두 포함해주세요">
					  </td>
                    </tr>
					<tr>
                      <th class="color_ch" scope="row"><font color="red">*</font>비밀번호확인</th>
                      <td >
								<input type="password" name="passwd2" id="passwd2" size="60" placeholder="비밀번호를 한번더 입력해주세요">
					  </td>
                    </tr>

					<tr>
                      <th class="color_ch" scope="row"><font color="red">*</font>이메일</th>
                      <td id="pprice">
							<input type="text" name="email" id="email" size="60">
					  </td>
                    </tr>
					<tr>
                      <th class="color_ch" scope="row">추천인</th>
                      <td id="pprice">
							<input type="text" name="referee" id="referee" size="60">
					  </td>
                    </tr>
					<tr>
						<td colspan="2" style="text-align:center;">
							<input class="form-check-input" type="checkbox" name="agree" id="agree" value="1"> 약관동의 <a href="#" onclick="window.open('yak.html','yak','width=640,height=820,scrollbars=yes');">[약관확인하기]</a>
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
		<li><a href="javascript:window.close();" class="button03_1">취소</a></li>
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

function checkId(){

	var uid=$("#uid").val();

	if(CheckId(uid) == false){
		$("#isCheckId").val("0");
		alert("아이디는 영문자와 숫자만 허용되며\n4자 이상 16자 이하로 입력해주세요.");
	}else{

		var params = "uid="+uid;
		$.ajax({
			  type: 'post'
			, url: 'checkId.php'
			,data : params
			, dataType : 'html'
			, success: function(data) {
				if(data==1){
					$("#isCheckId").val("1");
					$("#uid").prop( "disabled", true );
					alert("사용 가능한 아이디입니다.\n 확인버튼을 클릭후 회원가입을 진행해주세요.");
				}else{
					$("#isCheckId").val("0");
					alert("이미 사용중인 아이디입니다.\n다른 아이디를 사용해 주십시오.");
				}
			  }
		});	
	}

}


function signUp(){

		var uid=$("#uid").val();
		var passwd=$("#passwd").val();
		var passwd2=$("#passwd2").val();
		var email=$("#email").val();
		var referee=$("#referee").val();


		if(CheckId(uid) == false){
			alert("아이디는 영문자와 숫자만 허용되며\n 4자 이상 16자 이하로 입력해주세요.");
			return;
		}

		if($("#isCheckId").val()==0){
			alert("아이디 중복확인 버튼을 클릭해\n 중복 사용여부를 확인해주세요");
			return;
		}


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

		var agree=$("input[name='agree']:checked").val();
		if(agree!=1){
				alert("약관에 동의하지 않으시면 \n 회원 가입을 할 수 없습니다.");
				return;
		}


		var params = "uid="+uid+"&passwd="+passwd+"&email="+email+"&referee="+referee;
		//console.log(params);

		$.ajax({
			  type: 'post'
			, url: 'signUpOk.php'
			,data : params
			, dataType : 'json'
			, success: function(data) {
				//console.log(data.result);

				if(data.result==1){
					alert('가입되셨습니다. 감사합니다. \n로그인 후 사용하실 수 있습니다.');
					window.close();
					opener.location.href='/login.html'
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