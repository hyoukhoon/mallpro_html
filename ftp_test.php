<?php session_start();
error_reporting(E_ALL);
ini_set("display_errors", 1);

include $_SERVER["DOCUMENT_ROOT"]."/inc/dbcon.php";

// ftp는 상대경로, 절대경로가 허용되지 않으며, 
 // 보통 public_html, www, html 로 시작합니다. 
 // public_html/userid 에 자료를 저장한다면, 
 // ftp 경로는 "public_html/userid/파일" 이 됩니다. 

 // B 호스트에서 가져올 실제 파일 
 $remote_file = "mediapic/미디어픽_TOTAL_리스트_2017. 0627.xlsx"; 
//  $remote_file = urlencode($remote_file);
 // A 호스트로 저장하거나 브라우저로 출력해야 할 파일 
 $local_file = "ftp_down.xlsx"; 

 // 임시 파일을 엽니다. 
 $fp = fopen($local_file, 'w+'); 

 // B 호스트 정보 
 $ftp_server = "211.104.0.211:990";  
 $ftp_user_name = "mediapic";  
 $ftp_user_pass = "2tusguest";  

// B 호스트 접속 
 $conn_id = ftp_connect($ftp_server) or die("Couldn't connect to $ftp_server"); 

 // B 호스트 로그인  
 $login_result = ftp_login($conn_id, $ftp_user_name, $ftp_user_pass); 

 // 파일을 A 호스트로 업로드하고,  
 // $file 로 다운로드하거나 저장할 코드를 작성하면 됩니다. 
 // ftp_get 은 로컬에서만 가능하므로 ftp_fget을 사용합니다. 
 if (ftp_fget($conn_id, $fp, $remote_file, FTP_BINARY, 0)) {  
    while(!feof($fp)){  
         $file .= fread($fp, 1024);  
    } 
    // 파일 다운로드나 파일 출력 처리 부분입니다. 
    echo "Successfully written to $local_file\n";  
 } else {  
    echo "There was a problem while downloading $remote_file 
            to $local_file\n";  
 }  


 ftp_close($conn_id);  
 fclose($fp);  

?>
