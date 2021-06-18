<?php session_start();
include $_SERVER["DOCUMENT_ROOT"]."/inc/dbcon.php";
$dir=$_SERVER["DOCUMENT_ROOT"]."media/PRODUCT/";

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
     <li><span>폴더선택</span></li>
    </ul>
  </div>
  <!-- 상단 head로고 E-->
  
  <!-- 컨텐츠 S -->
  <div class="pop_content">

  <!-- GRID S-->
              <div class="list_table_list01">
<form method="get" action="pi_ok.php" name="pf">
<input type="hidden" name="mode" value="up">
                <table width="100%" border="0"  style="table-layout:fixed; word-break:break-all;">
                  <colgroup>
                  <col width=100/>
				  <col width=100/>
                  <col width="*"/>
                  </colgroup>
                 
                  <tbody>
<?
$que="select * 
	from ptest  where  gubun='0' group by reg_date";
//	echo $que;
	$result = $mysqli->query($que) or die("3:".$mysqli->error);
	while($rs = $result->fetch_object()){
			$rsc[]=$rs;
	}

foreach($rsc as $p){
?>
                    <tr>
                      <th class="color_ch" style="text-align:center;"><input type="checkbox" name="sd[]" value="<?=$p->reg_date?>"></th>
                      <td><?=$p->reg_date?></td>
					  <td><a href="pi_list.php?reg_date=<?=$p->reg_date?>" target="_blank">내용보기</a>
						
					  </td>
                    </tr>
<?}?>
                  </tbody>
                </table>
</form>
              </div>

   <!-- 하단 버튼 S-->
  
<div class="bottom_bu_area mt5">
	<ul>
		<li><a href="javascript:;" class="button03" style="width:150px;" onclick="sdForm();">선택날짜 제품입력하기</a></li>
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
function sdForm(){

	a=document.pf;
	a.submit();

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
