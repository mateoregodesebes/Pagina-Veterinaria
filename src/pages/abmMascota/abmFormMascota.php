<?php
require_once(__DIR__ . '/../../../includes/connection.php');

if (isset($_SESSION['user_id'])) {
  $idAtencion = $_SESSION['user_id'];
}

if (isset($_SESSION["idMascota"])) {
  $id = $_SESSION["idMascota"];
  $query = "SELECT * FROM mascotas WHERE id = '$id' ";
  $result = mysqli_query($conn, $query);
  $row = mysqli_fetch_array($result);
  $id_cliente = $row['cliente_id'];
  $nombre = $row['nombre'];
  $raza = $row['raza'];
  $color = $row['color'];
  $fecha_de_nac = $row['fecha_de_nac'];
  if (isset($row['fecha_muerte'])) {
    $fecha_muerte = $row['fecha_muerte'];
  } else {
    $fecha_muerte = '';
  }
} else {
  $id = null;
}

// * Para el combo del id cliente
$query2 = "SELECT id FROM clientes";
$result = mysqli_query($conn, $query2);
$id_clientes = mysqli_fetch_all($result, MYSQLI_ASSOC);

//?Colores de mascotas actuales
$colors = ['Blanco', 'Negro', 'Marron', 'Amarillo', 'Potus', 'Verde', 'Naranja']

?>
<?php ?>
<div class="dataForm my-3">
  <form class="button-form" method="post">
    <div class="mb-3">
      <button class="button-back" <?php if (isset($idAtencion))
                                    echo 'style="display: none;"' ?> type="submit" name="action" value="goBack"><i class="fa-solid fa-arrow-left"></i></button>
    </div>
  </form>

  <form method="post" enctype="multipart/form-data">
    <div class="mb-3">
      <label class="form-label">Id de cliente dueño</label>
      <select name="idCliente" class="form-control">
        <?php
        foreach ($id_clientes as $id_temp) {
          $selected = $id_temp['id'] == $id_cliente ? "selected" : "";
          echo "<option value='" . $id_temp['id'] . "' $selected>" . $id_temp['id'] . "</option>";
        }
        ?>
      </select>
    </div>
    <div class="mb-3">
      <label class="form-label">Nombre</label>
      <input type="text" required name="nombre" class="form-control" placeholder="Nombre" value="<?php echo isset($nombre) ? $nombre : ""; ?>">
    </div>
    <div class="mb-3">
      <label class="form-label">Raza</label>
      <input type="text" required name="raza" class="form-control" placeholder="Raza" value="<?php echo isset($raza) ? $raza : ""; ?>">
    </div>
    <div class="mb-3" <?php if (isset($idAtencion)) echo 'style="display: none;"' ?>>
      <label for="formFile" class="form-label">Foto de la mascota</label>
      <input <?php echo !isset($_SESSION["idMascota"]) ? "required" : "" ?> class="form-control" name="foto" type="file" id="formFile" accept="image/png" />
    </div>
    <div class="mb-3">
      <label class="form-label">Color</label>
      <select required name="color" class="form-control">
        <?php 
          foreach ($colors as $colorOption) {
            $selected = (isset($color) && $color == $colorOption) ? "selected" : "";
            echo "<option value='$colorOption' $selected>$colorOption</option>";
          }
        ?>
      </select>
    </div>
    <div class="mb-3">
      <label class="form-label">Fecha de nacimiento</label>
      <input type="date" required name="fechaNac" class="form-control" max="<?php echo date('Y-m-d') ?>" placeholder="Fecha de nacimiento" value="<?php echo isset($fecha_de_nac) ? $fecha_de_nac : ""; ?>">
    </div>
    <div class="mb-3">
      <label for="formFile" class="form-label" style="<?php echo isset($id) ? "" : "display: none" ?>">Fecha de
        muerte</label>
      <input type="<?php echo isset($id) ? "date" : "hidden" ?>" name="fechaMuerte" max="<?php echo date('Y-m-d') ?>" class="form-control" placeholder="Fecha de muerte" value="<?php echo isset($fecha_muerte) ? $fecha_muerte : ""; ?>">
    </div>

    <div class="row justify-content-center">
      <div class="col-3 my-3">
        <button type="button" class="btn btn-primary submit-btn" data-bs-toggle="modal" data-bs-target="#staticBackdrop">
          Enviar
        </button>
      </div>
    </div>


    <?php //?Modal             
    ?>
    <div class="modal fade" id="staticBackdrop" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1" aria-labelledby="staticBackdropLabel" aria-hidden="true">
      <div class="modal-dialog modal-dialog-centered">
        <div class="modal-content">
          <div class="modal-header">
            <h1 class="modal-title fs-5" id="staticBackdropLabel">Usted esta a punto de
              <?php echo isset($id) ? "modificar" : "crear" ?> una mascota
            </h1>
            <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
          </div>
          <div class="modal-body">
            Esta seguro?
          </div>
          <div class="modal-footer">
            <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cancelar</button>
            <button type="submit" class="btn btn-primary" name="action" value="<?php echo isset($id) ? "updateEntity" : "createEntity" ?>">Si</button>
          </div>
        </div>
      </div>
    </div>
  </form>
</div>


<?php
if (isset($_POST['id'])) {
  require_once(__DIR__ . '/../../entity-dbs/mascotas/updateMascota.php');
  $_SESSION['currentPage'] = '../src/pages/abmMascota/abmListMascota.php';
  echo '<script>window.location.replace("index.php");</script>';
}
?>
<?php
if ($_SERVER['REQUEST_METHOD'] == 'POST') {
  if ($_POST['action'] == 'updateEntity') {
    if (isset($_SESSION["idMascota"])) {
      require_once(__DIR__ . '/../../entity-dbs/mascotas/updateMascota.php');
      $_SESSION['idMascota'] = null;
    }
  } elseif ($_POST['action'] == 'goBack') {
    $_SESSION['idMascota'] = null;
  } elseif ($_POST['action'] == 'createEntity') {
    require_once(__DIR__ . '/../../entity-dbs/mascotas/altaMascota.php');
  }

  $_SESSION['currentPage'] = '../src/pages/abmMascota/abmListMascota.php';
  if (isset($_SESSION['user_id'])) {
    $_SESSION['currentPage'] = '../src/pages/atencionDom/formAtencion.php';
  }

  echo '<script>window.location.replace("index.php");</script>';
  exit();
}
mysqli_close($conn);
?>