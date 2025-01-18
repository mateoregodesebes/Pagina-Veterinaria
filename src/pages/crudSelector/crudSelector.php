<div class="btn-group mt-3" role="group">
  <form method="post">
    <input type="radio" class="btn-check" name="option" id="btnradio1" autocomplete="off" value="clientes">
    <label class="btn btn-outline-primary" for="btnradio1">Clientes</label>

    <input type="radio" class="btn-check" name="option" id="btnradio2" autocomplete="off" value="mascotas">
    <label class="btn btn-outline-primary" for="btnradio2">Mascotas</label>
    <button class="btn btn-dark submit-btn">Enviar</button>
  </form>
</div>

<?php
if ($_SERVER['REQUEST_METHOD'] == 'POST') {
  if (isset($_POST['option'])) {
    $selected_option = $_POST['option'];
    if ($selected_option == 'clientes') {
      require_once(__DIR__ . '/../abmCliente/abmListCliente.php');
    }
    if ($selected_option = $_POST['option']) {
      require_once(__DIR__ . '/../abmMascota/abmListMascota.php');
    }

  }

  exit();
}
?>