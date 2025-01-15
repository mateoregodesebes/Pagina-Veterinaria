<?php
require_once(__DIR__ . '/../../includes/connection.php');

$login_email = $_POST["email"];
$login_password = $_POST["password"];

$stmt = $conn->prepare("SELECT * FROM personas WHERE email = ?");

if (!$stmt) {
    throw new Exception("Error preparing statement: " . $conn->error);
}

$stmt->bind_param("s", $login_email);

if (!$stmt->execute()) {
        throw new Exception("Error executing statement" . $stmt->error);
    }

$result = $stmt->get_result();

$user = mysqli_fetch_assoc($result);

$stmt->close();

if($user['rol_id'] != NULL){
    // Recupero los roles
    $roles_stmt = $conn->prepare("SELECT * FROM roles");
    
    if (!$roles_stmt) {
        throw new Exception("Error preparing statement: " . $conn->error);
    }
    
    if (!$roles_stmt->execute()) {
        throw new Exception("Error executing statement: " . $roles_stmt->error);
    }
    
    $roles_result = $roles_stmt->get_result();
    $roles = $roles_result->fetch_all(MYSQLI_ASSOC);
}

if ($user) {
    $user_name = $user["nombre"];
    $user_password_hash = $user["clave"];

    if (password_verify($login_password, $user_password_hash)) {
        $_SESSION["user_name"] = $user_name;
        $_SESSION["user_id"] = $user["id"];
        $_SESSION["user"] = 'yes';

        if($user['rol_id'] == NULL){
            $_SESSION["user_role"] = 'cliente';
        }
        else {
            // Se usa $user['rol_id'] - 1 porque los roles empiezan en 1 y los índices en 0
            $_SESSION["user_role"] = $roles[$user['rol_id'] - 1]['nombre'];
        }
        echo '<script>window.location.replace("index.php");</script>';
        exit();
    } else {
        $_SESSION["error_message"] = "Usuario o contraseña no correcto";
        echo '<script>window.location.replace("index.php");</script>';
        exit();
    }
} else {
    $_SESSION["error_message"] = "Usuario o contraseña no correcto";
    echo '<script>window.location.replace("index.php");</script>';
    exit();
}
