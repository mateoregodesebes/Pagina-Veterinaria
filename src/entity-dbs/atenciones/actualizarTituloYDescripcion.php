<?php

include(__DIR__ . '/../../../includes/connection.php');

if(isset($titulo) && isset($descripcion)) {
  try {
    $query = "UPDATE atenciones 
                      SET titulo = ?, 
                          descripcion = ?
                        WHERE id = ?";
    $stmt = $conn->prepare($query);
    
    if (!$stmt) {
      throw new Exception("Error preparing statement: " . $conn->error);
    }
    $stmt->bind_param("ssi", $titulo, $descripcion, $appointmentId);

    if (!$stmt->execute()) {
      throw new Exception("Error executing statement" . $stmt->error);
    }
    $stmt->close();

  } catch (Exception $e) {
    echo 'Caught exception: ', $e->getMessage(), "\n";
  } finally {
    mysqli_close($conn);
  }
}
?>