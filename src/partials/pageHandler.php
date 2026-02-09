<?php
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    if (isset($_POST["LogoButton"]) or isset($_POST["home"])) {
        unset($_SESSION['currentPage']);
        echo '<script>window.location.replace("index.php");</script>';
        exit();
    }
    if(isset($_POST["about-us"])) {
        $_SESSION['currentPage'] = '../src/pages/aboutus/aboutus.php';
        echo '<script>window.location.replace("index.php");</script>';
        exit();
    }
    if(isset($_POST["contact"])) {
        $_SESSION['currentPage'] = '../src/pages/contact/contact.php';
        echo '<script>window.location.replace("index.php");</script>';
        exit();
    }
    if(isset($_POST["services"])) {
        $_SESSION['currentPage'] = '../src/pages/services/services.php';
        echo '<script>window.location.replace("index.php");</script>';
        exit();
    }
    if(isset($_POST["newspaper"])) {
        $_SESSION['currentPage'] = '../src/pages/inprogress/inprogress.php';
        echo '<script>window.location.replace("index.php");</script>';
        exit();
    }
}
    // Array con las paginas que estan en progreso
$in_progress_pages = [
    '../src/pages/shop/shop.php',
    '../src/pages/peluqueria/peluqueria.php',
    '../src/pages/hospitalization/hospitalization.php',
    '../src/pages/atencion/atencion.php'
];

if (!isset($_SESSION["currentPage"])) {
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