<?php
    require_once(__DIR__ . '/../../includes/connection.php');

    $login_email = $_POST["email"];
    $login_password = $_POST["password"];

    $sql = "SELECT * FROM clientes WHERE email = '$login_email'";
    $result = mysqli_query($conn, $sql);
    $user = mysqli_fetch_assoc($result);

    if ($user) 
        {
            $user_name = $user["nombre"];
            $user_password_hash = $user["contrasenia"];

            if (password_verify($login_password, $user_password_hash)) 
            {
                echo "<div class='alert alert-success' role='alert'>Bienvenido $user_name</div>";
                $_SESSION["user_name"] = $user_name;
                $_SESSION["user"] = 'yes';
                header("Location: index.php");
                die();
            } else {
                # Check if these echoes work
                echo "<div class='alert alert-danger' role='alert'>Usuario o contraseña no correcto</div>";
            }
        } 
        else 
        {
            echo "<div class='alert alert-danger' role='alert'>Usuario o contraseña no correcto</div>";
        }
?>