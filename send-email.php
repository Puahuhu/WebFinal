<?php
use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\Exception;

require 'vender/PHPMailer/src/Exception.php';
require 'vender/PHPMailer/src/PHPMailer.php';
require 'vender/PHPMailer/src/SMTP.php';

$mail = new PHPMailer(true);

try {
    //Server settings
    $mail->isSMTP();                                            //Send using SMTP
    $mail->Host       = 'smtp.gmail.com';                       //Set the SMTP server to send through
    $mail->SMTPAuth   = true;                                   //Enable SMTP authentication
    $mail->Username   = 'nguyenletuanphuongzzz@gmail.com';      //SMTP username
    $mail->Password   = 'gkbgbevzelltuuca';                         //SMTP password
    $mail->SMTPSecure = PHPMailer::ENCRYPTION_STARTTLS;         //Enable explicit TLS encryption
    $mail->Port       = 587;                                    //TCP port to connect to for TLS

    //Recipients
    $mail->setFrom('nguyenletuanphuongzzz@gmail.com', 'Admin');
    $mail->addAddress($email, $fullName);     //Add a recipient

    //Content
    $mail->isHTML(true);                                  //Set email format to HTML
    $mail->Subject = 'Your account successfully created';
    $mail->Body = 'Your account has been successfully created with the following details:<br><br>'
                . 'Username: ' . $username . '<br>'
                . 'Password: ' . $username;

    $mail->send();
} catch (Exception $e) {
}
