
<?php
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    if (isset($_POST["about-us"])) {
        $_SESSION['currentPage'] = '../src/pages/aboutus/aboutus.php';
        echo '<script>window.location.replace("index.php");</script>';
        exit();
    }}
?>
<div class="row">
    <div class="col-6 footerblock">
        <address>
            Dirección: 1234 Calle Prueba<br>
            <a class="footer-link" href="https://www.google.com/maps">Ver en Google Maps</a><br>
            Teléfono: 341 - 1234567
        </address>
    </div>
    <div class="col-6 footerblock">
        <form action="index.php" method="post">
                        <button class="footer-link" type="submit" name="about-us"> 
                            Quienes somos
                        </button>
        </form>
        <p>Nuestras redes sociales:</p>
        <div class="row">
            <div class="col-6">
                <a class="footer-link" href="https://www.facebook.com/">
                    <i class="fa fa-facebook-square" aria-hidden="true"></i>
                    Nuestro Facebook</a>
            </div>
            <div class="col-6">
                <a class="footer-link" href="https://www.instagram.com/">
                    <i class="fa fa-instagram" aria-hidden="true"></i>
                    Nuestro Instagram</a>
            </div>
        </div>
    </div>
    <p>Este sitio es realizado para una prueba práctica de la materia Entornos Gráficos de la Universidad Tecnologica
        Nacional Regional Rosario (UTNFRRO), no representa a ninguna veterinaria ni debe ser tomada como ello.</p>
</div>