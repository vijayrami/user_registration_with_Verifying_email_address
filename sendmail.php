<?php
require_once('./PHPMailer/PHPMailerAutoload.php');
if (dirname($_SERVER['PHP_SELF']) != '/'){
	$actual_link = $_SERVER['SERVER_NAME'].dirname($_SERVER['PHP_SELF']);
} else {
	$actual_link = $_SERVER['SERVER_NAME']."/";
}
$link = "http://".$actual_link."/confirm.php?passkey=".$confirm_code;
$mail = new PHPMailer;
//$mail->SMTPDebug = 3;// debugging: 1 = errors and messages, 2 = messages only                               // Enable verbose debug output
$mail->isSMTP();                                      // Set mailer to use SMTP
$mail->Host = 'smtp.gmail.com';  // Specify main and backup SMTP servers
$mail->SMTPAuth = true;                               // Enable SMTP authentication
$mail->Username = 'vijaymrami@gmail.com';                 // SMTP username
$mail->Password = '**********';                           // SMTP password
$mail->SMTPSecure = 'ssl'; // secure transfer enabled REQUIRED for GMail  // Enable TLS encryption, `ssl` also accepted
$mail->Port = 465;           // or 587                         // TCP port to connect to
$mail->setFrom('vijaymrami@gmail.com', 'Vijay Rami');
$mail->addAddress($user_email, $user_name);     // Add a recipient

//$mail->addAddress('ellen@example.com');               // Name is optional
//$mail->addReplyTo('info@example.com', 'Information');
//$mail->addCC('cc@example.com');
//$mail->addBCC('bcc@example.com');
//$mail->addAttachment('/var/tmp/file.tar.gz');         // Add attachments
//$mail->addAttachment('/tmp/image.jpg', 'new.jpg');    // Optional name
//$mail->isHTML(true);                                  // Set email format to HTML
$mail->Subject = 'User Registration Mail Confirmation';
$mail->Body    = '<h1>Your Confirmation link!</h1><br/><p>Click on below link to activate your account</p><br/><a href="'.$link.'">Click Here To Activate</a>';
$mail->AltBody = 'Your Confirmation link! Click on this link to activate your account http://192.168.1.52/user_register/confirm.php?passkey='.$confirm_code;

if(!$mail->send()) {
    echo 'false';
} else {
    echo 'true';
}