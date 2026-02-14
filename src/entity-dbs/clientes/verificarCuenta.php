<?php

require_once(__DIR__ . '/../../../includes/connection.php');

try {
  // $userId viene de urlParamsHandler.php, se asigna a una variable local para evitar problemas de scope
  $vId = $userId;

  $stmt = $conn->prepare("UPDATE personas 
                            SET is_verified = True, 
                                verification_token_hash = NULL, 
                                verification_expires_at = NULL 
                                  WHERE id = ?");

  if (!$stmt) {
    throw new Exception("Error preparing statement: " . $conn->error);
  }

  $stmt->bind_param("i", $vId);

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