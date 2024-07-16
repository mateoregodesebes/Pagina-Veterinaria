<?php

require_once(__DIR__ . '/../../../includes/connection.php');
$vId = $_SESSION["idCliente"];
$query = "SELECT * FROM clientes WHERE id = $vId";

try {
  $result = mysqli_query($conn, $query);
  if (!$result) {
    throw new Exception('Error, no existe el cliente: ' . mysqli_error($conn));
  }

  $vIdClient = $_SESSION["idCliente"];
  $vNombre = $_POST['nombre'];
  $vApellido = $_POST['apellido'];
  $vEmail = $_POST['email'];
  $vCiudad = $_POST['ciudad'];
  $vDireccion = $_POST['direccion'];
  $vTelefono = $_POST['telefono'];

  $stmt = $conn->prepare("UPDATE clientes SET id = ?, nombre = ?, apellido = ?, email = ?, ciudad = ?, direccion = ?, telefono = ? WHERE id = ?");

  if (!$stmt) {
    throw new Exception("Error preparing statement: " . $conn->error);
  }

  $stmt->bind_param("ssssssss", $vIdClient, $vNombre, $vApellido, $vEmail, $vCiudad, $vDireccion, $vTelefono, $vId);

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