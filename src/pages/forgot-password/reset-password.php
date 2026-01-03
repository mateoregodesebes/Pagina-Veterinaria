<?php

// Redirigir al inicio si no hay token en sesión o es vacia
if (!isset($_SESSION["reset_psw_token"]) || empty($_SESSION["reset_psw_token"])) {
  $_SESSION['currentPage'] = '../src/pages/homepage/homepage.php';
  echo '<script>window.location.replace("index.php");</script>';
  exit();
}

// Verificar que el token en sesión sea válido
$_SESSION["reset_psw_token_hash"] = hash('sha256', $_SESSION["reset_psw_token"]);

require_once(__DIR__ . '/../../../includes/connection.php');

$sql = "SELECT * FROM personas 
          WHERE reset_token_hash = ? 
            AND reset_token_expires_at > now()";

$stmt = $conn->prepare($sql);
$stmt->bind_param("s", $_SESSION["reset_psw_token_hash"]);
$stmt->execute();

$user = $stmt->get_result()->fetch_assoc();

// Si el token es invalido se muestra un alerta y se redirige a la pagina de recuperar contraseña
if ($user === null) {
  echo "<br><div class='alert alert-danger mx-5 my-2' role='alert'>El token es invalido o ha expirado. Se te redirigirá a la página de recuperación de contraseña nuevamente.</div>";
echo "<script>
    setTimeout(function() {
        window.location.replace('index.php');
    }, 50000);
</script>";
$_SESSION['currentPage'] = '../src/pages/forgot-password/forgot-password.php';
exit();
}

// Lógica para procesar el formulario
if ($_SERVER["REQUEST_METHOD"] == "POST" && isset($_POST["submit"])) {
  $new_password = $_POST["new_password"];

  $repeat_new_password = $_POST["repeat_new_password"];

  if ($new_password !== $repeat_new_password) {
    echo "<br><div class='alert alert-danger mx-5 my-2' role='alert'>Las contraseñas no coinciden.</div>";
    exit();
  }

  // Actualizar la contraseña del usuario
  $hashed_password = password_hash($new_password, PASSWORD_DEFAULT);
  $sql = "UPDATE personas SET clave = ?, reset_token_hash = NULL, reset_token_expires_at = NULL WHERE reset_token_hash = ?";
  $stmt = $conn->prepare($sql);
  $stmt->bind_param("ss", $hashed_password, $_SESSION["reset_psw_token_hash"]);
  if ($stmt->execute()) {
    echo "<br><div class='alert alert-success mx-5 my-2' role='alert'>Contraseña actualizada correctamente. Se te redirigirá a la página de inicio de sesión.</div>";
    echo "<script>
        setTimeout(function() {
            window.location.replace('index.php');
        }, 5000);
    </script>";
    $_SESSION['currentPage'] = '../src/pages/homepage/homepage.php';
    exit();
  } else {
    echo "<br><div class='alert alert-danger mx-5 my-2' role='alert'>Error al actualizar la contraseña.</div>";
    exit();
  }
}

?>

<script>
$(document).ready(function(){
    function checkInputs() {
        let allValid = true;
        $(".reg-required").each(function() {
            const type = $(this).attr('type');
            const value = $(this).val();
            if (value == "") {
                allValid = false;
            } else if (type == "email" && value.indexOf("@") == -1) {
                allValid = false;
            } else if (type == "password" && value.length < 8) {
                allValid = false;
            }
        });
        $("#submitBtn").prop('disabled', !allValid);
    }
$(".reg-required").on('blur keyup', function() {
        // Shows or hides warning
        if($(this).val() == "") {
            $(this).prev("small").removeClass("d-none");
        } else {
            $(this).prev("small").addClass("d-none");
        }
        checkInputs();
    });
    checkInputs();
});

</script>

<div class="row m-5 info-container">
  <form method="post" action="index.php">
    <div class="row">
      <div class="col-12 main-inputs">
        <h2>Restablecimiento de contraseña</h2>
        <div class="user-info mb-2">
          <p>Por favor ingrese su nueva contraseña y confírmela. Recuerde la necesidad de que la contraseña tenga al menos 8 caracteres</p>
          <input type="hidden" name="reset_psw_token_hash" value="<?php htmlspecialchars($_SESSION['reset_psw_token_hash']); ?>" />

          <div class="form-group">
            <label>Nueva contraseña</label>
                <br>
                <small class="d-none">Campo obligatorio (*)</small>
                <input type="password" class="form-control reg-required" name="new_password" minlength="8" required/>
          </div>
          <div class="form-group mt-2">
            <label>Repetir nueva contraseña</label>
                <br>
                <small class="d-none">Campo obligatorio (*)</small>
                <input type="password" class="form-control reg-required" name="repeat_new_password" minlength="8" required/>
          </div>   
        </div>
        <button type="submit" name="submit" class="btn btn-primary submit-btn mt-2">Enviar</button>
      </div>
      </div>
    </div>
  </form>
</div>