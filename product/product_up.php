<?php session_start();
include $_SERVER["DOCUMENT_ROOT"]."/inc/dbcon.php";

$PRODUCT_ID=$_GET['PRODUCT_ID'];

if(!$PRODUCT_ID){
	$que="select max(PRODUCT_ID) from product";
	$result = $mysqli->query($que) or die("1:".$mysqli->error);
	$rs = $result->fetch_array();
	$pi=$rs[0]+1;
	$c0=10-strlen($pi);
	for($k=0;$k<$c0;$k++){
		$cn.="0";
	}
	$PRODUCT_ID=$cn.$pi;
	$action="pu_ok.php";
}else{
	$que="select * from product where PRODUCT_ID='".$PRODUCT_ID."'";
	$result = $mysqli->query($que) or die("2:".$mysqli->error);
	$rs = $result->fetch_object();
	$SELLER_CODE=$rs->ADMIN;
	$SNAME=seller_name_is('ko',$SELLER_CODE);

	$que3="select SHOP_CODE from seller where SELLER_CODE='".$SELLER_CODE."'";
	$result3 = $mysqli->query($que3) or die("1:".$mysqli->error);
	$rs3 = $result3->fetch_array();
	$ADMIN=$rs3[0];

	$action="pe_ok.php";
}


$img_path="/media/SHOP/".$rs->sc."/".$seller_code."/COMMON/".$rs->PROFIL_IMG;
//$iPath="/media/SHOP/".$rs->sc."/".$seller_code."/COMMON/";
//$iPath="/image/product/";
?>
<!doctype html>
<html>
<head>
<meta charset="utf-8">
<title>Mediapic Back-office</title>
<link href="/admin_page/css/dcg_tmall.css" rel="stylesheet" type="text/css" />

<link rel="stylesheet" href="http://code.jquery.com/ui/1.8.18/themes/base/jquery-ui.css" type="text/css" />  
<script src="http://ajax.googleapis.com/ajax/libs/jquery/1.7.1/jquery.min.js"></script>  
<script src="http://code.jquery.com/ui/1.8.18/jquery-ui.min.js"></script>  
<script type="text/javascript" src="/asset/js/formplugin.js"></script>
<script type="text/javascript">


$(document).ready(function() {
	if($('#seller_code').val()==""){
			alert('매장을 먼저 선택하세요.');
			return;
		}

});

$(function(){
	
	$( "#start_date, #end_date" ).datepicker({
				showOn:"both"
				,buttonImage:"/admin_page/images/calendar_Ico.png"
				,buttonImageOnly:true
				,dateFormat:'yy-mm-dd'
			});


	$('#imgfile1').change(function() {

		if($('#seller_code').val()==""){
			alert('매장을 먼저 선택하세요.');
			return;
		}
		var scode=$('#seller_code').val();
		var adm=$('#admin').val();
		$('#scode').val(scode);
		$('#adm').val(adm);
		$('#imgFrm1').submit();
	});

	$('#imgFrm1').ajaxForm({
		success: function(rst) {
			var rsta = eval('[' + rst + ']');
					$.each(rsta, function(key, value){ 
						//alert('key:' + key + ' / ' + 'file_name:' + value.fnm + ' / insret_id:' + value.iid + ' / fo:' + value.fo + ' / iPath2:' + value.iPath2 + ' / ofn:' + value.ofn); 
						
						if(value.fnm=="not"){
								alert('이미지파일(JPG,PNG)만 등록할 수 있습니다.');
								return false;
						}

							var ins_data = "";
	
							var chk="";
							if(value.fo==1){
								chk="checked";
							}
							del_data="";
							ins_data = "<img style='max-width: 100%; object-fit: cover;object-position: top;' src='"+value.iPath2+value.fnm+"' width='100%'  />";
							var tr_data="<tr id='"+value.iid+"' onclick=imgView('"+value.iid+"','"+value.iPath2+value.fnm+"') class='sid' fi='"+value.iid+"' val='"+value.iPath2+value.fnm+"'><td style='text-align:center;'><input type='checkbox' name='num[]' id='chkId' value='"+value.iid+"'></td><td style='text-align:center;'  class='fio'>"+value.fo+"</td><td style='text-align:center;'><input type='radio' name='REP_FLAG' onclick='imgUp("+value.iid+")' value='"+value.iid+"' "+chk+"></td><td style='text-align:center;'>"+value.ofn+"</td></tr>";
							$("#img1").html(ins_data);
							$("#ta_img").append(tr_data);

			});

		}
	});


	$('#imgfile2').change(function() {
		if($('#seller_code').val()==""){
			alert('매장을 먼저 선택하세요.');
			return;
		}
		var scode=$('#seller_code').val();
		var adm=$('#admin').val();
		$('#scodev').val(scode);
		$('#admv').val(adm);

		$('#imgFrm2').submit();
	});

	$('#imgFrm2').ajaxForm({
		success: function(rst) {

			var data = eval('(' + rst + ')');
			var loop = data.length;
			var ins_data = "";
			if (data[0].fnm)
			{
				if(data[0].fnm=="no"){
					alert('동영상은 하나만 등록할 수 있습니다.');
				}else if(data[0].fnm=="not"){
					alert('동영상 파일확장자는 [mp4,mov] 만 가능합니다.');
				}else{
					del_data="";
					var tr_data="<tr id='v"+data[0].iid+"' class='sid2' fi='"+data[0].iid+"' val='<?=$iPath?>"+data[0].fnm+"'><td style='text-align:center;'><input type='checkbox' name='num[]' id='chkId2' value='"+data[0].iid+"'></td><td style='text-align:center;'  class='fio'>"+data[0].fo+"</td><td style='text-align:center;'><input type='radio' name='REP_FLAG2' checked value='"+data[0].iid+"'></td><td style='text-align:center;'>"+data[0].ofn+"</td></tr>";
					$("#vta_img").append(tr_data);
					
				}
			}
		}
	});

	$('#imgfile3').change(function() {
		if($('#seller_code').val()==""){
			alert('매장을 먼저 선택하세요.');
			return;
		}
		var scode=$('#seller_code').val();
		var adm=$('#admin').val();
		$('#scodei').val(scode);
		$('#admi').val(adm);
		$('#imgFrm3').submit();
	});

	$('#imgFrm3').ajaxForm({
		success: function(rst) {
			var data = eval('(' + rst + ')');
			var loop = data.length;
			var ins_data = "";
			if (data[0].fnm)
			{
				if(data[0].fnm=="no"){
					alert('스틸컷 이미지는 하나만 등록할 수 있습니다.');
				}else{
					del_data="";
					ins_data = "<img style='max-width: 100%; object-fit: cover;object-position: top;' src='"+data[0].iPath2+data[0].fnm+"?"+data[0].aa+"' width='100%'  />";
					var tr_data="<tr id='i"+data[0].iid+"'  class='sid3' fi='"+data[0].iid+"' val='"+data[0].iPath2+data[0].fnm+"'><td style='text-align:center;'><input type='checkbox' name='num[]' id='chkId3' value='"+data[0].iid+"'></td><td style='text-align:center;'  class='fio'>"+data[0].fo+"</td><td style='text-align:center;'><input type='radio' name='REP_FLAG3' value='"+data[0].iid+"' checked></td><td style='text-align:center;'>"+data[0].ofn+"</td></tr>";
					$("#img3").html(ins_data);
					$("#ta_img3").append(tr_data);
					
				}
			}
		}
	});

});

function shop_check(){
	if($('#seller_code').val()==""){
			alert('매장을 먼저 선택하세요.');
			return;
		}
}
</script>
<style>
.ui-datepicker-trigger { position:relative;top:7px ;left:0px ; }
 /* {} is the value according to your need */
 .back_color{background:#e9e9e9;}
</style>
</head>

<body class="bg_popup">

<!-- 전체 넓이 S-->
<div id="pop_wrap">
  <!-- 상단 head로고 S-->
  <div class="pop_top_bg">
    <ul>
     <li><span>상품등록</span></li>
    </ul>
  </div>
  <!-- 상단 head로고 E-->
<form name="imgFrm1" id="imgFrm1" method="post" enctype="multipart/form-data" action="img_upload.php">
<input type="file" multiple="multiple" name="imgfile1[]" id="imgfile1" style="position: fixed; left: -9999em;" />
<input type="hidden" name="iPath" value="<?=$iPath?>">
<input type="hidden" name="PRODUCT_ID" value="<?=$PRODUCT_ID?>">
<input type="hidden" name="SELLER_CODE" id="scode">
<input type="hidden" name="ADMIN" id="adm">
<input type="hidden" name="USE_FLAG" value="0"><!--0: 모바일 , 1:사이니지-->
<input type="submit" style="display:none;" />
</form>

<form name="imgFrm2" id="imgFrm2" method="post" enctype="multipart/form-data" action="vod_upload.php">
<input type="file" name="imgfile2" id="imgfile2" style="position: fixed; left: -9999em;" />
<input type="hidden" name="iPath" value="<?=$iPath?>">
<input type="hidden" name="PRODUCT_ID" value="<?=$PRODUCT_ID?>">
<input type="hidden" name="SELLER_CODE" id="scodev">
<input type="hidden" name="ADMIN" id="admv">
<input type="hidden" name="USE_FLAG" value="0">
<input type="submit" style="display:none;" />
</form>

<form name="imgFrm3" id="imgFrm3" method="post" enctype="multipart/form-data" action="vthumb_upload.php">
<input type="file" name="imgfile3" id="imgfile3" style="position: fixed; left: -9999em;" />
<input type="hidden" name="iPath" value="<?=$iPath?>">
<input type="hidden" name="PRODUCT_ID" value="<?=$PRODUCT_ID?>">
<input type="hidden" name="SELLER_CODE" id="scodei">
<input type="hidden" name="ADMIN" id="admi">
<input type="hidden" name="USE_FLAG" value="0"><!--0: 모바일 , 1:사이니지-->
<input type="submit" style="display:none;" />
</form>
  <!-- 컨텐츠 S -->
<div class="pop_content">
<form method="post" action="<?=$action?>" name="sf" enctype="multipart/form-data">
<input type="hidden" name="PRODUCT_ID" value="<?=$PRODUCT_ID?>">
<input type="hidden" name="ADMIN" id="admin" value="<?=$ADMIN?>">
<input type="hidden" name="SELLER_CODE" id="seller_code" value="<?=$SELLER_CODE?>">
  <!-- 타이틀 S--> 
     <ul class="top_title_area">
       <li class="top_title">기본정보등록</li>
     </ul>
  <!-- 타이틀 E--> 
  
  
  <!-- GRID S-->
              <div class="list_table_list01">
                <table width="100%" border="0" >
                  <colgroup>
                  <col width=100/>
				  <col width=100/>
                  <col width="300"/>
                  <col width=100/>
                  <col width="300"/>
				  <col width=100/>
                  <col width="*"/>
                  </colgroup>
                 
                  <tbody>
                    <tr>
                      <th class="color_ch" scope="row" colspan="2"><font color="red">*</font>매장명</th>
					<td><button type="button" class="button03_4" id="add1" <?if($rs->PRODUCT_ID){?>onclick="alert('매장은 변경할 수 없습니다.')"<?}else{?>onclick="window.open('shop_search.php','sh1','width=500,height=600,scrollbars=yes')"<?}?>>매장검색</button><input type="text" name="SNAME" id="sname" readonly value="<?=$SNAME?>"></td>
					  <th class="color_ch" scope="row">상품코드</th>
                      <td><input type="text" name="PRODUCT_CODE"  readonly size="12" placeholder="상품코드(Key)" value="<?=$rs->PRODUCT_CODE?>">&nbsp;<input type="text" name="DISPLAY_CODE" readonly size="12" value="<?=$rs->DISPLAY_CODE?>" placeholder="Display용코드"></td>
                      <th class="color_ch"  scope="row" rowspan="3">QR코드</th>
                      <td rowspan="3">
					  <?if($PRODUCT_ID){?>
					  <img src="http://www.mediapic.net/qrcode/php/qr_img.php?d=http://www.mediapic.net/html/Myshop_Product.php?PRODUCT_ID=<?=$PRODUCT_ID?>&e=M&s=3" alt="QR code" width="70"><?}?></td>
                    </tr>
                     <tr>
                      <th class="color_ch" scope="row" rowspan="2"><font color="red">*</font>상품명</th>
					  <th class="color_ch" scope="row">한국어</th>
                      <td colspan="3">
						<input type="text" name="PRODUCT_NAME" onkeydown="shop_check();" size="60" value="<?=$rs->PRODUCT_NAME?>">
					  </td>
                    </tr>
					<tr>
					  <th class="color_ch" scope="row">중국어</th>
                      <td colspan="3">
						<input type="text" name="PRODUCT_NAME_CH" onkeydown="shop_check();" size="60" value="<?=$rs->PRODUCT_NAME_CH?>">
					  </td>
                    </tr>

					<tr>
                      <th class="color_ch" scope="row" rowspan="2"><font color="red">*</font>상품설명</th>
					  <th class="color_ch" scope="row">한국어</th>
                      <td colspan="5">
						<textarea name="SHORTINFO" cols="90" rows="3" onkeydown="shop_check();"><?echo stripslashes($rs->SHORTINFO);?></textarea>
					  </td>
                    </tr>
					<tr>
					  <th class="color_ch" scope="row">중국어</th>
                      <td colspan="5">
						<textarea name="SHORTINFO_CH" cols="90" rows="3" onkeydown="shop_check();"><?echo stripslashes($rs->SHORTINFO_CH);?></textarea>
					  </td>
                    </tr>

					<tr>
                      <th class="color_ch" scope="row" rowspan="2">프로모션태그</th>
					  <th class="color_ch" scope="row">사용여부</th>
                      <td>
							<input type="radio" name="PROMOTION_YN" value="N" <?if($rs->PROMOTION_YN!="Y"){?>checked<?}?>>사용안함 
							<input type="radio" name="PROMOTION_YN" value="Y" <?if($rs->PROMOTION_YN=="Y"){?>checked<?}?>>사용함
					  </td>
					  <th class="color_ch" scope="row">색상</th>
                      <td colspan="3">
							<select name="PROMOTION_COLOR">
								<option value="">선택</option>
								<option value="#080E6E" <?if($rs->PROMOTION_COLOR=="#080E6E"){?>selected<?}?>>네이비(#080E6E)</option>
								<option value="#C40000" <?if($rs->PROMOTION_COLOR=="#C40000"){?>selected<?}?>>레드(#C40000)</option>
								<option value="#7B4311" <?if($rs->PROMOTION_COLOR=="#7B4311"){?>selected<?}?>>브라운(#7B4311)</option>
								<option value="#E49300" <?if($rs->PROMOTION_COLOR=="#E49300"){?>selected<?}?>>골드(#E49300)</option>
								<option value="#FF21BC" <?if($rs->PROMOTION_COLOR=="#FF21BC"){?>selected<?}?>>핑크(#FF21BC)</option>
								<option value="#A601A4" <?if($rs->PROMOTION_COLOR=="#A601A4"){?>selected<?}?>>바이올렛(#A601A4)</option>
								<option value="#0E59D3" <?if($rs->PROMOTION_COLOR=="#0E59D3"){?>selected<?}?>>블루(#0E59D3)</option>
								<option value="#00A86F" <?if($rs->PROMOTION_COLOR=="#00A86F"){?>selected<?}?>>그린(#00A86F)</option>
							</select>
					  </td>
                    </tr>
					<tr>
					  <th class="color_ch" scope="row">문구</th>
                      <td colspan="5">
						<textarea name="PROMOTION_CONTENTS" cols="20" rows="3"><?echo stripslashes($rs->PROMOTION_CONTENTS);?></textarea>
					  </td>
                    </tr>
					<tr>
					  <th class="color_ch" scope="row" colspan="2"><font color="red">*</font>모바일서비스용<br>이미지등록</th>
                      <td colspan="3" style="vertical-align:top;">
							<table border=0 width="100%">
								<tr>
									<td>
										<button type="button" class="button03_4" style="width:30px;" onclick="moveUpDown('u');">▲</button>
										<button type="button" class="button03_4" style="width:30px;" onclick="moveUpDown('d');">▼</button>
									</td>
									<td style="text-align:right;">
										<label for="imgfile1" class="changeImg" style="float:left;" >이미지추가</label>
										<button type="button" class="button03_5" onclick="delForm();">이미지삭제</button>
									</td>
								</tr>
							</table>

								<table width="100%" border="0" id="ta_img" class="imgTable" style="table-layout:fixed; word-break:break-all;">
								  <colgroup>
								  <col width=50/>
								  <col width=50/>
								  <col width=50/>
								  <col width="*"/>
								  </colgroup>
								 
								  <tbody>
									<tr>
									  <th class="color_ch" scope="row" style="text-align:center;"><input type="checkbox" id="checkAll"></th>
									  <th class="color_ch" scope="row" style="text-align:center;">순번</th>
									  <th class="color_ch" scope="row" style="text-align:center;">대표</th>
									  <th class="color_ch" scope="row" style="text-align:center;">이미지파일</th>
									</tr>

				<?

					$where=" and PRODUCT_ID='".$PRODUCT_ID."'";
					$order=" order by FILE_ORDER asc";
					$que="select * 
					from product_file_info  where USE_FLAG='0' and DEL_FLAG='0' and IMGVOD_FLAG='0'";
					$que.=$where;
					$que.=$order;
					$que.=$limit_query;
					//echo $que;
					$result2 = $mysqli->query($que) or die("3:".$mysqli->error);
					while($rs2 = $result2->fetch_object()){
							$rsc[]=$rs2;
					}

				$no=1;
				foreach($rsc as $p){

				?>
									<tr id="<?echo $p->FILE_ID;?>" class="sid"  fi="<?=$p->FILE_ID?>" val="<?echo $p->FILEPATH.$p->FILENM_SYS;?>">
									  <td style="text-align:center;"><input type="checkbox" name="num[]" id="chkId" value="<?=$p->FILE_ID?>"></td>
									  <td style="text-align:center;" class="fio"><?echo $p->FILE_ORDER;?></td>
									  <td style="text-align:center;"><input type="radio" name="REP_FLAG" class='RP' value="<?=$p->FILE_ID?>" <?if($p->REP_FLAG==1){?> checked<?}?>></td>
									  <td style="text-align:center;" class="ppname"><?echo $p->FILENM_ORG;?></td>
									</tr>
				<?
				$no++;
				}
				
				?>

								  </tbody>
								</table>

						</td>
						<td colspan="2" valign="top">
								<table width="100%" border="0" >
								  <tbody>
									<tr height="300">
									  <td style="text-align:center;" id="img"><span id="img1"></span></td>
									</tr>
								  </tbody>
								</table>
					  </td>
                    </tr>

					<tr>
					  <th class="color_ch" scope="row" colspan="2">모바일서비스용<br>동영상등록</th>
                      <td colspan="3" style="vertical-align:top;">
							<table border=0 width="100%">
								<tr>
									<td style="text-align:right;">
										<label for="imgfile2" class="changeImg" style="float:left;" >동영상추가</label>
										<button type="button" class="button03_5" onclick="vdelForm();">동영상삭제</button>
									</td>
								</tr>
							</table>


								<table width="100%" border="0" id="vta_img">
								  <colgroup>
								  <col width=50/>
								  <col width=50/>
								  <col width=50/>
								  <col width="*"/>
								  </colgroup>
								 
								  <tbody>
									<tr>
									  <th class="color_ch" scope="row" style="text-align:center;"></th>
									  <th class="color_ch" scope="row" style="text-align:center;">순번</th>
									  <th class="color_ch" scope="row" style="text-align:center;">대표</th>
									  <th class="color_ch" scope="row" style="text-align:center;">동영상파일</th>
									</tr>

				<?

					$where=" and PRODUCT_ID='".$PRODUCT_ID."'";
					$order=" order by FILE_ORDER asc";
					$que="select * 
					from product_file_info  where USE_FLAG='0' and DEL_FLAG='0' and IMGVOD_FLAG='1'";
					$que.=$where;
					$que.=$order;
					$que.=$limit_query;
				//	echo $que;
					$result = $mysqli->query($que) or die("3:".$mysqli->error);
					while($rsv = $result->fetch_object()){
							$rscv[]=$rsv;
					}

				$no=1;
				foreach($rscv as $v){

				?>
									<tr id="v<?echo $v->FILE_ID;?>" class="sid2"  fi="<?=$v->FILE_ID?>" val="<?echo $v->FILEPATH.$v->FILENM_SYS;?>">
									  <td style="text-align:center;"><input type="checkbox" name="num[]" id="chkId2" value="<?=$v->FILE_ID?>"></td>
									  <td style="text-align:center;"><?echo $v->FILE_ORDER;?></td>
									  <td style="text-align:center;"><input type="radio" name="REP_FLAG2" value="<?=$v->FILE_ID?>"  <?if($v->REP_FLAG==1){?> checked<?}?>></td>
									  <td style="text-align:center;"><a href="/<?echo $v->FILEPATH.$v->FILENM_SYS;?>"><?echo $v->FILENM_ORG;?></a></td>
									</tr>
				<?
				$no++;
				}
				
				?>

								  </tbody>
								</table>

						</td>
						<td colspan="2" valign="top">

					  </td>
                    </tr>
					<tr>
					  <th class="color_ch" scope="row" colspan="2">모바일서비스용<br>스틸컷등록</th>
                      <td colspan="3" style="vertical-align:top;">
							<table border=0 width="100%">
								<tr>
									<td style="text-align:right;">
										<label for="imgfile3" class="changeImg" style="float:left;" >스틸컷추가</label>
										<button type="button" class="button03_5" onclick="thumbdelForm();">스틸컷삭제</button>
									</td>
								</tr>
							</table>


								<table width="100%" border="0" id="ta_img3">
								  <colgroup>
								  <col width=50/>
								  <col width=50/>
								  <col width=50/>
								  <col width="*"/>
								  </colgroup>
								 
								  <tbody>
									<tr>
									  <th class="color_ch" scope="row" style="text-align:center;"></th>
									  <th class="color_ch" scope="row" style="text-align:center;">순번</th>
									  <th class="color_ch" scope="row" style="text-align:center;">대표</th>
									  <th class="color_ch" scope="row" style="text-align:center;">스틸컷파일</th>
									</tr>

				<?

					$where=" and PRODUCT_ID='".$PRODUCT_ID."'";
					$order=" order by FILE_ORDER asc";
					$que="select * 
					from product_file_info  where USE_FLAG='0' and DEL_FLAG='0' and IMGVOD_FLAG='2'";
					$que.=$where;
					$que.=$order;
					$que.=$limit_query;
				//	echo $que;
					$result = $mysqli->query($que) or die("3:".$mysqli->error);
					while($rsi = $result->fetch_object()){
							$rsci[]=$rsi;
					}

				$no=1;
				foreach($rsci as $vt){

				?>
									<tr id="i<?echo $vt->FILE_ID;?>" class="sid3"  fi="<?=$vt->FILE_ID?>" val="<?echo $vt->FILEPATH.$vt->FILENM_SYS;?>">
									  <td style="text-align:center;"><input type="checkbox" name="num[]" id="chkId3" value="<?=$vt->FILE_ID?>"></td>
									  <td style="text-align:center;"><?echo $vt->FILE_ORDER;?></td>
									  <td style="text-align:center;"><input type="radio" name="REP_FLAG3" value="<?=$vt->FILE_ID?>" checked></td>
									  <td style="text-align:center;"><?echo $vt->FILENM_ORG;?></td>
									</tr>
				<?
				$no++;
				}
				
				?>

								  </tbody>
								</table>

						</td>
						<td colspan="2" valign="top">
								<table width="100%" border="0" >
								  <tbody>
									<tr height="300">
									  <td style="text-align:center;" id="img"><span id="img3"></span></td>
									</tr>
								  </tbody>
								</table>
					  </td>
                    </tr>

                  </tbody>
                </table>
              </div>
      <!-- GRID E-->

  <!-- 타이틀 S--> 
     <ul class="top_title_area">
       <li class="top_title">상품분류선택</li>
     </ul>
  <!-- 타이틀 E--> 

	  <!-- GRID S-->
              <div class="list_table_list01">
                <table width="100%" border="0" >
                  <colgroup>
                  <col width=200/>
                  <col width="*"/>
                  </colgroup>
                 
                  <tbody>
                    <tr>
					  <th class="color_ch" scope="row"><font color="red">*</font>상품분류</th>
                      <td colspan="3" style="vertical-align:top;">
							<table border=0 width="100%">
								<tr>
									<td style="text-align:right;">
										<button type="button" class="button03_5" onclick="addCate();">추가</button>
										<button type="button" class="button03_5" onclick="delCate();">삭제</button>
									</td>
								</tr>
							</table>

								<table width="100%" border="0" id="cate_table">
								  <colgroup>
								  <col width=50%/>
								  <col width=50%/>
								  </colgroup>
								 
								  <tbody>
									<tr>
									  <th class="color_ch" scope="row" style="text-align:center;">대분류</th>
									  <th class="color_ch" scope="row" style="text-align:center;">소분류</th>
									</tr>

				<?

					$where=" and PRODUCT_ID='".$PRODUCT_ID."'";
					$order=" order by CATEGORY_RELATION_SEQ asc";
					$que="select * 
					from category_relation  where DISP='1'";
					$que.=$where;
					$que.=$order;
					$que.=$limit_query;
					//echo $que;
					$result = $mysqli->query($que) or die("3:".$mysqli->error);
					while($cs = $result->fetch_object()){
							$csi[]=$cs;
					}

				$no=1;
				foreach($csi as $ci){


				?>
									<tr class="csic">
									  <td>
									  <select name="cate1[]" class="big_cate">
										<?
										$CID=substr($ci->CATEGORY_ID,0,3);
										$CID2=substr($ci->CATEGORY_ID,0,6);
										$que1="select * 
										from category_info  where CATEGORY_USE='1' and DEPTH='0' order by LEVEL1 asc";
										$result1 = $mysqli->query($que1) or die("2:".$mysqli->error);
										while($rs1 = $result1->fetch_object()){
				?>
										<option value="<?=$rs1->CATEGORY_ID?>" <?if($CID==substr($rs1->CATEGORY_ID,0,3)){?>selected<?}?>><?=$rs1->CATEGORY_NAME?></option>
										<?}?>
									  </select>
									  </td>
									  <td>
										<select name="cate2[]" class="small_cate"><option value="">소분류</option>
										<?
										$que1="select * 
										from category_info  where CATEGORY_USE='1' and DEPTH='1' and left(CATEGORY_ID,3)='".$CID."' order by LEVEL2 asc";
										$result1 = $mysqli->query($que1) or die("2:".$mysqli->error);
										while($rs1 = $result1->fetch_object()){
				?>
										<option value="<?=$rs1->CATEGORY_ID?>" <?if($CID2==substr($rs1->CATEGORY_ID,0,6)){?>selected<?}?>><?=$rs1->CATEGORY_NAME?></option>
										<?}?>
										</select>
									  </td>
									</tr>
				<?
				$no++;
				}
				
				?>
									
								  </tbody>
								</table>
						</td>
						<td colspan="2" valign="top">

					  </td>
                    </tr>

                  </tbody>
                </table>
              </div>
      <!-- GRID E-->

  <!-- 타이틀 S--> 
     <ul class="top_title_area">
       <li class="top_title">소재정보등록</li>
     </ul>
  <!-- 타이틀 E--> 

	  <!-- GRID S-->
              <div class="list_table_list01">
                <table width="100%" border="0" >
                  <colgroup>
                  <col width=200/>
                  <col width="*"/>
                  </colgroup>
                 
                  <tbody>
                    <tr>
					  <th class="color_ch" scope="row"><font color="red">*</font>상품소재</th>
                      <td colspan="3" style="vertical-align:top;">
							<table border=0 width="100%">
								<tr>
									<td style="text-align:right;">
										<button type="button" class="button03_5" onclick="addMate();">추가</button>
										<button type="button" class="button03_5" onclick="delMate();">삭제</button>
									</td>
								</tr>
							</table>

								<table width="100%" border="0" id="mate_table">
								  <colgroup>
								  <col width=50%/>
								  <col width=50%/>
								  </colgroup>
								 
								  <tbody>
									<tr>
									  <th class="color_ch" scope="row" style="text-align:center;">소재</th>
									  <th class="color_ch" scope="row" style="text-align:center;">함유량(%)</th>
									</tr>

									<?

					$order=" order by MATR_NAME asc";
					$que="select * 
					from material_code";
					$que.=$order;
					$que.=$limit_query;
///					echo $que;
					$result = $mysqli->query($que) or die("3:".$mysqli->error);
					while($ms = $result->fetch_object()){
							$msi[]=$ms;
					}


								$where=" and PRODUCT_ID='".$PRODUCT_ID."'";
								$que="select * 
								from product_material_info where 1=1 ";
								$que.=$where;
								//echo $que;
								$result = $mysqli->query($que) or die("3:".$mysqli->error);
								while($mcs = $result->fetch_object()){
										$mcsi[]=$mcs;
								}

							$no=1;
							foreach($mcsi as $mci){
				?>
									<tr class="csic">
									  <td>
									  <select name="mate[]" class="mate_css">
									<?foreach($msi as $mi){?>
										<option value='<?=$mi->MATR_CODE?>' <?if($mi->MATR_CODE==$mci->MATR_CODE){?>selected<?}?>><?=$mi->MATR_NAME?></option>
									<?}?>
									  </select>
									  </td>
									  <td>
											<input type='text' name='pt[]' value="<?=$mci->PERCENTAGE?>">
									  </td>
									</tr>
					<?}?>

								  </tbody>
								</table>
						</td>
						<td colspan="2" valign="top">

					  </td>
                    </tr>
					<tr>
					  <th class="color_ch" scope="row">상품컬러</th>
                      <td colspan="3" style="vertical-align:top;">
							<table border=0 width="100%">
								<tr>
									<td style="text-align:right;">
										<button type="button" class="button03_5" onclick="addColor();">추가</button>
										<button type="button" class="button03_5" onclick="delColor();">삭제</button>
									</td>
								</tr>
							</table>

								<table width="100%" border="0" id="color_table">
								  <colgroup>
								  <col width=50%/>
								  <col width=50%/>
								  </colgroup>

								  <tbody>
									<tr>
									  <th class="color_ch" scope="row" style="text-align:center;">컬러(한국어)</th>
									  <th class="color_ch" scope="row" style="text-align:center;">컬러(중국어)</th>
									</tr>
<?
								$where=" and PRODUCT_ID='".$PRODUCT_ID."'";
								$order=" order by COLOR_ID asc";
								$que="select * 
								from product_color where 1=1 ";
								$que.=$where;
								$que.=$order;
								$que.=$limit_query;
								//echo $que;
								$result = $mysqli->query($que) or die("3:".$mysqli->error);
								while($ccs = $result->fetch_object()){
										$ccsi[]=$ccs;
								}

							$no=1;
							foreach($ccsi as $cci){
				?>
									<tr>
										<td><input type='text' name='COLOR[]' value="<?=$cci->COLOR?>"></td>
										<td><input type='text' name='COLOR_CH[]' value="<?=$cci->COLOR_CH?>"></td>
									</tr>
<?}?>
								  </tbody>
								</table>
						</td>
						<td colspan="2" valign="top">

					  </td>
                    </tr>

                  </tbody>
                </table>
              </div>
      <!-- GRID E-->
  <!-- 타이틀 S--> 
     <ul class="top_title_area">
       <li class="top_title">판매정보등록</li>
     </ul>
  <!-- 타이틀 E--> 
<?
$que3="select CNY from common_exchange_rate where IS_USE='0' order by ER_SEQ desc limit 1";
$result3 = $mysqli->query($que3) or die("1:".$mysqli->error);
$rs3 = $result3->fetch_array();
$CNY=$rs3[0];
$WHOLESALE_PRICE_CH=round(($rs->WHOLESALE_PRICE/$CNY),2);
?>
  <!-- GRID S-->
              <div class="list_table_list01">
                <table width="100%" border="0" >
                  <colgroup>
                  <col width=100/>
				  <col width=100/>
                  <col width="300"/>
                  <col width=100/>
                  <col width="300"/>
				  <col width=100/>
                  <col width="*"/>
                  </colgroup>
                 
                  <tbody>
                     <tr>
                      <th class="color_ch" scope="row" rowspan="2">도매가</th>
					  <th class="color_ch" scope="row">한국</th>
                      <td colspan="3">
						<input type="text" name="WHOLESALE_PRICE" size="20" id="wp" onkeyup="cal_cny();" onBlur="cal_cny();" value="<?=$rs->WHOLESALE_PRICE?>"> KRW &nbsp; 
						<input type="radio" name="DISP" value="0" <?if(!$rs->DISP){?>checked<?}?>>노출 <input type="radio" name="DISP" value="1" <?if($rs->DISP){?>checked<?}?>>비노출 
						</td>
                    </tr>
					<tr>
					  <th class="color_ch" scope="row">중국</th>
                      <td colspan="3">
						<input type="text" name="WHOLESALE_PRICE_CH" id="ccal" size="20" value="<?=$WHOLESALE_PRICE_CH?>"> CNY &nbsp; 환율 1 CNY = <?echo $CNY;?>KRW
					  </td>
                    </tr>

                  </tbody>
                </table>
              </div>
      <!-- GRID E-->

  <!-- 타이틀 S--> 
     <ul class="top_title_area">
       <li class="top_title">상품진열</li>
     </ul>
  <!-- 타이틀 E--> 
<script>



function getToday(){
				var today = new Date();

				// Display the month, day, and year. getMonth() returns a 0-based number.
				var month = today.getMonth()+1;
				var day = today.getDate();
				var year = today.getFullYear();
				 if (day<10)  day = '0'+day;
				 if (month<10)  month = '0'+month;
				return year + '-' + month + '-' + day ;
			}

function getWeekDay(){
			  var today = new Date();
			  var yesterday = new Date(today.valueOf() + (7*24*60*60*1000));
			  var year = yesterday.getFullYear();
			  var month = yesterday.getMonth() + 1;
			  var day = yesterday.getDate();
			  if (day<10)  day = '0'+day;
			  if (month<10)  month = '0'+month;
			  return year + '-' + month + '-' + day ;
			}

function gettwoWeekDay(){
			  var today = new Date();
			  var yesterday = new Date(today.valueOf() + (14*24*60*60*1000));
			  var year = yesterday.getFullYear();
			  var month = yesterday.getMonth() + 1;
			  var day = yesterday.getDate();
			  if (day<10)  day = '0'+day;
			  if (month<10)  month = '0'+month;
			  return year + '-' + month + '-' + day ;
			}

function getthreeWeekDay(){
			  var today = new Date();
			  var yesterday = new Date(today.valueOf() + (21*24*60*60*1000));
			  var year = yesterday.getFullYear();
			  var month = yesterday.getMonth() + 1;
			  var day = yesterday.getDate();
			  if (day<10)  day = '0'+day;
			  if (month<10)  month = '0'+month;
			  return year + '-' + month + '-' + day ;
			}

function getfourWeekDay(){
			  var today = new Date();
			  var yesterday = new Date(today.valueOf() + (28*24*60*60*1000));
			  var year = yesterday.getFullYear();
			  var month = yesterday.getMonth() + 1;
			  var day = yesterday.getDate();
			  if (day<10)  day = '0'+day;
			  if (month<10)  month = '0'+month;
			  return year + '-' + month + '-' + day ;
			}




function getweek(n){
	var sd=getToday();
	if(n==1){
		var ed = getWeekDay();
	}else if(n==2){
		var ed = gettwoWeekDay();
	}else if(n==3){
		var ed = getthreeWeekDay();
	}else if(n==4){
		var ed = getfourWeekDay();
	}else if(n==5){
		var ed = "9999-12-31";
	}



		$('#start_date').val(sd);
		$('#end_date').val(ed);
}
</script>
	  <!-- GRID S-->
              <div class="list_table_list01">
                <table width="100%" border="0" >
                  <colgroup>
                  <col width=200/>
                  <col width="*"/>
                  </colgroup>
                 
                  <tbody>
                    <tr>
					  <th class="color_ch" scope="row"><font color="red">*</font>상품진열기간</th>
                      <td style="vertical-align:top;">
							<input type="text" id="start_date"  class="input_form01"  style="width:160px;" name="DISPLAY_START_DATE" value="<?=$rs->DISPLAY_START_DATE?>">  ~ <input type="text" id="end_date" class="input_form01"  style="width:160px;" name="DISPLAY_END_DATE" value="<?=$rs->DISPLAY_END_DATE?>">
							<button type="button" class="button03_5" onclick="getweek(1);">1주</button>
							<button type="button" class="button03_5" onclick="getweek(2);">2주</button>
							<button type="button" class="button03_5" onclick="getweek(3);">3주</button>
							<button type="button" class="button03_5" onclick="getweek(4);">4주</button>
							<button type="button" class="button03_5" onclick="getweek(5);">무제한</button>
					  </td>
                    </tr>
					<tr>
					  <th class="color_ch" scope="row"><font color="red">*</font>상품진열여부</th>
                      <td style="vertical-align:top;">
						<input type="radio" name="DISPLAY_YN" value="Y" <?if($rs->DISPLAY_YN=="Y"){?>checked<?}?>>진열함
						<input type="radio" name="DISPLAY_YN" value="N"  <?if($rs->DISPLAY_YN!="Y"){?>checked<?}?>>진열안함
					  </td>
                    </tr>

                  </tbody>
                </table>
              </div>
      <!-- GRID E-->

<input type="hidden" name="cny" id="cny_val" value="<?=$CNY?>">
   <!-- 하단 버튼 S-->
</form>
   <div class="bottom_bu_area mt5">
	<ul>
		<li><a href="javascript:;" class="button03" onclick="return sendform();">저장</a></li>
		<li><a href="javascript:reset();" class="button03_1" onclick="window.close();">취소</a></li>
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
function sendform(){
	a=document.sf;

	if(!a.SNAME.value){
		alert('매장검색으로 매장을 선택하세요');
		a.SNAME.focus();
		return false;
	}

	if(!a.PRODUCT_NAME.value){
		alert('상품명(한국어)을 입력하세요');
		a.PRODUCT_NAME.focus();
		return false;
	}

	if(!a.PRODUCT_NAME_CH.value){
		alert('상품명(중국어)을 입력하세요');
		a.PRODUCT_NAME_CH.focus();
		return false;
	}

	if(!a.SHORTINFO.value){
		alert('상품 설명(한국어)을 입력하세요');
		a.SHORTINFO.focus();
		return false;
	}

	if(!a.SHORTINFO_CH.value){
		alert('상품 설명(중국어)을 입력하세요');
		a.SHORTINFO_CH.focus();
		return false;
	}

	var isimg=$(".sid").attr('val');
	if(!isimg){
		alert('모바일서비스용 이미지를 등록하세요');
		return false;
	}

	var cate1=$(".big_cate").val();
	if(!cate1){
		alert('상품 분류를 선택하세요.');
		return false;
	}

	$(".big_cate").each(function(e){
		var selval=$(this).val();
		if(!selval){
			alert('상품 분류를 선택하세요.');
			e.stopPropagation();
			e.preventDefault();
		}
	});


	var mate1=$(".mate_css").val();
	if(!mate1){
		alert('상품 소재를 선택하세요.');
		return false;
	}

	if(!a.start_date.value){
		alert('상품진열기간을 입력하세요');
		a.start_date.focus();
		return false;
	}

	if(!a.end_date.value){
		alert('상품진열기간을 입력하세요');
		a.end_date.focus();
		return false;
	}


			a.submit();

	return true;
}

function moveUpDown(ud){

	a=document.df;

	 var total_cnt=0;
	   $('input:checkbox[id="chkId"]').each(function() {
		  if(this.checked){//checked 처리된 항목의 값
		  //alert(this.value);
		  fid=this.value;//배열로 저장
		  total_cnt++;
		  }
		});

	   if(total_cnt==0){
		 alert('이미지를 선택하세요.');
		 return;
	   }else if(total_cnt>1){
		 alert('하나만 선택하세요.');
		 return;
	   }

	   var params = "FILE_ID="+fid+"&ud="+ud;

		$.ajax({
			  type: 'get'
			, url: 'move_down.php'
			,data : params
			, dataType : 'html'
			, success: function(data) {

				if(data=="stop"){

					alert('최상위 순번입니다.');
					return;

				}else{

				var arr=decodeURIComponent(data);
				var obj=JSON.parse(arr);

					var element = $("#"+obj[0]).closest('tr');
					if(ud=='d'){
						$("#"+obj[0]+" .fio").text(obj[1]);
						$("#"+obj[2]+" .fio").text(obj[3]);
						element.insertAfter(element.next());
					}else if(ud=='u'){
						$("#"+obj[0]+" .fio").text(obj[1]);
						$("#"+obj[2]+" .fio").text(obj[3]);
						if(element.prev().html() != null){
							element.insertBefore(element.prev());
						}
					}

				}
			  }
		});	

}



	function delForm(){
		a=document.df;

		var total_cnt=0;
		var nototal_cnt=0;
		var imgArray=new Array();
		var noimgArray=new Array();
	$('input:checkbox[id="chkId"]').each(function() {
		if(this.checked){//checked 처리된 항목의 값
			//alert(this.value);
			imgArray[total_cnt]=this.value;//배열로 저장
			total_cnt++;
		}else{
			noimgArray[nototal_cnt]=this.value;//배열로 저장
			nototal_cnt++;
		}
			
		});

	   if(total_cnt==0){
		 alert('삭제할 이미지를 선택하세요.');
		 return;
	   }else{
			var jsonimg = JSON.stringify(imgArray);//json으로 바꿈
			var nojsonimg = JSON.stringify(noimgArray);//json으로 바꿈
	   }

		var params = "FILE_ID="+encodeURI(jsonimg);

		$.ajax({
			  type: 'get'
			, url: 'del_img.php'
			,data : params
			, dataType : 'html'
			, success: function(data) {

				var arr=decodeURI(data);
				var obj=JSON.parse(arr);
				var obj2=JSON.parse(nojsonimg);
				
				for(var i=0;i<obj.length;i++){
					$("#"+obj[i]).html("");
				}
				
				for(var ii=0;ii<obj2.length;ii++){
					var kk=parseInt(ii)+1;
					$("#"+obj2[ii]+" .fio").text(kk);
				}

				$('input:radio[name=REP_FLAG]').eq(0).attr("checked", true);

			  }
		});	
}


	function vdelForm(){
		a=document.vf;

		var total_cnt=0;
		var nototal_cnt=0;
		var imgArray=new Array();
		var noimgArray=new Array();
	$('input:checkbox[id="chkId2"]').each(function() {
		if(this.checked){//checked 처리된 항목의 값
			//alert(this.value);
			imgArray[total_cnt]=this.value;//배열로 저장
			total_cnt++;
		}else{
			noimgArray[nototal_cnt]=this.value;//배열로 저장
			nototal_cnt++;
		}
			
		});

	   if(total_cnt==0){
		 alert('삭제할 동영상을 선택하세요.');
		 return;
	   }else{
			var jsonimg = JSON.stringify(imgArray);//json으로 바꿈
			var nojsonimg = JSON.stringify(noimgArray);//json으로 바꿈
	   }

		var params = "FILE_ID="+encodeURI(jsonimg);

		$.ajax({
			  type: 'get'
			, url: 'vdel_img.php'
			,data : params
			, dataType : 'html'
			, success: function(data) {

				var arr=decodeURI(data);
				var obj=JSON.parse(arr);
				var obj2=JSON.parse(nojsonimg);
				
				for(var i=0;i<obj.length;i++){
					$("#v"+obj[i]).html("");
				}

			  }
		});	
}


function thumbdelForm(){
		a=document.if;

		var total_cnt=0;
		var nototal_cnt=0;
		var imgArray=new Array();
		var noimgArray=new Array();
	$('input:checkbox[id="chkId3"]').each(function() {
		if(this.checked){//checked 처리된 항목의 값
			//alert(this.value);
			imgArray[total_cnt]=this.value;//배열로 저장
			total_cnt++;
		}else{
			noimgArray[nototal_cnt]=this.value;//배열로 저장
			nototal_cnt++;
		}
			
		});

	   if(total_cnt==0){
		 alert('삭제할 스틸컷을 선택하세요.');
		 return;
	   }else{
			var jsonimg = JSON.stringify(imgArray);//json으로 바꿈
			var nojsonimg = JSON.stringify(noimgArray);//json으로 바꿈
	   }

		var params = "FILE_ID="+encodeURI(jsonimg);

		$.ajax({
			  type: 'get'
			, url: 'thumbdel_img.php'
			,data : params
			, dataType : 'html'
			, success: function(data) {

				var arr=decodeURI(data);
				var obj=JSON.parse(arr);
				var obj2=JSON.parse(nojsonimg);
				
				for(var i=0;i<obj.length;i++){
					$("#i"+obj[i]).html("");
				}

			  }
		});	
}
</script>
<script>

	$('.RP').on('click', function() {

		var val = $(this).attr('value');
		var params = "FILE_ID="+val;
		$.ajax({
			  type: 'get'
			, url: 'img_up.php'
			,data : params
			, dataType : 'html'
			, success: function(data) {
					alert(data);
			  }
		});	

	});

	function imgUp(val){

		var params = "FILE_ID="+val;
		$.ajax({
			  type: 'get'
			, url: 'img_up.php'
			,data : params
			, dataType : 'html'
			, success: function(data) {
					alert(data);
			  }
		});	

	}

	$(document).ready(function(){
		  $("#checkAll").on("click",function(){
		   var _value = $(this).is(":checked");
		   $('input:checkbox[id="chkId"]').each(function () { 
		    this.checked = _value; 
		   });
		  });
		 });

	

	$('.sid').on('click', function() {

		var val = $(this).attr('val');
		$("table tr").not(this).removeClass('back_color');
		$(this).addClass('back_color');
		val="<img src='/"+val+"' style='max-width:100%;'>";
		$("#img1").html(val);

	});

	$('.sid3').on('click', function() {

		var val = $(this).attr('val');
		val="<img src='/"+val+"' style='max-width:100%;'>";
		$("#img3").html(val);

	});

	function imgView(val,img){
		var element = document.getElementById(val);
		$("table tr").not(this).removeClass('back_color');
	//	element.classList.remove( 'back_color' );
		element.classList.add( 'back_color' );
		var imgUrl="<img src='"+img+"' style='max-width:100%;'>";
		$("#img1").html(imgUrl);
	}

	function delCate(){
		$('#cate_table > tbody:last > tr:last').remove();
	}

	function addCate(){
		var params = "CATEGORY_ID=0";
		$.ajax({
			  type: 'get'
			, url: 'cate_sel.php'
			,data : params
			, dataType : 'html'
			, success: function(data) {
					$("#cate_table").append(data);

					$(".big_cate").change(function() {
						selCate($(this), $(this).val());
					});
			  }
		});	

	}

	function selCate(obj, val){

		var params = "CATEGORY_ID="+val;
		$.ajax({
			  type: 'get'
			, url: 'sel_cate.php'
			,data : params
			, dataType : 'html'
			, success: function(data) {
					//$(".big_cate").parents("table").find("select:nth-child(2)").append(data);

					obj.parent().parent().find("select.small_cate").html(data);
			  }
		});	

	}

	function delMate(){
		$('#mate_table > tbody:last > tr:last').remove();
	}

	function addMate(){

		var val="<tr><td><select name='mate[]' class='mate_css'>";
		<?
		foreach($msi as $mi){	
		?>
				val+="<option value='<?=$mi->MATR_CODE?>'><?=$mi->MATR_NAME?></option>";
		<?}?>
		
		val+="</select></td><td><input type='text' name='pt[]'></td></tr>";

		$("#mate_table").append(val);
	}

	function delColor(){
		$('#color_table > tbody:last > tr:last').remove();
	}

	function addColor(){

		var	val="<tr><td><input type='text' name='COLOR[]'></td><td><input type='text' name='COLOR_CH[]'></td></tr>";

		$("#color_table").append(val);
	}


	function cal_cny(val){
		var cal=$("#wp").val()/$("#cny_val").val();
		var cal=cal.toFixed(2);
		$("#ccal").val(cal);
	}
</script>