<?php

require_once(__DIR__ . '/../../../includes/connection.php');

try {
  $vId = $_POST['id'];
  $stmt = $conn->prepare("DELETE FROM personas WHERE id = ?");

  if (!$stmt) {
    throw new Exception("Error preparing statement: " . $conn->error);
  }
  $stmt->bind_param("i", $vId);

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