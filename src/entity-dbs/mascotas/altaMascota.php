<?php

require_once(__DIR__ . '../../includes/connection.php');

try {
  $vNombre = $_POST['nombre'];
  $vFoto = $_POST['foto'];
  $vRaza = $_POST['raza'];
  $vColor = $_POST['color'];
  $vFechaNac = $_POST['fechaNac'];
  $stmt = $conn->prepare("INSERT INTO mascotas (nombre, foto, raza, color, fecha_de_nac) 
                          VALUES (?, ?, ?, ?, ?)");

  if (!$stmt) {
    throw new Exception("Error preparing statement: " . $conn->error);
  }
  $stmt->bind_param("sssss", $vNombre, $vFoto, $vRaza, $vColor, $vFechaNac);

  if (!$stmt->execute()) {
    throw new Exception("Error executing statement" . $stmt->error);
  }

  $stmt->close();

} catch (Exception $e) {
  echo 'Caught exception: ', $e->getMessage(), "\n";
} finally {
  mysqli_close($conn);
}

mysqli_close($conn);
?>