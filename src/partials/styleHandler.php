<?php

// Lógica por si entra por el mail de recuperar contraseña
// Si hay un token en la URL, se carga la pagina de reset-password
if ($_GET['token'] ?? false) {
    $_SESSION["reset_psw_token"] = $_GET['token'] ?? '';
    $_SESSION["currentPage"] = '../src/pages/forgot-password/reset-password.php';
}
else if(isset($_SESSION["currentPage"]) && isset($_SESSION["user_role"])) {
    if($_SESSION["currentPage"] == "../src/pages/homepage/homepage.php" && $_SESSION["user_role"] != 'Profesional') {
    echo '<link rel="stylesheet" href="css/atencion.css">';
    }
}

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
        case '../src/pages/abmStaff/abmListStaff.php':
        case '../src/pages/abmStaff/abmFormStaff.php':
        case '../src/pages/abmTurno/abmListTurno.php':
        case '../src/pages/abmTurno/abmFormTurno.php':
            echo '<link rel="stylesheet" href="css/abm.css">';
            break;
        case '../src/pages/contact/contact.php':
            echo '<link rel="stylesheet" href="css/contact.css">';
            break;
        case '../src/pages/forgot-password/forgot-password.php':
        case '../src/pages/forgot-password/reset-password.php':
            echo '<link rel="stylesheet" href="css/forgot-password.css">';
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
        case '../src/pages/services/services.php':
            echo '<link rel="stylesheet" href="css/services.css">';
            break;
        case '../src/pages/inprogress/inprogress.php':
            echo '<link rel="stylesheet" href="css/inprogress.css">';
            break;
        case '../src/pages/aboutus/aboutus.php':
            echo '<link rel="stylesheet" href="css/aboutus.css">';
            break;
        case '../src/pages/requestAppointment/requestAppointment.php':
            echo '<link rel="stylesheet" href="css/requestAppointment.css">';
            break;
        case '../src/pages/viewAppointments/viewAppointments.php':
            echo '<link rel="stylesheet" href="css/viewAppointments.css">';
            break;
        case '../src/pages/addPet/addPet.php':
            echo '<link rel="stylesheet" href="css/addPet.css">';
            break;
        case '../src/pages/atencionDom/atencionMain.php':
            echo '<link rel="stylesheet" href="css/atencion.css">';
            break;
        case '../src/pages/editAppointment/editAppointment.php':
            echo '<link rel="stylesheet" href="css/editAppointment.css">';
            break;
    }
} else {
    echo '<link rel="stylesheet" href="css/homepage.css">';
}
?>