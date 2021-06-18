<?php

error_reporting(E_ALL);
ini_set("display_errors", TRUE);
ini_set("display_startup_errors", TRUE);

$test="";




$test2='{"3589505843583": {"price": {"priceMoney": "9900", "priceText": "99", "showTitle": "false", "sugProm": "false"}, "quantity": "235", "depositText": "约 KRW 17125", "depositTextColor": "#333333"}, "3589505843584": {"price": {"priceMoney": "9900", "priceText": "99", "showTitle": "false", "sugProm": "false"}, "quantity": "129", "depositText": "约 KRW 17125", "depositTextColor": "#333333"}, "3552893753264": {"price": {"priceMoney": "9700", "priceText": "97", "showTitle": "false", "sugProm": "false"}, "quantity": "0", "depositText": "约 KRW 16779", "depositTextColor": "#333333"}, "3419798660268": {"price": {"priceMoney": "13000", "priceText": "130", "showTitle": "false", "sugProm": "false"}, "quantity": "56", "depositText": "约 KRW 22487", "depositTextColor": "#333333"}, "3472760833656": {"price": {"priceMoney": "6900", "priceText": "69", "showTitle": "false", "sugProm": "false"}, "quantity": "0", "depositText": "约 KRW 11936", "depositTextColor": "#333333"}, "3419798660269": {"price": {"priceMoney": "12200", "priceText": "122", "showTitle": "false", "sugProm": "false"}, "quantity": "4", "depositText": "约 KRW 21104", "depositTextColor": "#333333"}, "3910722580138": {"price": {"priceMoney": "13100", "priceText": "131", "showTitle": "false", "sugProm": "false"}, "quantity": "24", "depositText": "约 KRW 22660", "depositTextColor": "#333333"}, "3419798660271": {"price": {"priceMoney": "14100", "priceText": "141", "showTitle": "false", "sugProm": "false"}, "quantity": "0", "depositText": "约 KRW 24390", "depositTextColor": "#333333"}, "0": {"price": {"priceMoney": "6900", "priceText": "82-174", "showTitle": "false", "sugProm": "false"}, "quantity": "1106", "depositText": "约 KRW 14184-30099", "depositTextColor": "#333333"}, "3909773261037": {"price": {"priceMoney": "9700", "priceText": "97", "showTitle": "false", "sugProm": "false"}, "quantity": "66", "depositText": "约 KRW 16779", "depositTextColor": "#333333"}, "3606030476283": {"price": {"priceMoney": "13100", "priceText": "131", "showTitle": "false", "sugProm": "false"}, "quantity": "0", "depositText": "约 KRW 22660", "depositTextColor": "#333333"}, "3909773261038": {"price": {"priceMoney": "8200", "priceText": "82", "showTitle": "false", "sugProm": "false"}, "quantity": "14", "depositText": "约 KRW 14184", "depositTextColor": "#333333"}, "3419798660274": {"price": {"priceMoney": "17400", "priceText": "174", "showTitle": "false", "sugProm": "false"}, "quantity": "35", "depositText": "约 KRW 30099", "depositTextColor": "#333333"}, "3618592677123": {"price": {"priceMoney": "23900", "priceText": "239", "showTitle": "false", "sugProm": "false"}, "quantity": "0", "depositText": "约 KRW 41342", "depositTextColor": "#333333"}, "3552893753266": {"price": {"priceMoney": "8200", "priceText": "82", "showTitle": "false", "sugProm": "false"}, "quantity": "0", "depositText": "约 KRW 14184", "depositTextColor": "#333333"}, "3552893753268": {"price": {"priceMoney": "9700", "priceText": "97", "showTitle": "false", "sugProm": "false"}, "quantity": "0", "depositText": "约 KRW 16779", "depositTextColor": "#333333"}, "3205733102665": {"price": {"priceMoney": "12200", "priceText": "122", "showTitle": "false", "sugProm": "false"}, "quantity": "250", "depositText": "约 KRW 21104", "depositTextColor": "#333333"}, "3205733102664": {"price": {"priceMoney": "12200", "priceText": "122", "showTitle": "false", "sugProm": "false"}, "quantity": "293", "depositText": "约 KRW 21104", "depositTextColor": "#333333"}}';

echo "<pre>";

//print_r(json_decode($test));

print_r(json_decode($test2));


/*
echo "1::::::::::::> ".$t->valItemInfo->skuList[0]->names."<br>";

$pvs=";".$t->valItemInfo->skuList[0]->pvs.";";

echo "2::::::::::::> ".$t->valItemInfo->skuMap->{$pvs}->price."<br>";

echo "3::::::::::::> ".$t->api->descUrl."<br>";
*/

?>