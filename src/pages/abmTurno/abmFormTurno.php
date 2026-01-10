<?php
require_once(__DIR__ . '/../../../includes/connection.php');

if (isset($_SESSION["idTurno"])) {
  $id = $_SESSION["idTurno"];
  $query = "SELECT * FROM atenciones WHERE id = '$id'";
  $result = mysqli_query($conn, $query);
  $row = mysqli_fetch_array($result);
  $id_turno = $row['id'];
  $mascotas = $row['mascota_id'];
  $servicios = $row['servicio_id'];
  $personal = $row['personal_id'];
  $fecha_hora = $row['fecha_hora'];
  $titulo = $row['titulo'];
  $descripcion = $row['descripcion'];
} else {
  $id = null;
}

$query2 = "SELECT id FROM personas where rol_id = 1 OR rol_id = 2";
$result = mysqli_query($conn, $query2);
$id_personal = mysqli_fetch_all($result, MYSQLI_ASSOC);

$query3 = "SELECT id FROM mascotas";
$result = mysqli_query($conn, $query3);
$id_mascotas = mysqli_fetch_all($result, MYSQLI_ASSOC);

$query4 = "SELECT id FROM servicios";
$result = mysqli_query($conn, $query4);
$id_servicios = mysqli_fetch_all($result, MYSQLI_ASSOC);

?>
<div class="dataForm">
  <form class="button-form" method="post">
    <div class="mb-3">
      <button class="button-back" type="submit" name="action" value="goBack"><i
          class="fa-solid fa-arrow-left"></i></button>
    </div>
  </form>

  <form method="post" enctype="multipart/form-data">
    <div class="mb-3 px-3">
      <label class="form-label">ID de Mascota</label>
      <select name="mascotas" class="form-control" 
        value="<?php echo isset($mascotas) ? $mascotas : ""; ?>">
        <?php foreach ($id_mascotas as $mascota): ?>
          <option value="<?php echo $mascota['id']; ?>" <?php echo (isset($mascotas) && $mascotas == $mascota['id']) ? 'selected' : ''; ?>>
            <?php echo $mascota['id']; ?>
          </option>
        <?php endforeach; ?>
      </select>
    </div>
    <div class="mb-3 px-3">
      <label class="form-label">ID de Servicio</label>
      <select name="servicios" class="form-control" 
        value="<?php echo isset($servicios) ? $servicios : ""; ?>">
        <?php foreach ($id_servicios as $servicio): ?>
          <option value="<?php echo $servicio['id']; ?>" <?php echo (isset($servicios) && $servicios == $servicio['id']) ? 'selected' : ''; ?>>
            <?php echo $servicio['id']; ?>
          </option>
        <?php endforeach; ?>
      </select>
    </div>
    <div class="mb-3 px-3">
      <label class="form-label">ID del Personal</label>
      <select name="personal" class="form-control" 
        value="<?php echo isset($personal) ? $personal : ""; ?>">
        <?php foreach ($id_personal as $personales): ?>
          <option value="<?php echo $personales['id']; ?>" <?php echo (isset($personal) && $personal == $personales['id']) ? 'selected' : ''; ?>>
            <?php echo $personales['id']; ?>
          </option>
        <?php endforeach; ?>
      </select>
    </div>
    <div class="mb-3 px-3">
      <label class="form-label">Fecha</label>
      <input type="date" required  name="fecha" class="form-control" placeholder="Fecha"
        value="<?php echo isset($fecha_hora) ? $fecha : ""; ?>">
    </div>
    <div class="mb-3 px-3">
      <label class="form-label">Hora</label>
      <input type="time" required  name="hora" class="form-control" placeholder="Hora"
        value="<?php echo isset($fecha_hora) ? $hora : ""; ?>">
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
        <button type="button" class="btn btn-primary submit-btn" data-bs-toggle="modal"
          data-bs-target="#staticBackdrop">
          Enviar
        </button>
      </div>
    </div>


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