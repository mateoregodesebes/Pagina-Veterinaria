<?php
require_once (__DIR__ . '/../../../includes/connection.php');

if (isset ($_SESSION['idCliente'])) {
  $idAtencion = $_SESSION['idCliente'];
}

if (isset ($_SESSION["idMascota"])) {
  $id = $_SESSION["idMascota"];
  $query = "SELECT * FROM mascotas WHERE id = '$id' ";
  $result = mysqli_query($conn, $query);
  $row = mysqli_fetch_array($result);
  $id_cliente = $row['cliente_id'];
  $nombre = $row['nombre'];
  $raza = $row['raza'];
  $color = $row['color'];
  $fecha_de_nac = $row['fecha_de_nac'];
  if (isset ($row['fecha_muerte'])) {
    $fecha_muerte = $row['fecha_muerte'];
  } else {
    $fecha_muerte = '';
  }
} else {
  $id = null;
}
?>
<?php ?>
<div class="dataForm my-3">
  <form class="button-form" method="post">
    <div class="mb-3">
      <button class="button-back" <?php if (isset ($idAtencion))
        echo 'style="display: none;"' ?> type="submit"
          name="action" value="goBack"><i class="fa-solid fa-arrow-left"></i></button>
      </div>
    </form>

    <form method="post" enctype="multipart/form-data">
      <div class="mb-3">
        <label class="form-label">Id de cliente dueño</label>
        <input type="text" required name="idCliente" class="form-control" placeholder="Id de cliente" value="<?php if (isset ($id_cliente)) {
        echo $id_cliente;
      } elseif (isset ($idAtencion)) {
        echo $idAtencion;
      } else {
        echo "";
      } ?>">
    </div>
    <div class="mb-3">
      <label class="form-label">Nombre</label>
      <input type="text" required name="nombre" class="form-control" placeholder="Nombre"
        value="<?php echo isset ($nombre) ? $nombre : ""; ?>">
    </div>
    <div class="mb-3">
      <label class="form-label">Raza</label>
      <input type="text" required name="raza" class="form-control" placeholder="Raza"
        value="<?php echo isset ($raza) ? $raza : ""; ?>">
    </div>
    <div class="mb-3">
      <label for="formFile" class="form-label">Foto de la mascota</label>
      <input required class="form-control" name="foto" type="file" id="formFile" accept="image/png" />
    </div>
    <?php //!Este ver que onda como guardar solamente el nombre de la foto y guardar el archivo en assets/mascotas/             ?>
    <div class="mb-3">
      <label class="form-label">Color</label>
      <input type="text" required name="color" class="form-control" placeholder="Color"
        value="<?php echo isset ($color) ? $color : ""; ?>">
    </div>
    <div class="mb-3">
      <label class="form-label">Fecha de nacimiento</label>
      <input type="date" required name="fechaNac" class="form-control" placeholder="Fecha de nacimiento"
        value="<?php echo isset ($fecha_de_nac) ? $fecha_de_nac : ""; ?>">
    </div>
    <div class="mb-3">
      <label for="formFile" class="form-label" style="<?php echo isset ($id) ? "" : "display: none" ?>">Fecha de
        muerte</label>
      <input type="<?php echo isset ($id) ? "date" : "hidden" ?>" name="fechaMuerte" class="form-control"
        placeholder="Fecha de muerte" value="<?php echo isset ($fecha_muerte) ? $fecha_muerte : ""; ?>">
    </div>

    <div class="row justify-content-center">
      <div class="col-3 my-3">
        <button type="button" class="btn btn-primary submit-btn" data-bs-toggle="modal"
          data-bs-target="#staticBackdrop">
          Enviar
        </button>
      </div>
    </div>


    <?php //?Modal             ?>
    <div class="modal fade" id="staticBackdrop" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1"
      aria-labelledby="staticBackdropLabel" aria-hidden="true">
      <div class="modal-dialog modal-dialog-centered">
        <div class="modal-content">
          <div class="modal-header">
            <h1 class="modal-title fs-5" id="staticBackdropLabel">Usted esta a punto de
              <?php echo isset ($id) ? "modificar" : "crear" ?> una mascota
            </h1>
            <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
          </div>
          <div class="modal-body">
            Esta seguro?
          </div>
          <div class="modal-footer">
            <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cancelar</button>
            <button type="submit" class="btn btn-primary" name="action"
              value="<?php echo isset ($id) ? "updateEntity" : "createEntity" ?>">Si</button>
          </div>
        </div>
      </div>
    </div>
  </form>
</div>


<?php
if (isset ($_POST['id'])) {
  require_once (__DIR__ . '/../../entity-dbs/mascotas/updateMascota.php');
  $_SESSION['currentPage'] = '../src/pages/abmMascota/abmListMascota.php';
  echo '<script>window.location.replace("index.php");</script>';
}
?>
<?php
if ($_SERVER['REQUEST_METHOD'] == 'POST') {
  if ($_POST['action'] == 'updateEntity') {
    if (isset ($_SESSION["idMascota"])) {
      require_once (__DIR__ . '/../../entity-dbs/mascotas/updateMascota.php');
      $_SESSION['idMascota'] = null;
    }

  } elseif ($_POST['action'] == 'goBack') {
    $_SESSION['idMascota'] = null;

  } elseif ($_POST['action'] == 'createEntity') {
    require_once (__DIR__ . '/../../entity-dbs/mascotas/altaMascota.php');
  }

  $_SESSION['currentPage'] = '../src/pages/abmMascota/abmListMascota.php';
  if (isset ($_SESSION['idCliente'])) {
    $_SESSION['currentPage'] = '../src/pages/atencionDom/formAtencion.php';
  }

  echo '<script>window.location.replace("index.php");</script>';
  exit();
}
mysqli_close($conn);
?>