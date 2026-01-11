<?php
// Query AJAX para obtener el personal según el servicio seleccionado

include(__DIR__ . '/../../../includes/connection.php');

if (isset($_POST['servicio_id'])) {
  $servicio_id = intval($_POST['servicio_id']);

  // Mapear servicio_id a rol_id
  if(in_array($servicio_id, array(1, 3))){
    $rol_id = 2; // Peluquero
  }
  else {
    $rol_id = 1; // Veterinario
  }

  $stmt = $conn->prepare("SELECT id, nombre, apellido FROM personas WHERE rol_id = ?");
  $stmt->bind_param("i", $rol_id);
  $stmt->execute();
  $result = $stmt->get_result();
  $professionals = [];
  while ($row = $result->fetch_assoc()) {
      $professionals[] = $row;
  }
  echo json_encode($professionals);
}
?>