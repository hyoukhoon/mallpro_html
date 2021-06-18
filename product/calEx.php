<?php session_start();
include $_SERVER["DOCUMENT_ROOT"]."/inc/dbcon.php";

if(!$_SESSION['AID']){
	location_is_close('로그인이 필요한 메뉴입니다.');
	exit;
}

$uid=$_SESSION['AID'];
$num=$_GET['num'];
$cny=cnyIs();

?>
<!doctype html>
<html>
<head>
<meta charset="utf-8">
<title>Mallpro Back-office</title>
<link href="/css/dcg_tmall.css" rel="stylesheet" type="text/css" />
<script type="text/javascript" src="/js/jquery.min.js"></script>

</head>

<body class="bg_popup">

<!-- 전체 넓이 S-->
<div id="pop_wrap">
  <!-- 상단 head로고 S-->
  <div class="pop_top_bg">
    <ul>
     <li><span>환율계산기</span></li>
    </ul>
  </div>
  <!-- 상단 head로고 E-->
  
  <!-- 컨텐츠 S -->
  <div class="pop_content">

	  <!-- GRID S-->
              <div class="list_table_list01">
			  
                <table width="100%" border="0" >
                  <colgroup>
                  <col width="*"/>
                  <col width="240"/>
                  </colgroup>
                 
                  <tbody>
					<tr>
                      <th class="color_ch" scope="row" style="text-align:center">타오바오구매가</th>
                      <td style="text-align:right;"><input type="text" numberOnly name="tprice" id="tprice" size="7"  style="text-align:right"  value="" >위안</td>
                    </tr>
					<tr>
                      <th class="color_ch" scope="row" style="text-align:center">환율</th>
                      <td style="text-align:right;"><input type="text" numberOnly name="exFee" id="exFee" size="7"  style="text-align:right"  value="<?=$cny?>" >원</td>
                    </tr>
					
					<tr style="background-color:red; color:#fff;">
                      <td  scope="row" style="text-align:center; color:#fff;"><b>한화</b></th>
                      <td style="text-align:right; color:#fff;">약 <span id="priceResult">0</span>원</td>
                    </tr>


                  </tbody>
                </table>
              </div>
      <!-- GRID E-->

   <!-- 하단 버튼 S-->
  
   <div class="bottom_bu_area mt5">
	<ul>
		<li><a href="javascript:;" class="button03" onclick="sendform();">계산</a></li>
		<li><a href="javascript:" class="button03_1" onclick="window.close();">닫기</a></li>
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

$( document ).ready(function() {

    $("input:text[numberOnly]").on("keyup", function() {
		$(this).val($(this).val().replace(/[^0-9.\\-]/g,""));
	});

});


function sendform(){

	var tPrice=$("#tprice").val();
	var exFee=$("#exFee").val();

	if(!tPrice){
		alert('타오바오구매가를 입력하세요');
		return;
	}

	var price=tPrice*exFee;

//	alert(tPrice+"*"+exFee+"="+price);

	$("#priceResult").text(price.toFixed(2));

}

</script>

