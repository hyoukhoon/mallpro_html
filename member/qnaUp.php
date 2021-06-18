<?php session_start();
include $_SERVER["DOCUMENT_ROOT"]."/inc/dbcon.php";

if(!$_SESSION['AID']){
	location_is_close('로그인이 필요한 메뉴입니다.');
	exit;
}
$uid=$_SESSION["AID"];

$title="1:1상담";
?>
<!doctype html>
<html>
<head>
<meta charset="utf-8">
<title>Mediapic Back-office</title>
<link href="/css/dcg_tmall.css" rel="stylesheet" type="text/css" />
<!-- include libraries(jQuery, bootstrap) -->
<link href="https://stackpath.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css" rel="stylesheet">
<script src="https://code.jquery.com/jquery-3.4.1.min.js"></script>
<script src="https://stackpath.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js"></script>
  <!-- include summernote css/js -->
<link href="https://cdn.jsdelivr.net/npm/summernote@0.8.11/dist/summernote.min.css" rel="stylesheet">
<script src="https://cdn.jsdelivr.net/npm/summernote@0.8.11/dist/summernote.min.js"></script>
<style>
.ui-datepicker-trigger { position:relative;top:7px ;left:0px ; }
 /* {} is the value according to your need */
 .qnaImg {
	max-width:80%;
}
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
															<input type="hidden" name="imgUrl" id="imgUrl" value="">

              <div class="list_table_list01">
                <table width="100%" border="0" >
                  <colgroup>
                  <col width=100/>
                  <col width="*"/>
                  </colgroup>
                 
                  <tbody>

					<tr>
                      <th class="color_ch" scope="row"><font color="red">*</font>제목</th>
                      <td ><input type="text" name="subject" id="subject" size="35" ></td>
                    </tr>
					<tr>
                      <th class="color_ch" scope="row">타오바오URL</th>
                      <td ><input type="text" name="url" id="url" size="35" placeholder="https://"></td>
                    </tr>
					<tr>
                      <th class="color_ch" scope="row"><font color="red">*</font>내용</th>
                      <td id="pprice">
							<div id="summernote"></div>
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
		<li><button type="button" class="button03" onclick="saveUp();">저장</button></li>
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

$(document).ready(function () {
    var $summernote = $('#summernote').summernote({
		codeviewFilter: false,
		codeviewIframeFilter: true,
        lang: 'ko-KR',
        height: 400,
        callbacks: {
            onImageUpload: function (files) {
				for(var i=0; i < files.length; i++) {
					if(i>=5){
						alert('5개까지만 등록할 수 있습니다.');
						return;
					}
				sendFile($summernote, files[i]);
			  } 
                
            }
        }
    });
});

function sendFile($summernote, file) {
    var formData = new FormData();
    formData.append("file", file);
    $.ajax({
        url: '/member/saveImage.php',
        data: formData,
        cache: false,
        contentType: false,
        processData: false,
        type: 'POST',
        success: function (data) {
			if(data==-1){
				alert('용량이 너무크거나 이미지 파일이 아닙니다.');
				return;
			}else{
				$summernote.summernote('insertImage', data, function ($image) {
					$image.attr('src', data);
					$image.attr('class', 'qnaImg');
				});
				var imgUrl=$("#imgUrl").val();
				if(imgUrl){
					imgUrl=imgUrl+",";
				}
				$("#imgUrl").val(imgUrl+data);
			}
        }
    });

}



function saveUp(){

		var subject=$("#subject").val();
		var url=$("#url").val();
		var imgUrl=$("#imgUrl").val();
		var content=$('#summernote').summernote('code');

		if(!subject){
			alert("제목을 입력하세요");
			return;
		}

		if ($('#summernote').summernote('isEmpty')) {
		  alert('내용을 입력하세요.');
		  return;
		}



		var params = "subject="+subject+"&content="+content+"&url="+url+"&imgUrl="+imgUrl;
		console.log(params);

		$.ajax({
			  type: 'post'
			, url: 'qnaUpOk.php'
			,data : params
			, dataType : 'json'
			, success: function(data) {
				//console.log(data.result);

				if(data.result==1){
					alert('등록됐습니다.');
					location.href='/member/qna.php'
				}else if(data.result==-1){
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