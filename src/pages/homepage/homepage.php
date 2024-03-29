<?php
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    if (isset($_POST["shopButton"])) {
        $_SESSION['currentPage'] = '../src/pages/shop/shop.php';
        echo '<script>window.location.replace("index.php");</script>';
        exit();
    }
    if (isset($_POST["PeluqButton"])) {
        $_SESSION['atencion'] = 'Corte de pelo';
        $_SESSION['currentPage'] = '../src/pages/atencionDom/formAtencion.php';
        echo '<script>window.location.replace("index.php");</script>';
        exit();
    }
    if (isset($_POST["AtButton"])) {
        $_SESSION['atencion'] = 'Revisión Médica';
        $_SESSION['currentPage'] = '../src/pages/atencionDom/formAtencion.php';
        echo '<script>window.location.replace("index.php");</script>';
        exit();
    }
    if (isset($_POST["HospButton"])) {
        $_SESSION['currentPage'] = '../src/pages/atencionDom/formAtencion.php';
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
            <button type="submit" name="PeluqButton">
                <div class="card">
                    <img class="card-img-top" src="https://cdn.download.ams.birds.cornell.edu/api/v1/asset/95481341/1800" alt="Card image cap">
                    <div class="card-img-overlay">
                        <h5 class="card-title" style="color: white;">Peluquería</h5>
                    </div>
                </div>
            </button>
        </form>
    </div>

    <div class="col-md-3 col-12 cartas">
        <form action="index.php" method="post">
            <button type="submit" name="AtButton">
                <div class="card">
                    <img class="card-img-top" src="https://static.fundacion-affinity.org/cdn/farfuture/PVbbIC-0M9y4fPbbCsdvAD8bcjjtbFc0NSP3lRwlWcE/mtime:1643275542/sites/default/files/los-10-sonidos-principales-del-perro.jpg" alt="Card image cap">
                    <div class="card-img-overlay">
                        <h5 class="card-title" style="color: white;">Atencion a domicilio</h5>
                    </div>
                </div>
            </button>
        </form>
    </div>


    <div class="col-md-3 col-12 cartas">
        <form action="index.php" method="post">
            <button type="submit" name="HospButton">
                <div class="card">
                    <img class="card-img-top" src="https://pbs.twimg.com/amplify_video_thumb/1743686164731637760/img/uXiVAF1NNnZ7uhCv.jpg" alt="Card image cap">
                    <div class="card-img-overlay">
                        <h5 class="card-title" style="color: white;">Hospitalización</h5>
                    </div>
                </div>
            </button>
        </form>
    </div>


    <!--
        <div class="col-md-3">
            <div class="card" style="width: 18rem;">
            <img class="card-img-top" src="https://content.nationalgeographic.com.es/medio/2023/03/17/cenzontle-pajaro_0b18132a_230317114903_800x800.jpg" alt="Card image cap">
            <div class="card-body">
                <h5 class="card-title">Tienda</h5>
            </div>
            </div>
        </div>
        -->

    <div class="col-md-3 col-12 cartas">
        <form action="index.php" method="post">
            <button type="submit" name="shopButton">
                <div class="card">
                    <img class="card-img-top" src="https://content.nationalgeographic.com.es/medio/2023/03/17/cenzontle-pajaro_0b18132a_230317114903_800x800.jpg" alt="Card image cap">
                    <div class="card-img-overlay">
                        <h5 class="card-title" style="color: white;">Tienda</h5>
                    </div>
                </div>
            </button>
        </form>
    </div>

</div>