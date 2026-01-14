<?php
if (!isset($_SESSION["user_id"])) {
    $_SESSION['currentPage'] = '../src/pages/homepage/homepage.php';
    echo '<script>window.location.replace("index.php");</script>';
    exit();
}
  else {
    if ($_SERVER["REQUEST_METHOD"] == "POST" && isset($_POST["submit"])) {
      $_POST['idCliente'] = $_SESSION["user_id"];
      if(isset($_SESSION['idMascota']) && $_SESSION['idMascota'] != '') {
        // Editar mascota
        require_once(__DIR__ . '/../../entity-dbs/mascotas/updateMascota.php');
        echo "<br><div class='alert alert-success mx-5 my-2' role='alert'>La mascota ha sido editada de manera satisfactoria. Se te redirigirá a la página de tu perfil.</div>";
      }
      else {
        // Agregar mascota
        require_once(__DIR__ . '/../../entity-dbs/mascotas/altaMascota.php');
        echo "<br><div class='alert alert-success mx-5 my-2' role='alert'>La mascota ha sido agregada de manera satisfactoria. Se te redirigirá a la página de tu perfil.</div>";
      }
      $_SESSION['currentPage'] = '../src/pages/profile/profile.php';
      echo "<script>
            setTimeout(function() {
                window.location.replace('index.php');
            }, 5000);
            </script>";
      exit();
    }

    # Se determina si se está agregando o editando una mascota
    if (isset($_SESSION['idMascota']) && $_SESSION['idMascota'] != '') {
      //?Editar mascota
      $_POST['idMascota'] = $_SESSION['idMascota'];
      include __DIR__ . '/../../entity-dbs/mascotas/consultaMascotaPorId.php';
      $fotoPreview = $mascota['foto'] != '' ? $mascota['foto'] : 'defaultPetImage.png';
    } else {
      //?Agregar mascota
      $fotoPreview = 'defaultPetImage.png';
    }

  //?Colores de mascotas actuales
  $colors = ['Blanco', 'Negro', 'Marron', 'Amarillo', 'Potus', 'Verde', 'Naranja'];
?>
<div class="row m-5 pet-container">
  <h2><?php echo $_SESSION['idMascota'] == '' ? "Agregar Mascota": "Editar Mascota" ?></h2>
  <form method="post" action="index.php" enctype="multipart/form-data">
    <div class="row">
      <div class="col-12 main-inputs">
        <div class="pet-info">
          <div class="form-group my-4">
            <label>Ingrese el nombre de la mascota: </label>
            <input type="text" class="form-control" name="nombre" required <?php echo isset($mascota['nombre']) ? 'value="' . $mascota['nombre'] . '"' : '' ?>>
          </div>

          <div class="form-group my-4">
            <label>Ingrese la raza de la mascota: </label>
            <input type="text" class="form-control" name="raza" required <?php echo isset($mascota['raza']) ? 'value="' . $mascota['raza'] . '"' : '' ?>>
          </div>

          <div class="form-group my-4">
            <label>Ingrese el color de la mascota: </label>
            <select class="form-control" name="color" required>
              <option value="" disabled selected>Seleccione un color</option>
              <?php foreach ($colors as $color): ?>
                <option value="<?= $color ?>" <?php echo isset($mascota['color']) && $mascota['color'] == $color ? 'selected' : '' ?>><?= $color ?></option>
              <?php endforeach; ?>
            </select>
          </div>

          <div class="form-group my-4">
            <label>Ingrese la fecha de nacimiento de la mascota: </label>
            <input type="date" class="form-control" name="fechaNac" max=<?php echo date('Y-m-d'); ?> required <?php echo isset($mascota['fecha_de_nac']) ? 'value="' . $mascota['fecha_de_nac'] . '"' : '' ?>>
          </div>

          <div class="my-4">
            <label for="formFile" class="form-label">Foto de la mascota</label>
            <div class="img-Mascota d-flex justify-content-center">
              <img src="../assets/petImages/<?php echo isset($mascota['foto']) ? $mascota['foto'] : $fotoPreview ?>" class="img-thumbnail img-fluid" alt="">
            </div>
            <input class="form-control" name="foto" type="file" id="formFile" accept="image/png" />
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