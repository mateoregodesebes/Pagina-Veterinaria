<?php
if (isset ($_SESSION['alerta'])) {
  switch ($_SESSION['alerta']) {
    case 'noCliente':
      echo '<div id="alert" class="mt-2 alert alert-danger" role="alert">
    El cliente no existe, por favor verifique el id ingresado.
          </div>';
      break;
    case 'noMascotas':
      echo '<div id="alert" class="mt-2 alert alert-warning" role="alert">
    El cliente no tiene mascotas registradas, por favor registre una mascota.
          </div>';
      break;
    case 'noServicios':
    case 'noPersonal':
      echo '<div id="alert" class="mt-2 alert alert-warning" role="alert">
    Hay un problema con el servicio, porfavor intente nuevamente mas tarde.
          </div>';
      break;
    case 'errorTurno':
      echo '<div id="alert" class="mt-2 alert alert-warning" role="alert">
    Ha habido un error en el registro de la atencion intente nuevamente.
          </div>';
      break;
    case 'altaTurno':
      echo '<div id="alert" class="mt-2 alert alert-success" role="alert">
    La atencion se ha registrado correctamente.
          </div>';
      break;


  }

  echo '<script type="text/javascript">
    setTimeout(function() {
      var alert = document.getElementById("alert");
      alert.style.display = "none";
    }, 10000); // 10 seconds
  </script>';
  $_SESSION['error'] = null;
}
?>
<form method="post">
  <div class="mt-4">
    <div class="d-flex justify-content-center">
      <h2>Atencion</h2>
    </div>

    <div class="d-flex justify-content-center">
      <h2>Domiciliaria</h2>
    </div>

    <div class="my-3">
      <label class="form-label">Id de cliente:</label>
      <input type="text" name="idCliente" class="form-control" placeholder="Id de cliente" required>
    </div>
    <div class="mb-5">
      <label class="form-label">Nueva Mascota?</label>
      <input name="petCheckbox" type="checkbox">
    </div>
    <div class="mb-3 d-flex justify-content-center">
      <button class="btn btn-primary" type="submit">Siguiente</button>
    </div>
  </div>
</form>


<?php
if ($_SERVER['REQUEST_METHOD'] == 'POST') {
  include __DIR__ . '/../../entity-dbs/clientes/validaCliente.php';
  if ($clientFlag) {
    $_SESSION['idCliente'] = $_POST['idCliente'];
    $_SESSION['currentPage'] = '../src/pages/atencionDom/formAtencion.php';
    if (isset ($_POST['petCheckbox'])) {
      $_SESSION['currentPage'] = '../src/pages/abmMascota/abmFormMascota.php';
    }
  } else {
    $_SESSION['alerta'] = 'noCliente';
  }

  echo '<script>window.location.replace("index.php");</script>';
}
?>