<?php

require_once(__DIR__ . '/../../../includes/connection.php');

try {
  /* The id is autoincremental, so we don't need to pass it 
  * ToDo: There should be a checks to see if everything is correctly. E.g.: if the email is already in use, if the phone number is already in use, etc.
  * ToDo: The password should be hashed, stored in some variable and then sent into the db.
  */
  $vIdClient = $_POST['idCliente'];
  $vNombre = $_POST['nombre'];
  $vApellido = $_POST['apellido'];
  $vEmail = $_POST['email'];
  $vCiudad = $_POST['ciudad'];
  $vDireccion = $_POST['direccion'];
  $vTelefono = $_POST['telefono'];


  $stmt = $conn->prepare("INSERT INTO clientes (id, nombre, apellido, email, ciudad, direccion, telefono) 
                          VALUES (?, ?, ?, ?, ?, ?, ?)");

  if (!$stmt) {
    throw new Exception("Error preparing statement: " . $conn->error);
  }
  $stmt->bind_param("sssssss", $vIdClient, $vNombre, $vApellido, $vEmail, $vCiudad, $vDireccion, $vTelefono);

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