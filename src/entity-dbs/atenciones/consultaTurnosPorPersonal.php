<?php
// Query AJAX para obtener los turnos de un profesional

include(__DIR__ . '/../../../includes/connection.php');

if (isset($_POST['personal_id'])) {
  $personal_id = intval($_POST['personal_id']);

  $stmt = $conn->prepare("SELECT fecha_hora FROM atenciones WHERE personal_id = ?");
  $stmt->bind_param("i", $personal_id);
  $stmt->execute();
  $result = $stmt->get_result();
  $appointments = [];
  while ($row = $result->fetch_assoc()) {
      $appointments[] = $row;
  }
  echo json_encode($appointments);
}
?>