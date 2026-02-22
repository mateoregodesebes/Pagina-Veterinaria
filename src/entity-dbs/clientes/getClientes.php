<?php

include(__DIR__ . '/../../../includes/connection.php');

try {
  $query = "SELECT  p.id AS id,
                    CONCAT(p.nombre, ' ', p.apellido) AS nombre
              FROM personas p
                WHERE p.rol_id IS NULL";
  $result = mysqli_query($conn, $query);
  $clientes = array();

  if ($result->num_rows > 0) {
    while ($row = $result->fetch_assoc()) {
        array_push($clientes, $row);
      }
    }
    else {
    $clientes = null;
  }

} catch (Exception $e) {
  echo 'Caught exception: ', $e->getMessage(), "\n";
} finally {
  mysqli_close($conn);
}
?>