<?session_start(); 

################# ๋ก๊ทธ์์ ################

$_SESSION["MMS_ID"] = '';  
$_SESSION["MMS_PWR"] = '';  

echo "<script>location.href='/admin_area/login.php';</script>";
exit;
?>