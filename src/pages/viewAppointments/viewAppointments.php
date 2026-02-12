<?php
if (!isset($_SESSION["user_id"])) {
    $_SESSION['currentPage'] = '../src/pages/homepage/homepage.php';
    echo '<script>window.location.replace("index.php");</script>';
    exit();
}
else {
  $esPeluquero = $_SESSION['user_role'] === 'Peluquero';
  $esVeterinario = $_SESSION['user_role'] === 'Veterinario';

  if ($_SESSION['user_role'] === 'cliente') {
    include __DIR__ . '/../../entity-dbs/atenciones/consultaTurnosPorUsuario.php';
  }
  else{
    include __DIR__ . '/../../entity-dbs/atenciones/consultaTurnosPorProfesional.php';
  }
  
  if(isset($_POST['cancelAppointment'])) {
    $appointmentIdsForUser = array_column($appointments, 'id');
    if(!in_array($_POST['formAppointmentId'], $appointmentIdsForUser)) {
      echo "<br><div class='alert alert-danger mx-5 my-2' role='alert'>Ocurrió un error con el cargado de turnos. Se recargará la página.</div>";
    }
    else {
      $appointmentId = $_POST['formAppointmentId'];
      include __DIR__ . '/../../entity-dbs/atenciones/cancelarTurno.php';
      echo "<br><div class='alert alert-success mx-5 my-2' role='alert'>Turno cancelado correctamente.</div>";
    }
    echo "<script>
        setTimeout(function() {
            window.location.replace('index.php');
        }, 3000);
    </script>";
  }
  elseif(isset($_POST['action']) && $_POST['action'] === 'goBack') {
    $_SESSION['currentPage'] = '../src/pages/profile/profile.php';
    echo '<script>window.location.replace("index.php");</script>';
  }
?>

<script>
// Script para pasar el ID del turno al form cancelar al modal
document.addEventListener('DOMContentLoaded', function () {

  const cancelButton = document.getElementById('cancelAppointmentBtn');

  cancelButton.addEventListener('click', function () {
    const appointmentId = document.getElementById('appointmentId').value;
    const formAppointmentId = document.getElementById('formAppointmentId');

    formAppointmentId.value = appointmentId;
  })
});
</script>

<div class="row m-5 appointment-container">
    <form class="button-form" method="post">
      <div class="mb-3">
        <button class="button-back" type="submit" name="action" value="goBack"><i
            class="fa-solid fa-arrow-left"></i></button>
      </div>
    </form>
  <h2>Listado de turnos</h2>
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
                <th><?= ($esPeluquero || $esVeterinario) ? "Dueño" : "Personal" ?></th>
                <th>Acciones</th>
              </tr>
            </thead>
            <tbody>
          <?php foreach ($appointments as $appointment): ?>
            <tr>
              <td><?= htmlspecialchars(substr($appointment['fecha_hora'], 0, 10)) ?></td>
              <td><?= htmlspecialchars(substr($appointment['fecha_hora'], 11, 5)) ?></td>
              <td><?= htmlspecialchars($appointment['mascota_nombre']) ?></td>
              <td><?= htmlspecialchars($appointment['servicio_nombre']) ?></td>
              <td><?= ($esPeluquero || $esVeterinario) ? htmlspecialchars($appointment['dueño_nombre']) : htmlspecialchars($appointment['personal_nombre']) ?></td>
              <td class="d-flex justify-content-center">
                <input type="hidden" id="appointmentId" value="<?= $appointment['id'] ?>">
                  <button name="cancelAppointment" id="cancelAppointmentBtn" data-bs-toggle="modal" data-bs-target="#cancelAppointmentModal" class="btn btn-danger btn-sm">Cancelar Turno</button>
              </td>
            </tr>
          <?php endforeach; ?>
            <tbody>
          </table>
        </div>
      </div>
      </div>
    </div>
</div>

<!-- Modal -->
<div class="modal fade" id="cancelAppointmentModal" tabindex="-1" aria-labelledby="cancelAppointmentModalLabel" aria-hidden="true">
  <div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-header">
        <h1 class="modal-title fs-5" id="cancelAppointmentModalLabel">Cancelar Turno</h1>
        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
      </div>
      <div class="modal-body">
        ¿Está seguro que desea cancelar este turno?
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Volver</button>
        <form method="POST" action="index.php">
          <input type="hidden" name="formAppointmentId" id="formAppointmentId" />
          <button type="submit" name="cancelAppointment" class="btn btn-danger">Confirmar Cancelación</button>
        </form>
      </div>
    </div>
  </div>
</div>


<?php
}
?>