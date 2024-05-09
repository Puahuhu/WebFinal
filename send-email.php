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
    $mail->addAddress('nguyenletuanphuong710@gmail.com', 'Puahuhu');     //Add a recipient

    //Content
    $mail->isHTML(true);                                  //Set email format to HTML
    $mail->Subject = 'send mail is so fucking easy little homie';
    $mail->Body    = 'gg mit to bit';

    $mail->send();
    echo 'Message has been sent';
} catch (Exception $e) {
    echo "Message could not be sent. Mailer Error: {$mail->ErrorInfo}";
}
