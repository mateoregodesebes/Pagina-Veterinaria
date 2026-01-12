<?php
if (!isset($_SESSION["user_id"])) {
    $_SESSION['currentPage'] = '../src/pages/homepage/homepage.php';
    echo '<script>window.location.replace("index.php");</script>';
    exit();
}
else {
  include __DIR__ . '/../../entity-dbs/atenciones/consultaTurnosPorUsuario.php';
?>

<div class="row m-5 appointment-container">
  <h2>Listado de turnos</h2>
  <form method="post" action="index.php">
    <div class="row">
      <div class="col-12 main-info">
        <div class="appointment-info">
          <table class="table table-striped">
            <thead>
              <tr>
                <th>Fecha</th>
                <th>Hora</th>
                <th>Mascota</th>
                <th>Servicio</th>
                <th>Personal</th>
              </tr>
            </thead>
            <tbody>
          <?php foreach ($appointments as $appointment): ?>
            <tr>
              <td><?= htmlspecialchars(substr($appointment['fecha_hora'], 0, 10)) ?></td>
              <td><?= htmlspecialchars(substr($appointment['fecha_hora'], 11, 5)) ?></td>
              <td><?= htmlspecialchars($appointment['mascota_nombre']) ?></td>
              <td><?= htmlspecialchars($appointment['servicio_nombre']) ?></td>
              <td><?= htmlspecialchars($appointment['personal_nombre']) ?></td>
            </tr>
          <?php endforeach; ?>
            <tbody>
          </table>
        </div>
      </div>
      </div>
    </div>
  </form>
</div>

<?php
}
?>