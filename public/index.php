<?php
session_start();
?>
<!DOCTYPE html>
<html lang="es">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-1BmE4kWBq78iYhFldvKuhfTAU6auU8tT94WrHftjDbrCEXSU1oBoqyl2QvZ6jIW3" crossorigin="anonymous">
    <link rel="stylesheet" href="css/veterinaria.css">
    <link rel="stylesheet" href="css/navbar.css">
    <script src="https://kit.fontawesome.com/ac9e2dd316.js" crossorigin="anonymous"></script>
    <?php
    if (isset($_SESSION["currentPage"])) {
        switch ($_SESSION["currentPage"]) {
            case '../src/pages/abmMascota/abmListMascota.php':
            case '../src/pages/abmMascota/abmFormMascota.php':
            case '../src/pages/abmCliente/abmListCliente.php':
            case '../src/pages/abmCliente/abmFormCliente.php':
                echo '<link rel="stylesheet" href="css/abm.css">';
                break;
            case '../src/pages/contact/contact.php':
                echo '<link rel="stylesheet" href="css/contact.css">';
                break;
            case '../src/pages/registration/registration.php':
                echo '<link rel="stylesheet" href="css/registration.css">';
                break;
            case '../src/pages/profile/profile.php':
                echo '<link rel="stylesheet" href="css/profile.css">';
                break;
            case '../src/pages/homepage/homepage.php':
                echo '<link rel="stylesheet" href="css/homepage.css">';
                break;
            case '../src/pages/shop/shop.php':
                # Cambiar por el css de la pagina de shop cuando la hagamos
                echo '<link rel="stylesheet" href="css/inprogress.css">';
                break;
            case '../src/pages/peluqueria/peluqueria.php':
                # Cambiar por el css de la pagina de peluqueria cuando la hagamos
                echo '<link rel="stylesheet" href="css/inprogress.css">';
                break;
            case '../src/pages/hospitalization/hospitalization.php':
                # Cambiar por el css de la pagina de hospitalizacion cuando la hagamos
                echo '<link rel="stylesheet" href="css/inprogress.css">';
                break;
            case '../src/pages/atencion/atencion.php':
                # Cambiar por el css de la pagina de atencion cuando la hagamos
                echo '<link rel="stylesheet" href="css/inprogress.css">';
                break;
            case '../src/pages/aboutus/aboutus.php':
                echo '<link rel="stylesheet" href="css/aboutus.css">';
                break;
        }
    }
    ?>

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
    date_default_timezone_set('America/Argentina/Buenos_Aires');
    ?>
    <main>
        <div class="container-fluid">

            <?php
            require_once("../src/partials/navbar.php");

            // Array con las paginas que estan en progreso
            $in_progress_pages = [
                '../src/pages/shop/shop.php',
                '../src/pages/peluqueria/peluqueria.php',
                '../src/pages/hospitalization/hospitalization.php',
                '../src/pages/atencion/atencion.php'
            ];
            if (!isset($_SESSION["currentPage"])) {
                //?Aca lo que habria que hacer es que en vez de abmList cuando tengamos el home hecho poner eso
                //?y que cuando se apreta el boton de home se ponga el home como current page
                require_once("../src/pages/homepage/homepage.php");
            } elseif (isset($_SESSION["currentPage"])) {
                // Si la pagina actual esta en el array de paginas en progreso, se muestra la pagina de en progreso
                if (in_array($_SESSION["currentPage"], $in_progress_pages)) {
                    require_once("../src/pages/inprogress/inprogress.php");
                } else {
                    require_once($_SESSION["currentPage"]);
                }
            }
            ?>
        </div>
    </main>
    <footer>
        <?php require_once("../src/partials/footer.php"); ?>
    </footer>


    <script src="https://code.jquery.com/jquery-3.3.1.slim.min.js" integrity="sha384-q8i/X+965DzO0rT7abK41JStQIAqVgRVzpbzo5smXKp4YfRvH+8abtTE1Pi6jizo" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/popper.js@1.14.7/dist/umd/popper.min.js" integrity="sha384-UO2eT0CpHqdSJQ6hJty5KVphtPhzWj9WO1clHTMGa3JDZwrnQq4sF86dIHNDz0W1" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@4.3.1/dist/js/bootstrap.min.js" integrity="sha384-JjSmVgyd0p3pXB1rRibZUAYoIIy6OrQ6VrjIEaFf/nJGzIxFDsf4x0xIM+B07jRM" crossorigin="anonymous"></script>
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.6.0/jquery.min.js"></script>
</body>

</html>