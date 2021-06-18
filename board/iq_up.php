<?php session_start();
include $_SERVER["DOCUMENT_ROOT"]."/inc/dbcon.php";

$INQUIRY_ID=$_GET['INQUIRY_ID'];

$que="select * 
	from inquiry  where INQUIRY_ID='".$INQUIRY_ID."'";
$result = $mysqli->query($que) or die("2:".$mysqli->error);
$rs = $result->fetch_object();


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
     <li><span>1:1 문의 관리</span></li>
    </ul>
  </div>
  <!-- 상단 head로고 E-->
  
  <!-- 컨텐츠 S -->
  <div class="pop_content">
<form method="post" action="iq_ok.php" name="sf" enctype="multipart/form-data">
<input type="hidden" name="INQUIRY_ID" value="<?=$INQUIRY_ID?>">
  <!-- 타이틀 S--> 
     <ul class="top_title_area">
       <li class="top_title">1:1 문의내용</li>
     </ul>
  <!-- 타이틀 E--> 
  
  
  <!-- GRID S-->
              <div class="list_table_list01">
                <table width="100%" border="0" >
                  <colgroup>
                  <col width=100/>
                  <col width=30%/>
                  <col width=100/>
                  <col width="*"/>
                  </colgroup>
                 
                  <tbody>
				  <tr>
                      <th class="color_ch" scope="row">제목</th>
                      <td colspan="3"><?=$rs->TITLE?></td>
                    </tr>
                    <tr>
                      <th class="color_ch" scope="row">이메일</th>
                      <td><?=$rs->EMAIL?></td>
                      <th class="color_ch"  scope="row">아이디</th>
                      <td><?=$rs->ID?></td>
                    </tr>
					<tr>
                      <th class="color_ch" scope="row">등록일</th>
                      <td><?=$rs->REG_DATE?></td>
                      <th class="color_ch"  scope="row">처리상태</th>
                      <td><?if($rs->REPLY_YN=="Y"){?>처리완료<?}else{?><font color="red">처리중</font><?}?></td>
                    </tr>
					<tr>
                      <th class="color_ch" scope="row">문의내용</th>
                      <td colspan="3"><?echo nl2br(stripslashes($rs->CONTENTS))?></td>
                    </tr>
                  </tbody>
                </table>
              </div>
      <!-- GRID E-->

  <!-- 타이틀 S--> 
     <ul class="top_title_area">
       <li class="top_title">1:1 답변내용</li>
     </ul>
  <!-- 타이틀 E--> 

	  <!-- GRID S-->
              <div class="list_table_list01">
                <table width="100%" border="0" >
                  <colgroup>
                  <col width=100/>
                  <col width="*"/>
                  </colgroup>
                 
                  <tbody>
                    <tr>
                      <th class="color_ch" scope="row">담당자</th>
                      <td><?=$rs->REPLY_ID?></td>
                      <th class="color_ch"  scope="row">답변일</th>
                      <td><?=$rs->REPLY_DATE?></td>
                    </tr>
					<tr>
                      <th class="color_ch" scope="row">답변내용</th>
                      <td>

						<textarea name="REPLY_CONTENTS" rows="5" cols="70"><?echo stripslashes($rs->REPLY_CONTENTS);?></textarea>

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
		<li><a href="javascript:;" class="button03" onclick="return sendform();">저장</a></li>
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
	a=document.sf;

			a.submit();

	return true;
}



	function chk_id(){

		a=document.sf;
		if(!a.SELLER_ID.value){
			alert('아이디를 입력하세요.');
		}
		var params = "sid="+a.SELLER_ID.value;
		$.ajax({
			  type: 'get'
			, url: 'checkId.php'
			,data : params
			, dataType : 'html'
			, success: function(data) {
				alert(data);
			  }
		});	
}
</script>
