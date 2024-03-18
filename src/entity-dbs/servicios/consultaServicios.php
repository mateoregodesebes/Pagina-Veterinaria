<?php

include(__DIR__ . '/../../../includes/connection.php');

try {
  $query = "SELECT * FROM servicios";
  $result = mysqli_query($conn, $query);
  $servicios = array();

  if ($result->num_rows > 0) {
    while ($row = $result->fetch_assoc()) {
      array_push($servicios, $row);
    }
  } else {
    $servicios = null;
  }

} catch (Exception $e) {
  echo 'Caught exception: ', $e->getMessage(), "\n";
} finally {
  mysqli_close($conn);
}
?>