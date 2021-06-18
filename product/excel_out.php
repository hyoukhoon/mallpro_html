<?php include $_SERVER["DOCUMENT_ROOT"]."/inc/dbcon.php";

$ud=$_GET['ud'];

header( "Content-type: application/vnd.ms-excel" );
header( "Content-type: application/vnd.ms-excel; charset=utf-8");
header( "Content-Disposition: attachment; filename = 미디어픽일괄등록.xls" );




	if($ud){
		$where.=" and reg_idx='$ud'";
	}

	if(!$order){
		$order=" order by up_date desc";
	}

	$que="select * 
	from ptest  where  1=1";
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
		<th width="50">No</th>
		<th width="120">등록일</th>
		<th width="200">선택폴더</th>
		<th width="150">엑셀파일명</th>
		<th width="300">매장명</th>
		<th width="200">매장아이디</th>
		<th width="300">상품명</th>
		<th width="100">성공여부</th>
		<th width="100">등록/수정</th>
		<th width="500">실패사유</th>
	</tr>
	</thead>
	<tbody>
	<?
	$no=1;
foreach($rsc as $p){

	?>
	<tr>
		<td><?=$no?></td>
		<td><?echo substr($p->up_date,0,10);?></td>
		<td><?echo substr($p->folder_name,0,6)." > ".$p->folder_name;?> </td>
		<td><?=$p->folder_name?>.xlxs</td>
		<td><?=$p->sname?></td>
		<td><?=$p->seller_id?></td>
		<td><?=$p->pname?></td>
		<td><?
							switch($p->gubun) {
								case 0:$gb="등록전";
								break;
								case 1:$gb="성공";
								break;
								default:$gb="<font color='red'>실패</font>";
							}
							echo $gb;
?></td>
		<td><?
							switch($p->utype) {
								case 0:$gb="등록";
								break;
								case 1:$gb="수정";
								break;
							}
							echo $gb;
?></td>
		<td><?
						switch($p->gubun) {
								case -4:$gb="이미지 등록 실패";
								break;
								case -2:$gb="FTP서버에 제품폴더는 있지만 이미지파일 없음";
								break;
								case -1:$gb="FTP서버에 제품 폴더가 없음";
								break;
								case 0:$gb="등록전";
								break;
								case 1:$gb="등록완료";
								break;
								case 2:$gb="해당 셀러가 없음";
								break;
								case 3:$gb="컬러없음";
								break;
								case 4:$gb="엑셀오류";
								break;
							}
							echo $gb;

							$reason=explode(",",substr($p->reason,0,-1));
							sort($reason);
							//print_r($reason);
							if($p->reason){
								echo " (";
							}
							$rr="";
							foreach($reason as $r){
								if($r){
									$rr.=reason_is($r).",";
								}
							}
							echo substr($rr,0,-1);
							if($p->reason){
								echo ")";
							}


?>
</td>

	
		</tr>
	<?
	$no++;
		}
?>
	</tbody>

</table>
		

