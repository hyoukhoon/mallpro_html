<?php

$url="https://item.taobao.com/item.htm?spm=2013.1.20141001.1.535e274eSUayYy&id=592298807243&scm=1007.12144.97955.42296_0_0&pvid=e941c3b8-7026-4c75-b950-39e79ab0c0e8&utparam=%7B%22x_hestia_source%22%3A%2242296%22%2C%22x_object_type%22%3A%22item%22%2C%22x_mt%22%3A5%2C%22x_src%22%3A%2242296%22%2C%22x_pos%22%3A1%2C%22x_pvid%22%3A%22e941c3b8-7026-4c75-b950-39e79ab0c0e8%22%2C%22x_object_id%22%3A592298807243%7D";

if(strpos($url,"?id=")){

	$url2=explode("?id=",$url);
	$url3=explode("&",$url2[1]);
	$pid=$url3[0];

}else if(strpos($url,"&id=")){

	$url2=explode("&id=",$url);
	$url3=explode("&",$url2[1]);
	$pid=$url3[0];

}


echo $pid;

?>