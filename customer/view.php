<?php session_start();
include $_SERVER["DOCUMENT_ROOT"]."/inc/dbcon.php";

$CONTENT_SEQ=$_GET['CONTENT_SEQ'];

$que="select * from bbs_content where CONTENT_SEQ='".$CONTENT_SEQ."'";
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
     <li><span>공지사항 내용보기</span></li>
    </ul>
  </div>
  <!-- 상단 head로고 E-->
  
  <!-- 컨텐츠 S -->
  <div class="pop_content">

	  <!-- GRID S-->
              <div class="list_table_list01">
                <table width="100%" border="0"  style="table-layout:fixed; word-break:break-all;">
                  <colgroup>
                  <col width=100/>
                  <col width="*"/>
                  </colgroup>
                 
                  <tbody>
                    <tr>
                      <th class="color_ch" scope="row">제목</th>
                      <td>
							<?=$rs->SUBJECT?>
					  </td>
                    </tr>
					<tr>
                      <th class="color_ch" scope="row">내용</th>
                      <td style="height:400px;vertical-align:top;"><?=$rs->CONTENTS?></td>
                    </tr>

                  </tbody>
                </table>
              </div>
      <!-- GRID E-->


  
   <div class="bottom_bu_area mt5">
	<ul>
		<li><a href="javascript:window.close();" class="button03_1">닫기</a></li>
	</ul>
</div>    
            
  <!-- 하단 버튼 E-->


   
</div>
  <!-- 컨텐츠 E --> 
 
   
  </div>
 <!-- 전체 넓이 E-->

</body>
</html>
