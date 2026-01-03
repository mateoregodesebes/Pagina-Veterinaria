<?php

$email = $_POST['email'];

$token = bin2hex(random_bytes(16));

$token_hash = hash('sha256', $token);

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
    $mail->CharSet = 'UTF-8';
    $mail->Encoding = 'base64';

    //! Cambiar localhost por el dominio cuando se suba al servidor
    $mail = require __DIR__ . '/../../scripts/mailer.php';
    $mail->setFrom('noreply@sanantonvet.com', 'San Anton Veterinaria');

    $mail->addAddress($email);

    // mb_encode_mimeheader es para que los caracteres especiales se vean bien en el asunto del mail
    $mail->Subject = mb_encode_mimeheader("Restablecimiento de contraseña", "UTF-8", "B");
    //! Recordar cambiar el link cuando se suba al servidor
    $mail->Body = <<<END
    <p>Hemos recibido una solicitud para restablecer la contraseña de su cuenta.</p>
    <a href="http://localhost/Pagina-Veterinaria/public/index.php?token=$token">Haga click en este enlace para restablecer su contraseña</a>
    <p>Si no solicitó este cambio, puede ignorar este correo electrónico.</p>
    END;

    try {
        $mail->send();
        $_SESSION["mail_success"] = true;
    } catch (Exception $e) {
        $_SESSION["mail_error"] = true;
    }
}
?>