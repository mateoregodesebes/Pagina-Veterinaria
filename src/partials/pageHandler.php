<?php
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
    require_once("../src/pages/homeoage/homepage.php");
} elseif (isset($_SESSION["currentPage"])) {
    // Si la pagina actual esta en el array de paginas en progreso, se muestra la pagina de en progreso
    if (in_array($_SESSION["currentPage"], $in_progress_pages)) {
        require_once("../src/pages/inprogress/inprogress.php");
    } else {
        require_once($_SESSION["currentPage"]);
    }
}
?>