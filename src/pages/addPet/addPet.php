<?php
if (!isset($_SESSION["user_id"])) {
    $_SESSION['currentPage'] = '../src/pages/homepage/homepage.php';
    echo '<script>window.location.replace("index.php");</script>';
    exit();
}
  else {
  //?Colores de mascotas actuales
  $colors = ['Blanco', 'Negro', 'Marron', 'Amarillo', 'Potus', 'Verde', 'Naranja']

?>
<div class="row m-5 pet-container">
  <h2>Agregar Mascota</h2>
  <form method="post" action="index.php">
    <div class="row">
      <div class="col-12 main-inputs">
        <div class="pet-info">
          <div class="form-group my-4">
            <label>Ingrese el nombre de la mascota: </label>
            <input type="text" class="form-control" name="nombre_mascota" required>
          </div>

          <div class="form-group my-4">
            <label>Ingrese la raza de la mascota: </label>
            <input type="text" class="form-control" name="raza_mascota" required>
          </div>

          <div class="form-group my-4">
            <label>Ingrese el color de la mascota: </label>
            <select class="form-control" name="color_mascota" required>
              <option value="" disabled selected>Seleccione un color</option>
              <?php foreach ($colors as $color): ?>
                <option value="<?= $color ?>"><?= $color ?></option>
              <?php endforeach; ?>
            </select>
          </div>

          <div class="form-group my-4">
            <label>Ingrese la fecha de nacimiento de la mascota: </label>
            <input type="date" class="form-control" name="fecha_nacimiento_mascota" max=<?php echo date('Y-m-d'); ?> required>
          </div>

          <div class="my-4" <?php if (isset($idAtencion)) echo 'style="display: none;"' ?>>
            <label for="formFile" class="form-label">Foto de la mascota</label>
            <div class="img-Mascota d-flex justify-content-center">
              <img src="../assets/petImages/<?php echo $fotoPreview ?>" class="img-thumbnail img-fluid" alt="" <?php if (!isset($_SESSION['idMascota']))
                echo 'style="display: none;"' ?>>
            </div>
            <input class="form-control" name="foto" type="file" id="formFile" accept="image/png" />
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