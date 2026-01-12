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

  # Primero reviso si el personal ya tiene una atención en esa fecha y hora. No puede tener dos turnos al mismo tiempo.
  $checkStmt = $conn->prepare("SELECT COUNT(*) FROM atenciones WHERE personal_id = ? AND fecha_hora = ?");
  if (!$checkStmt) {
    throw new Exception("Error preparing statement: " . $conn->error);
  }
  $checkStmt->bind_param("is", $vPersonalId, $vFecha);
  if (!$checkStmt->execute()) {
    throw new Exception("Error executing statement: " . $checkStmt->error);
  }
  $checkStmt->bind_result($count);
  $checkStmt->fetch();
  $checkStmt->close();
  if ($count > 0) {
    throw new Exception("El personal seleccionado ya tiene una atención programada para la fecha y hora indicadas.");
  }

  # Si no hay conflictos, procedo a insertar el nuevo turno.
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