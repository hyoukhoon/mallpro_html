#!/usr/bin/php -q
<?php
include "/data/givelot/dbcon.php";

$ds=json_decode(file_get_contents("https://quotation-api-cdn.dunamu.com/v1/forex/recent?codes=FRX.KRWCNY"));
//$ds=json_decode(file_get_contents("https://quotation-api-cdn.dunamu.com/v1/forex/recent?codes=FRX.KRWUSD"));
//$ds2=json_decode(file_get_contents("https://quotation-api-cdn.dunamu.com/v1/forex/recent?codes=FRX.KRWPHP"));
//$ds3=json_decode(file_get_contents("https://quotation-api-cdn.dunamu.com/v1/forex/recent?codes=FRX.KRWJPY"));
//$usd=$ds[0]->basePrice;
//$php=$ds2[0]->basePrice;
//$jpy=$ds3[0]->basePrice;
$jpy=$ds3[0]->basePrice;



//$que="update changeMoney set usd='$usd', php='$php', jpy='$jpy', regDate=now() where num='1'";
//$sql = $mysqli->query($que);


?>