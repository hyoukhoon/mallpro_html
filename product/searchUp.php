<?php session_start();
include $_SERVER["DOCUMENT_ROOT"]."/inc/dbcon.php";

location_is_close('사용할 수 없는 메뉴입니다.');
	exit;


if(!$_SESSION['AID']){
	location_is_close('로그인이 필요한 메뉴입니다.');
	exit;
}

if(!$_SESSION['AAUTH']){
	location_is_close('유료회원 전용서비스입니다.');
	exit;
}

if(!$_SESSION['AMLEVEL']){
	location_is_close('유료회원 전용서비스입니다.');
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
<title>Mallpro</title>
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
     <li><span>검색어 등록</span></li>
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
                      <th class="color_ch" scope="row"><font color="red">*</font>검색어</th>
                      <td colspan="5"><input type="text" name="kw" id="kw" size="30">
					  <br>타오바오 사이트에서 검색할 문구를 입력하세요.<br>
					  <font color="red">(중국어간체나 영어를 입력하세요, 한글은 안돼요)</font>
					 </td>
                    </tr>
					<tr>
                      <th class="color_ch" scope="row"><font color="red">*</font>페이지</th>
                      <td colspan="5">
						<input type="radio" name="pageNumber" id="pageNumber" value="1" checked>1 
						<input type="radio" name="pageNumber" id="pageNumber" value="2" >2 
						<input type="radio" name="pageNumber" id="pageNumber" value="3">3 
						<input type="radio" name="pageNumber" id="pageNumber" value="4">4 
						<input type="radio" name="pageNumber" id="pageNumber" value="5">5 
						<input type="radio" name="pageNumber" id="pageNumber" value="6">6 
						<input type="radio" name="pageNumber" id="pageNumber" value="7">7 
						<input type="radio" name="pageNumber" id="pageNumber" value="8">8 
						<input type="radio" name="pageNumber" id="pageNumber" value="9">9 
						<input type="radio" name="pageNumber" id="pageNumber" value="10">10 
					  <br>가져올 페이지를 선택하세요.
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
		<li><button type="button" class="button03" onclick="send()">저장</a></li>
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


function send(){

		var kw=$("#kw").val();
		var tag=$("#tag").val();
		var pageNumber=$(":input:radio[name=pageNumber]:checked").val();
		var params = "kw="+kw+"&tag="+tag+"&pageNumber="+pageNumber;

		
		if(!kw){
			alert('검색어를 입력하세요.');
			return;
		}

		check = /[ㄱ-ㅎ|ㅏ-ㅣ|가-힣]/;
		if(check.test(kw)){
			alert("한글은 입력할 수 없습니다.");
			return;
		}


		$.ajax({
			  type: 'post'
			, url: '/product/suOK.php'
			,data : params
			, dataType : 'json'
			, success: function(data) {
				if(data.result==1){
					//alert('데이터를 가져옵니다. 잠시만 기다려주십시오.');
					//window.close();
					location.href='suPb.php?snum='+data.snum
				}else if(data.result==-1){
//					console.log(data.val);
					alert(data.val);
				}else{
					alert('다시 시도하세요');
				}
			  }
		});


}

</script>