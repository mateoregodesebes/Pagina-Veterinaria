<?php
require_once(__DIR__ . '/../../includes/connection.php');

$login_email = $_POST["email"];
$login_password = $_POST["password"];

$stmt = $conn->prepare("SELECT * FROM clientes WHERE email = ?");

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

if ($user) {
    $user_name = $user["nombre"];
    $user_password_hash = $user["contrasenia"];

    if (password_verify($login_password, $user_password_hash)) {
        $_SESSION["user_name"] = $user_name;
        $_SESSION["user_id"] = $user["id"];
        $_SESSION["user"] = 'yes';
        echo '<script>window.location.replace("index.php");</script>';
        exit();
    } else {
        # Check if these echoes work
        echo "<div class='alert alert-danger' role='alert'>Usuario o contraseña no correcto</div>";
    }
} else {
    echo "<div class='alert alert-danger' role='alert'>Usuario o contraseña no correcto</div>";
}
