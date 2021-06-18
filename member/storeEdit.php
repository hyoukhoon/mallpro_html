<?php session_start();
include $_SERVER["DOCUMENT_ROOT"]."/inc/dbcon.php";

if(!$_SESSION['AID']){
	location_is_close('로그인이 필요한 메뉴입니다.');
	exit;
}

$uid=$_SESSION['AID'];

$que="select * from storeinfo where uid='".$uid."'";
$result = $mysqli->query($que) or die("2:".$mysqli->error);
$rs = $result->fetch_object();


?>
<!doctype html>
<html>
<head>
<meta charset="utf-8">
<title>Mediapic Back-office</title>
<link href="/css/dcg_tmall.css" rel="stylesheet" type="text/css" />
<script type="text/javascript" src="/js/jquery.min.js"></script>

</head>

<body class="bg_popup">

<!-- 전체 넓이 S-->
<div id="pop_wrap">
  <!-- 상단 head로고 S-->
  <div class="pop_top_bg">
    <ul>
     <li><span>스토어정보</span></li>
    </ul>
  </div>
  <!-- 상단 head로고 E-->
  
  <!-- 컨텐츠 S -->
  <div class="pop_content">

	  <!-- GRID S-->
              <div class="list_table_list01">
                <table width="100%" border="0" >
                  <colgroup>
                  <col width=150/>
                  <col width="*"/>
                  </colgroup>
                 
                  <tbody>
					<tr>
                      <th class="color_ch" scope="row"><font color="red">*</font>A/S 전화번호</th>
                      <td><input type="text" name="asTel" id="asTel" size="40" value="<?=$rs->asTel?>"></td>
                    </tr>
					<tr>
                      <th class="color_ch" scope="row"><font color="red">*</font>A/S 안내내용</th>
                      <td><input type="text" name="asComment" id="asComment" size="50" value="<?=$rs->asComment?>"></td>
                    </tr>
					<tr>
                      <th class="color_ch" scope="row">제품상세 상단이미지<br>※URL을 입력하세요</th>
                      <td>
							<input type="text" name="topImage" id="topImage" size="50" value="<?=$rs->topImage?>" placeholder="http://">
					  </td>
                    </tr>
					<tr>
                      <th class="color_ch" scope="row">제품상세 하단이미지<br>※URL을 입력하세요</th>
                      <td>
							<input type="text" name="footerImage" id="footerImage" size="50" value="<?=$rs->footerImage?>" placeholder="http://">
					  </td>
                    </tr>
					<tr>
                      <th class="color_ch" scope="row">제품상단 텍스트<br>※HTML형식으로 입력하세요</th>
                      <td>
							<textarea name="topText" id="topText" style="width:90%;height:200px;"><?echo stripslashes($rs->topText);?></textarea>
					  </td>
                    </tr>

                  </tbody>
                </table>
              </div>
      <!-- GRID E-->

   <!-- 하단 버튼 S-->
  
   <div class="bottom_bu_area mt5">
	<ul>
		<li><a href="javascript:;" class="button03" onclick="sendform();">저장</a></li>
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

		var asTel=$("#asTel").val();
		var asComment=$("#asComment").val();
		var topImage=$("#topImage").val();
		var footerImage=$("#footerImage").val();
		var topText=$("#topText").val();



		if(!asTel){
			alert("AS 전화번호를 입력하세요.");
			return;
		}

		if(!asComment){
			alert("AS 안내내용을 입력하세요.");
			return;
		}
/*
		if(!topImage){
			alert("제품상세 상단이미지를 입력하세요.");
			return;
		}

		if(!footerImage){
			alert("제품상세 하단이미지를 입력하세요.");
			return;
		}
*/

		var params = "asTel="+asTel+"&asComment="+asComment+"&topImage="+topImage+"&footerImage="+footerImage+"&topText="+topText;
		//console.log(params);

		$.ajax({
			  type: 'post'
			, url: 'storeOk.php'
			,data : params
			, dataType : 'json'
			, success: function(data) {
//				console.log(data.val);

				if(data.result==1){
					alert(data.val);
					window.close();
					opener.location.reload();
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

