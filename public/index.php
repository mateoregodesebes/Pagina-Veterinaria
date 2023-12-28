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
    <link rel="stylesheet" href="css/styles.css">
    <link rel="stylesheet" href="css/abmMascota">
    <script src="https://kit.fontawesome.com/ac9e2dd316.js" crossorigin="anonymous"></script>

    <title>Página Principal</title>
</head>

<body>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.bundle.min.js"
        integrity="sha384-ka7Sk0Gln4gmtz2MlQnikT1wXgYsOg+OMhuP+IlRH9sENBO0LRn5q+8nbTov4+1p"
        crossorigin="anonymous"></script>
    <script src="https://kit.fontawesome.com/ac9e2dd316.js" crossorigin="anonymous"></script>
    <div class="container">
        <div class="row">
            <?php
            if (!isset($_SESSION["currentPage"])) {
                require_once("../src/pages/abmMascota/abmListMascota.php");
            } elseif (isset($_SESSION["currentPage"])) {
                echo $_SESSION["currentPage"];
                require_once($_SESSION["currentPage"]);
            }
            ?>
        </div>
    </div>
</body>

</html>