<?php session_start();
include $_SERVER["DOCUMENT_ROOT"]."/inc/dbcon.php";

//error_reporting(E_ALL);
//ini_set("display_errors", 1);
if(!$_SESSION['AID']){
	location_is_close('로그인이 필요한 메뉴입니다.');
	exit;
}
$uid=$_SESSION['AID'];
/*
if(!$_SESSION['AAUTH']){
	location_is_close('유료회원 전용서비스입니다.');
	exit;
}

if(!$_SESSION['AMLEVEL']){
	location_is_close('유료회원 전용서비스입니다.');
	exit;
}
*/
$num=$_GET['num'];

$que="select * , a.price as myPrice, b.price as itemPrice 
	from myItem a, taobao b where a.pnum=b.num and a.uid='$uid' and a.num='$num'";
$result = $mysqli->query($que) or die("2:".$mysqli->error);
$rs = $result->fetch_object();
$optImg=explode(",",$rs->optionImage);
$noOption=$rs->noOption;
$myPrice=$rs->myPrice;
$nowFee=$rs->nowFee;
$nowUnit=$rs->nowUnit;
if($nowUnit=="원"){
	$salePrice=$myPrice-$nowFee;
}else{
	$salePrice=$myPrice-($myPrice*($nowFee/100));
}

$que2="select * from storeinfo where uid='".$uid."'";
$result2 = $mysqli->query($que2) or die($mysqli->error);
$rs2 = $result2->fetch_object();

$contents=rawurldecode($rs->itemContents);
$contents=str_replace("\\","",$contents);
//$contents=htmlspecialchars($contents);

if($rs->videoUrl){

	$vUrl=$rs->videoUrl;
	$vUrl=str_replace("e/1","e/6",$vUrl);
	$vUrl=str_replace("t/8","t/1",$vUrl);
	$vUrl=str_replace(".swf",".mp4",$vUrl);
	$vUrl="http:".$vUrl;
	$vs="<video width='800' controls='controls' autoplay='autoplay' loop='loop'><source src='".$vUrl."'></video><br><br>";
	$contents=$vs.$contents;
	
}

$contentsText=stripslashes($rs2->topText)."<br>";

	if($rs2->topImage){
		$contentsTopImage="<img src='".$rs2->topImage."'><br>";
	}

	if($rs2->footerImage){
		$contentsFooterImage="<br><img src='".$rs2->footerImage."' width='800'>";
	}

	$contents=$contentsText.$contentsTopImage.$contents;
//$contents=stripslashes($rs2->topText)."<br>".$rs2->topImage."<br>".$contents."<br>".$rs2->footerImage;
?>
<!doctype html>
<html>
<head>
<meta charset="utf-8">
<title>Mallpro Back-office</title>
<link href="/css/dcg_tmall.css" rel="stylesheet" type="text/css" />
    <style>
.td {
        font-family: 'Nanum Gothic', sans-serif;
        font-size: 43px;color:#ffffff}
		
.td02 {
        font-family: 'Nanum Gothic', sans-serif;
        font-size: 28px;color:#288ee5;}
		
		
.line{border-top:1px solid #e1e1e1;}
.line{border-bottom:1px solid #e1e1e1;}
.line{border-right:1px solid #e1e1e1;}
.line{border-left:1px solid #e1e1e1;}
    </style>

</head>

<body class="bg_popup">

<!-- 전체 넓이 S-->
<div id="pop_wrap">
  <!-- 상단 head로고 S-->
  <div class="pop_top_bg">
    <ul>
     <li><span>제품 상세 보기</span></li>
    </ul>
  </div>
  <!-- 상단 head로고 E-->
  
  <!-- 컨텐츠 S -->
  <div class="pop_content">
  <?
  $result3 = $mysqli->query("select * from optiontable where pnum='".$rs->pnum."'") or die("725:".$mysqli->error);
	$rs3 = $result3->fetch_object();

	$optionName="";
	if($rs3->optionName1)$optionName=$rs3->optionName1."\r";
	if($rs3->optionName2)$optionName.=$rs3->optionName2."\r";
	if($rs3->optionName3)$optionName.=$rs3->optionName3."\r";

	$optionValue="";
	if($rs3->optionName1)$optionValue=$rs3->optionValue1."\r";
	if($rs3->optionName2)$optionValue.=$rs3->optionValue2."\r";
	if($rs3->optionName3)$optionValue.=$rs3->optionValue3."\r";

	$optPrice="";
	if($rs->optionType=="0"){
		$optGubun="";
		$optionName="";
		$optionValue="";
		$optionPrice="";
		$optionCnt="";

	}else if($rs->optionType=="1"){
		if($rs3->isRegist==1){
			$optionValue="";
			$optGubun="단독형";
			$optionName="선택하세요";
			$optPriceArray=json_decode(urldecode($rs3->optionMixPrice));
			foreach($optPriceArray as $op){
				if($op->pricek!=-999900){
					$optPrice.=$op->pricek.",";
					$optionValue.=$op->name.",";
					$optionCnt.="100".",";
				}
			}
			$optionPrice=substr($optPrice,0,-1);
			$optionValue=substr($optionValue,0,-1);
			$optionCnt=substr($optionCnt,0,-1);
		}else{
			$optGubun="단독형";
		}
	}else if($rs->optionType=="2"){
		$optionValue="";
		$optGubun="조합형";
		$optPriceArray=json_decode(urldecode($rs3->optionMixPrice));
		foreach($optPriceArray as $op){
			if($op->pricek!=-999900){
				$optPrice.=$op->pricek.",";
				$optionValue.=$op->name.",";
				$optionCnt.="100".",";
			}
		}
		$optionName="선택하세요";
		$optionPrice=substr($optPrice,0,-1);
		$optionValue=substr($optionValue,0,-1);
		$optionCnt=substr($optionCnt,0,-1);
	}else{
		$optGubun="";
	}
//	echo $optGubun."<br>";
//	echo $optionName."<br>";
//	echo $optionValue."<br>";
//	echo $optionPrice."<br>";
//	echo $optionCnt."<br>";
  ?>
    
  <!-- 타이틀 S--> 
     <ul class="top_title_area">
       <li class="top_title"><?echo $rs->itemName;?></li>
     </ul>
  <!-- 타이틀 E--> 
       <li style="font-size:14px;">판매가 : <?echo number_format($myPrice);?>원</li>
	   <li style="font-size:14px;color:#6b90dc;font-weight:bold;">할인가 : <?echo number_format($salePrice);?>원</li>
		<li style="font-size:14px;">배송비 : <?echo number_format($rs->sendBasicFee);?>원 (<?=$rs->sendFeeType?>)</li>
<?if($optGubun){?>
		<li style="font-size:14px;">옵션 : 
			<select name="optionList">
				<option><?=$optionName?></option>
				<?php
					$ov=explode(",",$optionValue);
					$op=explode(",",$optionPrice);
					$j=0;
					foreach($ov as $v){
				?>
						<option><?=$v?>(<?echo number_format($op[$j]);?>원추가)</option>
				<?
					$j++;
				}?>
			</select>
		</li>
<?}?>
    <ul>
			<?echo $contents;?>
    </ul>

<?

if(!$noOption){

//옵션시작
if($rs->optionImage){

	$que3="select if(optionName1='컬러',optionValue1, if(optionName2='컬러',optionValue2, optionValue3)) as optVal,optionMixPrice from optiontable where pnum='".$rs->pnum."'";
	$result3 = $mysqli->query($que3) or die($mysqli->error);
	$rs3 = $result3->fetch_object();
	$optVal=explode(",",$rs3->optVal);
	$optPriceArray=json_decode(urldecode($rs3->optionMixPrice));
//	echo "<pre>";
//	print_r($optVal);
?>
<p>&nbsp;</p>
	 <table width="100%" border="0" align="center" cellpadding="0" cellspacing="0">
      <tr>
        <td height="100" align="center" bgcolor="#333333" class="td">옵션상세정보</td>
      </tr>
      <tr>
        <td height="219" style="text-align:center;">
		<p>&nbsp;</p>
<?php
				$i=0;
				foreach($optImg as $c){

					if(!strpos($optVal[$i],"매진") and !strpos($optVal[$i],"품절")){

					//if($optPriceArray[$i]->pricek!=-999900){
					?>
					  <table border="0" align="center" cellpadding="0" cellspacing="20" class="line">
					  <tr>
						<td height="61" align="center" class="td02">옵션 : <?=$optVal[$i]?> </td>
					  </tr>
					  <tr>
						<td align="center"><img src="<?=$c?>" style="max-width:100%"></td>
					  </tr>
					</table>
					<p>&nbsp;</p>
<?
					//}

					}

$i++;
				}?>
		</td>
      </tr>
    </table>
<?}

//옵션끝
}

echo $contentsFooterImage;
?>
      <!-- 하단 버튼 S-->
  
   <div class="bottom_bu_area">
	<ul>
		<li><a href="#" class="button03" onclick="window.close();">확인</a></li>
	</ul>
</div>    
            
  <!-- 하단 버튼 E-->


   
</div>
     <!-- 컨텐츠 E -->
 
   
  </div>
 <!-- 전체 넓이 E-->
 
  
     
   
     
     

</body>
</html>
