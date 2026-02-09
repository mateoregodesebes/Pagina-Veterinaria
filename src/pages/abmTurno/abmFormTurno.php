<?php
require_once(__DIR__ . '/../../../includes/connection.php');
  define('iniManiana', 9);
  define('finManiana', 13);
  define('iniTarde', 14);
  define('finTarde', 18);

if (isset($_SESSION["idTurno"])) {
  $id = $_SESSION["idTurno"];
  $query = "SELECT * FROM atenciones WHERE id = '$id'";
  $result = mysqli_query($conn, $query);
  $row = mysqli_fetch_array($result);
  $id_turno = $row['id'];
  $mascotas = $row['mascota_id'];
  $servicios = $row['servicio_id'];
  $personal = $row['personal_id'];
  $fecha = substr($row['fecha_hora'], 0, 10);
  $hora = substr($row['fecha_hora'], 11, 5);
  $titulo = $row['titulo'];
  $descripcion = $row['descripcion'];
} else {
  $id = null;
}

$query2 = "SELECT id, nombre, apellido FROM personas where rol_id = 1 OR rol_id = 2";
$result = mysqli_query($conn, $query2);
$id_personal = mysqli_fetch_all($result, MYSQLI_ASSOC);

$query3 = "SELECT id, nombre FROM mascotas";
$result = mysqli_query($conn, $query3);
$id_mascotas = mysqli_fetch_all($result, MYSQLI_ASSOC);

$query4 = "SELECT id, nombre FROM servicios";
$result = mysqli_query($conn, $query4);
$id_servicios = mysqli_fetch_all($result, MYSQLI_ASSOC);

//esto es para que el script compare correctamente contra la BD
$query5 = "SELECT DATE_FORMAT(fecha_hora,'%Y-%m-%d %H:%i') AS fecha_hora FROM atenciones";
$result = mysqli_query($conn, $query5);
$horario_atenciones = mysqli_fetch_all($result, MYSQLI_ASSOC);

?>
<script>
  const horariosOcupados = <?php echo json_encode($horario_atenciones); ?>;
</script>


<div class="dataForm">
  <form class="button-form" method="post">
    <div class="mb-3">
      <button class="button-back" type="submit" name="action" value="goBack"><i
          class="fa-solid fa-arrow-left"></i></button>
    </div>
  </form>

  <form method="post" enctype="multipart/form-data">
    <div class="mb-3 px-3">
      <label class="form-label">ID - Mascota</label>
      <select name="mascotas" class="form-control" 
        value="<?php echo isset($mascotas) ? $mascotas : ""; ?>">
        <?php foreach ($id_mascotas as $mascota): 
          {
            $selected = (isset($mascotas) && $mascotas == $mascota['id']) ? 'selected' : '';
            echo "<option value='{$mascota['id']}' $selected>{$mascota['id']} - {$mascota['nombre']}</option>";
          }
        endforeach;?>
      </select>
    </div>
    <div class="mb-3 px-3">
      <label class="form-label">ID - Servicio</label>
      <select name="servicios" class="form-control" value="<?php echo isset($servicios) ? $servicios : ""; ?>">
        <?php foreach ($id_servicios as $servicio):
        { 
            $selected = (isset($servicios) && $servicios == $servicio['id']) ? 'selected' : '';
            echo "<option value='{$servicio['id']}' $selected>{$servicio['id']} - {$servicio['nombre']}</option>";
        }
        endforeach;?>
      </select>
    </div>
    <div class="mb-3 px-3">
      <label class="form-label">ID - Personal</label>
      <select name="personal" class="form-control" 
        value="<?php echo isset($personal) ? $personal : ""; ?>">
        <?php foreach ($id_personal as $personales):
          {
            $selected = (isset($personal) && $personal == $personales['id']) ? 'selected' : '';
            echo "<option value='{$personales['id']}' $selected>{$personales['id']} - {$personales['nombre']} {$personales['apellido']}</option>";
          } 
        endforeach; ?>
      </select>
    </div>
    <div class="mb-3 px-3">
      <label>Seleccione fecha y hora del servicio: </label>
      <input type="date" class="form-control" name="fecha" id="fecha" <?php echo isset($fecha) ? 'value="' . $fecha . '"' : '' ?> required>

      <select class="form-select my-1" name="hora" id="hora" required>
        <option value="" disabled <?php echo !isset($hora) ? 'selected' : '' ?>>Selecciona la hora</option>
        <?php
        for ($i = iniManiana; $i < finManiana; $i += 0.5) {
          $time = $i >= 1 ? intval($i) . ':' . (($i * 60) % 60 == 0 ? '00' : '30') : '00:' . (($i * 60) % 60 == 0 ? '00' : '30');
          echo '<option value="' . $i . '" ' . (isset($hora) && $hora == $i ? 'selected' : '') . '>' . $time . '</option>';
        }
        for ($i = iniTarde; $i < finTarde; $i += 0.5) {
           $time = $i >= 1 ? intval($i) . ':' . (($i * 60) % 60 == 0 ? '00' : '30') : '00:' . (($i * 60) % 60 == 0 ? '00' : '30');
            echo '<option value="' . $i . '" ' . (isset($hora) && $hora == $i ? 'selected' : '') . '>' . $time . '</option>';
        }
        ?>
      </select>
    </div>
    <div class="mb-3 px-3">
      <label class="form-label">Titulo</label>
      <input type="text" required name="titulo" class="form-control" placeholder="Titulo"
        value="<?php echo isset($titulo) ? $titulo : ""; ?>">
    </div>
    <div class="mb-3 px-3">
      <label class="form-label">Descripcion</label>
      <input type="text" required name="descripcion" class="form-control" placeholder="Descripcion"
        value="<?php echo isset($descripcion) ? $descripcion : ""; ?>">
    </div>

    <div class="row justify-content-center">
      <div class="col-3">
        <button type="button" id="btnSubmit" class="btn btn-primary submit-btn" data-bs-toggle="modal"
          data-bs-target="#staticBackdrop">
          Enviar
        </button>
      </div>
    </div>
    <div id="msgHorario" class="text-danger mt-1" style="display:none;">
      Ese horario ya está ocupado
    </div>

    <script>
        const fecha = document.getElementById("fecha");
        const hora  = document.getElementById("hora");
        const btn   = document.getElementById("btnSubmit");
        const msg   = document.getElementById("msgHorario");

        function convertirHora(valor) {
          const horas = Math.floor(valor);
          const minutos = (valor - horas) * 60;
          return String(horas).padStart(2,'0') + ":" + String(minutos).padStart(2,'0');
        }

        function verificarHorario() {
          if (!fecha.value || !hora.value) return;

          const fechaFormateada = fecha.value; 

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



    <?php //?Modal ?>
    <div class="modal fade" id="staticBackdrop" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1"
      aria-labelledby="staticBackdropLabel" aria-hidden="true">
      <div class="modal-dialog modal-dialog-centered">
        <div class="modal-content">
          <div class="modal-header">
            <h1 class="modal-title fs-5" id="staticBackdropLabel">Usted esta a punto de
              <?php echo isset($id) ? "modificar" : "crear" ?> un turno
            </h1>
            <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
          </div>
          <div class="modal-body">
            Esta seguro?
          </div>
          <div class="modal-footer">
            <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cancelar</button>
            <button type="submit" class="btn btn-primary" name="action"
              value="<?php echo isset($id) ? "updateEntity" : "createEntity" ?>">Si</button>
          </div>
        </div>
      </div>
    </div>
  </form>
</div>


<?php
if (isset($_POST['id'])) {
  require_once(__DIR__ . '/../../entity-dbs/clientes/updateTurno.php');
  $_SESSION['currentPage'] = '../src/pages/crudSelector/crudSelector.php';
  echo '<script>window.location.replace("index.php");</script>';
}
?>
<?php
if ($_SERVER['REQUEST_METHOD'] == 'POST') {
  if ($_POST['action'] == 'updateEntity') {
    if (isset($_SESSION["idTurno"])) {
      require_once(__DIR__ . '/../../entity-dbs/atenciones/updateTurnos.php');
      $_SESSION['idTurno'] = null;
    }

  } elseif ($_POST['action'] == 'goBack') {
    $_SESSION['idTurno'] = null;

  } elseif ($_POST['action'] == 'createEntity') {
    require_once(__DIR__ . '/../../entity-dbs/atenciones/altaTurnos.php');
  }

  $_SESSION['currentPage'] = '../src/pages/crudSelector/crudSelector.php';
  echo '<script>window.location.replace("index.php");</script>';
  exit();
}
mysqli_close($conn);
?>