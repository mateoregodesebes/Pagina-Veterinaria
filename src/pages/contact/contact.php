<div class="row m-5 contact-container">
  <form method="post" action="../src/pages/contact/email.php">
    <div class="row">
      <div class="col-8 main-inputs">
        <h2>Contactenos directamente</h2>
        <div class="user-info mb-2">
          <input type="text" name="name" placeholder="Nombre completo" required>
          <input type="email" name="email" placeholder="Email/correo" class="email" required>
        </div>
        <div class="message mb-2">
          <input type="text" name="subject" placeholder="Asunto" class="subject mb-2" required>
          <textarea name="message" placeholder="Mensaje" class="message-textarea" required></textarea>
        </div>
        <button class="btn btn-primary submit-btn mt-2">Enviar</button>
        <button class="btn btn-secondary mt-2" type="reset">Limpiar formulario</button>
      </div>
      <div class="col-4 static-info">
        <h2>O encuentrenos en</h2>
        <div class="socials">
          <span> <i class="fa-solid fa-location-dot"></i> Direccion:</span>
          <p>Loren itsum</p>
          <span> <i class="fa-solid fa-phone"></i>Telefono:</span>
          <p>Loren itsum</p>
          <a href="https://web.whatsapp.com/"><i class="fa-brands fa-whatsapp"></i> WhatsApp</a>
        </div>
      </div>
    </div>
  </form>
  <?php
  if (isset($_SESSION['email_sent'])) {
    if ($_SESSION['email_sent']) {
      echo '<div id="alert" class="alert alert-success" role="alert">
      Correo enviado con exito
    </div>';
    } else {
      echo '<div id="alert" class="alert alert-danger" role="alert">
      Error al enviar el correo, intente nuevamente
    </div>';
    }
    echo '<script type="text/javascript">
          setTimeout(function() {
            var alert = document.getElementById("alert");
            alert.style.display = "none";
          }, 5000); // 5 seconds
          </script>';
    $_SESSION['email_sent'] = null;
  }
  ?>
</div>