<?php
if ($_SERVER["REQUEST_METHOD"] == "POST" && isset($_POST["submit"])) 
{
    $errors = array();

    if (!filter_var($_POST["email"], FILTER_VALIDATE_EMAIL))
    {
        array_push($errors, "Email inválido");
    }
    if ($_POST["password"] != $_POST["repeat_password"])
    {
        array_push($errors, "Las contraseñas no coinciden");
    }

    if (count($errors) > 0) 
    {
        foreach ($errors as $error)
        {
            echo "<div class='alert alert-danger' role='alert'>$error</div>";
        }
    }
    else
    {
        require_once __DIR__ . '/../../entity-dbs/clientes/altaCliente.php';
    }
}
?>
<div class="row">
    <div class="col-2"></div>
    <div class="col-8">
        <h2>Formulario de registro</h2>
        <form action="registration.php" method="post">
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
                <input type="text" class="form-control" name="dirección" placeholder="Calle 1234" required>
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
                <input class="btn btn-outline-secondary" type="reset" value="Borrar información">
            </div>
            <div class="form-btn">
                <button type="submit" value="Register" name="submit" class="btn btn-primary">Registrarse</button>
            </div>
            <br>

        </form>
    </div>
    <div class="col-2"></div>
</div>