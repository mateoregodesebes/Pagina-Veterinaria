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

    <input type="radio" class="btn-check" name="option" id="btnradio3" autocomplete="off" value="turnos">
    <label class="btn btn-outline-primary" for="btnradio3">Turnos</label>

    <input type="radio" class="btn-check" name="option" id="btnradio4" autocomplete="off" value="veterinarios">
    <label class="btn btn-outline-primary" for="btnradio4">Veterinarios</label>

    <input type="radio" class="btn-check" name="option" id="btnradio5" autocomplete="off" value="peluqueros">
    <label class="btn btn-outline-primary" for="btnradio5">Peluqueros</label>

    <input type="radio" class="btn-check" name="option" id="btnradio6" autocomplete="off" value="estudiantes">
    <label class="btn btn-outline-primary" for="btnradio6">Estudiantes</label>
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
   if ($_SESSION['crudSelected'] == 'turnos') {
    require_once(__DIR__ . '/../abmTurno/abmListTurno.php');
  }
  if ($_SESSION['crudSelected'] == 'veterinarios') {
    require_once(__DIR__ . '/../abmStaff/abmListStaff.php');
  }
  if ($_SESSION['crudSelected'] == 'peluqueros') {
    require_once(__DIR__ . '/../abmStaff/abmListStaff.php');
  }
  if ($_SESSION['crudSelected'] == 'estudiantes') {
    require_once(__DIR__ . '/../abmStaff/abmListStaff.php');
  }
}
?>