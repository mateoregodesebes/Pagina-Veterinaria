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

$query = "SELECT * FROM mascotas WHERE id_usuario = ?";
$stmt = mysqli_prepare($conn, $query);

mysqli_stmt_bind_param($stmt, "i", $_SESSION['user_id']);

mysqli_stmt_execute($stmt);

$result = mysqli_stmt_get_result($stmt);

foreach ($result as $mascota) {
  echo '<div class="row">';
  echo '<div class="col-3">';
  echo '<img src="' . $mascota['foto'] . '" class="img-fluid" alt="Imagen de ' . $mascota['nombre'] . '">';
  echo '</div>';
  echo '<div class="col-9">';
  echo '<h3>' . $mascota['nombre'] . '</h3>';
  echo '<p>' . $mascota['raza'] . '</p>';
  echo '<p>' . $mascota['edad'] . ' años</p>';
  echo '</div>';
  echo '</div>';
}
?>