<?php

function sendMail($toEmail, $fromEmail, $subject, $message) {

	$headers = "MIME-Version: 1.0" . "\r\n";
	$headers .= "Content-type:text/html;charset=UTF-8" . "\r\n";	
	$headers .= "From: ". $fromEmail . "\r\n";
	
	mail($toEmail,$subject,$message,$headers);
}

sendMail('test2dh@gmail.com', 'test2wos@gmail.com', 'test mail', 'hello world');
?>