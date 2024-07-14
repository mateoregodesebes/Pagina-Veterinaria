<?php

require_once(__DIR__ . '/../../../includes/connection.php');
$vId = $_SESSION["idMascota"];
$query = "SELECT * FROM mascotas WHERE id = $vId";

try {
  $result = mysqli_query($conn, $query);
  if (!$result) {
    throw new Exception('Error, no existe la mascota: ' . mysqli_error($conn));
  }

  if ($_FILES["foto"]["error"] == UPLOAD_ERR_OK) {
    //? No hay errores, se selecciono archivo
    $targetDirectory = "../assets/petImages/";
    $targetFile = $targetDirectory . basename($_FILES["foto"]["name"]);
    if (move_uploaded_file($_FILES["foto"]["tmp_name"], $targetFile)) {
        echo "The file " . basename($_FILES["foto"]["name"]) . " has been uploaded.";
        $name = basename($_FILES["foto"]["name"]);
        $_SESSION['error'] = false;
    } else {
      $name = null;
      $_SESSION['error'] = true;
      echo "There was an error uploading the file.";
    }
  } elseif ($_FILES["foto"]["error"] == UPLOAD_ERR_NO_FILE) {
    //? No se seleccionó ningún archivo
    $query2 = "SELECT foto FROM mascotas WHERE id = $vId";
    $result2 = mysqli_query($conn, $query2);
    $row = mysqli_fetch_array($result2);
    $name = $row['foto'];
  } else {
    $name = null;
    $_SESSION['error'] = true;
    echo "An error occurred during the file upload.";
  }


  $vIdClient = $_POST['idCliente'];
  $vNombre = $_POST['nombre'];
  $vFoto = $name;
  $vRaza = $_POST['raza'];
  $vColor = $_POST['color'];
  //nunca deberia venir null porque es required
  if (!empty($_POST['fechaNac'])) {
    $date = DateTime::createFromFormat('Y-m-d', $_POST['fechaNac']);
    $vFechaNac = $date->format('Y-m-d');
  } else {
    $vFechaNac = null;
  }

  if (!empty($_POST['fechaMuerte'])) {
    $date = DateTime::createFromFormat('Y-m-d', $_POST['fechaMuerte']);
    $vFechaMuerte = $date->format('Y-m-d');
  } else {
    $vFechaMuerte = null;
  }

  $stmt = $conn->prepare("UPDATE mascotas SET cliente_id= ?, nombre = ?, foto = ?, raza = ?, color = ?, fecha_de_nac = ?, fecha_muerte = ? WHERE id = ?");

  if (!$stmt) {
    throw new Exception("Error preparing statement: " . $conn->error);
  }

  $stmt->bind_param("ssssssss", $vIdClient, $vNombre, $vFoto, $vRaza, $vColor, $vFechaNac, $vFechaMuerte, $vId);

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