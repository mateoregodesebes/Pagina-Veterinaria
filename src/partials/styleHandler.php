<?php
if (isset($_SESSION["currentPage"])) {
    switch ($_SESSION["currentPage"]) {
        case '../src/pages/appointmentList/appointmentList.php':
            echo '<link rel="stylesheet" href="css/abm.css">';
            break;
        case '../src/pages/crudSelector/crudSelector.php':
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
} else {
    echo '<link rel="stylesheet" href="css/homepage.css">';
}
?>