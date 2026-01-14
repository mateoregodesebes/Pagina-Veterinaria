<?php

require_once(__DIR__ . '/../../../includes/connection.php');

try {
  $vId = $_POST['idMascota'];
  $stmt = $conn->prepare("SELECT * FROM mascotas WHERE id = ?");

  if (!$stmt) {
    throw new Exception("Error preparing statement: " . $conn->error);
  }
  $stmt->bind_param("i", $vId);

  if (!$stmt->execute()) {
    throw new Exception("Error executing statement" . $stmt->error);
  }

  $result = $stmt->get_result();
  if ($result->num_rows > 0) {
    $mascota = $result->fetch_assoc();
  } else {
    $mascota = null;
  }

  $stmt->close();

} catch (Exception $e) {
  echo 'Caught exception: ', $e->getMessage(), "\n";
} finally {
  mysqli_close($conn);
}

?>