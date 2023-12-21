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
    </tr>
  </thead>
  <tbody>
    <?php $i = 0;
    while ($row = mysqli_fetch_array($result)): ?>
      <tr>
        <th scope="row">
          <?php $i ?>
        </th>
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
        <?php $i++ ?>
      </tr>
      <?php
    endwhile;
    mysqli_free_result($result);
    mysqli_close($conn);
    ?>
  </tbody>
</table>