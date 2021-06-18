<?php

		$nameFrom="몰프로";
		$email="hyoukhoon@gmail.com";
		$admin_mail="escritoyane@gmail.com";
		$mailTo=$email;
		$subject="[몰프로]회원가입 확인 메일입니다.";
		$subject="=?UTF-8?B?".base64_encode($subject)."?=";
		$mailFrom=$admin_mail;
		$header = "Content-Type: text/html; charset=utf-8\r\n";
		$header .= "MIME-Version: 1.0\r\n";
		$header .= "Return-Path: <". $mailFrom .">\r\n";
		$header .= "From: ". $nameFrom ." <". $mailFrom .">\r\n";
		$header .= "Reply-To: <". $mailFrom .">\r\n";
		//$MailBody=file_get_contents($_SERVER['DOCUMENT_ROOT']."/user/mail_pwsearch.php");
		//$MailBody=str_replace("{domain}",$domain,$MailBody);
		//$MailBody=str_replace("{uid}",$rs3[0],$MailBody);// 아이디
		//$MailBody=str_replace("{name}",$rs3[1],$MailBody);// 이름
		//$MailBody=str_replace("{passwd}",$passwd,$MailBody);// 비밀번호
		$MailBody="아래 링크를 누르시면 회원인증이 완료됩니다. <br>
		<br>
		<a href='https://www.mallpro.kr/emailCheck.php?email=".$email."' target='_blank'></a>
		<br>
		<br>
		감사합니다.
		";

		
		if(mail($mailTo, $subject, $MailBody, $header, $mailFrom)){
			echo "ok";
		}else{
			echo "fail";
		}
?>