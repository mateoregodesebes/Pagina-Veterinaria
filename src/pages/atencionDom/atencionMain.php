<?php
if (isset($_SESSION['alerta'])) {
  switch ($_SESSION['alerta']) {
    case 'noCliente':
      echo '<div id="alert" class="mt-2 alert alert-danger" role="alert">
    El cliente no existe, por favor verifique el id ingresado.
          </div>';
      break;
    case 'noMascotas':
      echo '<div id="alert" class="mt-2 alert alert-warning" role="alert">
    El cliente no tiene mascotas registradas, por favor registre una mascota.
          </div>';
      break;
    case 'noServicios':
    case 'noPersonal':
      echo '<div id="alert" class="mt-2 alert alert-warning" role="alert">
    Hay un problema con el servicio, porfavor intente nuevamente mas tarde.
          </div>';
      break;
    case 'errorTurno':
      echo '<div id="alert" class="mt-2 alert alert-warning" role="alert">
    Ha habido un error en el registro de la atencion intente nuevamente.
          </div>';
      break;
    case 'altaTurno':
      echo '<div id="alert" class="mt-2 alert alert-success" role="alert">
    La atencion se ha registrado correctamente.
          </div>';
      break;
  }

  echo '<script type="text/javascript">
    setTimeout(function() {
      var alert = document.getElementById("alert");
      alert.style.display = "none";
    }, 10000); // 10 seconds
  </script>';
  unset($_SESSION['alerta']);

  }
require_once __DIR__ . '/../../entity-dbs/clientes/getClientes.php';
?>
<script>
  document.addEventListener('DOMContentLoaded', function () {
    console.log('Search dropdown script loaded')
    const form = document.querySelector('form')
    const searchInput = document.getElementById('clienteSearchInput')
    const list = document.getElementById('clienteList')
    const items = Array.from(document.querySelectorAll('.cliente-item'))
    const hidden = document.getElementById('idClienteHidden')
    const btn = document.getElementById('clienteDropdownBtn')

    searchInput?.addEventListener('input', function () {
        const q = this.value.trim().toLowerCase()
        items.forEach((item) => {
            const text = item.textContent.toLowerCase()
            item.style.display = text.includes(q) ? '' : 'none'
        })
    })

    list?.addEventListener('click', function (e) {
        const item = e.target.closest('.cliente-item')
        if (!item) return

        hidden.value = item.dataset.id
        btn.textContent = item.dataset.label
        searchInput.value = ''

        items.forEach((i) => (i.style.display = ''))
    })

    form?.addEventListener('submit', function (e) {
        if (!hidden.value) {
            e.preventDefault()
            alert('Debe seleccionar un cliente.')
        }
    })
})
</script>
<form method="post">
  <div class="my-4 form-container">
    <div class="main-form">
      <div class="d-flex justify-content-center">
        <h1>Atención Domiciliaria</h1>
      </div>      

      <div class="my-3">
  <label class="form-label">Id de cliente:</label>

  <input type="hidden" name="idCliente" id="idClienteHidden">

  <div class="dropdown w-100">
    <button class="btn btn-outline-secondary dropdown-toggle w-100 text-start" type="button"
            id="clienteDropdownBtn" data-bs-toggle="dropdown" aria-expanded="false">
      Seleccione un cliente
    </button>

    <div class="dropdown-menu p-2 w-100" aria-labelledby="clienteDropdownBtn">
      <input type="text" class="form-control mb-2" id="clienteSearchInput" placeholder="Buscar por ID o nombre...">

      <div id="clienteList" style="max-height: 240px; overflow-y: auto;">
        <?php if (isset($clientes)): ?>
          <?php foreach ($clientes as $cliente): ?>
            <?php
              $id = (int)$cliente['id'];
              $nombre = htmlspecialchars($cliente['nombre'], ENT_QUOTES, 'UTF-8');
              $label = "ID: {$id} - {$nombre}";
            ?>
            <button type="button"
                    class="dropdown-item cliente-item"
                    data-id="<?= $id ?>"
                    data-label="<?= htmlspecialchars($label, ENT_QUOTES, 'UTF-8') ?>">
              <?= $label ?>
            </button>
          <?php endforeach; ?>
        <?php endif; ?>
      </div>
    </div>
  </div>

  <div class="form-text">Escriba para filtrar y seleccione un cliente.</div>
</div>
      <div class="mb-5 form-switch">
        <input class="form-check-input" name="petCheckbox" type="checkbox" role="switch" id="flexSwitchCheckDefault">
        <label class="form-check-label" for="flexSwitchCheckDefault">Se trata de una nueva mascota del cliente?</label>  
    
      </div>
      <div class="mb-3 d-flex justify-content-center">
        <button class="btn btn-primary" type="submit">Siguiente</button>
      </div>
    </div>
  </div>
</form>


<?php
if ($_SERVER['REQUEST_METHOD'] == 'POST') {
  include __DIR__ . '/../../entity-dbs/clientes/validaCliente.php';
  if ($clientFlag) {
    $_SESSION['user_idAt'] = $_POST['idCliente'];
    $_SESSION['currentPage'] = '../src/pages/atencionDom/formAtencion.php';
    if (isset($_POST['petCheckbox'])) {
      $_SESSION['currentPage'] = '../src/pages/abmMascota/abmFormMascota.php';
    }
  } else {
    $_SESSION['alerta'] = 'noCliente';
  }

  echo '<script>window.location.replace("index.php");</script>';
}
?>