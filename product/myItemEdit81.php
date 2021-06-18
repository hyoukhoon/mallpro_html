<?php session_start();
include $_SERVER["DOCUMENT_ROOT"]."/inc/dbcon.php";


if(!$_SESSION['AID']){
	location_is_close('로그인이 필요한 메뉴입니다.');
	exit;
}
$uid=$_SESSION['AID'];

/*
if(!$_SESSION['AAUTH']){
	location_is_close('유료회원 전용서비스입니다.');
	exit;
}

if(!$_SESSION['AMLEVEL']){
	location_is_close('유료회원 전용서비스입니다.');
	exit;
}
*/
$num=$_GET['num'];

$que="select * , a.price as myPrice, b.price as itemPrice 
	from myItem a, taobao b where a.pnum=b.num and a.uid='$uid' and a.num='$num'";
$result = $mysqli->query($que) or die("2:".$mysqli->error);
$rs = $result->fetch_object();

$contents=rawurldecode($rs->itemContents);
$contents=stripslashes($contents);
$contents=str_replace("hidden","",$contents);
?>
<head>
  <meta charset="UTF-8">
  <title>Summernote</title>
  <link href="https://stackpath.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css" rel="stylesheet">
  <script src="https://code.jquery.com/jquery-3.4.1.min.js"></script>
  <script src="https://stackpath.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js"></script>
  <link href="https://cdn.jsdelivr.net/npm/summernote@0.8.11/dist/summernote.min.css" rel="stylesheet">
  <script src="https://cdn.jsdelivr.net/npm/summernote@0.8.11/dist/summernote.min.js"></script>
</head>
<body>
  <!-- 타이틀 S--> 
     <ul class="top_title_area" style="margin:10px;">
       <li class="top_title"><?echo $rs->itemName;?></li>
	   <li class="top_title">동영상URL <input type="text" name="videoUrl" id="videoUrl" value="<?=$rs->videoUrl?>" size="80"></li>
	   <li><a href="#" onclick="insertComma()">따옴표넣기</a></li>
     </ul>
  <!-- 타이틀 E--> 
        

<div id="summernote">
			<span class="c1"></span>
			<?echo "<br>".$contents;?>
</div>
<div style="width:100%;text-align:center;padding:5px;">
	<p>
		<input type="checkbox" id="noOption" name="noOption" value="1" <?if($rs->noOption==1){?>checked<?}?>> 옵션을 표시하지 않는 경우 체크하세요.
	</p>
	<ul>
		<a href="#" class="btn btn-primary" onclick="save();">저장하기</a>
	</ul>
</div>
  <script>

	function insertComma(){
		var com1='<img src="http://www.mallpro.kr/img/c1.png" style="padding-bottom:5px;"><br><br><img src="http://www.mallpro.kr/img/c2.png" style="padding-top:5px;">';
		$(".c1").html(com1);
}

var save = function() {
  var videoUrl = $('#videoUrl').val();
  var markup = $('#summernote').summernote('code');
  //console.log(markup);
  //$('#summernote').summernote('destroy');
  var contents=encodeURIComponent(markup);
  //var contents=markup;
  if($('input:checkbox[id="noOption"]').is(":checked") == true){
		  var noOption=1;
  }else{
		var noOption=0;
  }
  var params="contents="+contents+"&noOption="+"&videoUrl="+videoUrl+"&pnum=<?=$rs->pnum?>&num=<?=$num?>";
//console.log(pnum);
//return;
		$.ajax({
			  type: 'post'
			, url: '/product/mieOk.php'
			,data : {
					"videoUrl" : videoUrl,
					"contents" : contents,
					"noOption" : noOption,
					"pnum" : <?=$rs->pnum?>,
					"num" : <?=$num?>
			}
			, dataType : 'json'
			, success: function(data) {

				if(data.result==1){
					//console.log(data.val);
					alert(data.val);
					location.reload();
				}else if(data.result==-1){
					alert(data.val);
				}else{
					alert('다시 시도하세요');
				}
			  }
			  ,beforeSend:function(){
						$('#wrap-loading').show();
						$('#wrap-loading').center();
				}
				,complete:function(){
						$('#wrap-loading').hide();
				}
		});

};

    $(document).ready(function() {

         $('#summernote').summernote({
			 height:700,
			lang: 'ko-KR',
			fontNames: ['나눔고딕', '나눔명조', '나눔스퀘어','Arial', 'Arial Black', 'Comic Sans MS', 'Courier New'],
			fontSizes: ['11', '12', '14', '18', '20', '22', '24', '36'],
			toolbar: [
				// [groupName, [list of button]]
				['style', ['bold', 'italic', 'underline', 'clear']],
				['font', ['strikethrough']],
				['fontname', ['fontname']],
				['fontsize', ['fontsize']],
				['color', ['color']],
				['para', ['ul', 'ol', 'paragraph']],
				['height', ['height']],
				['codeview']
			  ]
		  });


    });
  </script>
</body>
</html>