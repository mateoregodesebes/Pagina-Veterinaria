<?php

require_once(__DIR__ . '../../includes/connection.php');
$vId = $_POST['id'];
$query = "SELECT * FROM mascotas WHERE id = $vId";

try {
  $result = mysqli_query($conn, $query);
  if (!$result) {
    throw new Exception('Error, no existe la mascota: ' . mysqli_error($conn));
  }


  $vNombre = $_POST['nombre'];
  $vFoto = $_POST['foto'];
  $vRaza = $_POST['raza'];
  $vColor = $_POST['color'];
  $vFechaNac = $_POST['fechaNac'];
  if (isset($_POST['fechaMuerte'])) {
    $vFechaMuerte = $_POST['fechaMuerte'];
  } else {
    $vFechaMuerte = null;
  }

  $stmt = $conn->prepare("UPDATE mascotas SET nombre = ?, foto = ?, raza = ?, color = ?, fecha_de_nac = ?, fecha_muerte = ? WHERE id = ?");

  if (!$stmt) {
    throw new Exception("Error preparing statement: " . $conn->error);
  }

  $stmt->bind_param("sssssss", $vNombre, $vFoto, $vRaza, $vColor, $vFechaNac, $vFechaMuerte, $vId);

  if (!$stmt->execute()) {
    throw new Exception("Error executing statement" . $stmt->error);
  }

  $stmt->close();
} catch (Exception $e) {
  echo 'Caught exception: ', $e->getMessage(), "\n";
} finally {
  mysqli_close($conn);
}

?>