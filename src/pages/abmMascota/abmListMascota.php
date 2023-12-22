<?php
require_once(__DIR__ . '/../../../includes/connection.php');
$query = "SELECT * FROM mascotas";
$result = mysqli_query($conn, $query);

?>
<table class="table table-hover table-striped-columns">
  <thead>
    <tr>
      <th scope="col">#</th>
      <th scope="col">Nombre</th>
      <th scope="col">Raza</th>
      <th scope="col">Color</th>
      <th scope="col">Fecha Nac</th>
      <th scope="col">Fecha Muerte</th>
      <th scope="col"></th>
      <th scope="col"></th>
    </tr>
  </thead>
  <tbody>
    <?php while ($row = mysqli_fetch_array($result)): ?>
      <tr>
        <td>
          <?= $row['id'] ?>
        </td>
        <td>
          <?= $row['nombre'] ?>
        </td>
        <td>
          <?= $row['raza'] ?>
        </td>
        <td>
          <?= $row['color'] ?>
        </td>
        <td>
          <?= $row['fecha_de_nac'] ?>
        </td>
        <td>
          <?= $row['fecha_muerte'] ?>
        </td>
        <td>
          <form method="post">
            <input type="hidden" name="id" value="<?= $row['id'] ?>">
            <button type="submit" name="action" value="update" class="btn btn-success">Update</button>
            <button type="submit" name="action" value="delete" class="btn btn-danger">Delete</button>
          </form>
        </td>
      </tr>
      <?php
    endwhile;
    mysqli_free_result($result);
    ?>
  </tbody>
</table>

<?php
if ($_SERVER['REQUEST_METHOD'] == 'POST') {
  if ($_POST['action'] == 'update') {
    echo $_POST['id'];
    header('Location: abmFormMascota.php');
  } elseif ($_POST['action'] == 'delete') {
    require_once(__DIR__ . '/../../entity-dbs/mascotas/bajaMascota.php');
    echo '<script>window.location.replace("index.php");</script>';
    exit();
  }
}
mysqli_close($conn);
?>