<?php session_start();
include $_SERVER["DOCUMENT_ROOT"]."/inc/dbcon.php";

$num=$_GET['num'];

$que="select * 
	from photo_request  where num='".$num."'";
$result = $mysqli->query($que) or die("2:".$mysqli->error);
$rs = $result->fetch_object();

$ampm=Array("A"=>"오전","P"=>"오후");
$bgc=Array("w"=>"흰색","g"=>"회색","b"=>"베이지");
$isa=Array("처리중","처리완료");
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
     <li><span>촬영요청사항관리</span></li>
    </ul>
  </div>
  <!-- 상단 head로고 E-->
  
  <!-- 컨텐츠 S -->
  <div class="pop_content">
<form method="post" action="pr_ok.php" name="sf" enctype="multipart/form-data">
<input type="hidden" name="num" value="<?=$num?>">
  <!-- 타이틀 S--> 
     <ul class="top_title_area">
       <li class="top_title">요청내용</li>
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
                      <th class="color_ch" scope="row">매장명</th>
                      <td colspan="3"><?=$rs->seller_name?></td>
                    </tr>
                    <tr>
                      <th class="color_ch" scope="row">촬영희망일</th>
                      <td><?=$rs->request_date?></td>
                      <th class="color_ch"  scope="row">오전/오후</th>
                      <td><?echo $ampm[$rs->request_part];?></td>
                    </tr>
					<tr>
                      <th class="color_ch" scope="row">수량</th>
                      <td><?=$rs->cnt?></td>
                      <th class="color_ch"  scope="row">배경지</th>
                      <td><?echo $bgc[$rs->background_color];?></td>
                    </tr>
					<tr>
                      <th class="color_ch" scope="row">납품희망일</th>
                      <td><?=$rs->end_date?></td>
                      <th class="color_ch"  scope="row">신청자(연락처)</th>
                      <td><?=$rs->name?>(<?=$rs->mobile?>)</td>
                    </tr>
					<tr>
                      <th class="color_ch" scope="row">요청사항</th>
                      <td colspan="3"><?echo nl2br(stripslashes($rs->memo))?></td>
                    </tr>
                  </tbody>
                </table>
              </div>
      <!-- GRID E-->

  <!-- 타이틀 S--> 
     <ul class="top_title_area">
       <li class="top_title">처리내용</li>
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
                      <th class="color_ch" scope="row">처리상태</th>
                      <td>
							<input type="radio" name="isend" value="0" <?if($rs->isend=="0"){?>checked<?}?>>처리중 &nbsp; <input type="radio" name="isend" value="1" <?if($rs->isend=="1"){?>checked<?}?>>처리완료
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
