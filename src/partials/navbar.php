<?php
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    if (isset($_POST["LogoButton"])) {
        $_SESSION['currentPage'] = '../src/pages/homepage/homepage.php';
        echo '<script>window.location.replace("index.php");</script>';
        exit();
    }
}
?>

<div class="row">
    <nav class="nav navbar-expand-sm d-flex justify-content-center">
        <form action="index.php" method="post">
            <button class="navbar-brand mx-3 logo" type="submit" name="LogoButton">
                <img src="../assets/logo.png" width="50" height="50" alt="Logo">
            </button>
        </form>
        <ul class="navbar-nav mr-auto mt-1">
            <li class="nav-item">
                <a class="nav-link" href="#">Sobre Nosotros</a>
            </li>
            <li class="nav-item">
                <a class="nav-link" href="#">Servicios</a>
            </li>
            <li class="nav-item">
                <a class="nav-link" href="#">Contacto</a>
            </li>
            <li class="nav-item">
                <a class="nav-link" href="#">Noticias Peludas</a>
            </li>
            <li class="nav-item">
                <a class="nav-link dropdown-toggle" href="#" id="navbarDropdown" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                    Mi cuenta
                </a>

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
                        <form method="post">
                            <button type="submit" class="dropdown-item" name="profileButton">
                                Perfil
                            </button>
                        </form>
                        <a class="dropdown-item" href="#">Mis Turnos</a>
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
                        }
                    ?>
                        <form class="px-4 py-3" action="index.php" method="POST">
                            <div class="form-group">
                                <label>Mail</label>
                                <input type="email" class="form-control mt-2" name="email" placeholder="email@ejemplo.com" required>
                            </div>
                            <div class="form-group">
                                <label>Contraseña</label>
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
                            <button type="submit" class="dropdown-item dropdown_button" name="registerButton">No tenes una
                                cuenta? Registrate</button>
                        </form>
                        <button type="submit" class="dropdown-item dropdown_button">Olvidaste tu contraseña?
                            Recuperala</button>
                    <?php
                    }
                    ?>

                </div>
            </li>
        </ul>
    </nav>
</div>