<?php
if ($_SERVER["REQUEST_METHOD"] == "POST" && isset($_POST["submit"])) {
    $user_full_name = $_POST["fullname"];
    $user_email = $_POST["email"];
    $user_password = $_POST["password"];
    $user_repeat_password = $_POST["repeat_password"];
    $errors = array();

    $password_hash = password_hash($user_password, PASSWORD_DEFAULT);

    if (!filter_var($user_email, FILTER_VALIDATE_EMAIL)) {
        array_push($errors, "Email inválido");
    }
    if ($user_password != $user_repeat_password) {
        array_push($errors, "Las contraseñas no coinciden");
    }

    require_once(__DIR__ . '/../../../includes/connection.php');
    $sql = "SELECT * FROM users WHERE email = '$user_email'";
    $result = mysqli_query($conn, $sql);

    if (mysqli_num_rows($result) > 0) {
        array_push($errors, "El email ya está registrado");
    }

    if (count($errors) > 0) {
        foreach ($errors as $error) {
            echo "<div class='alert alert-danger' role='alert'>$error</div>";
        }
    } else {
        $sql = "INSERT INTO users (full_name, email, password) VALUES (?, ?, ? )";
        $stmt = $conn->prepare($sql);

        if ($stmt) {
            $stmt->bind_param("sss", $user_full_name, $user_email, $password_hash);
            $stmt->execute();
            echo "<div class='alert alert-success' role='alert'>Usuario registrado correctamente</div>";
        } else {
            echo "<div class='alert alert-danger' role='alert'>Error al registrar el usuario</div>";
        }
    }
}
?>
<form action="registration.php" method="post">
    <div class="form-group">
        <input type="text" class="form-control" name="fullname" placeholder="Nombre completo" required>
    </div>
    <div class="form-group">
        <input type="email" class="form-control" name="email" placeholder="Email" required>
    </div>
    <div class="form-group">
        <input type="password" class="form-control" name="password" placeholder="Contraseña" minlength="8" required>
    </div>
    <div class="form-group">
        <input type="password" class="form-control" name="repeat_password" placeholder="Repetir Contraseña" minlength="8" required>
    </div>
    <div class="form-btn">
        <button type="submit" value="Register" name="submit" class="btn btn-primary">Registrarse</button>
    </div>

</form>