<?php
if ($_SERVER["REQUEST_METHOD"] == "POST" && isset($_POST["submit"])) {

  require_once(__DIR__ . '/send-password-reset.php');
}

if (isset($_SESSION["mail_error"])) {
    echo "<br><div class='alert alert-danger mx-5 my-2' role='alert'>No se pudo enviar el correo electrónico. Intente nuevamente más tarde.</div>";
    unset($_SESSION["mail_error"]);
}
if (isset($_SESSION["mail_success"])) {
    echo "<br><div class='alert alert-success mx-5 my-2' role='alert'>Se ha enviado un correo electrónico con instrucciones para restablecer su contraseña.</div>";
    unset($_SESSION["mail_success"]);
}
?>

<div class="row m-5 info-container">
  <form method="post" action="index.php">
    <div class="row">
      <div class="col-12 main-inputs">
        <h2>Recupere su contraseña</h2>
        <div class="user-info mb-2">
          <p>Por favor ingrese su el correo asociado a su cuenta. Le enviaremos un enlace para restablecer su contraseña.</p>
          <div class="form-group">
            <label>Correo electrónico</label>
            <input type="email" name="email" placeholder="Email/correo" class="email" required>
          </div>  
        </div>
        <button type="submit" name="submit" class="btn btn-primary submit-btn mt-2">Enviar</button>
      </div>
      </div>
    </div>
  </form>
</div>