<?php

include(__DIR__ . '/../../../includes/connection.php');

try {
  $query = "SELECT fecha_hora FROM atenciones";
  $result = mysqli_query($conn, $query);
  $horario_atenciones = array();

  if ($result->num_rows > 0) {
    while ($row = $result->fetch_assoc()) {
      $fecha_hora = strtotime($row['fecha_hora']);
      if($fecha_hora >= strtotime(date('d-m-Y H:i'))){
        $row['fecha_hora'] = date('d-m-Y H:i', $fecha_hora);
        array_push($horario_atenciones, $row);
      }
    }
  } else {
    $horario_atenciones = null;
  }

} catch (Exception $e) {
  echo 'Caught exception: ', $e->getMessage(), "\n";
} finally {
  mysqli_close($conn);
}
?>