<?php include $_SERVER["DOCUMENT_ROOT"]."/inc/dbcon.php";

include $_SERVER["DOCUMENT_ROOT"]."/admin_page/product/product_insert_func.php";


$sd=$_GET['sd'];

foreach($sd as $n){
//		$df=date("Y-m-d",strtotime(substr($n,0,8)));
		$ps2=product_insert($n);
		if($ps2=="fail"){
			location_is('','','제품등록중 오류가 발생했습니다. 잠시후에 다시 시도해주십시오.');
			exit;
		}
}
//echo "end:".$ps2;
//exit;
location_is('','','등록했습니다. 처리결과는 성공수나 실패수를 눌러 확인하세요.');
exit;


?>

