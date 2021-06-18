<?php session_start();
include $_SERVER["DOCUMENT_ROOT"]."/inc/dbcon.php";

if(!$_SESSION['AID']){
	location_is_close('로그인이 필요한 메뉴입니다.');
	exit;
}
$uid=$_SESSION["AID"];

$title="1:1상담";
$num=$_GET['num'];
$result = $mysqli->query("select * from cboard where num='$num'");
$rs = $result->fetch_object();
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


              <div class="list_table_list01">
                <table width="100%" border="0" >
                  <colgroup>
                  <col width=100/>
                  <col width="*"/>
                  </colgroup>
                 
                  <tbody>

					<tr>
                      <th class="color_ch" scope="row">제목</th>
                      <td ><?echo stripslashes($rs->subject);?></td>
                    </tr>
					<tr>
                      <th class="color_ch" scope="row">타오바오URL</th>
                      <td ><?echo $rs->url;?></td>
                    </tr>
					<tr>
                      <th class="color_ch" scope="row">내용</th>
                      <td id="pprice">
							<?echo content_is2($rs->content);?>
							<?php
								if($rs->fn1){
							?>
							<br>
							첨부파일 : <a href="/data/<?=$rs->fn1?>" target="_blank"><?php echo $rs->fn_name1;?></a>
							<?
							}
							?>
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
		<li><button type="button" class="button03" onclick="history.back()">목록으로</button></li>
		<li><a href="javascript:window.close();" class="button03_1">창닫기</a></li>
	</ul>
</div>    
            
  <!-- 하단 버튼 E-->


   
</div>
  <!-- 컨텐츠 E --> 
 
   
  </div>
 <!-- 전체 넓이 E-->

</body>
</html>
