<?php session_start();
include $_SERVER["DOCUMENT_ROOT"]."/inc/dbcon.php";
$ER_SEQ=$_GET['ER_SEQ'];

if($ER_SEQ){
$que="select * from common_exchange_rate where ER_SEQ='".$ER_SEQ."'";
$result = $mysqli->query($que) or die("2:".$mysqli->error);
$rs = $result->fetch_object();
	$action="xe_ok.php";
}else{
	$action="xu_ok.php";
}

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
     <li><span>환율 등록</span></li>
    </ul>
  </div>
  <!-- 상단 head로고 E-->
  
  <!-- 컨텐츠 S -->
<div class="pop_content">
<form method="post" action="<?=$action?>" name="sf" enctype="multipart/form-data">
<input type="hidden" name="ER_SEQ" value="<?=$ER_SEQ?>">
	  <!-- GRID S-->
              <div class="list_table_list01">
                <table width="100%" border="0" >
                  <colgroup>
                  <col width=100/>
                  <col width="*"/>
                  </colgroup>
                 
                  <tbody>

					<tr>
                      <th class="color_ch" scope="row">달러(미국)</th>
                      <td colspan="5"><input type="text" name="USD" size="30" value="<?=$rs->USD?>"></td>
                    </tr>
					<tr>
                      <th class="color_ch" scope="row">엔(일본)</th>
                      <td colspan="5"><input type="text" name="JPY" size="30"  value="<?=$rs->JPY?>"></td>
                    </tr>
					<tr>
                      <th class="color_ch" scope="row">위안(중국)</th>
                      <td colspan="5"><input type="text" name="CNY" size="30"  value="<?=$rs->CNY?>"></td>
                    </tr>
					<tr>
                      <th class="color_ch" scope="row">유로(EU)</th>
                      <td colspan="5"><input type="text" name="EUR" size="30"  value="<?=$rs->EUR?>"></td>
                    </tr>

                  </tbody>
                </table>
              </div>
      <!-- GRID E-->



   <!-- 하단 버튼 S-->
  
   <div class="bottom_bu_area mt5">
	<ul>
		<li><button type="submit" class="button03">저장</a></li>
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
