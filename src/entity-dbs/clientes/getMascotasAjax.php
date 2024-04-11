<?php

include(__DIR__ . '/../../../includes/connection.php');

if(isset($_GET['idCliente'])){
  $idCliente = $_GET['idCliente'];
  $htmlMascotas = '';

  try{
    $stmt = $conn->prepare("SELECT * FROM mascotas WHERE cliente_id = ?");
    if(!$stmt){
      throw new Exception('Error en la conexion a la base de datos', $conn->error);
    }
    $stmt->bind_param('i', $idCliente);
    if(!$stmt->execute()){
      throw new Exception('Error en la ejecucion de la consulta', $stmt->error);
    }
    $result = $stmt->get_result();

    if($result->num_rows > 0){
    while($row = $result->fetch_assoc()){
      $htmlMascotas .= '<p>' . $row['nombre'] . ' - ' . $row['raza'] . '</p>';
    }
  } else {
    $htmlMascotas = '<p>No hay mascotas registradas</p>';
  }
  $stmt->close();
  mysqli_close($conn);
  echo $htmlMascotas;
  } catch (Exception $e){
    echo 'Error: ' . $e->getMessage();
  }
} else {
  echo 'Error: No se recibio el id del cliente';
}

?>
