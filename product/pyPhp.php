<?php 
$pid=$_GET['pid'];

$output=exec('cd /home/mallpro/ && python3 taoOption.py '.$pid);

echo $pid."<br>".$output;

?>
