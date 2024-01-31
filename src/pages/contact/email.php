<?php
session_start();
require_once(__DIR__ . '/../../../vendor/autoload.php');

$dotenv = Dotenv\Dotenv::createImmutable(__DIR__ . '/../../../includes/');
$dotenv->load();
use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\Exception;

$app_password = $_ENV['APP_PASSWORD'];

$mail = new PHPMailer(true);

//?Sanitizacion de los form input
$name = filter_input(INPUT_POST, 'name', FILTER_SANITIZE_STRING);
$email = filter_input(INPUT_POST, 'email', FILTER_SANITIZE_EMAIL);
$subject = filter_input(INPUT_POST, 'subject', FILTER_SANITIZE_STRING);
$mmesage = filter_input(INPUT_POST, 'message', FILTER_SANITIZE_STRING);

try {
  // SMTP configuration
  $mail->isSMTP();
  $mail->Host = 'smtp.gmail.com';
  $mail->SMTPAuth = true;
  $mail->Username = 'san.anton.vet24@gmail.com';
  $mail->Password = $app_password;
  $mail->SMTPSecure = PHPMailer::ENCRYPTION_STARTTLS;
  $mail->Port = 587;

  //? Por un tema de spoofing aca siempre que se envie un correo se va a enviar desde el correo de la veterinaria
  //? Asi que no importa que correo ponga en el parametro de setFrom
  $mail->setFrom('random@gmail.com', "{$name}");
  //? Correo destino
  $mail->addAddress('san.anton.vet24@gmail.com', 'Veterinaria San Anton');
  $mail->Subject = "{$subject}";
  $mail->Body = "El cliente con nombre: {$_POST['name']} y correo: {$_POST['email']}\nEnvio el siguiente mensaje\n{$_POST['message']}";

  $mail->send();

  //? Este es el correo que se le va a enviar al cliente
  $mail->clearAddresses();
  $mail->setFrom('random@gmail.com', 'Veterinaria San Anton');
  $mail->addAddress("{$email}", "{$name}");
  $mail->Subject = "Gracias por contactarnos";
  $mail->Body = "Gracias por contactarnos, en breve nos pondremos en contacto con usted";

  $mail->send();
  $_SESSION['email_sent'] = true;


} catch (Exception $e) {
  echo "Error: {$mail->ErrorInfo}";
  $_SESSION['email_sent'] = false;
} finally {
  echo '<script>window.location.replace("../../../public/index.php");</script>';
}