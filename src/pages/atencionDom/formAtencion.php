<?php
include __DIR__ . '/../../entity-dbs/clientes/mascotasCliente.php';
include __DIR__ . '/../../entity-dbs/servicios/consultaServicios.php';
include __DIR__ . '/../../entity-dbs/personal/consultaPersonal.php';
include __DIR__ . '/../../entity-dbs/atenciones/consultaTurnos.php';
const iniManiana = 9;
const finManiana = 13;
const iniTarde = 14;
const finTarde = 18;
?>

<script>
  const horariosOcupados = <?php echo json_encode($horario_atenciones); ?>;
</script>

<?php
if (!isset($mascotas)) {
  $_SESSION['alerta'] = 'noMascotas';
  $_SESSION['currentPage'] = '../src/pages/atencionDom/atencionMain.php';
  echo '<script>window.location.replace("index.php");</script>';
}
if (!isset($servicios)) {
  $_SESSION['alerta'] = 'noServicios';
  $_SESSION['currentPage'] = '../src/pages/atencionDom/atencionMain.php';
  echo '<script>window.location.replace("index.php");</script>';
}
if (!isset($personal)) {
  $_SESSION['alerta'] = 'noPersonal';
  $_SESSION['currentPage'] = '../src/pages/atencionDom/atencionMain.php';
  echo '<script>window.location.replace("index.php");</script>';
}
?>
<form method="POST">
  <div class="mb-2 mt-3 d-flex justify-content-start">
    <button class="button-back" type="submit" name="action" value="goBack"><i class="fa-solid fa-arrow-left"></i></button>
  </div>
</form>
<div class="mb-2 d-flex justify-content-center">
  <h3>Formulario de atención a domicilio</h3>
</div>

<form method="POST">

  <div class="mb-3">
    <label for="mascotas">Mascota: </label>
    <select class="form-select" name="mascotas" id="mascotas" required>
      <option value="" disabled selected>Selecciona la mascota</option>
      <?php
      //?Esto es mas por seguridad de crasheo y me lo recomendo copilot pero diria que no es necesario,
      //?Ya checkeo si es null al principio
      if (isset($mascotas)) {
        foreach ($mascotas as $mascota) {
          echo '<option value="' . $mascota['id'] . '">' . $mascota['nombre'] . '</option>';
        }
      }
      ?>
    </select>
  </div>


  <div class="mb-3">
    <label for="servicios">Servicio: </label>
    <select class="form-select" name="servicios" id="servicios" required>
      <option value="" disabled selected>Selecciona el tipo de servicio</option>
      <?php
      if (isset($servicios)) {
        foreach ($servicios as $servicio) {
          echo '<option value="' . $servicio['id'] . '">' . $servicio['nombre'] . '</option>';
        }
      }
      ?>
    </select>
  </div>


  <div class="mb-3">
    <label for="personal">Profesional a cargo: </label>
    <select class="form-select" name="personal" id="personal" required>
      <option value="" disabled selected>Selecciona email del profesional</option>
      <?php
      if (isset($personal)) {
        foreach ($personal as $p) {
          echo '<option value="' . $p['idPersona'] . '">' . $p['nombre'] . ' ' . $p['apellido'] . ' ('  . $p['nombreRol'] . ')</option>';
        }
      }
      ?>
    </select>
  </div>

  <div class="mb-3">
    <label for="titulo">Titulo de la atencion: </label>
    <input type="text" class="form-control" name="titulo" id="titulo" placeholder="Control..." required>
  </div>

  <div class="mb-3">
    <label for="descripcion">Descripción de la atencion: </label>
    <textarea class="form-control" name="descripcion" id="descripcion" rows="5" placeholder="Le duele la panza al rrope..." required></textarea>
  </div>

  <div class="mb-3">
    <label for="fecha">Fecha de atencion: </label>
    <input type="date" class="form-control" name="fecha" id="fecha" min="<?php echo date("Y-m-d") ?>" max="<?php echo date('Y-m-d', strtotime('+90 days')) ?> required">

    <div class="mt-1">
      <select class="form-select" name="hora" id="hora" required>
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

  <div class="mb-3 button-submit d-flex justify-content-center">
    <button type="submit" id="btnSubmit" class="btn btn-primary" name="action" value="altaAtencion">Enviar</button>
  </div>
  <p id="msgHorario" style="text-align:center; color:red; display:none;"> El horario seleccionado ya está ocupado. </p>
</form>

<script>
const fecha = document.getElementById("fecha");
const hora  = document.getElementById("hora");
const btn   = document.getElementById("btnSubmit");
const msg   = document.getElementById("msgHorario");

function convertirHora(horaFloat) {
  let horas = Math.floor(horaFloat);
  let minutos = (horaFloat - horas) * 60;
  return String(horas).padStart(2,'0') + ":" + String(minutos).padStart(2,'0');
}

function verificarHorario() {
  if (!fecha.value || !hora.value) return;

  const fechaPartes = fecha.value.split("-");
  const fechaFormateada = `${fechaPartes[2]}-${fechaPartes[1]}-${fechaPartes[0]}`;
  const horaFormateada = convertirHora(parseFloat(hora.value));
  const seleccion = `${fechaFormateada} ${horaFormateada}`;

  const ocupado = horariosOcupados.some(h => h.fecha_hora === seleccion);

  if (ocupado) {
    btn.disabled = true;
    msg.style.display = "block";
  } else {
    btn.disabled = false;
    msg.style.display = "none";
  }
}

fecha.addEventListener("change", verificarHorario);
hora.addEventListener("change", verificarHorario);
</script>



<?php
if ($_SERVER['REQUEST_METHOD'] == 'POST') {
  if ($_POST['action'] == 'altaAtencion') {
    include(__DIR__ . '/../../entity-dbs/atenciones/altaTurnos.php');
    if ($_SESSION['alerta'] !== 'errorTurno') {
      $_SESSION['alerta'] = 'altaTurno';
    }
  }
  $_SESSION['user_idAt'] = null;
  $_SESSION['currentPage'] = '../src/pages/atencionDom/atencionMain.php';
  echo '<script>window.location.replace("index.php");</script>';
}
?>