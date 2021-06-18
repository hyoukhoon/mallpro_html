<?php session_start();
include $_SERVER["DOCUMENT_ROOT"]."/inc/dbcon.php";

//error_reporting(E_ALL);
//ini_set('display_errors', TRUE);
//ini_set('display_startup_errors', TRUE);

$result2 = $mysqli->query("select * from optiontable where pnum='503'") or die("725:".$mysqli->error);
							$rs2 = $result2->fetch_object();

							$optionName="";
							if($rs2->optionName1)$optionName=$rs2->optionName1.",";
							if($rs2->optionName2)$optionName.=$rs2->optionName2.",";
							if($rs2->optionName3)$optionName.=$rs2->optionName3.",";
							$optionName=substr($optionName,0,-1);


							$optionValue="";
							if($rs2->optionValue1)$optionValue=$rs2->optionValue1."\n=======================\n";
							if($rs2->optionValue2)$optionValue.=$rs2->optionValue2."\n";
							if($rs2->optionValue3)$optionValue.=$rs2->optionValue3."\n";


							if($rs2->optionNum1!="%22%22"){
								$optionNum1=urldecode($rs2->optionNum1);
								$optionNum1=json_decode($optionNum1);
							}else{
								$optionNum1=array();
							}
							if($rs2->optionNum2!="%22%22"){
								$optionNum2=urldecode($rs2->optionNum2);
								$optionNum2=json_decode($optionNum2);
							}else{
								$optionNum2=array();
							}


							$optionPrice=urldecode($rs2->optionPrice);
							$optionPrice=json_decode($optionPrice);

//							echo sizeof($optionNum1).",".sizeof($optionNum2)."<br>";

							echo "<pre>";
							echo "num1";
							print_r($optionNum1);
							echo "num2";
							print_r($optionNum2);
							echo "price";
							print_r($optionPrice);

							if(count($optionNum1)>0 and count($optionNum2)>0){
								foreach($optionNum1 as $ot1){
									foreach($optionNum2 as $ot2){
										//echo $ot1.";".$ot2."<br>";
										$k=";".$ot1.";".$ot2.";";
											echo "가격:".$optionPrice->{$k}->price."<br>";

									}
								}
							}else if(count($optionNum1)>0 and count($optionNum2)==0){
								foreach($optionNum1 as $ot1){

										$k=";".$ot1.";";
											echo "가격:".$optionPrice->{$k}->price."<br>";

								}
							}else if(count($optionNum1)==0 and count($optionNum2)>0){
								foreach($optionNum2 as $ot2){

										$k=";".$ot2.";";
											echo "가격:".$optionPrice->{$k}->price."<br>";

								}
							}


?>