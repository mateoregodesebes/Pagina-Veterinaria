<?php

use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\SMTP;
use PHPMailer\PHPMailer\Exception;

require __DIR__ . '../../../vendor/autoload.php';

$app_password = $_ENV['APP_PASSWORD'];

$mail = new PHPMailer(true);

$mail->SMTPDebug = SMTP::DEBUG_SERVER; // Enable verbose debug output

// SMTP configuration
$mail->isSMTP();
$mail->Host = 'smtp.gmail.com';
$mail->SMTPAuth = true;
$mail->Username = 'san.anton.vet24@gmail.com';
$mail->Password = $app_password;
$mail->SMTPSecure = PHPMailer::ENCRYPTION_STARTTLS;
$mail->Port = 587;
$mail->isHTML(true);

return $mail;
?>