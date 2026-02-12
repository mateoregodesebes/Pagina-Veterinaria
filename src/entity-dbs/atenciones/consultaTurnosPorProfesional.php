<?php
// Query para obtener los turnos de un profesional

include(__DIR__ . '/../../../includes/connection.php');

if (isset($_SESSION['user_id'])) {
  try{
    $personal_id = intval($_SESSION['user_id']);

      $stmt = $conn->prepare("SELECT  a.id AS id,
                                      a.fecha_hora AS fecha_hora, 
                                      m.nombre AS mascota_nombre,
                                      s.nombre AS servicio_nombre,
                                      CONCAT(p.nombre, ' ', p.apellido) AS dueño_nombre
                                FROM atenciones a
                                INNER JOIN mascotas m ON m.id = a.mascota_id 
                                INNER JOIN servicios s ON s.id = a.servicio_id
                                INNER JOIN personas p ON p.id = m.cliente_id
                                  WHERE personal_id = ?
                                  AND titulo != 'Turno cancelado'
                                  AND descripcion != 'Turno cancelado'");
      $stmt->bind_param("i", $personal_id);
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