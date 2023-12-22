<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href='https://fonts.googleapis.com/css?family=Montserrat' rel='stylesheet'>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-1BmE4kWBq78iYhFldvKuhfTAU6auU8tT94WrHftjDbrCEXSU1oBoqyl2QvZ6jIW3" crossorigin="anonymous">
    <link rel="stylesheet" href="css/styles.css">
    <link rel="stylesheet" href="css/navbar.css">
    <title>Página Principal</title>
</head>
<?php
/* TODO: 
        -   Add the links to their respective pages to each list item from the navbar, default is "#".
        -   Add another list item for the profile thing. */
?>

<body>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-ka7Sk0Gln4gmtz2MlQnikT1wXgYsOg+OMhuP+IlRH9sENBO0LRn5q+8nbTov4+1p" crossorigin="anonymous"></script>
<?php   
/* Although Bootstrap usually uses the container class, the container-fluid class makes it so the page includes all of the viewport */
?> 
    <div class="container-fluid">
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
                </ul>
            </nav>
        </div>

        <footer>
            <div class="row">
                <div class="col-6 footerblock">
                    <address>
                        Dirección: 1234 Calle Prueba<br>
                        <a href="https://www.google.com/maps">Ver en Google Maps</a><br>
                        Teléfono: 341 - 1234567
                    </address>
                </div>
                <div class="col-6 footerblock">
                    <a href="QuienesSomos.php">Quienes somos</a>
                    <p>Nuestras redes sociales:</p>
                    <div class="row">
                        <div class="col-6">
                            <a href="https://www.facebook.com/">Nuestro Facebook</a>
                        </div>
                        <div class="col-6">
                            <a href="https://www.instagram.com/">Nuestro Instagram</a>
                        </div>
                    </div>
                </div>
                <p>Este sitio es realizado para una prueba práctica de la materia Entornos Gráficos de la Universidad Tecnologica Nacional Regional Rosario (UTNFRRO), no representa a ninguna veterinaria ni debe ser tomada como ello.</p>
            </div>
        </footer>
    </div>
</body>

</html>