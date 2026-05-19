<?php
require_once __DIR__ . "/../controlador/perfilControl.php";


$idSeleccionado = isset($_GET['id']) ? (int) $_GET['id'] : null;
$publicaciones=mostrarPublicaciones();
$publicacionesUsuario = [];
$publicacion = null;



    $resultadoPublicaciones = mostrarPublicaciones();

    if ($resultadoPublicaciones) {
        while ($fila = $resultadoPublicaciones->fetch_assoc()) {
            $publicacionesUsuario[] = $fila;
        }
    }


if ($idSeleccionado) {
    foreach ($publicaciones as $pub) {
        if ((int) $pub['id'] === $idSeleccionado) {
            $publicacion = mostrarPublicacionById($idSeleccionado);
            break;
        }
    }
}

function campoEditar($valor) {
    return htmlspecialchars((string) ($valor ?? ''), ENT_QUOTES, 'UTF-8');
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
}
</style>

<div class="container py-5">

  <div class="row justify-content-center mb-4">
    <div class="col-xl-10 col-lg-11">
      <div class="card p-4">
        <label class="form-label fw-semibold">
          <i class="bi bi-hash"></i> Selecciona el ID de la publicacion
        </label>

        <select id="selectorPublicacion" class="form-select">
          <option value="">Selecciona una publicacion</option>
          <?php foreach ($publicacionesUsuario as $pub): ?>
            <option value="<?= campoEditar($pub['id']) ?>" <?= ((int) $pub['id'] === $idSeleccionado) ? 'selected' : '' ?>>
               <?= campoEditar($pub['titulo']) ?>
            </option>
          <?php endforeach; ?>
        </select>
      </div>
    </div>
  </div>

 
  <?php if ($idSeleccionado && !$publicacion): ?>
    <div class="alert alert-danger text-center">
      No se ha encontrado una publicacion tuya con ese ID.
    </div>
  <?php endif; ?>

  <?php if ($publicacion): ?>
  <div class="row justify-content-center">
    <div class="col-xl-10 col-lg-11">

      <div class="card p-4 p-md-5">

        <h2 class="text-center mb-4 form-title">
          <i class="bi bi-map"></i> Editar ruta
        </h2>

        <form action="../controlador/editarPublicaciones.php" method="POST" enctype="multipart/form-data">
          <input type="hidden" name="id" value="<?= campoEditar($publicacion['id']) ?>">

          <div class="row g-4">

            <!-- IZQUIERDA -->
            <div class="col-lg-6">

              <div class="mb-3">
                <label class="form-label"><i class="bi bi-pencil"></i> Titulo</label>
                <input type="text" name="titulo" class="form-control" value="<?= campoEditar($publicacion['titulo']) ?>" required>
              </div>

              <div class="mb-3">
                <label class="form-label"><i class="bi bi-textarea"></i> Descripcion</label>
                <textarea name="descripcion" class="form-control" rows="5" required><?= campoEditar($publicacion['descripcion']) ?></textarea>
              </div>

              <div class="mb-3">
                <label class="form-label"><i class="bi bi-bar-chart"></i> Dificultad</label>
                <select name="dificultad" class="form-select" required>
                  <option value="">Selecciona</option>
                  <option value="1" <?= ((string) $publicacion['dificultad'] === '1') ? 'selected' : '' ?>>Facil</option>
                  <option value="2" <?= ((string) $publicacion['dificultad'] === '2') ? 'selected' : '' ?>>Media</option>
                  <option value="3" <?= ((string) $publicacion['dificultad'] === '3') ? 'selected' : '' ?>>Dificil</option>
                  <option value="4" <?= ((string) $publicacion['dificultad'] === '4') ? 'selected' : '' ?>>Muy dificil</option>
                </select>
              </div>

              <div class="row">
                <div class="col-md-6 mb-3">
                  <label class="form-label"><i class="bi bi-clock"></i> Tiempo</label>
                  <input type="text" name="tiempo" class="form-control" value="<?= campoEditar($publicacion['tiempo_estimado']) ?>" required>
                </div>

                <div class="col-md-6 mb-3">
                  <label class="form-label"><i class="bi bi-signpost"></i> Km</label>
                  <input type="number" step="0.1" name="kilometros" class="form-control" value="<?= campoEditar($publicacion['kilometros']) ?>" required>
                </div>
              </div>

            </div>

            <!-- DERECHA -->
            <div class="col-lg-6">

              <div class="mb-3">
                <label class="form-label"><i class="bi bi-geo-alt"></i> Punto de inicio</label>
                <input type="text" name="punto_inicio" class="form-control" value="<?= campoEditar($publicacion['punto_inicio']) ?>" required>
              </div>

              <div class="row">
                <div class="col-md-6 mb-3">
                  <label class="form-label"><i class="bi bi-arrow-up"></i> Desnivel +</label>
                  <input type="number" name="desnivel_positivo" class="form-control" value="<?= campoEditar($publicacion['desnivel_positivo']) ?>">
                </div>

                <div class="col-md-6 mb-3">
                  <label class="form-label"><i class="bi bi-arrow-down"></i> Desnivel -</label>
                  <input type="number" name="desnivel_negativo" class="form-control" value="<?= campoEditar($publicacion['desnivel_negativo']) ?>">
                </div>
              </div>

              <div class="mb-3">
                <label class="form-label"><i class="bi bi-triangle"></i> Cimas</label>
                <input type="text" name="cimas" class="form-control" value="<?= campoEditar($publicacion['cimas']) ?>" required>
              </div>

              <div class="mb-3">
                <label class="form-label"><i class="bi bi-images"></i> Imagenes</label>
                <input type="file" id="imagenes" name="imagenes[]" class="form-control" multiple accept="image/*">
              </div>
              <div id="preview" class="row g-2"></div>
            </div>

          </div>

          <!-- BOTON -->
          <div class="d-grid mt-4">
            <button type="submit" class="btn btn-custom btn-lg">
              <i class="bi bi-save"></i> Guardar cambios
            </button>
          </div>

        </form>

      </div>

    </div>
  </div>
  <?php endif; ?>

</div>
</main>

<?php include("footer.php"); ?>
<!-- Bootstrap JS -->
<script>
document.addEventListener("DOMContentLoaded", function() {

  const selectorPublicacion = document.getElementById('selectorPublicacion');

  selectorPublicacion.addEventListener('change', function() {

    if (this.value) {
      window.location.href = 'editar.php?id=' + encodeURIComponent(this.value);
      return;
    }

    window.location.href = 'editar.php';
  });

  const input = document.getElementById('imagenes');
  const preview = document.getElementById('preview');

  if (!input || !preview) return;

  let archivos = [];
let imagenesActuales = <?php echo json_encode($publicacion['imagenes'] ?? [], JSON_UNESCAPED_SLASHES); ?>;

  mostrarPreview();

  input.addEventListener('change', function(e) {

    const nuevosArchivos = Array.from(e.target.files);

    archivos = archivos.concat(nuevosArchivos);

    actualizarInput();
    mostrarPreview();
  });

  function crearColumnaImagen(src, onRemove, nombreCampo, valorCampo) {
    const col = document.createElement("div");
    col.className = "col-12 col-md-6 col-lg-4 position-relative";

    const img = document.createElement("img");
    img.src = src;
    img.className = "img-fluid rounded shadow";
    img.style.cssText = "height:250px; width:100%; object-fit:cover;";

    const btn = document.createElement("button");
    btn.type = "button";
    btn.innerHTML = "&times;";
    btn.className = "btn btn-danger position-absolute top-0 end-0 m-2 rounded-circle";
    btn.style.width = "35px";
    btn.style.height = "35px";
    btn.onclick = onRemove;

    col.appendChild(img);
    col.appendChild(btn);

    if (nombreCampo && valorCampo) {
      const hidden = document.createElement("input");
      hidden.type = "hidden";
      hidden.name = nombreCampo;
      hidden.value = valorCampo;
      col.appendChild(hidden);
    }

    preview.appendChild(col);
  }

  function mostrarPreview() {

    preview.innerHTML = "";

    imagenesActuales.forEach((url, index) => {
      crearColumnaImagen(
        "/Proyecto-final/" + url,
        function() {
          imagenesActuales.splice(index, 1);
          mostrarPreview();
        },
        "imagenes_actuales[]",
        url
      );
    });

    archivos.forEach((file, index) => {

      if (!file.type.startsWith("image/")) return;

      const reader = new FileReader();

      reader.onload = function(e) {
        crearColumnaImagen(e.target.result, function() {
          archivos.splice(index, 1);
          actualizarInput();
          mostrarPreview();
        });
      };

      reader.readAsDataURL(file);
    });
  }

  function actualizarInput() {
    const dataTransfer = new DataTransfer();

    archivos.forEach(file => {
      dataTransfer.items.add(file);
    });

    input.files = dataTransfer.files;
  }

});
</script>
