<?php
// Lógica por si entra por el mail de recuperar contraseña
// Si hay un token en la URL, se carga la pagina de reset-password
if ($_GET['reset_psw_token'] ?? false) {
  $_SESSION["reset_psw_token"] = $_GET['reset_psw_token'] ?? '';
  $_SESSION["currentPage"] = '../src/pages/forgot-password/reset-password.php';
}
else if ($_GET['verification_token'] ?? false) {
  $_SESSION["verification_token"] = $_GET['verification_token'] ?? '';
  // Verificar que el token en sesión sea válido
  $_SESSION["verification_token_hash"] = hash('sha256', $_SESSION["verification_token"]);

  require_once(__DIR__ . '/../../../includes/connection.php');

  $sql = "SELECT * FROM personas 
              WHERE verification_token_hash = ? 
                AND verification_expires_at > now()";

  $stmt = $conn->prepare($sql);
  $stmt->bind_param("s", $_SESSION["verification_token_hash"]);
  $stmt->execute();

  $user = $stmt->get_result()->fetch_assoc();

  // Si el token es invalido se muestra un alerta y se redirige a la pagina de recuperar contraseña
  if ($user === null) {
  echo "<br><div class='alert alert-danger mx-5 my-2' role='alert'>El token de verificación es inválido o ha expirado. Se recargará la página, intenta registrarte de nuevo o ingresar nuevamente por el link de verificación.</div>";
  echo "<script>
      setTimeout(function() {
          window.location.replace('index.php');
      }, 5000);
  </script>";
  exit();
  } else {
    // Si el token es valido se verifica la cuenta del usuario
    echo '<script>console.log("Token de verificación válido. Verificando cuenta... de id ' . $user['id'] . '"); </script>';
    $userId = $user['id'];
    require_once __DIR__ . '/../../entity-dbs/personas/verificarCuenta.php';
    echo "<br><div class='alert alert-success mx-5 my-2' role='alert'>Cuenta verificada exitosamente. La página se recargará, ya puedes loguearte</div>";
    echo "<script>
        setTimeout(function() {
            window.location.replace('index.php');
        }, 5000);
    </script>";
  }
}
?>