<?session_start(); 

################# 로그아웃 ################

$_SESSION["MMS_ID"] = '';  
$_SESSION["MMS_PWR"] = '';  

echo "<script>location.href='/admin_area/login.php';</script>";
exit;
?>