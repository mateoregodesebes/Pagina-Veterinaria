<?php

$email = $_POST['email'];

$token = bin2hex(random_bytes(16));

$token_hash = password_hash($token, PASSWORD_DEFAULT);

$expires_at = date("Y-m-d H:i:s", time() + 60 * 30); // 30 minutos de expiración

require_once(__DIR__ . '/../../../includes/connection.php');

$sql = "UPDATE personas 
          SET reset_token_hash = ?,
              reset_token_expires_at = ?
          WHERE email = ?";

$stmt = $conn->prepare ($sql);
$stmt->bind_param("sss", $token_hash, $expires_at, $email);
$stmt->execute();

if ($conn->affected_rows === 0) {
    $_SESSION["mail_error"] = true;
} else {
    require_once(__DIR__ . '/../../scripts/mailer.php');

    //! Cambiar localhost por el dominio cuando se suba al servidor
    $mail = require __DIR__ . '/../../scripts/mailer.php';
    $mail->setFrom('noreply@sanantonvet.com', 'San Anton Veterinaria');

    $mail->addAddress($email);

    $mail->Subject = "Restablecimiento de contraseña";
    $mail->Body = <<<END
    <p>Hemos recibido una solicitud para restablecer la contraseña de su cuenta.</p>
    <a href="http://localhost/Pagina-Veterinaria/src/pages/reset-password.php>Haga click en este enlace para restablecer su contraseña</a>
    <p>Si no solicitó este cambio, puede ignorar este correo electrónico.</p
    
    END;

    try {
        $mail->send();
        echo "<br><div class='alert alert-success' role='alert'>Se ha enviado un correo electrónico con instrucciones para restablecer su contraseña.</div>";
    } catch (Exception $e) {
        $_SESSION["mail_error"] = true;
    }
}
?>