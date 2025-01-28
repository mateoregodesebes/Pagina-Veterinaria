<script>
  $(document).ready(function(){
    // Submit button starts disabled
    $("#submitBtn").prop('disabled', true);

    // Enable submit button when the radio button is clicked
    $(".btn-check").on('click', function() {
      $("#submitBtn").prop('disabled', false);
    });
  });

</script>

<?php $_SESSION["currentPage"] = '../src/pages/crudSelector/crudSelector.php'; ?>

<div class="btn-group mt-3" role="group">
  <form method="post">
    <input type="radio" class="btn-check" name="option" id="btnradio1" autocomplete="off" value="clientes">
    <label class="btn btn-outline-primary" for="btnradio1">Clientes</label>

    <input type="radio" class="btn-check" name="option" id="btnradio2" autocomplete="off" value="mascotas">
    <label class="btn btn-outline-primary" for="btnradio2">Mascotas</label>
    <button class="btn btn-dark submit-btn" id="submitBtn">Enviar</button>
  </form>
</div>

<?php
if ($_SERVER['REQUEST_METHOD'] == 'POST') {
  if (isset($_POST['option'])) {
    $_SESSION['crudSelected'] = $_POST['option'];
    echo '<script>window.location.replace("index.php");</script>';
  }
}

if(isset($_SESSION['crudSelected'])) {
  if ($_SESSION['crudSelected'] == 'clientes') {
    require_once(__DIR__ . '/../abmCliente/abmListCliente.php');
  }
  if ($_SESSION['crudSelected'] == 'mascotas') {
    require_once(__DIR__ . '/../abmMascota/abmListMascota.php');
  }
}
?>