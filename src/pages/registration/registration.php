<?php
if ($_SERVER["REQUEST_METHOD"] == "POST" && isset($_POST["submit"])) {
    $errors = array();

    if (!filter_var($_POST["email"], FILTER_VALIDATE_EMAIL)) {
        array_push($errors, "Email inválido");
    }
    if ($_POST["password"] != $_POST["repeat_password"]) {
        array_push($errors, "Las contraseñas no coinciden");
    }

    /* Check if the email is already registered
    *  require_once(__DIR__ . '/../../../includes/connection.php');
    *  $sql = "SELECT * FROM clientes WHERE email = '$email'";
    *  $result = mysqli_query($conn, $sql);
    *
    *  if (mysqli_num_rows($result) > 0) 
    * {
    *      array_push($errors, "El email ya está registrado");
    *  }
    */

    if (count($errors) > 0) {
        foreach ($errors as $error) {
            echo "<br><div class='alert alert-danger' role='alert'>$error</div>";
        }
    } else {
        require_once __DIR__ . '/../../entity-dbs/clientes/altaCliente.php';
        echo "<br><div class='alert alert-success' role='alert'>Has creado tu perfil correctamente</div>";

        $_SESSION['currentPage'] = '../src/pages/contact/contact.php';
        echo '<script>window.location.replace("index.php");</script>';
        exit();
    }
}
?>
<div class="row">
    <div class="col-2"></div>
    <div class="col-8">
        <h2>Formulario de registro</h2>
        <form action="index.php" method="POST">
            <div class="form-group">
                <label>Nombre</label>
                <input type="text" class="form-control" name="nombre" required>
            </div>
            <div class="form-group">
                <label>Apellido</label>
                <input type="text" class="form-control" name="apellido" required>
            </div>
            <div class="form-group">
                <label>Email</label>
                <input type="email" class="form-control" name="email" required>
            </div>
            <div class="form-group">
                <label>Ciudad</label>
                <input type="text" class="form-control" name="ciudad" placeholder="Ej: 'Buenos Aires'" required>
            </div>
            <div class="form-group">
                <label>Dirección</label>
                <input type="text" class="form-control" name="direccion" placeholder="Calle 1234" required>
            </div>
            <div class="form-group">
                <label>Teléfono</label>
                <br>
                <small>No hace falta el prefijo +54</small>
                <input type="tel" class="form-control" name="telefono" placeholder="123456789" required>
            </div>
            <div class="form-group">
                <label>Contraseña</label>
                <br>
                <small>La contraseña debe tener al menos 8 caracteres</small>
                <input type="password" class="form-control" name="password" minlength="8" required>
            </div>
            <div class="form-group">
                <label>Repetir Contraseña</label>
                <input type="password" class="form-control" name="repeat_password" minlength="8" required>
            </div>
            <div class="form-btn">
                <input class="btn btn-outline-danger" type="reset" value="Borrar información">
            </div>
            <div class="form-btn">
                <button type="button" value="Register" class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#staticBackdrop">Registrarse</button>
            </div>
            <?php //?Modal 
            ?>
            <div class="modal fade" id="staticBackdrop" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1" aria-labelledby="staticBackdropLabel" aria-hidden="true">
                <div class="modal-dialog modal-dialog-centered">
                    <div class="modal-content">
                        <div class="modal-header">
                            <h1 class="modal-title fs-5" id="staticBackdropLabel">Usted esta a punto de registrarse
                            </h1>
                            <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                        </div>
                        <div class="modal-body">
                            Esta seguro?
                        </div>
                        <div class="modal-footer">
                            <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cancelar</button>
                            <button type="submit" class="btn btn-primary" name="submit" value="register">Si</button>
                        </div>
                    </div>
                </div>
            </div>
        </form>

        <br>
    </div>
    <div class="col-2"></div>
</div>