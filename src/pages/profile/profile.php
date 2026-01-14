<?php
if (!isset($_SESSION["user"])) {
  $_SESSION['currentPage'] = '../src/pages/homepage/homepage.php';
    echo '<script>window.location.replace("index.php");</script>';
    exit();
}
  else{
  if ($_SERVER["REQUEST_METHOD"] == "POST") {
    if (isset($_POST["requestAppointment"])) {
      $_SESSION['mascota_id'] = $_POST['requestAppointment'] ?? null;
      $_SESSION['currentPage'] = '../src/pages/requestAppointment/requestAppointment.php';
      echo '<script>window.location.replace("index.php");</script>';
      exit();
    }
    elseif (isset($_POST["viewAppointments"])) {
      $_SESSION['currentPage'] = '../src/pages/viewAppointments/viewAppointments.php';
      echo '<script>window.location.replace("index.php");</script>';
      exit();
    }
    elseif (isset($_POST["addPet"])) {
      $_SESSION['idMascota'] = $_POST['addPet'] ?? null;

      $_SESSION['currentPage'] = '../src/pages/addPet/addPet.php';
      echo '<script>window.location.replace("index.php");</script>';
      exit();
    }
  }

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
      <div class="col-12 my-3 actions-section d-flex flex-column justify-content-around">
        <h2>Acciones:</h2>
        <div class="d-flex justify-content-around">
          <div>
            <form action="index.php" method="post">
              <button class="btn btn-warning btn-lg" name="requestAppointment" type="submit">Pedir Turno</button>
            </form>
          </div>
          <div>
            <form action="index.php" method="post">
            <button class="btn btn-info btn-lg" name="viewAppointments" type="submit">Ver Turnos</button>
          </form>
          </div>
          <div>
            <form action="index.php" method="post">
            <button class="btn btn-primary btn-lg" name="addPet" type="submit">Agregar Mascota</button>
          </form>
          </div>
      </div>
    </div>
    <div class="pets-section my-1">
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
          echo '<form action="index.php" method="post"><button class="btn btn-info btn-lg" name="requestAppointment" value="' . $mascota['id'] . '">Realizar Consulta</button> </form>';
          echo '<form class="mt-2 mx-5" action="index.php" method="post"><button class="btn btn-secondary btn-sm" name="addPet" value="' . $mascota['id'] . '">Editar Mascota</button> </form>';
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
  </div>
<?php
}
?>