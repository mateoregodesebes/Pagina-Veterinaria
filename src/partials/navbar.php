<div class="row">
    <nav class="nav navbar-expand d-flex justify-content-between">
        <?php
        #ToDo: Make so that the logo change the $_SESSION['currentPage'] to contact.php
        ?>
        <a class="navbar-brand mx-3" href="index.php">
            <img src="../assets/logo.png" width="50" height="50" alt="Logo">
        </a>

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
                        # Maybe, I could remove the echo and use the html directly. Closing the php tag and opening it again before the }
                    ?>
                        <div class="alert alert-success" role="alert">Bienvenido $user_name</div>
                        <a class="dropdown-item" href="#">Perfil</a>
                        <a class="dropdown-item" href="#">Mis Mascotas</a>
                        <a class="dropdown-item" href="#">Mis Turnos</a>
                        <div class="dropdown-divider"></div>
                        <a class="dropdown-item" href="#">Cerrar Sesion</a>
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
                        <form class="px-4 py-3">
                            <div class="form-group">
                                <label>Mail</label>
                                <input type="email" class="form-control mt-1" id="exampleDropdownFormEmail1" placeholder="email@ejemplo.com" required>
                            </div>
                            <div class="form-group">
                                <label>Contraseña</label>
                                <input type="password" class="form-control mt-1" id="exampleDropdownFormPassword1" title="Ingrese una contraseña de al menos 8 caracteres" required>
                            </div>
                            <div class="form-check mt-2">
                                <input type="checkbox" class="form-check-input" id="dropdownCheck">
                                <label class="form-check-label" for="dropdownCheck">
                                    Recordarme
                                </label>
                            </div>
                            <button type="submit" class="btn btn-primary mx-auto iniciar_sesion" name="login">Iniciar Sesion</button>
                        </form>
                        <div class="dropdown-divider"></div>
                        <button type="submit" class="dropdown-item register_button btn btn-secondary" name="registerButton">No tenes una cuenta? Registrate</button>
                        <a class="dropdown-item" href="#">Olvidaste tu contraseña?</a>
                    <?php
                    }
                    ?>

                </div>
            </li>
        </ul>
    </nav>
</div>