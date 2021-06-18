<?php include $_SERVER['DOCUMENT_ROOT']."/admin_area/inc/admin_top.php";

//error_reporting(E_ALL);
//ini_set("display_errors", 1);

$num=$_GET['num'];

$result = $mysqli->query("select * from cboard where num='".$num."'");
$rs = $result->fetch_object()

?>

<link href="/css/dcg_tmall.css" rel="stylesheet" type="text/css" />
<!-- include libraries(jQuery, bootstrap) -->
<link href="https://stackpath.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css" rel="stylesheet">
<script src="https://code.jquery.com/jquery-3.4.1.min.js"></script>
<script src="https://stackpath.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js"></script>
  <!-- include summernote css/js -->
<link href="https://cdn.jsdelivr.net/npm/summernote@0.8.11/dist/summernote.min.css" rel="stylesheet">
<script src="https://cdn.jsdelivr.net/npm/summernote@0.8.11/dist/summernote.min.js"></script>

      <!-- **********************************************************************************************************************************************************
      MAIN CONTENT
      *********************************************************************************************************************************************************** -->
      <!--main content start-->
      <section id="main-content">
          <section class="wrapper">
          	<h3><i class="fa fa-angle-right"></i> <?echo comm_title_is($multi);?> 수정하기</h3>

				<div class="row mt">
			  		<div class="col-lg-12">
                      <div class="content-panel" style="padding:20px;">

				<table class="table table-bordered table-striped table-condensed">
<form name="signup">
				<input type=hidden name=mode value="up">
				<input type=hidden name=multi value="<?=$multi?>">
				<input type=hidden name=num value="<?=$num?>">
				<input type=hidden name=gubun value="<?=$gubun?>">
				<tbody>
				<tr>
					<td class="th_01" width="10%">제목</td>
					<td class="td_02"><input type="text" name="subject" id="subject" size="50" value="<?echo stripslashes($rs->subject);?>"></td>
				</tr>
				<tr>
					<td class="th_01">표시여부</td>
					<td class="td_02"><input type=radio name=isdisp value="0" <?if(!$rs->isdisp){echo "checked";}?>>숨김&nbsp;<input type=radio name=isdisp value="1" <?if($rs->isdisp){echo "checked";}?>>표시</td>
				</tr>
				<tr>
					<td class="th_01">메인글</td>
					<td class="td_02"><input type=radio name=notice value="0" <?if(!$rs->notice){echo "checked";}?>>일반글&nbsp;<input type=radio name=notice value="1" <?if($rs->notice){echo "checked";}?>>메인글</td>
				</tr>
				<tr>
					<td class="th_01">답변등록</td>
					<td class="td_02"><input type=radio name="isReply" value="0" <?if(!$rs->isReply){echo "checked";}?>>답변전&nbsp;<input type=radio name=isReply value="1" <?if($rs->isReply){echo "checked";}?>>답변완료</td>
				</tr>

				<?if($multi=="stream"){?>
				<tr>
					<td class="th_01" width="10%">동영상</td>
					<td class="td_02"><textarea name="stream" rows="7" cols="80"><?echo stripslashes($rs->stream);?></textarea></td>
				</tr>
				<?}?>

				<tr>
					<td class="th_01">내용</td>
					<td class="td_02" height="680" style="word-break:break-all;">
						<div id="summernote"><?echo stripslashes($rs->content);?></div>
					</td>
					</td>
				</tr>
				
				</tbody>
			</table>
			<div style="text-align:center;">
				<button type="button" class="button03" onclick="saveUp();">저장</button>
			</div>

	                  </div><!-- /content-panel -->
               </div><!-- /col-lg-4 -->			
		  	</div><!-- /row -->


		</section><!--wrapper -->
      </section><!-- /MAIN CONTENT -->

      <!--main content end-->
      <!--footer start-->
      <footer class="site-footer">
          <div class="text-center">
              2018 - propick
              <a href="responsive_table.html#" class="go-top">
                  <i class="fa fa-angle-up"></i>
              </a>
          </div>
      </footer>
      <!--footer end-->
  </section>
<script>

$(document).ready(function () {
    var $summernote = $('#summernote').summernote({
		codeviewFilter: false,
		codeviewIframeFilter: true,
        lang: 'ko-KR',
        height: 600,
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
		var content=$('#summernote').summernote('code');

		var isdisp=$(':input[name="isdisp"]:checked').val();
		var notice=$(':input[name="notice"]:checked').val();
		var isReply=$(':input[name="isReply"]:checked').val();
		var num=$(':input[name="num"]').val();

		if(!subject){
			alert("제목을 입력하세요");
			return;
		}

		if ($('#summernote').summernote('isEmpty')) {
		  alert('내용을 입력하세요.');
		  return;
		}



		var params = "subject="+subject+"&content="+content+"&isdisp="+isdisp+"&notice="+notice+"&isReply="+isReply+"&num="+num+"&mode=up";
		console.log(params);

		$.ajax({
			  type: 'post'
			, url: 'boardEditOk.php'
			,data : params
			, dataType : 'json'
			, success: function(data) {
				//console.log(data.val);

				if(data.result==1){
					alert('등록됐습니다.');
					location.href='/admin_area/cboard/boardList.php'
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

    <!--script for this page-->

  </body>
</html>
