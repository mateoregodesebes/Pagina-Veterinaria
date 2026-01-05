<?php
require_once(__DIR__ . '/../../../includes/connection.php');
$rolId = $_SESSION["idrol"];
$rol = $_SESSION["rol"];
if (isset($_SESSION["idStaff"])) {
  $id = $_SESSION["idStaff"];
  $rol_id = $rolId;
  $query = "SELECT * FROM personas WHERE id = '$id' AND rol_id = $rolId";
  $result = mysqli_query($conn, $query);
  $row = mysqli_fetch_array($result);
  $id_staff = $row['id'];
  $nombre = $row['nombre'];
  $apellido = $row['apellido'];
  $email = $row['email'];
  $ciudad = $row['ciudad'];
  $direccion = $row['direccion'];
  $telefono = $row['telefono'];
} else {
  $id = null;
  $rol_id = $rolId;
}
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
      <label class="form-label">Nombre</label>
      <input type="text" required name="nombre" class="form-control" placeholder="Nombre"
        value="<?php echo isset($nombre) ? $nombre : ""; ?>">
    </div>
    <div class="mb-3 px-3">
      <label class="form-label">Apellido</label>
      <input type="text" required name="apellido" class="form-control" placeholder="Apellido"
        value="<?php echo isset($apellido) ? $apellido : ""; ?>">
    </div>
    <div class="mb-3 px-3">
      <label class="form-label">Email</label>
      <input type="text" required name="email" class="form-control" placeholder="Email"
        value="<?php echo isset($email) ? $email : ""; ?>">
    </div>
    <div class="mb-3 px-3">
      <label class="form-label">Ciudad</label>
      <input type="text" required name="ciudad" class="form-control" placeholder="Ciudad"
        value="<?php echo isset($ciudad) ? $ciudad : ""; ?>">
    </div>
    <div class="mb-3 px-3">
      <label class="form-label">Direccion</label>
      <input type="text" required name="direccion" class="form-control" placeholder="Direccion"
        value="<?php echo isset($direccion) ? $direccion : ""; ?>">
    </div>
    <div class="mb-3 px-3">
      <label class="form-label">Telefono</label>
      <input type="text" required name="telefono" class="form-control" placeholder="Telefono"
        value="<?php echo isset($telefono) ? $telefono : ""; ?>">
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
              <?php echo isset($id) ? "modificar" : "crear" ?> un <?php echo $rol ?>
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
  require_once(__DIR__ . '/../../entity-dbs/clientes/updateCliente.php');
  $_SESSION['currentPage'] = '../src/pages/crudSelector/crudSelector.php';
  echo '<script>window.location.replace("index.php");</script>';
}
?>
<?php
if ($_SERVER['REQUEST_METHOD'] == 'POST') {
  if ($_POST['action'] == 'updateEntity') {
    if (isset($_SESSION["idStaff"])) {
      require_once(__DIR__ . '/../../entity-dbs/clientes/updateStaff.php');
      $_SESSION['idStaff'] = null;
    }

  } elseif ($_POST['action'] == 'goBack') {
    $_SESSION['idStaff'] = null;

  } elseif ($_POST['action'] == 'createEntity') {
    require_once(__DIR__ . '/../../entity-dbs/clientes/altaStaff.php');
  }

  $_SESSION['currentPage'] = '../src/pages/crudSelector/crudSelector.php';
  echo '<script>window.location.replace("index.php");</script>';
  exit();
}
mysqli_close($conn);
?>