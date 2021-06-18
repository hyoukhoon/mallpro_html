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
<!doctype html>
<html>
<head>
<meta charset="utf-8">
<title>Mallpro Back-office</title>
<link href="/css/dcg_tmall.css" rel="stylesheet" type="text/css" />
  <link href="https://stackpath.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css" rel="stylesheet">
  <script type="text/javascript" src="/js/jquery-3.4.1.min.js"></script>
  <script type="text/javascript" src="/js/jquery-latest.min.js"></script>
  <script src="https://stackpath.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js"></script>
  <link href="https://cdn.jsdelivr.net/npm/summernote@0.8.11/dist/summernote.min.css" rel="stylesheet">
  <script src="https://cdn.jsdelivr.net/npm/summernote@0.8.11/dist/summernote.min.js"></script>
</head>

<body class="bg_popup">

<!-- 전체 넓이 S-->
<div id="pop_wrap">
  <!-- 상단 head로고 S-->
  <div class="pop_top_bg">
    <ul>
     <li><span>편집하기</span></li>
    </ul>
  </div>
  <!-- 상단 head로고 E-->
  
  <!-- 컨텐츠 S -->
  <div class="pop_content">
  
    
  <!-- 타이틀 S--> 
     <ul class="top_title_area">
       <li class="top_title"><?echo $rs->itemName;?></li>
	  </ul>
	  <ul class="top_title_area">
	   <li class="top_title">동영상URL <input type="text" name="videoUrl" id="videoUrl" value="<?=$rs->videoUrl?>" size="80" style="height:25px;"></li>
	   </ul>
	   <ul class="top_title_area">
	   <li class="top_title"><a href="#" onclick="insertComma()">따옴표넣기</a></li>
     </ul>

  <!-- 타이틀 E--> 
  
<div id="summernote">
			<?echo "<br>".$contents;?>
</div>

                     
      <!-- 하단 버튼 S-->
  
   <div class="bottom_bu_area" style="width:100%;">
   <?//if($rs->optionCount<=2){?>
   <ul style="width:300px;text-align:center;">
		<li><input type="checkbox" id="noOption" name="noOption" value="1" <?if($rs->noOption==1){?>checked<?}?>> 옵션을 표시하지 않는 경우 체크하세요.</li>
	</ul>
	<?//}?>
	<ul>
		<li><a href="#" class="button03" onclick="save();">저장하기</a></li>
	</ul>
</div>    
            
  <!-- 하단 버튼 E-->


   
</div>
     <!-- 컨텐츠 E -->
 
   
  </div>
 <!-- 전체 넓이 E-->
<div id="wrap-loading" style="display:none;"><img src="/images/loading.gif"></div>
  <script>

jQuery.fn.center = function () {
    this.css("position","absolute");
    this.css("top", Math.max(0, (($(window).height() - $(this).outerHeight()) / 2) + $(window).scrollTop()) + "px");
    this.css("left", Math.max(0, (($(window).width() - $(this).outerWidth()) / 2) + $(window).scrollLeft()) + "px");
    return this;
}

var save = function() {
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
  var params="contents="+contents+"&noOption="+noOption+"&num=<?=$num?>";
console.log(params);
		$.ajax({
			  type: 'post'
			, url: '/product/mieOk.php'
			,data : {
					"contents" : contents,
					"noOption" : noOption,
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
			lang: 'ko-KR',
			toolbar: [
				// [groupName, [list of button]]
				['style', ['bold', 'italic', 'underline', 'clear']],
				['font', ['strikethrough']],
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
