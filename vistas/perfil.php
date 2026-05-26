<?php
require_once __DIR__ . "/../controlador/perfilControl.php";
require_once __DIR__ . "/../controlador/funcionesPublicaciones.php";

$resultadoPublicaciones = mostrarPublicaciones();
$publicaciones = [];

if ($resultadoPublicaciones) {
    while ($fila = $resultadoPublicaciones->fetch_assoc()) {
        $publicaciones[] = prepararDificultadPublicacion($fila);
    }
}

$mensaje = null;
if (isset($_SESSION['toast_guardado'])) {
    $mensaje = $_SESSION['toast_guardado'];
    unset($_SESSION['toast_guardado']);
}

include("cabecera.php");
?>

<main class="container my-5 flex-grow-1">

<style>
body {
  background: linear-gradient(135deg, #e9f5ec, #ffffff);
}

.card {
  border-radius: 20px;
  box-shadow: 0 10px 30px rgba(0,0,0,0.1);
  border: none;
}

.form-control, .form-select {
  border-radius: 10px;
}

.form-title {
  font-weight: bold;
  color: #2c5e4e;
}

.btn-custom {
  background-color: #2c5e4e;
  color: white;
  border-radius: 10px;
}

.btn-custom:hover {
  background-color: #234b3d;
  color: white;
}

.tabla-publicaciones {
  border-radius: 20px;
  overflow: hidden;
}
</style>

<div class="container py-5">

  <div class="row justify-content-center mb-4">
    <div class="col-xl-10 col-lg-11">
      <div class="card p-4 p-md-5">
        <div class="d-flex flex-column flex-md-row justify-content-between align-items-md-center gap-3">
          <div>
            <h2 class="mb-2 form-title">
              <i class="bi bi-person"></i> Mi perfil
            </h2>
            <p class="text-muted mb-0">Gestiona tus rutas creadas</p>
          </div>

          <a href="crear.php" class="btn btn-custom px-4 py-2">
            <i class="bi bi-plus-circle"></i> Nueva publicacion
          </a>
        </div>
      </div>
    </div>
  </div>

  <div class="row justify-content-center">
    <div class="col-xl-10 col-lg-11">

      <div class="d-none d-md-block">
        <div class="table-responsive tabla-publicaciones shadow-sm">
          <table class="table table-hover align-middle bg-white mb-0">
            <thead class="table-light">
              <tr class="text-center">
                <th class="py-3">Titulo</th>
                <th class="py-3">Dificultad</th>
                <th class="py-3">Duracion</th>
                <th class="py-3">Km</th>
                <th class="py-3">Acciones</th>
              </tr>
            </thead>

            <tbody>
              <?php if (!empty($publicaciones)): ?>
                <?php foreach ($publicaciones as $pub): ?>
                  <?php
                    $dificultad = $pub['dificultad_nombre'];
                    $color = colorDificultad($pub['dificultad_nombre']);
                  ?>

                  <tr class="text-center">
                    <td class="fw-semibold py-4">
                      <?= campoPublicacion($pub['titulo']) ?>
                    </td>

                    <td>
                      <span class="badge bg-<?= campoPublicacion($color) ?> px-3 py-2">
                        <?= campoPublicacion($dificultad) ?>
                      </span>
                    </td>

                    <td><?= campoPublicacion($pub['tiempo_estimado']) ?></td>

                    <td><?= campoPublicacion($pub['kilometros']) ?> km</td>

                    <td>
                      <div class="d-flex justify-content-center gap-2">
                        <a href="ver.php?id=<?= campoPublicacion($pub['id']) ?>&origen=perfil" class="btn btn-custom btn-sm px-3">
                          Ver
                        </a>

                        <a href="editar.php?id=<?= campoPublicacion($pub['id']) ?>" class="btn btn-outline-warning btn-sm px-3">
                          Editar
                        </a>

                        <a href="../controlador/eliminarPubli.php?id=<?= campoPublicacion($pub['id']) ?>" class="btn btn-outline-danger btn-sm px-3">
                          Borrar
                        </a>
                      </div>
                    </td>
                  </tr>
                <?php endforeach; ?>
              <?php else: ?>
                <tr>
                  <td colspan="5" class="text-center py-5 text-muted">
                    No tienes publicaciones todavia
                  </td>
                </tr>
              <?php endif; ?>
            </tbody>
          </table>
        </div>
      </div>

      <div class="d-block d-md-none">
        <?php if (!empty($publicaciones)): ?>
          <?php foreach ($publicaciones as $pub): ?>
            <?php
              $dificultad = $pub['dificultad_nombre'];
              $color = colorDificultad($pub['dificultad_nombre']);
            ?>

            <div class="card mb-3 shadow border-0">
              <div class="card-body">
                <div class="d-flex justify-content-between align-items-start gap-3 mb-2">
                  <h5 class="fw-bold mb-0"><?= campoPublicacion($pub['titulo']) ?></h5>

                  <span class="badge bg-<?= campoPublicacion($color) ?>">
                    <?= campoPublicacion($dificultad) ?>
                  </span>
                </div>

                <p class="mb-1">
                  <strong>Duracion:</strong> <?= campoPublicacion($pub['tiempo_estimado']) ?>
                </p>

                <p class="mb-3">
                  <strong>Km:</strong> <?= campoPublicacion($pub['kilometros']) ?> km
                </p>

                <div class="d-flex gap-2">
                  <a href="ver.php?id=<?= campoPublicacion($pub['id']) ?>&origen=perfil" class="btn btn-custom btn-sm w-100">
                    Ver
                  </a>

                  <a href="editar.php?id=<?= campoPublicacion($pub['id']) ?>" class="btn btn-outline-warning btn-sm w-100">
                    Editar
                  </a>

                  <a href="../controlador/eliminarPubli.php?id=<?= campoPublicacion($pub['id']) ?>" class="btn btn-outline-danger btn-sm w-100">
                    Borrar
                  </a>
                </div>
              </div>
            </div>
          <?php endforeach; ?>
        <?php else: ?>
          <div class="alert alert-info text-center">
            No tienes publicaciones todavia
          </div>
        <?php endif; ?>
      </div>

    </div>
  </div>

</div>
</main>

<?php if ($mensaje): ?>
<script>
window.addEventListener("DOMContentLoaded", function () {
  const toast = document.createElement("div");
  toast.innerText = "<?= campoPublicacion($mensaje) ?>";
  toast.style.position = "fixed";
  toast.style.top = "20px";
  toast.style.right = "20px";
  toast.style.background = "<?= stripos($mensaje, 'eliminada') !== false ? '#dc3545' : '#28a745' ?>";
  toast.style.color = "white";
  toast.style.padding = "12px 18px";
  toast.style.borderRadius = "8px";
  toast.style.zIndex = "9999";
  toast.style.boxShadow = "0 10px 30px rgba(0,0,0,0.15)";

  document.body.appendChild(toast);

  setTimeout(function() {
    toast.remove();
  }, 5000);
});
</script>
<?php endif; ?>

<?php include("footer.php"); ?>
