<?php
$_SESSION['currentPage'] = '../src/pages/homepage/homepage.php';
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    if (isset($_POST["shopButton"])) {
        $_SESSION['currentPage'] = '../src/pages/shop/shop.php';
        echo '<script>window.location.replace("index.php");</script>';
        exit();
    }
    if (isset($_POST["PeluqButton"])) {
        // $_SESSION['atencion'] = 'Corte de pelo';
        $_SESSION['currentPage'] = '../src/pages/peluqueria/peluqueria.php';
        echo '<script>window.location.replace("index.php");</script>';
        exit();
    }
    if (isset($_POST["AtButton"])) {
        // $_SESSION['atencion'] = 'Revisión Médica';
        $_SESSION['currentPage'] = '../src/pages/atencion/atencion.php';
        echo '<script>window.location.replace("index.php");</script>';
        exit();
    }
    if (isset($_POST["HospButton"])) {
        $_SESSION['currentPage'] = '../src/pages/hospitalization/hospitalization.php';
        echo '<script>window.location.replace("index.php");</script>';
        exit();
    }
}

?>

<div class="row fondo">
    <div class="col-md-4 my-5">
        <h1>¿Tu mascota necesita ayuda?</h1>
        <h3>Comunícate por asistencia a domicilio.</h3>
        <div class="row">
            <div class="col-md-10">
            </div>
            <div class="col-md-2 text-center mt-md-0 mt-3">
                <a class="whatsapp-link d-inline-block" href="https://chat.whatsapp.com/HJUCUqL6SON3BkIJs6NlvX">
                    <i class="fa-brands fa-whatsapp fa-3x icono"></i>
                </a>
            </div>
        </div>
    </div>
</div>
<div class="row mb-5 mt-4 g-2">

    <div class="col-md-3 col-12 cartas">
        <form action="index.php" method="post">
            <button class="card-btn" type="submit" name="PeluqButton">
                <div class="card">
                    <img class="card-img-top" src="..\assets\loro-card.png" alt="Card image cap">
                    <div class="card-img-overlay">
                        <h5 class="card-title" style="color: white;">Peluquería</h5>
                    </div>
                </div>
            </button>
        </form>
    </div>

    <div class="col-md-3 col-12 cartas">
        <form action="index.php" method="post">
            <button class="card-btn" type="submit" name="AtButton">
                <div class="card">
                    <img class="card-img-top" src="..\assets\perro-card.png" alt="Card image cap">
                    <div class="card-img-overlay">
                        <h5 class="card-title" style="color: white;">Atencion a domicilio</h5>
                    </div>
                </div>
            </button>
        </form>
    </div>


    <div class="col-md-3 col-12 cartas">
        <form action="index.php" method="post">
            <button class="card-btn" type="submit" name="HospButton">
                <div class="card">
                    <img class="card-img-top" src="..\assets\gato-card.png" alt="Card image cap">
                    <div class="card-img-overlay">
                        <h5 class="card-title" style="color: white;">Hospitalización</h5>
                    </div>
                </div>
            </button>
        </form>
    </div>

    <div class="col-md-3 col-12 cartas">
        <form action="index.php" method="post">
            <button class="card-btn" type="submit" name="shopButton">
                <div class="card">
                    <img class="card-img-top" src="..\assets\pajaro-card.png" alt="Card image cap">
                    <div class="card-img-overlay">
                        <h5 class="card-title" style="color: white;">Tienda</h5>
                    </div>
                </div>
            </button>
        </form>
    </div>

</div>