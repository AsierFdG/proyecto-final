<?php
require_once __DIR__ . "/../controlador/funcionesPublicaciones.php";

$datosPublicaciones = obtenerDatosPublicaciones();
$publicaciones = $datosPublicaciones["publicaciones"];
$usuarios = $datosPublicaciones["usuarios"];

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
        <h2 class="text-center mb-4 form-title">
          <i class="bi bi-map"></i> Publicaciones
        </h2>

        <div class="row g-3">
          <div class="col-md-6">
            <label class="form-label fw-semibold">
              <i class="bi bi-bar-chart"></i> Dificultad
            </label>
            <select id="filtroDificultad" class="form-select">
              <option value="">Todas</option>
              <option value="Facil">Facil</option>
              <option value="Media">Media</option>
              <option value="Dificil">Dificil</option>
              <option value="Muy dificil">Muy dificil</option>
            </select>
          </div>

          <div class="col-md-6">
            <label class="form-label fw-semibold">
              <i class="bi bi-person"></i> Usuario
            </label>
            <select id="filtroUsuario" class="form-select">
              <option value="">Todos</option>
              <?php foreach ($usuarios as $idUsuario => $nombreUsuario): ?>
                <option value="<?= campoPublicacion($idUsuario) ?>">
                  <?= campoPublicacion($nombreUsuario) ?>
                </option>
              <?php endforeach; ?>
            </select>
          </div>
        </div>
      </div>
    </div>
  </div>

  <div class="row justify-content-center">
    <div class="col-xl-10 col-lg-11">

      <div id="mensajeSinResultados" class="alert alert-info text-center d-none">
        No hay publicaciones que coincidan con los filtros.
      </div>

      <div class="d-none d-md-block">
        <div class="table-responsive tabla-publicaciones shadow-sm">
          <table class="table table-hover align-middle bg-white mb-0">
            <thead class="table-light">
              <tr class="text-center">
                <th class="py-3">Usuario</th>
                <th class="py-3">Titulo</th>
                <th class="py-3">Dificultad</th>
                <th class="py-3">Duracion</th>
                <th class="py-3">Km</th>
                <th class="py-3">Accion</th>
              </tr>
            </thead>

            <tbody>
              <?php if (!empty($publicaciones)): ?>
                <?php foreach ($publicaciones as $pub): ?>
                  <?php $color = colorDificultad($pub['dificultad_nombre']); ?>

                  <tr class="text-center publicacion-item"
                      data-dificultad="<?= campoPublicacion($pub['dificultad_nombre']) ?>"
                      data-usuario="<?= campoPublicacion($pub['usuario_id']) ?>">
                    <td class="py-4">
                      <?= campoPublicacion($pub['nombre_usuario']) ?>
                    </td>

                    <td class="fw-semibold py-4">
                      <?= campoPublicacion($pub['titulo']) ?>
                    </td>

                    <td>
                      <span class="badge bg-<?= campoPublicacion($color) ?> px-3 py-2">
                        <?= campoPublicacion($pub['dificultad_nombre']) ?>
                      </span>
                    </td>

                    <td><?= campoPublicacion($pub['tiempo_estimado']) ?></td>

                    <td><?= campoPublicacion($pub['kilometros']) ?> km</td>

                    <td>
                      <a href="ver.php?id=<?= campoPublicacion($pub['id']) ?>&origen=publicaciones" class="btn btn-custom btn-sm px-3">
                        Ver
                      </a>
                    </td>
                  </tr>
                <?php endforeach; ?>
              <?php else: ?>
                <tr>
                  <td colspan="6" class="text-center py-5 text-muted">
                    No hay publicaciones todavia
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
            <?php $color = colorDificultad($pub['dificultad_nombre']); ?>

            <div class="card mb-3 shadow border-0 publicacion-item"
                 data-dificultad="<?= campoPublicacion($pub['dificultad_nombre']) ?>"
                 data-usuario="<?= campoPublicacion($pub['usuario_id']) ?>">
              <div class="card-body">
                <div class="d-flex justify-content-between align-items-start gap-3 mb-2">
                  <div>
                    <h5 class="fw-bold mb-1"><?= campoPublicacion($pub['titulo']) ?></h5>
                    <p class="text-muted mb-0"><?= campoPublicacion($pub['nombre_usuario']) ?></p>
                  </div>

                  <span class="badge bg-<?= campoPublicacion($color) ?>">
                    <?= campoPublicacion($pub['dificultad_nombre']) ?>
                  </span>
                </div>

                <p class="mb-1">
                  <strong>Duracion:</strong> <?= campoPublicacion($pub['tiempo_estimado']) ?>
                </p>

                <p class="mb-3">
                  <strong>Km:</strong> <?= campoPublicacion($pub['kilometros']) ?> km
                </p>

                <a href="ver.php?id=<?= campoPublicacion($pub['id']) ?>&origen=publicaciones" class="btn btn-custom btn-sm w-100">
                  Ver
                </a>
              </div>
            </div>
          <?php endforeach; ?>
        <?php else: ?>
          <div class="alert alert-info text-center">
            No hay publicaciones todavia
          </div>
        <?php endif; ?>
      </div>

    </div>
  </div>

</div>
</main>

<script>
document.addEventListener("DOMContentLoaded", function() {
  const filtroDificultad = document.getElementById("filtroDificultad");
  const filtroUsuario = document.getElementById("filtroUsuario");
  const publicaciones = document.querySelectorAll(".publicacion-item");
  const mensajeSinResultados = document.getElementById("mensajeSinResultados");

  function aplicarFiltros() {
    const dificultadSeleccionada = filtroDificultad.value;
    const usuarioSeleccionado = filtroUsuario.value;
    let visibles = 0;

    publicaciones.forEach(function(publicacion) {
      const coincideDificultad = !dificultadSeleccionada || publicacion.dataset.dificultad === dificultadSeleccionada;
      const coincideUsuario = !usuarioSeleccionado || publicacion.dataset.usuario === usuarioSeleccionado;
      const mostrar = coincideDificultad && coincideUsuario;

      publicacion.classList.toggle("d-none", !mostrar);

      if (mostrar) {
        visibles++;
      }
    });

    if (mensajeSinResultados) {
      mensajeSinResultados.classList.toggle("d-none", visibles !== 0 || publicaciones.length === 0);
    }
  }

  filtroDificultad.addEventListener("change", aplicarFiltros);
  filtroUsuario.addEventListener("change", aplicarFiltros);
});
</script>

<?php include("footer.php"); ?>
