<?php
include (__DIR__ . '/../../../includes/connection.php');

//Convirtiendo en DateTime
$hours = intval($_POST['hora']);
$minutes = ($_POST['hora'] * 60) % 60;
$date = new DateTime($_POST['fecha']);
$date->setTime($hours, $minutes);
$dateString = $date->format('Y-m-d H:i:s');

try {
  $vMascotaId = $_POST['mascotas'];
  $vServicioId = $_POST['servicios'];
  $vPersonalId = $_POST['personal'];
  $vTitulo = $_POST['titulo'];
  $vDescripcion = $_POST['descripcion'];
  $vFecha = $dateString;


  $stmt = $conn->prepare("INSERT INTO atenciones (mascota_id, servicio_id, personal_id, fecha_hora, titulo, descripcion) 
                          VALUES (?, ?, ?, ?, ?, ?)");

  if (!$stmt) {
    throw new Exception("Error preparing statement: " . $conn->error);
  }
  $stmt->bind_param("iiisss", $vMascotaId, $vServicioId, $vPersonalId, $vFecha, $vTitulo, $vDescripcion);

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