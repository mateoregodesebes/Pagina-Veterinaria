<?php
if ($_SERVER["REQUEST_METHOD"] == "POST" && isset($_POST["submit"])) {
    $errors = array();
    $reg_email = $_POST["email"];
    
    # Filtrado de email y validación de contraseña
    if (!filter_var($reg_email, FILTER_VALIDATE_EMAIL)) {
        array_push($errors, "Email inválido");
    }
    if ($_POST["password"] != $_POST["repeat_password"]) {
        array_push($errors, "Las contraseñas no coinciden");
    }
    
    # Se busca repetición de mail en base de datos
    require_once(__DIR__ . '/../../../includes/connection.php');
    $stmt = $conn->prepare("SELECT * FROM personas 
                                WHERE email = ? 
                                AND rol_id IS NULL
                                AND is_verified = True");

    if (!$stmt) {
    throw new Exception("Error preparing statement: " . $conn->error);
    }

    $stmt->bind_param("s", $reg_email);

    if (!$stmt->execute()) {
        throw new Exception("Error executing statement" . $stmt->error);
    }

    $result = $stmt->get_result();
    
    if (mysqli_num_rows($result) > 0) 
    {
        array_push($errors, "El email ya está registrado");
    }

    $stmt->close();

    mysqli_close($conn);

    # Se muestran todos los errores encontrados o se da de alta al cliente
    if (count($errors) > 0) {
        foreach ($errors as $error) {
            echo "<br><div class='alert alert-danger' role='alert'>$error</div>";
        }
    } else {
        # Si no hay errores, se le envia al cliente un mail de verificación
        require_once __DIR__ . '/../../entity-dbs/clientes/altaCliente.php';
        require_once __DIR__ . '/sendVerificationEmail.php';

        if(isset($_SESSION["mail_success"])) {
        echo "<br><div class='alert alert-success' role='alert'>Se envió un mail de verificación a tu correo electrónico</div>";
        $_SESSION['currentPage'] = '../src/pages/homepage/homepage.php';
        unset($_SESSION["mail_success"]);
        } else if(isset($_SESSION["mail_error"])) {
            echo "<br><div class='alert alert-danger' role='alert'>Hubo un error al enviar el mail de verificación. Por favor, intente registrarse nuevamente.</div>";
            unset($_SESSION["mail_error"]);
        }
        echo "<script>
        setTimeout(function() {
            window.location.replace('index.php');
        }, 5000);
    </script>";
        exit();
    }
}
?>
<script>
$(document).ready(function(){
    function checkInputs() {
        let allValid = true;
        $(".reg-required").each(function() {
            const type = $(this).attr('type');
            const value = $(this).val();
            if (value == "") {
                allValid = false;
            } else if (type == "email" && value.indexOf("@") == -1) {
                allValid = false;
            } else if (type == "password" && value.length < 8) {
                allValid = false;
            }
        });
        $("#submitBtn").prop('disabled', !allValid);
    }

    $(".reg-required").on('blur keyup', function() {
        // Shows or hides warning
        if($(this).val() == "") {
            $(this).prev("small").removeClass("d-none");
        } else {
            $(this).prev("small").addClass("d-none");
        }
        // Additional specific checks for email and password
        if($(this).attr('type') == "email") {
            if($(this).val().indexOf("@") == -1) {
                $("#reg-email-warning").removeClass("d-none");
            } else {
                $("#reg-email-warning").addClass("d-none");
            }
        } else if($(this).attr('type') == "password") {
            if($(this).val().length < 8) {
                $("#reg-password-warning").removeClass("d-none");
            } else {
                $("#reg-password-warning").addClass("d-none");
            }
        }
        checkInputs(); // Check all inputs and update button state
    });
    checkInputs(); // Initial check on page load
});
</script>

<div class="row m-5 form-container">
    <div class="col registration-info">
        <h2>Formulario de registro</h2>
        <form action="index.php" method="POST">
            <div class="form-group">
                <label>Nombre</label>
                <br>
                <small class="d-none">Campo obligatorio (*)</small>
                <input type="text" class="form-control reg-required" name="nombre" required/>
            </div>
            <div class="form-group">
                <label>Apellido</label>
                <br>
                <small class="d-none" >Campo obligatorio (*)</small>
                <input type="text" class="form-control reg-required" name="apellido" required/>
            </div>
            <div class="form-group">
                <label>Email</label>
                <br>
                <small class="warning d-none" id="reg-email-warning">El mail debe contar con un @</small>
                <br>
                <small class="d-none">Campo obligatorio (*)</small>
                <input type="email" class="form-control reg-required" name="email" required/>
            </div>
            <div class="form-group">
                <label>Ciudad</label>
                <br>
                <small class="d-none" >Campo obligatorio (*)</small>
                <input type="text" class="form-control reg-required" name="ciudad" placeholder="Ej: 'Buenos Aires'" required/>
            </div>
            <div class="form-group">
                <label>Dirección</label>
                <br>
                <small class="d-none">Campo obligatorio (*)</small>
                <input type="text" class="form-control reg-required" name="direccion" placeholder="Calle 1234" required/>
            </div>
            <div class="form-group">
                <label>Teléfono</label>
                <br>
                <small>No es necesario el prefijo +54</small>
                <br>
                <small class="d-none">Campo obligatorio (*)</small>
                <input type="tel" class="form-control reg-required" name="telefono" placeholder="123456789" required/>
            </div>
            <div class="form-group">
                <label>Contraseña</label>
                <br>
                <small id="reg-password-warning" class="d-none">La contraseña debe tener al menos 8 caracteres</small>
                <br>
                <small class="d-none">Campo obligatorio (*)</small>
                <input type="password" class="form-control reg-required" name="password" minlength="8" required/>
            </div>
            <div class="form-group">
                <label>Repetir Contraseña</label>
                <br>
                <small class="d-none">Campo obligatorio (*)</small>
                <input type="password" class="form-control reg-required" name="repeat_password" minlength="8" required/>
            </div>
            <div class="form-btn">
                <input class="btn btn-outline-danger" type="reset" value="Borrar información">
            </div>
            <div class="form-btn">
                <button id="submitBtn" type="button" value="Register" class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#staticBackdrop" disabled>Registrarse</button>
            </div>
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
                            <button type="submit" class="btn btn-primary" name="submit" value="register" data-bs-dismiss="modal">Si</button>
                        </div>
                    </div>
                </div>
            </div>
        </form>

        <br>
    </div>
</div>