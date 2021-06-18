<?php session_start();
include $_SERVER["DOCUMENT_ROOT"]."/inc/dbcon.php";


if(!$_SESSION['AID']){
	location_is_close('로그인이 필요한 메뉴입니다.');
	exit;
}
$uid=$_SESSION["AID"];
if($uid!="hyoukhoon"){
	$where=" and uid='".$_SESSION["AID"]."'";
}
$que="SELECT * FROM cboard where multi='qna' $where";
$LIMIT=$_GET['LIMIT']??10;
$page=$_GET['page']??1;
$start_page=($page-1)*$LIMIT;
$end_page=$LIMIT;
$ps=$LIMIT;//한페이지에 몇개를 표시할지
$sub_size=10;//아래에 나오는 페이징은 몇개를 할지
$total_page=ceil($total/$ps);//몇페이지
$f_no=$_GET['f_no']??1;//첫페이지
if($f_no<1)$f_no=1;
$l_no=$f_no+$sub_size-1;//마지막페이지
if($l_no>$total_page)$l_no=$total_page;
$n_f_no=$f_no+$sub_size;//다음첫페이지
$p_f_no=$f_no-$sub_size;//이전첫페이지
$no=$total-($page-1)*$ps;//번호매기기

$limit_query=" order by num desc limit $start_page, $end_page";
$last_query=$que.$limit_query;
//	echo "query:".$last_query;
$result = $mysqli->query($last_query) or die("3:".$mysqli->error);
while($rs = $result->fetch_object()){
$rsc[]=$rs;
}

$total=count($rsc);
?>
<!doctype html>
<html>
<head>
<meta charset="utf-8">
<title>몰프로</title>
<link href="/css/dcg_tmall.css" rel="stylesheet" type="text/css" />
<link rel="stylesheet" href="http://code.jquery.com/ui/1.8.18/themes/base/jquery-ui.css" type="text/css" />  
<script src="http://ajax.googleapis.com/ajax/libs/jquery/1.7.1/jquery.min.js"></script>  
<script src="http://code.jquery.com/ui/1.8.18/jquery-ui.min.js"></script>  
<style>
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
     <li><span>1:1문의</span></li>
    </ul>
  </div>
  <!-- 상단 head로고 E-->
  
  <!-- 컨텐츠 S -->
  <div class="pop_content">
  
    
  <!-- 타이틀 S--> 
     <ul class="top_title_area">
       <li class="top_title"><?=$uid?>님께서 문의하신 내용입니다.</li>
     </ul>
     <ul class="right_bu_area mtm35">
      <li class="num_list01">전체:<span><?=$total?></span>건</li>
     </ul>
  <!-- 타이틀 E--> 
  
  
  

    <!-- GRID S-->
    <div class="list_table_list03">
      <table width="100%" border="0"  summary="이 표는 주문결제정보를 나타내는 테이블 입니다.">
      
           <thead>        
           <tr>
             <td class="color_sub_ch" scope="col">답변</td>
             <td class="color_sub_ch" scope="col">제목</td>
             <td class="color_sub_ch" scope="col">날짜</td>
			 <td class="color_sub_ch" scope="col">삭제</td>
             </tr>
           </thead>
             <tbody>
            <?php
            foreach($rsc as $p){


            ?>
             <tr style="line-height:30px;cursor:pointer;">
             <td><?if($p->isReply==1){?><font color="#337ab7">[완료]</font><?}else{?>[준비중]<?}?></td>
             <td><a href="/member/qnaView.php?num=<?=$p->num?>"><?=$p->subject?></a></td>
             <td><?echo date("Y.m.d", strtotime($p->reg_date));?></td>
			 <td>
				<a href="qnaDel.php?num=<?=$p->num?>" onclick="return confirm('삭제하시겠습니까?');">삭제</a>
			  </td>
             </tr>
			 
            <?
            }

            if(!sizeof($rsc)){
            ?>
            <tr>
              <td style="vertical-align:middle;text-align:center;" colspan="4">아직 데이타가 없습니다.
            </td>
          </tr>
          <?}?>
        </tbody>
      </table>
    </div>
      <!-- GRID E-->


   

   <!-- 하단 버튼 S-->
  
   <div class="bottom_bu_area mt10">
	<ul>
		<li><a href="/member/qnaUp.php" class="button03">글쓰기</a></li>
		<li><a href="#" class="button03_1" onclick="window.close();">창닫기</a></li>
	</ul>
</div>    
            
  <!-- 하단 버튼 E-->


   
</div>
  <!-- 컨텐츠 E --> 
 
   
  </div>
 <!-- 전체 넓이 E-->
 
  
<script>
$( document ).ready(function() {

	$(".viewLine").on("click",function(){
	var obj = $(this);

	if( obj.hasClass("viewLine") ){
		$(".warning").hide();
			obj.next().fadeIn();
		}
	});

});
</script>

</body>
</html>
