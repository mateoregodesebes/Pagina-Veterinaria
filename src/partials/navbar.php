<div class="row">
    <nav class="nav navbar-expand d-flex justify-content-between">
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
                    if(isset($_SESSION["user"]) && $_SESSION["user"] != null){
                        echo '
                        <a class="dropdown-item" href="#">Perfil</a>
                        <a class="dropdown-item" href="#">Mis Mascotas</a>
                        <a class="dropdown-item" href="#">Mis Turnos</a>
                        <div class="dropdown-divider"></div>
                        <a class="dropdown-item" href="#">Cerrar Sesion</a>
                        ';
                    
                    }
                    // ToDo: Make the remember me button work 
                    else echo '
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
                        <button type="submit" class="btn btn-primary mx-auto iniciar_sesion">Iniciar Sesion</button>
                    </form>
                    <div class="dropdown-divider"></div>
                    <button type="submit" class="dropdown-item register_button btn btn-secondary" name="registerButton">No tenes una cuenta? Registrate</button>
                    <a class="dropdown-item" href="#">Olvidaste tu contraseña?</a>
                    ';
                        ?>

                </div>
            </li>
        </ul>
    </nav>
</div>