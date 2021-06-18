<?php session_start();
include $_SERVER["DOCUMENT_ROOT"]."/inc/dbcon.php";
echo "<meta http-equiv='Content-Type' content='text/html; charset=utf-8'> ";
$uid=$_SESSION['AID'];

header( "Content-type: application/vnd.ms-excel" );
header( "Content-type: application/vnd.ms-excel; charset=utf-8");
header( "Content-Disposition: attachment; filename = myList_".$now3.".xls" );
header( "Content-Description: PHP5 Generated Data" );

$jsonCheck=urldecode($_GET['jsonCheck']);
$itemNum=json_decode($jsonCheck);
$w="";
foreach($itemNum as $i){
		$w.="'".$i."',";
}
	$w=substr($w,0,-1);
	$where=" and a.num in (".$w.")";
	if(!$order){
		$order=" order by a.num desc";
	}

	$que="select * , a.price as myPrice, b.price as itemPrice 
	from myItem a, taobao b where a.pnum=b.num and uid='$uid'";
	$que.=$where;
	$que.=$order;

//	echo $que;
	$result = $mysqli->query($que) or die("3:".$mysqli->error);
	while($rs = $result->fetch_object()){
			$rsc[]=$rs;
	}

?>

<table width="100%" border="1">
	<thead>
		<tr>
			<th scope="col">상품상태</th>
			<th scope="col">카테고리ID</th>
			<th scope="col">상품명</th>
			<th scope="col">판매가</th>
			<th scope="col">재고수량</th>
			<th scope="col">A/S 안내내용</th>
			<th scope="col">A/S 전화번호</th>
			<th scope="col">대표 이미지 파일명</th>
			<th scope="col">추가 이미지 파일명</th>
			<th scope="col">상품 상세정보</th>
			<th scope="col">판매자 상품코드</th>
			<th scope="col">판매자 바코드</th>
			<th scope="col">제조사</th>
			<th scope="col">브랜드</th>
			<th scope="col">제조일자</th>
			<th scope="col">유효일자</th>
			<th scope="col">부가세</th>
			<th scope="col">미성년자 구매</th>
			<th scope="col">구매평 노출여부</th>
			<th scope="col">원산지 코드</th>
			<th scope="col">수입사</th>
			<th scope="col">복수원산지 여부</th>
			<th scope="col">원산지 직접입력</th>
			<th scope="col">배송방법</th>
			<th scope="col">배송비 유형</th>
			<th scope="col">기본배송비</th>
			<th scope="col">배송비 결제방식</th>
			<th scope="col">조건부무료-상품판매가합계</th>
			<th scope="col">수량별부과-수량</th>
			<th scope="col">반품배송비</th>
			<th scope="col">교환배송비</th>
			<th scope="col">지역별 차등배송비 정보</th>
			<th scope="col">별도설치비</th>
			<th scope="col">판매자 특이사항</th>
			<th scope="col">즉시할인 값</th>
			<th scope="col">즉시할인 단위</th>
			<th scope="col">복수구매할인 조건 값</th>
			<th scope="col">복수구매할인 조건 단위</th>
			<th scope="col">복수구매할인 값</th>
			<th scope="col">복수구매할인 단위</th>
			<th scope="col">상품구매시 포인트 지급 값</th>
			<th scope="col">상품구매시 포인트 지급 단위</th>
			<th scope="col">텍스트리뷰 작성시 지급 포인트</th>
			<th scope="col">포토/동영상 리뷰 작성시 지급 포인트</th>
			<th scope="col">"한달사용텍스트리뷰 작성시 지급 포인트"</th>
			<th scope="col">"한달사용포토/동영상리뷰 작성시 지급 포인트"</th>
			<th scope="col">"톡톡친구/스토어찜고객리뷰 작성시 지급 포인트"</th>
			<th scope="col">무이자 할부 개월</th>
			<th scope="col">사은품</th>
			<th scope="col">옵션형태</th>
			<th scope="col">옵션명</th>
			<th scope="col">옵션값</th>
			<th scope="col">옵션가</th>
			<th scope="col">옵션 재고수량</th>
			<th scope="col">추가상품명</th>
			<th scope="col">추가상품값</th>
			<th scope="col">추가상품가</th>
			<th scope="col">추가상품 재고수량</th>
			<th scope="col">상품정보제공고시 품명</th>
			<th scope="col">상품정보제공고시 모델명</th>
			<th scope="col">상품정보제공고시 인증허가사항</th>
			<th scope="col">상품정보제공고시 제조자</th>
			<th scope="col">스토어찜회원 전용여부</th>
			<th scope="col">문화비 소득공제</th>
			<th scope="col">ISBN</th>
			<th scope="col">독립출판</th>
		</tr>
	</thead>
	<tbody>
	<?
	$no=1;
foreach($rsc as $p){

						$imgCnt=0;
						$ectImg="";
						$viewImg="";
						$imgArray=json_decode($p->itemImage);
						$imgTotal=sizeof($imgArray);
						foreach($imgArray as $img){
							if(!strpos($img,".gif")){
								$ectImg.=$img.",";
								//$viewImg.="<img src='http://www.mallpro.kr/itemImage/".$img."' width='90%'>";
								$imgCnt++;
							}
						}
						$viewImg="상세설명생략";
						$ectImg=substr($ectImg,0,-1);
	?>
	<tr>
		<td>신상품</td>
		<td><?=$p->cateId?></td>
		<td><?=$p->itemName?></td>
		<td><?=$p->myPrice?></td>
		<td>100</td>
		<td>평일 오전10시~오후5시</td>
		<td>070-7777-8888</td>
		<td><?=$p->itemThumb?></td>
		<td><?=$ectImg?></td>
		<td><?=$viewImg?></td>
		<td></td>
		<td></td>
		<td></td>
		<td></td>
		<td></td>
		<td>과세상품</td>
		<td>Y</td>
		<td>Y</td>
		<td>0200037</td>
		<td>타오바오</td>
		<td>N</td>
		<td></td>
		<td></td>
		<td>택배</td>
		<td>조건부무료</td>
		<td>2500</td>
		<td>선결제</td>
		<td>30000</td>
		<td></td>
		<td>5000</td>
		<td>5000</td>
		<td>제주/도서산간은 1만원추가</td>
		<td>N</td>
		<td></td>
		<td></td>
		<td></td>
		<td></td>
		<td></td>
		<td></td>
		<td>1</td>
		<td>%</td>
		<td></td>
		<td></td>
		<td></td>
		<td></td>
		<td></td>
		<td></td>
		<td></td>
		<td></td>
		<td></td>
		<td></td>
		<td></td>
		<td></td>
		<td></td>
		<td></td>
		<td></td>
		<td></td>
		<td></td>
		<td></td>
		<td></td>
		<td></td>
		<td></td>
		<td>N</td>
		<td></td>
		<td></td>
		<td></td>

	</tr>
	<?
	$no++;
		}
?>

<?php
	if(!sizeof($rsc)){
?>
		<tr>
		<td colspan="4">데이타 없음</td>
	</tr>
<?}?>

	</tbody>

</table>
		

