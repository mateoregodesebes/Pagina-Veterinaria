<?php
if (isset($_SESSION["user"])) {

?>
  <div class="container-fluid px-3">
    <div class="row py-5">
      <div class="col-3">
        <?php
        /* TODO: Agregar foto de perfil para el usuario.
        *   <img src="../assets/userImages/<?php echo $_SESSION['user_image'] ?>" class="img-fluid rounded-circle" alt="Imagen de perfil de <?php echo $_SESSION['user_name'] ?>">
        */
        ?>
      </div>
      <div class="col-9">
        <h1>
          <?php echo 'Hola ' . $_SESSION["user_name"]
          ?>
        </h1>
      </div>
    </div>

    <?php
    include __DIR__ . '/../../entity-dbs/clientes/mascotasCliente.php';

    if (!empty($mascotas)) {

      echo '<div class="row">';
      echo '<div class="col ps-2">';
      echo '<h2>Mis Mascotas:</h2>';
      echo '</div>';
      echo '</div>';
      foreach ($mascotas as $mascota) {
        echo '<div class="row pet-card my-3 mx-auto">';
        echo '<div class="col-12 col-md-3 foto-mascota">';
        echo '<img src="../assets/petImages/' . $mascota['foto'] . '" alt="Imagen de ' . $mascota['nombre'] . '">';
        echo '</div>';
        echo '<div class="col-12 col-md-5 pet-card_info">';
        echo '<h3><b>' . $mascota['nombre'] . '</b></h3>';
        echo '<p>Raza: <b>' . $mascota['raza'] . '</b></p>';
        echo '<p>Color: <b>' . $mascota['color'] . '</b></p>';
        echo '<p>Fecha de nacimiento: <b>' . $mascota['fecha_de_nac'] . '</b></p>';
        echo '</div>';
        echo '<div class="col-12 col-md-4 pet-card_action my-5">';
        echo '<form><button class="btn btn-info btn-lg">Realizar Consulta</button> </form>';
        echo '</div>';
        echo '</div>';
      }
    } else {
      echo '<div class="row">';
      echo '<div class="col ps-2">';
      echo '<h2>No tenes mascotas registradas para mostrar</h2>';
      echo '</div>';
      echo '</div>';
    }
    echo '</div>';
    ?>
  </div>
<?php
}
# Si el usuario no tiene cuenta y de alguna manera accedió a profile.php, lo reedirigimos a homepage
else {
  $_SESSION['currentPage'] = '../src/pages/homepage/homepage.php';
  echo '<script>window.location.replace("index.php");</script>';
  exit();
}
?>