<?php

include(__DIR__ . '/../../../includes/connection.php');

try {
  $query = "SELECT * FROM personal";
  $result = mysqli_query($conn, $query);
  $personal = array();

  if ($result->num_rows > 0) {
    while ($row = $result->fetch_assoc()) {
      array_push($personal, $row);
    }
  } else {
    $personal = null;
  }

} catch (Exception $e) {
  echo 'Caught exception: ', $e->getMessage(), "\n";
} finally {
  mysqli_close($conn);
}
?>