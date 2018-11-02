<?php
//メールの送信
$mail = $argv[1];
$url = $argv[2];

mb_language("ja");
mb_internal_encoding("UTF-8");
$to = $mail;
$subject = "登録用URLの送信につきまして";
$message = "登録用のurlです。URL先からの登録をお願い致します。\r\n".$url;
$headers = "From: someya.training@gmail.com";

//確認用にファイルに出力
date_default_timezone_set('Asia/Tokyo');
$file = 'log/mail' .date(m_j) .'log.txt';
$sendtime = date('F j, Y, g:i:s A : ');
if(mb_send_mail($to, $subject, $message, $headers)){
	file_put_contents( $file, $sendtime ."send to " .$mail .": success \n",FILE_APPEND);
}else{
	file_put_contents( $file, $sendtime ."send to " .$mail .":  error \n",FILE_APPEND);
}
?>
