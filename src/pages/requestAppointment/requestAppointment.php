<?php
if (!isset($_SESSION["user_id"])) {
    $_SESSION['currentPage'] = '../src/pages/homepage/homepage.php';
    echo '<script>window.location.replace("index.php");</script>';
    exit();
}
else {
  include __DIR__ . '/../../entity-dbs/clientes/mascotasCliente.php';
  include __DIR__ . '/../../entity-dbs/servicios/consultaServicios.php';

  if (!isset($mascotas)) {
    echo "<br><div class='alert alert-danger mx-5 my-2' role='alert'>No tienes mascotas ingresadas. Se te redirigirá a la página de inicio.</div>";
    $_SESSION['currentPage'] = '../src/pages/homepage/homepage.php';
    echo "<script>
        setTimeout(function() {
            window.location.replace('index.php');
        }, 5000);
    </script>";
    exit();
  }
  if (!isset($servicios)) {
    echo "<br><div class='alert alert-danger mx-5 my-2' role='alert'>No hay servicios disponibles. Se te redirigirá a la página de inicio.</div>";
    $_SESSION['currentPage'] = '../src/pages/homepage/homepage.php';
    echo "<script>
        setTimeout(function() {
            window.location.replace('index.php');
        }, 5000);
    </script>";
    exit();
  }

?>

<script>
  // AJAX para cargar el personal basado en el servicio seleccionado
$(document).ready(function() {
  $('#servicios').on('change', function() {
    console.log("Servicio cambiado");
      var serviceId = $(this).val();
      console.log("ID del servicio seleccionado: " + serviceId);
      $.ajax({
          url: '../src/entity-dbs/personal/consultaPersonalPorServicio.php',
          type: 'POST',
          data: { servicio_id: serviceId },
          dataType: 'json',
          success: function(data) {
              $("#personal").prop("disabled", false); // Habilitar el select de personal
              var $personal = $('#personal');
              $personal.empty();
              $personal.append('<option value="" disabled selected>Seleccione un encargado</option>');
              $.each(data, function(i, professional) {
                  $personal.append('<option value="' + professional.id + '">' + professional.nombre + '</option>');
              })
          },
              error: function(xhr, status, error) {
        console.error("AJAX error:", status, error, xhr.responseText);
        alert("Error en la consulta AJAX: " + error);
    },
    complete: function() {
        console.log("AJAX request completed");
    }
      
      });
  });
});
</script>

<div class="row m-5 appointment-container">
  <h2>Pida un turno</h2>
  <form method="post" action="index.php">
    <div class="row">
      <div class="col-12 main-inputs">
        <div class="appointment-info">
          <div class="form-group my-4">
            <label>Seleccione la mascota que desea atender: </label>
            <select class="form-select" name="mascotas" id="mascotas" required>
              <option value="" disabled selected>Nombre de la mascota</option>
              <?php
              if (isset($mascotas)) {
                foreach ($mascotas as $mascota) {
                  echo '<option value="' . $mascota['id'] . '">' . $mascota['nombre'] . '</option>';
                }
              }
              ?>
            </select>
          </div>

          <div class="form-group my-4">
            <label>Seleccione el tipo de servicio: </label>
            <select class="form-select" name="servicios" id="servicios" required>
              <option value="" disabled selected>Nombre del servicio</option>
              <?php
              if (isset($servicios)) {
                foreach ($servicios as $servicio) {
                  echo '<option value="' . $servicio['id'] . '">' . $servicio['nombre'] . '</option>';
                }
              }
              ?>
            </select>
          </div>

          <div class="form-group my-4">
            <label>Seleccione el personal encargado: </label>
          <select name="personal" id="personal" class="form-select" disabled required>
            <option value="" disabled selected>Seleccione un encargado</option>
            <?php
              if (isset($personal)) {
                foreach ($personal as $encargado) {
                  echo '<option value="' . $encargado['id'] . '">' . $encargado['nombre'] . '</option>';
                }
              }
              ?>
          </select>
          </div>

          <div class="form-group my-4">
            <label>Seleccione fecha y hora del servicio: </label>
            <input type="datetime-local" name="date" placeholder="Fecha y hora del servicio" class="date" required>
          </div>
        
        </div>
        <button type="submit" name="submit" class="btn btn-primary submit-btn mt-2">Enviar</button>
      </div>
      </div>
    </div>
  </form>
</div>
<?php
}
?>