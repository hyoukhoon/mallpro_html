<?php 
//로딩중입니다 표시 header start 
$loading_html = " 
<div id='delay' name='delay' style='position:absolute; left:0;top:0;z-index:1;display:none;width:100%;height:100%'> 
<table border='0' cellpadding='0' cellspacing='0' width='100%' height='100%'> 
<tr><td align='center'>페이지를 로딩중입니다</td></tr> 
</table> 
</div> 
<script language='javascript'> 
<!-- 
document.all.delay.style.display = ''; 
//--> 
</script> "; 
echo $loading_html; 
ob_start(); 
// 로딩중입니다 표시 header end 
?>




<!-- // 로딩중입니다 표시 tail start --> 
<script language="javascript"> 
<!-- 
document.all.delay.style.display = "none"; 
//--> 
</script> 
<?php 
ob_end_flush(); // 버퍼의 내용을 출력한 후 현재 출력 버퍼를 종료 
?> 
<!-- // 로딩중입니다 표시 tail end -->