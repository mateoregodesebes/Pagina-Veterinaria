<?php
if (!isset($_SESSION['user_id'])) {
    $_SESSION['currentPage'] = '../src/pages/homepage/homepage.php';
    echo '<script>window.location.replace("index.php");</script>';
    exit();
} else {

    include __DIR__ . '/../../entity-dbs/atenciones/consultaTurnosPorProfesional.php';

    $validAppointments = array_column($appointments, 'id');
    $appointmentId = intval($_SESSION['appointmentToEdit']);
    if(in_array($appointmentId, $validAppointments)) {
      include __DIR__ . '/../../entity-dbs/atenciones/consultaTurnoPorId.php';
    }
    else {
      $_SESSION['currentPage'] = '../src/pages/viewAppointments/viewAppointments.php';
      echo "<br><div class='alert alert-danger mx-5 my-2' role='alert'>Ocurrió un error con el cargado del turno. Se recargará la página.</div>";
      echo "<script>
          setTimeout(function() {
              window.location.replace('index.php');
          }, 3000);
      </script>";
    }

  if(isset($_POST['action']) && $_POST['action'] === 'goBack') {
    $_SESSION['currentPage'] = '../src/pages/viewAppointments/viewAppointments.php';
    echo '<script>window.location.replace("index.php");</script>';
  } else if(isset($_POST['submit'])) {
    $titulo = $_POST['titulo'];
    $descripcion = $_POST['descripcion'];
    // Para usar esto es necesario que este seteado el $appointmentId tambien, pero eso ya esta seteado arriba.
    include __DIR__ . '/../../entity-dbs/atenciones/actualizarTituloYDescripcion.php';
    $_SESSION['appointmentToEdit'] = null;
    $_SESSION['currentPage'] = '../src/pages/viewAppointments/viewAppointments.php';
    echo "<br><div class='alert alert-success mx-5 my-2' role='alert'>Turno editado correctamente. Se recargará la página.</div>";
    echo "<script>
        setTimeout(function() {
            window.location.replace('index.php');
        }, 3000);
    </script>";
}
}
?>

<div class="row m-5 form-container">
  <form class="button-form" method="post">
      <div class="mb-3">
        <button class="button-back" type="submit" name="action" value="goBack"><i
            class="fa-solid fa-arrow-left"></i></button>
      </div>
  </form>
  <h2>Editar Turno</h2>
  <form method="post" action="index.php" enctype="multipart/form-data">
    <div class="row">
      <div class="col-12 main-inputs">
        <div class="info">
          
          <div class="form-group my-4">
              <label>Nombre de la mascota del turno: </label>
              <input type="text" class="form-control" name="nombre_mascota" required <?php echo isset($appointment['mascota_nombre']) ? 'value="' . $appointment['mascota_nombre'] . '"' : '' ?> disabled>
            </div>

          <div class="form-group my-4">
              <label>Fecha y hora del turno: </label>
              <input type="text" class="form-control" name="fecha_hora" required <?php echo isset($appointment['fecha_hora']) ? 'value="' . $appointment['fecha_hora'] . '"' : '' ?> disabled>
            </div>
          
          <div class="form-group my-4">
            <label>Servicio a realizar: </label>
            <input type="text" class="form-control" name="servicio_nombre" required <?php echo isset($appointment['servicio_nombre']) ? 'value="' .$appointment['servicio_nombre'] . '"' : '' ?> disabled>
          </div>
          
          <div class="form-group my-4">
            <label>Titulo del turno: </label>
            <input type="text" class="form-control" name="titulo" required <?php echo isset($appointment['titulo']) ? 'value="' . $appointment['titulo'] . '"' : '' ?> >
          </div>

          <div class="form-group my-4">
            <label>Descripcion del turno: </label>
              <textarea class="form-control" name="descripcion" required><?php echo isset($appointment['descripcion']) ? $appointment['descripcion'] : '' ?></textarea>
            </div>

        </div>
        <button type="submit" name="submit" class="btn btn-primary submit-btn mt-2">Enviar</button>
      </div>
      </div>
    </div>
  </form>
</div>