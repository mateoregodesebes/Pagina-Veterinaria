<?php
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    if (isset($_POST["LogoButton"])) {
        unset($_SESSION['currentPage']);
        echo '<script>window.location.replace("index.php");</script>';
        exit();
    }
    elseif(isset($_POST["about-us"])) {
        $_SESSION['currentPage'] = '../src/pages/aboutus/aboutus.php';
        echo '<script>window.location.replace("index.php");</script>';
        exit();
    }
    elseif (isset($_POST["viewAppointments"])) {
        $_SESSION['currentPage'] = '../src/pages/viewAppointments/viewAppointments.php';
        echo '<script>window.location.replace("index.php");</script>';
        exit();
    }
}

if (isset($_SESSION["user_role"]) && $_SESSION["user_role"] != "cliente") {
    echo
        '<style>
    .logToggle {
        display: none;
    }
    .nav-item {
        margin-right: 12%;
    }
    </style>';  
}

?>
<script>
$(document).ready(function(){
    // Prevent the dropdown from closing when clicking inside it
    $(".dropdown-menu").click(function(event){
        event.stopPropagation();
    });
    // Show warning if email or password are not valid
    $(".form-control").blur(function(){
        if($(this).attr('type') == "email") {
            if($(this).val().indexOf("@") == -1) {
                $("#email-warning").removeClass("d-none");
            } else {
                $("#email-warning").addClass("d-none");
            }
        } else if($(this).attr('type') == "password") {
            if($(this).val().length < 8) {
                $("#password-warning").removeClass("d-none");
            } else {
                $("#password-warning").addClass("d-none");
            }
        }
    })
});
</script>


<div class="row">
    <nav class="navb navbar-expand-sm">
        <div class="col-1 logToggle">
            <form action="index.php" method="post">
                <button class="navbar-brand mx-3 logo" type="submit" name="LogoButton">
                    <img src="../assets/logo.png" width="50" height="50" alt="Logo">
                </button>
            </form>
        </div>
        <div class="col-2"></div>
        <div class="col-9">
            <ul class="navbar-nav mr-auto mt-1 d-flex justify-content-around">
                <li class="nav-item logToggle">
                    <form action="index.php" method="post">
                        <button class="nav-btn" type="submit" name="about-us"> 
                            Sobre Nosotros
                        </button>
                    </form>
                </li>
                <li class="nav-item logToggle">
                    <form action="index.php" method="post">
                        <button class="nav-btn" type="submit" name="services"> 
                            Servicios
                        </button>
                    </form>
                </li>
                <li class="nav-item logToggle">
                    <form action="index.php" method="post">
                        <button class="nav-btn" type="submit" name="contact"> 
                            Contacto
                        </button>
                    </form>
                </li>
                <li class="nav-item logToggle">
                    <form action="index.php" method="post">
                        <button class="nav-btn" type="submit" name="newspaper"> 
                            Noticias peludas
                        </button>
                    </form>
                </li>
                <li class="nav-item">
                    <button class="nav-btn dropdown-toggle" id="navbarDropdown" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                        Mi cuenta
                    </button>

                    <div class="dropdown-menu dropdown-menu-right" aria-labelledby="navbarDropdown">
                        <?php
                        if (isset($_SESSION["user"])) {
                            if (isset($_POST["logoutButton"])) {
                                // Is it correct to destroy the session here? Or should I only unset the user related $_SESSION variables?
                                session_destroy();
                                echo '<script>window.location.replace("index.php");</script>';
                                exit();
                            } elseif (isset($_POST["profileButton"])) {
                                $_SESSION['currentPage'] = '../src/pages/profile/profile.php';
                                echo '<script>window.location.replace("index.php");</script>';
                                exit();
                            }
                        ?>
                            <div class='alert alert-success' role='alert'>Bienvenido
                                <?php echo $_SESSION["user_name"] ?>
                            </div>
                            <div>
                                <form method="post">
                                    <button type="submit" class="dropdown-item" name="profileButton">
                                        Perfil
                                    </button>
                                </form>
                            </div>
                            <div>
                                <form method="post">
                                    <button type="submit" class="dropdown-item" name="viewAppointments">
                                        Ver Turnos
                                    </button>
                                </form>
                            </div>
                            <div class="dropdown-item">
                                <form method="post">
                                    <button type="submit" class="dropdown-item register_button" name="logoutButton">
                                        Cerrar Sesión
                                    </button>
                                </form>
                            </div>
                        <?php
                        }
                        // ToDo: Make the remember me button work 
                        else {
                            if ($_SERVER["REQUEST_METHOD"] == "POST") {
                                if (isset($_POST["login"])) {
                                    require_once(__DIR__ . '/../scripts/login.php');
                                } elseif (isset($_POST["registerButton"])) {
                                    $_SESSION['currentPage'] = '../src/pages/registration/registration.php';
                                    echo '<script>window.location.replace("index.php");</script>';
                                    exit();
                                }
                                elseif (isset($_POST["forgotPasswordButton"])) {
                                    $_SESSION['currentPage'] = '../src/pages/forgot-password/forgot-password.php';
                                    echo '<script>window.location.replace("index.php");</script>';
                                    exit();
                                }
                            }
                        if(isset($_SESSION["error_message"])) {
                            echo "<div class='alert alert-danger' role='alert'>" . $_SESSION["error_message"] . "</div>";
                            unset($_SESSION["error_message"]);
                        }
                        ?>
                            <form class="px-4 py-3" action="index.php" method="POST">
                                <div class="form-group">
                                    <label>Mail</label>
                                    <br>
                                    <small class="warning d-none" id="email-warning">El mail debe contar con un @</small>
                                    <input type="email" class="form-control mt-2" name="email" placeholder="email@ejemplo.com" required>
                                </div>
                                <div class="form-group mt-auto">
                                    <label>Contraseña</label>
                                    <br>
                                    <small class="warning d-none" id="password-warning">La contraseña debe tener 8 caracteres por lo menos</small>
                                    <input type="password" class="form-control mt-2" name="password" title="Ingrese una contraseña de al menos 8 caracteres" minlength="8" required>
                                </div>
                                <div class="form-check mt-3">
                                    <input type="checkbox" class="form-check-input" id="dropdownCheck">
                                    <label class="form-check-label" for="dropdownCheck">
                                        Recordarme
                                    </label>
                                </div>
                                <button type="submit" class="btn btn-primary mx-auto iniciar_sesion dropdown_button" name="login">Iniciar Sesion</button>
                            </form>
                            <form method="post">
                                <button type="submit" class="dropdown-item dropdown_button" name="register">No tenes una
                                    cuenta? Registrate</button>
                            </form>
                            <form method="post">
                                <button type="submit" class="dropdown-item dropdown_button" name="forgotPasswordButton">Olvidaste tu contraseña?
                                    Recuperala</button>
                            </form>
                        <?php
                        }
                        ?>

                    </div>
                </li>
            </ul>
        </div>
    </nav>
</div>