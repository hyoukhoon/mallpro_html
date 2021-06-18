<?php
error_reporting(E_ERROR | E_WARNING | E_PARSE);

// Same as error_reporting(E_ALL);
ini_set('error_reporting', E_ERROR | E_WARNING | E_PARSE);

ini_set("display_errors", 1);
$path="media/PRODUCT/201707/20170714/룰루랄라/V레이스";
$path=iconv('UTF-8','EUC-KR',$path);
$oldfile=$_SERVER["DOCUMENT_ROOT"].$path."/[vap]y44a7763.mp4";
$newfile=$_SERVER["DOCUMENT_ROOT"]."media/SHOP/06/0000000760/MOBILE/0000001256/MOV/0000001256_20170718071436264816.mp4";
echo $oldfile."<br>".$newfile;
copy($oldfile, $newfile);//복사하고
set_time_limit(10);
flush();


?>