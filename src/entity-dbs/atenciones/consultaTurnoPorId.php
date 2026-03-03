<?php
// Query para obtener los turnos de un profesional

include(__DIR__ . '/../../../includes/connection.php');

if (isset($appointmentId)) {
  try{
      $stmt = $conn->prepare("SELECT  a.id AS id,
                                      a.fecha_hora AS fecha_hora,
                                      m.nombre AS mascota_nombre,
                                      s.nombre AS servicio_nombre,
                                      a.titulo AS titulo,
                                      a.descripcion AS descripcion,
                                      CONCAT(p.nombre, ' ', p.apellido) AS dueño_nombre
                                FROM atenciones a
                                INNER JOIN mascotas m ON m.id = a.mascota_id 
                                INNER JOIN servicios s ON s.id = a.servicio_id
                                INNER JOIN personas p ON p.id = m.cliente_id
                                  WHERE a.id = ?
                                  AND a.titulo != 'Turno cancelado'
                                  AND a.descripcion != 'Turno cancelado'");
      $stmt->bind_param("i", $appointmentId);
      $stmt->execute();
      $result = $stmt->get_result();
      $appointment = $result->fetch_assoc();
    } catch (Exception $e) {
        echo 'Caught exception: ', $e->getMessage(), "\n";
    } finally {
        mysqli_close($conn);
    }
}
else {
  $appointment = null;
}

?>