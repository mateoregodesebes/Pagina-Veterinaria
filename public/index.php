<?php
session_start();
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css" rel="stylesheet"
        integrity="sha384-1BmE4kWBq78iYhFldvKuhfTAU6auU8tT94WrHftjDbrCEXSU1oBoqyl2QvZ6jIW3" crossorigin="anonymous">
    <link rel="stylesheet" href="css/veterinaria.css">
    <link rel="stylesheet" href="css/navbar.css">

    <script src="https://kit.fontawesome.com/ac9e2dd316.js" crossorigin="anonymous"></script>
    <?php
    if (isset($_SESSION["currentPage"])) {
        switch ($_SESSION["currentPage"]) {
            case '../src/pages/abmMascota/abmListMascota.php':
            case '../src/pages/abmMascota/abmFormMascota.php':
                echo '<link rel="stylesheet" href="css/abmMascota.css">';
                break;
            case '../src/pages/contact/contact.php':
                echo '<link rel="stylesheet" href="css/contact.css">';
                break;
            case '../src/pages/abmCliente/abmListCliente.php':
            case '../src/pages/abmCliente/abmFormCliente.php':
                echo '<link rel="stylesheet" href="css/abmCliente.css">';
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
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.bundle.min.js"
        integrity="sha384-ka7Sk0Gln4gmtz2MlQnikT1wXgYsOg+OMhuP+IlRH9sENBO0LRn5q+8nbTov4+1p"
        crossorigin="anonymous"></script>
    <?php
    /* Although Bootstrap usually uses the container class, the container-fluid class makes it so the page includes all of the viewport */
    ?>
    <main>
        <div class="container-fluid">

            <?php
            require_once("../src/partials/navbar.php");
            if (!isset($_SESSION["currentPage"])) {
                //?Aca lo que habria que hacer es que en vez de abmList cuando tengamos el home hecho poner eso
                //?y que cuando se apreta el boton de home se ponga el home como current page
                require_once("../src/pages/contact/contact.php");
            } elseif (isset($_SESSION["currentPage"])) {
                require_once($_SESSION["currentPage"]);
            }
            ?>
    </main>
    <footer>
        <?php require_once("../src/partials/footer.php"); ?>
    </footer>

</body>

</html>