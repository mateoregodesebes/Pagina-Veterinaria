<?php

$sitemap_role = $_SESSION["user_role"] ?? 'cliente';

$sitemap = array(
    "cliente" => array(
    "La veterinaria" => array(
        "Inicio" => "home",
        "Quienes Somos" => "about-us",
        "Contacto" => "contact",
        "Noticias peludas" => "newspaper"
        ),
    "Servicios y funciones" => array(
        "Listado de precios para servicios" => "services",
        "Pedido de turnos" => "requestAppointment",
        "Tienda online" => "shop"
        ),
    "Usuario" => array(
        "Registrarse" => "register",
        "Mi perfil" => "profile"
        )
    ),
    "Veterinario" => array(
        "Atención domiciliaria" => array(
            "Inicio" => "home"
            ),
        "Usuario" => array(
            "Mi perfil" => "profile"
            )
    ),
    "Peluquero" => array(
        "Turnos" => array(
            "Ver mis turnos" => "viewAppointments"
            ),
        "Usuario" => array(
            "Mi perfil" => "profile"
            )
    ),
    "Estudiante" => array(
        "Turnos" => array(
            "Ver mis turnos" => "viewAppointments"
            ),
        "Usuario" => array(
            "Mi perfil" => "profile"
            )
    ),
    'Asistente' => array()
);

$sitemap_col_length = $sitemap_role != 'Asistente' ? 12 / count($sitemap[$sitemap_role]) : 0; 

$hasSitemap = $sitemap_role === 'Asistente' ? false : true;

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

    <?php
    if($hasSitemap){
    ?>
    <div class="col-12 sitemap">
        <?php
        foreach($sitemap[$sitemap_role] as $sitemap_elem_title => $sitemap_elem_array)  {
        ?>
            <div class="col-<?=$sitemap_col_length?> sitemap-elem"> 
            <h3><?=$sitemap_elem_title?></h3>
            <ul>
            <?php
            foreach($sitemap_elem_array as $sitemap_elem_desc => $sitemap_route){
                ?>
                <li>
                    <form action="index.php" method="post">
                        <button type="submit" name="<?=$sitemap_route?>"> 
                            <?=$sitemap_elem_desc?>
                        </button>
                    </form> 
                </li>
                <?php
            }
            ?>
            </div>
        <?php
        }
        ?>
    </div>
    <?php
    }
    ?>
    <p class="note">Este sitio es realizado para una prueba práctica de la materia Entornos Gráficos de la Universidad Tecnologica
        Nacional Regional Rosario (UTNFRRO), no representa a ninguna veterinaria ni debe ser tomada como ello.</p>
</div>