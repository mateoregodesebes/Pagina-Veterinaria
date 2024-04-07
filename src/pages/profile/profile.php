<div class="container-fluid px-3">
  <div class="row py-5">
    <div class="col-3">

    </div>
    <div class="col-9">
      <h1>
        <?php echo 'Hola ' . $_SESSION["user_name"]
        ?>
      </h1>
    </div>
  </div>

  <div class="row">
    <div class="col ps-2">
      <h2>
        Mis Mascotas:
      </h2>
    </div>
  </div>

  <div class="row">
    <div class="col ps-2">
      <h2>
        Mis Mascotas:
      </h2>
    </div>
  </div>

  <?php
  require_once(__DIR__ . '/../../includes/connection.php');

  $stmt = $conn->prepare("SELECT * FROM mascotas WHERE id_usuario = ?");

  $stmt->bind_param("i", $_SESSION['user_id']);

  if (!$_SESSION['error']) {
    if (!$stmt->execute()) {
      throw new Exception("Error executing statement" . $stmt->error);
    }
  }
  $result = $stmt->get_result();

  $stmt->close();
  $mascotas = mysqli_fetch_assoc($result);

  foreach ($mascotas as $mascota) {
    echo '<div class="row">';
    echo '<div class="col-3">';
    echo '<img src="' . $mascota['foto'] . '" class="img-fluid" alt="Imagen de ' . $mascota['nombre'] . '">';
    echo '</div>';
    echo '<div class="col-9">';
    echo '<h3>' . $mascota['nombre'] . '</h3>';
    echo '<p>' . $mascota['raza'] . '</p>';
    echo '<p>' . $mascota['edad'] . ' años</p>';
    echo '<form><button class="btn btn-info">Realizar Consultar</button> </form>';
    echo '</div>';
    echo '</div>';
  }
  ?>
</div>