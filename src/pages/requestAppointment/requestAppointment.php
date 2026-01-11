<?php
if (!isset($_SESSION["user_id"])) {
    $_SESSION['currentPage'] = '../src/pages/homepage/homepage.php';
    echo '<script>window.location.replace("index.php");</script>';
    exit();
}
else {
  include __DIR__ . '/../../entity-dbs/clientes/mascotasCliente.php';
  include __DIR__ . '/../../entity-dbs/servicios/consultaServicios.php';

  define('iniManiana', 9);
  define('finManiana', 13);
  define('iniTarde', 14);
  define('finTarde', 18);

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
  if ($_SERVER["REQUEST_METHOD"] == "POST" && isset($_POST["submit"])) {
    $_POST['titulo'] = 'Turno solicitado por web';
    $_POST['descripcion'] = 'Turno solicitado vía página web';

    require_once __DIR__ . '/../../entity-dbs/atenciones/altaTurnos.php';

    echo "<br><div class='alert alert-success mx-5 my-2' role='alert'>Tu turno ha sido solicitado correctamente. Se te redirigirá a la página de inicio.</div>";
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
      var serviceId = $(this).val();
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
  // Habilitar la selección de fecha y hora de turnos disponibles después de seleccionar el personal
  $('#personal').on('change', function() {
    var personalId = $(this).val();
    $.ajax({
        url: '../src/entity-dbs/atenciones/consultaTurnosPorPersonal.php',
        type: 'POST',
        data: { personal_id: personalId },
        dataType: 'json',
        success: function(data) {
            console.log("Turnos recibidos:", data);
            var $fecha = $('#fecha');
            var $hora = $('#hora');

            $fecha.prop("disabled", false); // Habilitar el input de fecha
            $hora.prop("disabled", false); // Habilitar el select de hora
            $fecha.off('change').on('change', function() {
                var selectedDate = $(this).val();
                var bookedHours = data.filter(function(appointment) {
                    return appointment.fecha === selectedDate;
                }).map(function(appointment) {
                    return appointment.hora;
                });
                $hora.find('option').each(function() {
                    var hourValue = $(this).val();
                    if (bookedHours.includes(hourValue)) {
                        $(this).prop('disabled', true);
                    } else {
                        $(this).prop('disabled', false);
                    }
                });
                $hora.val(''); // Resetear la selección de hora
            });
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
  // Habilitar el botón de enviar cuando todos los campos estén seleccionados
  $('#hora').on('change', function() {
      if ($('#mascotas').val() && $('#servicios').val() && $('#personal').val() && $('#fecha').val() && $('#hora').val()) {
          $('.submit-btn').prop('disabled', false);
      } else {
          $('.submit-btn').prop('disabled', true);
      }
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
            <input type="date" class="form-control my-1" name="fecha" id="fecha" min="<?php echo date("Y-m-d") ?>" max="<?php echo date('Y-m-d', strtotime('+90 days')) ?>" disabled required>

            <select class="form-select" name="hora" id="hora" disabled required>
            <option value="" disabled selected>Selecciona la hora</option>
              <?php
              for ($i = iniManiana; $i < finManiana; $i += 0.5) {
                $time = $i >= 1 ? intval($i) . ':' . (($i * 60) % 60 == 0 ? '00' : '30') : '00:' . (($i * 60) % 60 == 0 ? '00' : '30');
                echo '<option value="' . $i . '">' . $time . '</option>';
              }
              for ($i = iniTarde; $i < finTarde; $i += 0.5) {
                $time = $i >= 1 ? intval($i) . ':' . (($i * 60) % 60 == 0 ? '00' : '30') : '00:' . (($i * 60) % 60 == 0 ? '00' : '30');
                echo '<option value="' . $i . '">' . $time . '</option>';
              }
              ?>
            </select>
          </div>
        </div>
        <button type="submit" name="submit" class="btn btn-primary submit-btn mt-2" disabled>Enviar</button>
      </div>
      </div>
    </div>
  </form>
</div>
<?php
}
?>