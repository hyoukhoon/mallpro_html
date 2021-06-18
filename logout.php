<?session_start(); 

################# 로그아웃 ################

$_SESSION["AID"] = '';  
$_SESSION["AAUTH"] = '';  
$_SESSION['AMLEVEL']= '';
$_SESSION["saveLoginInfo"]=0;

SetCookie("cookieSaveLoginInfo","",time()-86400*365,"/");
session_destroy();

echo "<script>location.href='/';</script>";
exit;
?>