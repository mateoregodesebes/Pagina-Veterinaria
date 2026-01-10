<?php
require_once(__DIR__ . '/../../../includes/connection.php');

//!Decidir despues si se agrega un efecto con js aca, si se agrega recomiendo hacer un script aparte y ponerlo aca
if (isset($_SESSION['error'])) {
  if ($_SESSION['error']) {
    echo '<div id="alert" class="alert alert-danger" role="alert">
    Error al cargar turno, intente nuevamente
          </div>';
  } else {
    echo '<div id="alert" class="alert alert-success" role="alert">
    Turno actualizado con exito
          </div>';
  }
  echo '<script type="text/javascript">
    setTimeout(function() {
      var alert = document.getElementById("alert");
      alert.style.display = "none";
    }, 5000); // 5 seconds
  </script>';
  $_SESSION['error'] = null;
}

$registrosPagina = 7;
$paginaActual = isset($_GET['pagina']) ? (int)$_GET['pagina'] : 1;
$paginaActual = max($paginaActual, 1);
$offset = ($paginaActual - 1) * $registrosPagina;

$query = "SELECT * FROM atenciones ORDER BY id LIMIT $registrosPagina OFFSET $offset";
$result = mysqli_query($conn, $query);

$paginadoTotal = mysqli_query($conn, "SELECT COUNT(*) as total FROM atenciones");
$filaTotal = mysqli_fetch_assoc($paginadoTotal);
$totalRegistros = $filaTotal['total'];
$totalPaginas = ceil($totalRegistros / $registrosPagina);
?>

<h3 class="mt-3"> Turnos </h3>
<table class="table table-bordered border-3 table-hover table-striped">
  <thead>
    <tr>
      <th scope="col">ID</th>
      <th scope="col">Mascota</th>
      <th scope="col">Servicio</th>
      <th scope="col">Personal</th>
      <th scope="col">Fecha y hora</th>
      <th scope="col">Titulo</th>
      <th scope="col">Descripcion</th>
      <form method="post">
        <th scope="col"><button class="plus-icon" type="submit" name="action" value="create"><i
              class="fa-solid fa-plus"></i></button>
        </th>
      </form>
    </tr>
  </thead>
  <tbody>
    <?php while ($row = mysqli_fetch_array($result)): ?>
      <tr>
        <td>
          <?= $row['id'] ?>
        </td>
        <td>
          <?= $row['mascota_id'] ?>
        </td>
        <td>
          <?= $row['servicio_id'] ?>
        </td>
        <td>
          <?= $row['personal_id'] ?>
        </td>
        <td>
          <?= $row['fecha_hora'] ?>
        </td>
        <td>
          <?= $row['titulo'] ?>
        </td>
        <td>
          <?= $row['descripcion'] ?>
        </td>

        <td>
          <form method="post">
            <input type="hidden" name="id" value="<?= $row['id'] ?>">
            <button type="submit" name="action" value="update" class="btn btn-success">Actualizar</button>
            <button type="button" class="btn btn-danger" data-bs-toggle="modal"
              data-bs-target="#staticBackdrop<?= $row['id'] ?>">Borrar</button>

            <div class="modal fade" id="staticBackdrop<?= $row['id'] ?>" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1"
              aria-labelledby="staticBackdropLabel<?= $row['id'] ?>" aria-hidden="true">
              <div class="modal-dialog modal-dialog-centered">
                <div class="modal-content">
                  <div class="modal-header">
                    <h1 class="modal-title fs-5" id="staticBackdropLabel<?= $row['id'] ?>">Usted esta a punto de borrar un cliente</h1>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                  </div>
                  <div class="modal-body">
                    Esta seguro?
                  </div>
                  <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cancelar</button>
                    <button type="submit" class="btn btn-primary" name="action" value="delete">Si</button>
                  </div>
                </div>
              </div>
            </div>
          </form>
        </td>
      </tr>
      <?php
    endwhile;
    mysqli_free_result($result);
    ?>
  </tbody>
</table>

<nav aria-label="Page navigation">
  <ul class="pagination justify-content-center">
    <?php for ($pagina = 1; $pagina <= $totalPaginas; $pagina++): ?>
      <li class="page-item <?= ($paginaActual == $pagina) ? 'active' : '' ?>">
        <a class="page-link" href="index.php?pagina=<?= $pagina ?>"><?= $pagina ?></a>
      </li>
    <?php endfor; ?>
  </ul>
</nav>

<?php
if ($_SERVER['REQUEST_METHOD'] == 'POST') {
  if ($_POST['action'] == 'update') {
    $_SESSION["currentPage"] = '../src/pages/abmTurno/abmFormTurno.php';
    $_SESSION["idTurno"] = $_POST['id'];
    echo '<script>window.location.replace("index.php");</script>';

  } elseif ($_POST['action'] == 'delete') {
    require_once(__DIR__ . '/../../entity-dbs/atenciones/bajaTurnos.php');
    echo '<script>window.location.replace("index.php");</script>';
    exit();
  } elseif ($_POST['action'] == 'create') {
    $_SESSION["currentPage"] = '../src/pages/abmTurno/abmFormTurno.php';
    echo '<script>window.location.replace("index.php");</script>';
  }
}
mysqli_close($conn);
?>