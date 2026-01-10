<?php
include (__DIR__ . '/../../../includes/connection.php');
$vId = $_SESSION["idTurno"];
//Convirtiendo en DateTime
$hours = intval($_POST['hora']);
$minutes = ($_POST['hora'] * 60) % 60;
$date = new DateTime($_POST['fecha']);
$date->setTime($hours, $minutes);
$dateString = $date->format('Y-m-d H:i:s');

try {
  $vIdTurno = $_SESSION["idTurno"];
  $vMascotaId = $_POST['mascotas'];
  $vServicioId = $_POST['servicios'];
  $vPersonalId = $_POST['personal'];
  $vTitulo = $_POST['titulo'];
  $vDescripcion = $_POST['descripcion'];
  $vFecha = $dateString;


  $stmt = $conn->prepare("UPDATE atenciones SET mascota_id=?, servicio_id=?, personal_id=?, fecha_hora=?, titulo=?, descripcion=? WHERE id=?");

  if (!$stmt) {
    throw new Exception("Error preparing statement: " . $conn->error);
  }
  $stmt->bind_param("iiisssi", $vMascotaId, $vServicioId, $vPersonalId, $vFecha, $vTitulo, $vDescripcion, $vIdTurno);

  if (!$stmt->execute()) {
    throw new Exception("Error executing statement" . $stmt->error);
  }

  $stmt->close();

} catch (Exception $e) {
  echo 'Caught exception: ', $e->getMessage(), "\n";
  $_SESSION['alerta'] = 'errorTurno';
} finally {
  mysqli_close($conn);
}





?>