<?php

//?Podria ver si se mueve la carpeta padre de este archivo(entity-dbs) a la carpeta abmMascotas
//?Para una coherencia con respecto a contact

require_once(__DIR__ . '/../../../includes/connection.php');

try {
  $targetDirectory = "../assets/petImages/";
  $targetFile = $targetDirectory . basename($_FILES["foto"]["name"]);
  if (move_uploaded_file($_FILES["foto"]["tmp_name"], $targetFile)) {
    echo "The file " . basename($_FILES["foto"]["name"]) . " has been uploaded.";
    $name = basename($_FILES["foto"]["name"]);
    $_SESSION['error'] = false;
  } elseif(isset($_SESSION['user_idAt'])){
    $name = "Provisional, subir foto";
  } else {
    $name = null;
    $_SESSION['error'] = true;
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

  $stmt = $conn->prepare("INSERT INTO mascotas (cliente_id, nombre, foto, raza, color, fecha_de_nac) 
                          VALUES (?, ?, ?, ?, ?, ?)");

  if (!$stmt) {
    throw new Exception("Error preparing statement: " . $conn->error);
  }
  $stmt->bind_param("ssssss", $vIdClient, $vNombre, $vFoto, $vRaza, $vColor, $vFechaNac);

  if (!$_SESSION['error']) {
    if (!$stmt->execute()) { throw new Exception("Error executing statement" . $stmt->error);}
  } else if($_SESSION['error'] && isset($_SESSION['user_idAt'])){
      if (!$stmt->execute()) {  throw new Exception("Error executing statement" . $stmt->error);}
  }

  $stmt->close();
} catch (Exception $e) {
  echo 'Caught exception: ', $e->getMessage(), "\n";
} finally {
  mysqli_close($conn);
}
