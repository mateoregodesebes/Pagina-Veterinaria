<?php

include(__DIR__ . '/../../../includes/connection.php');

try {
  $vId = $_SESSION["user_id"];
  $stmt = $conn->prepare("SELECT * FROM mascotas WHERE cliente_id = ?");
  $mascotas = array();

  if (!$stmt) {
    throw new Exception("Error preparing statement: " . $conn->error);
  }
  $stmt->bind_param("i", $vId);

  if (!$stmt->execute()) {
    throw new Exception("Error executing statement" . $stmt->error);
  }

  $result = $stmt->get_result();
  if ($result->num_rows > 0) {
    while ($row = $result->fetch_assoc()) {
      array_push($mascotas, $row);
    }
  } else {
    $mascotas = null;
  }
  $stmt->close();
} catch (Exception $e) {
  echo 'Caught exception: ', $e->getMessage(), "\n";
} finally {
  mysqli_close($conn);
}
