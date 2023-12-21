<?php

//! Falta corregir no tener de ejemplo
function Alta()
{
  require_once(__DIR__ . '/../includes/connection.php');

  $vNombre = $_POST['nombre'];
  $vFoto = $_POST['foto'];
  $vRaza = $_POST['raza'];
  $vColor = $_POST['color'];
  $vFechaNac = $_POST['fechaNac'];

  $stmt = $conn->prepare("INSERT INTO mascotas (nombre, foto, raza, color, fechaNac) 
                          VALUES (?, ?, ?, ?, ?)");

  if (!$stmt) {
    die("Error preparing statement: " . $conn->error);
  }
  $stmt->bind_param("sssss", $vNombre, $vFoto, $vRaza, $vColor, $vFechaNac);

  if (!$stmt->execute()) {
    die("Error: " . $stmt->error); // Check for execute() errors
  }

  $stmt->close();
  mysqli_close($conn);
}

?>