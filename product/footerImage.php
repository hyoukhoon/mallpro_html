<?php 
$que25="select footerImage from storeinfo where uid='".$uid."'";
$result25 = $mysqli->query($que25) or die($mysqli->error);
$rs25 = $result25->fetch_object();

$footerImage=$rs25->footerImage;

?>