<?php
	//sendmail("aravinda@technopulse.in","Sending mail with settings","IMAP and POP are both ways to read your Gmail messages in other email clients. IMAP can be used across multiple devices. Emails are synced in real time.","Raj kiran");

function sendmail($toaddress,$subject,$message,$name)
{
	require 'PHPMailer-master/PHPMailerAutoload.php';
	
	$mail = new PHPMailer;
	
	$mail->SMTPDebug = false;                               // Enable verbose debug output
	
	$mail->isSMTP();                                      // Set mailer to use SMTP
	$mail->Host = 'mail.tex24x7.com';  // Specify main and backup SMTP servers
	$mail->SMTPAuth = true;                               // Enable SMTP authentication
	$mail->Username = 'mailer@tex24x7.com';                 // SMTP username
	$mail->Password = 'Ad4KiVQfhFWx';                           // SMTP password
	$mail->SMTPSecure = 'ssl';                            // Enable TLS encryption, `ssl` also accepted
	$mail->Port = 465;                                    // TCP port to connect to
	
	$mail->From = 'mailer@tex24x7.com';
	$mail->FromName = 'College Social Network';
	$mail->addAddress($toaddress, $name);     // Add a recipient
	$mail->addAddress($toaddress);               // Name is optional
	$mail->addReplyTo('mailer@tex24x7.com', 'College Social Network');
	//$mail->addCC('cc@example.com');
	//$mail->addBCC('bcc@example.com');
	
	$mail->addAttachment('/var/tmp/file.tar.gz');         // Add attachments
	$mail->addAttachment('/tmp/image.jpg', 'new.jpg');    // Optional name
	$mail->isHTML(true);                                  // Set email format to HTML
	
	$mail->Subject = $subject;
	$mail->Body    = $message;
	$mail->AltBody = $subject;
	
	if(!$mail->send()) {
		echo 'Message could not be sent.';
		echo 'Mailer Error: ' . $mail->ErrorInfo;
	} else {
		//echo '<script>alert("Mail sent.");</script>';
	}
}
?>
  