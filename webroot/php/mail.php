<?php

$file = 'mailcheck.txt';
$mail = $argv[1];
$url = $argv[2];

mb_language("ja");
mb_internal_encoding("UTF-8");
$to = $mail;
$subject = "登録用URLの送信につきまして";
$message = "登録用のurlです。URL先からの登録をお願い致します。\r\n".$url;
$headers = "From: someya.training@gmail.com";

if(mb_send_mail($to, $subject, $message, $headers)){
	file_put_contents( $file, $mail."\n success");
}else{
	file_put_contents( $file, $mail."\n error");
}
?>
