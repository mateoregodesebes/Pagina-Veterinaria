<?php
require_once(__DIR__ . '/../../../includes/connection.php');

$query = "SELECT ate.id, 
  mas.nombre AS mascota_nombre, 
  ser.nombre AS servicio_nombre,
  ate.fecha_hora AS fecha_hora,
  ate.titulo AS titulo,
  ate.descripcion AS descripcion
  FROM atenciones ate
  INNER JOIN mascotas mas ON ate.mascota_id = mas.id
  INNER JOIN servicios ser ON ate.servicio_id = ser.id
    WHERE (servicio_id = 1 OR servicio_id = 3) 
    AND personal_id = {$_SESSION["user_id"]} 
  ORDER BY id";

$result = mysqli_query($conn, $query);
?>
<h3 class="mt-3"> Turnos </h3>
<table class="table table-bordered border-3 table-hover table-striped">
  <thead>
    <tr>
      <th scope="col">ID</th>
      <th scope="col">Nombre Mascota</th>
      <th scope="col">Servicio</th>
      <th scope="col">Fecha y Hora</th>
      <th scope="col">Titulo</th>
      <th scope="col">Descripcion</th>
    </tr>
  </thead>
  <tbody>
    <?php while ($row = mysqli_fetch_array($result)): ?>
      <tr>
        <td>
          <?= $row['id'] ?>
        </td>
        <td>
          <?= $row['mascota_nombre'] ?>
        </td>
        <td>
          <?= $row['servicio_nombre'] ?>
        </td>
        <td>
          <?= $row['fecha_hora'] ?>
        </td>
        <td>
          <?= $row['titulo'] ?>
        </td>
        <td>
          <?= $row['descripcion'] ?>
        </td>
    </tr>
    <?php 
    endwhile; 
    mysqli_free_result($result);
    ?>
  </tbody>
</table>

<?php
mysqli_close($conn);
?>