<?php

include(__DIR__ . '/../../../includes/connection.php');

try {
  $query = 
  "SELECT per.id as idPersona, per.nombre as nombre, per.apellido as apellido, rol.nombre as nombreRol
    FROM personas per
    INNER JOIN roles rol on per.rol_id = rol.id
    WHERE rol.id <> 3";
  $result = mysqli_query($conn, $query);
  $personal = array();

  if ($result->num_rows > 0) {
    while ($row = $result->fetch_assoc()) {
      array_push($personal, $row);
    }
  } else {
    $personal = null;
  }

} catch (Exception $e) {
  echo 'Caught exception: ', $e->getMessage(), "\n";
} finally {
  mysqli_close($conn);
}
?>