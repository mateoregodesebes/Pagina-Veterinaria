<?php

include(__DIR__ . '/../../../includes/connection.php');

if (isset($_SESSION['user_id'])) {
  try {
  $usuario_id = intval($_SESSION['user_id']);

  $stmt = $conn->prepare("SELECT  a.fecha_hora AS fecha_hora, 
                                  m.nombre AS mascota_nombre,
                                  s.nombre AS servicio_nombre,
                                  CONCAT(p.nombre, ' ', p.apellido) AS personal_nombre
                            FROM mascotas m
                            INNER JOIN atenciones a ON m.id = a.mascota_id 
                            INNER JOIN servicios s ON s.id = a.servicio_id
                            INNER JOIN personas p ON p.id = a.personal_id
                              WHERE cliente_id = ?
                              AND fecha_hora >= NOW()");
  $stmt->bind_param("i", $usuario_id);
  $stmt->execute();
  $result = $stmt->get_result();
  $appointments = [];
  while ($row = $result->fetch_assoc()) {
      $appointments[] = $row;
  }
  } catch (Exception $e) {
    echo 'Caught exception: ', $e->getMessage(), "\n";
  } finally {
    mysqli_close($conn);
  }
}
else {
  $appointments = [];
}
?>