<?php session_start();
include $_SERVER["DOCUMENT_ROOT"]."/inc/dbcon.php";

if(!$_SESSION['AID']){
	location_is_close('로그인이 필요한 메뉴입니다.');
	exit;
}

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

if(!isMyCnt($_SESSION['AID'])){
	location_is_close('수집 가능 갯수가 없습니다. 유료회원으로 등록하십시오.');
	exit;
}




$CONTENT_SEQ=$_GET['CONTENT_SEQ'];

$que="select * from searchWord";
$result = $mysqli->query($que) or die("2:".$mysqli->error);
$rs = $result->fetch_object();

?>
<!doctype html>
<html>
<head>
<meta charset="utf-8">
<title>Mallpro Back-office</title>
<link href="/css/dcg_tmall.css" rel="stylesheet" type="text/css" />
<script type="text/javascript" src="/js/jquery.min.js"></script>
	<script type="text/javascript" src="/js/jquery-ui.min.js"></script>
</head>

<body class="bg_popup">

<!-- 전체 넓이 S-->
<div id="pop_wrap">
  <!-- 상단 head로고 S-->
  <div class="pop_top_bg">
    <ul>
     <li><span>URL 등록</span></li>
    </ul>
  </div>
  <!-- 상단 head로고 E-->
  
  <!-- 컨텐츠 S -->
  <div class="pop_content">
	  <!-- GRID S-->
              <div class="list_table_list01">
                <table width="100%" border="0" >
                  <colgroup>
                  <col width=100/>
                  <col width="*"/>
                  </colgroup>
                 
                  <tbody>
                    
					<tr>
                      <th class="color_ch" scope="row"><font color="red">*</font>URL</th>
                      <td colspan="5"><input type="text" name="url" id="url" size="50">
					  <br>타오바오 사이트 제품상세 페이지 URL을 입력하세요.
					 </td>
                    </tr>
					<tr>
                      <th class="color_ch" scope="row"><font color="red">*</font>태그</th>
                      <td colspan="5"><input type="text" name="tag" id="tag" size="50">
						<br>태그와 태그는 , 로 구분하세요. 한글이나 영어로 입력하세요.
					  </td>
                    </tr>


                  </tbody>
                </table>
              </div>
      <!-- GRID E-->



   <!-- 하단 버튼 S-->
  
   <div class="bottom_bu_area mt5">
	<ul>
		<li><button type="button" class="button03" onclick="send()">가져오기</a></li>
		<li><a href="javascript:reset();" class="button03_1">취소</a></li>
	</ul>
</div>    
            
  <!-- 하단 버튼 E-->
</form>

   
</div>
  <!-- 컨텐츠 E --> 
 
   
  </div>
 <!-- 전체 넓이 E-->
<div id="wrap-loading" style="display:none;"><img src="/images/loading.gif"></div>
</body>
</html>
<script>


function send(){

		var url=$("#url").val();
		var tag=$("#tag").val();
		url=encodeURIComponent(url);
		var params = "url="+url+"&tag="+tag;
		
		if(!url){
			alert('url을 입력하세요.');
			return;
		}

		$.ajax({
			  type: 'post'
			, url: '/product/suOK2.php'
			,data : params
			, dataType : 'json'
			, success: function(data) {
				//alert(data.result);
				//console.log(data.val);
				//return;
				if(data.result==1){
					alert('데이터를 가져옵니다. 잠시 후에 전체상품 리스트에 나타납니다.');
					opener.location.href='/product/itemList.php';
					window.close();
					return;
					//location.href='su2Pb.php?pid='+data.pid
				}else if(data.result==-1){
					alert(data.val);
				}else{
					alert('다시 시도하세요');
				}
			  }

		});


}

</script>