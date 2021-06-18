<?php session_start();

header("Pragma: no-cache");
header("Cache-Control: no-store, no-cache, must-revalidate"); 

include $_SERVER["DOCUMENT_ROOT"]."/inc/dbcon.php";
$dir=$_SERVER["DOCUMENT_ROOT"]."media/PRODUCT/";
$ignored = array('.', '..', '.svn', '.htaccess');
$files = array();
foreach (scandir($dir) as $file) {
if (in_array($file, $ignored)) continue;
	$files[] = $file;
}
arsort($files);

?>
<!doctype html>
<html>
<head>
<meta charset="utf-8">
<title>Mediapic Back-office</title>
<link href="/admin_page/css/dcg_tmall.css" rel="stylesheet" type="text/css" />
<script type="text/javascript" src="/asset/js/jquery-1.11.3.min.js"></script>
<script type="text/javascript" src="/inc/inline-progress.js"></script>
<script src="/inc/jquery.simplemodal.js" type="text/javascript"></script>
<script src="/inc/ProgressBar.js" type="text/javascript"></script> 
<script>
var progressbar = new Object();
progressbar.enable = true; // 사용여부
progressbar.image = "/image/loading2.gif"; // 사용할 이미지 파일
/* Progress Bar 함수 */
function Progressbar() {
    if (progressbar.enable) {
        $("#imgProgressbar").modal({
            overlayCss: { "background-color": "#000", "cursor": "wait" },
            containerCss: { "background-color": "#fff", "border": "0px solid #ccc" },
            close: false,
            closeHTML: ''
        });
    }
}
    
$(function(){
    // 크롬과 사파리에서 beforeunload 이벤트가 실행되는 동안
    // 동적으로 생성된 img 엘리먼트가가 정상적으로 로딩되지 않아 미리 img 엘리먼트를 생성한다. 
    $("body").append('<img id ="imgProgressbar" src="' + progressbar.image + '" alt="progressbar" />');
     $("#imgProgressbar").hide();
     $.modal.close();
    
    // IE에서 애니메이션 gif가 멈춰있는 현상으로 인하여 setTimeout을 이용하여 Progressbar function 실행
    $(window).bind("beforeunload", function(){  setTimeout("Progressbar()", 0);});
});
</script>
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
<form method="get" name="pf">
                <table width="100%" border="0" >
                  <colgroup>
                  <col width=100/>
                  <col width="*"/>
                  </colgroup>
                 
                  <tbody>
<?foreach($files as $f){
?>
				  <tr>
                      <th class="color_ch" style="text-align:left;" colspan="2"><?=$f?></th>
                    </tr>
	<?
		$dir2=$_SERVER["DOCUMENT_ROOT"]."media/PRODUCT/".$f;
		$days = array();
		foreach (scandir($dir2) as $da) {
		if (in_array($da, $ignored)) continue;
			$days[] = $da;
		}
		arsort($days);
		foreach($days as $d){
			$df=date("Y.m.d",strtotime(substr($d,0,8)));
			$reg_date=date("Y-m-d",strtotime(substr($d,0,8)));
			$et1=substr($d,8);
			if($et1){
				$df=$df.$et1;
			}
			$cnt=$pcnt=0;
			$que="select count(*) from ptest where folder_name='".$d."'";
			$result = $mysqli->query($que) or die("1:".$mysqli->error);
			$rs = $result->fetch_array();
			$cnt=$rs[0];

			$que2="select count(*) from product where IS_DELETE='0' and ETC2='".$d."'";
			$result2 = $mysqli->query($que2) or die("2:".$mysqli->error);
			$rs2 = $result2->fetch_array();
			$pcnt=$rs2[0];
?>
                    <tr>
                      <th class="color_ch" style="text-align:center;"><input type="checkbox" name="sd[]" value="<?=$d?>"></th>
                      <td><?=$df?><?if($rs[0]){?> [엑셀등록완료]<?}?><?if($pcnt){?> & [총 <?=$cnt?>중 <?=$pcnt?>개 등록]<?}?></td>
                    </tr>

		<?}?>
<?}?>
                  </tbody>
                </table>
</form>
              </div>

   <!-- 하단 버튼 S-->
  
<div class="bottom_bu_area mt5">
	<ul style="width:100%;text-align:center">
		<li><a href="/admin_page/product/shell_test.php" class="button03" style="width:140px;">1.서버로자료가져오기</a></li>
		<li><a href="javascript:;" class="button03" style="width:140px;" onclick="sdForm();">2.선택날짜엑셀등록하기</a></li>
		<li><a href="javascript:;" class="button03" style="width:140px;" onclick="sdForm2();">3.선택날짜제품등록하기</a></li>
		<li><a href="javascript:window.close();" class="button03_1" style="width:90px;">취소</a></li>
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
	a.action='fd_ok.php'; 
	a.submit();

}

function sdForm2(){

	a=document.pf;
	a.action='fi_ok.php'; 
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
