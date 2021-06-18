<?php session_start();
include $_SERVER["DOCUMENT_ROOT"]."/inc/dbcon.php";


$uid=$_SESSION['AID'];
$num=$_POST["num"];

	$result = $mysqli->query("select b.num as tNum, a.price as myPrice, b.price as itemPrice, a.regDate as myregDate,itemName,b.optionType as optionType  
	from myItem a, taobao b where a.pnum=b.num and b.num='".$num."'") or die("8:".$mysqli->error);
	$rs = $result->fetch_object();

	if($rs->optionType==2){
		$val="";
		$result2 = $mysqli->query("select * from optiontable where pnum='".$num."'") or die("725:".$mysqli->error);
		$rs2 = $result2->fetch_object();

		$optionMixPrice=json_decode(urldecode($rs2->optionMixPrice));

		$t=0;
						foreach($optionMixPrice as $p){
							$pricek=$p->promoPricek;
							$promoPrice=$p->promoPrice;
							$pricek=ceil($pricek/100)*100;
							$hiddenPrice=ceil(($promoPrice*$cny)/100)*100;

							if($p->name){
						
					
						$val.="<option value=\"".$p->name."\">".$p->name."(".number_format($pricek)."원)</option>";

								$t++;
							}
						}

		$data=array("result"=>1,
		"optionType"=>2,
		"val"=>$val
		);
	}


		

		echo json_encode($data);


?>