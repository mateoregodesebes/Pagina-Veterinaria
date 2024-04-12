<div class="row my-5 inprogress">
  <div class="col-3">
    <img src="../assets/inprogress.png" alt="Hamster con casco de trabajo" class="img-fluid">
  </div>
  <div class="col-9">
    <h1>¡Estamos trabajando en ello!</h1>
    <?php

    switch ($_SESSION['currentPage']) {
      case '../src/pages/shop/shop.php':
        echo '<p>Pronto podrás disfrutar de nuestros servicios de tienda en línea.</p>';
        break;
      case '../src/pages/peluqueria/peluqueria.php':
        echo '<p>Pronto podrás disfrutar de nuestros servicios de turnos online para peluqueria.</p>';
        break;
      case '../src/pages/hospitalization/hospitalization.php':
        echo '<p>Pronto podrás disfrutar de nuestros servicios de solicitud de hospitalización en linea.</p>';
        break;
      case '../src/pages/atencion/atencion.php':
        echo '<p>Pronto podrás disfrutar de nuestros servicios de atención a domicilio.</p>';
        break;
      default:
        echo '<p>Pronto podrás disfrutar de nuestros servicios.</p>';
    }
    ?>
  </div>
</div>