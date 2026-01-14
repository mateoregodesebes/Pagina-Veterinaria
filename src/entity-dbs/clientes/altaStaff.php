<?php

require_once(__DIR__ . '/../../../includes/connection.php');

try {
  $vNombre = $_POST['nombre'];
  $vApellido = $_POST['apellido'];
  $vEmail = $_POST['email'];
  $vCiudad = $_POST['ciudad'];
  $vDireccion = $_POST['direccion'];
  $vTelefono = $_POST['telefono'];
  $vContrasenia = $_POST['password'];
  $vRol = $_SESSION['idrol'];

  $vContrasenia_hash = password_hash($vContrasenia, PASSWORD_DEFAULT);

  $stmt = $conn->prepare("INSERT INTO personas (nombre, apellido, email, ciudad, direccion, telefono, clave, rol_id) 
                          VALUES (?, ?, ?, ?, ?, ?, ?, ?)");

  if (!$stmt) {
    throw new Exception("Error preparing statement: " . $conn->error);
  }
  $stmt->bind_param("sssssssi", $vNombre, $vApellido, $vEmail, $vCiudad, $vDireccion, $vTelefono, $vContrasenia_hash, $vRol);

  if (!$_SESSION['error']) {
    if (!$stmt->execute()) {
      throw new Exception("Error executing statement" . $stmt->error);
    }
  }

  $stmt->close();

} catch (Exception $e) {
  echo 'Caught exception: ', $e->getMessage(), "\n";
} finally {
  mysqli_close($conn);
}
?>