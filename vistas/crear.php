<?php include("cabecera.php"); ?>

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

</head>

<body>

<div class="container py-5">

  <div class="row justify-content-center">
    <div class="col-xl-10 col-lg-11">

      <div class="card p-4 p-md-5">

        <h2 class="text-center mb-4 form-title">
          <i class="bi bi-map"></i> Crear nueva ruta
        </h2>

        <form action="../controlador/crearPublicaciones.php" method="POST" enctype="multipart/form-data">

          <div class="row g-4">

            <!-- IZQUIERDA -->
            <div class="col-lg-6">

              <div class="mb-3">
                <label class="form-label"><i class="bi bi-pencil"></i> Título</label>
                <input type="text" name="titulo" class="form-control" required>
              </div>

              <div class="mb-3">
                <label class="form-label"><i class="bi bi-textarea"></i> Descripción</label>
                <textarea name="descripcion" class="form-control" rows="5" required></textarea>
              </div>

              <div class="mb-3">
                <label class="form-label"><i class="bi bi-bar-chart"></i> Dificultad</label>
                <select name="dificultad" class="form-select" required>
                  <option value="">Selecciona</option>
                  <option value="1">Fácil</option>
                  <option value="2">Media</option>
                  <option value="3">Difícil</option>
                  <option value="4">Muy difícil</option>
                </select>
              </div>

              <div class="row">
                <div class="col-md-6 mb-3">
                  <label class="form-label"><i class="bi bi-clock"></i> Tiempo</label>
                  <input type="text" name="tiempo" class="form-control" required>
                </div>

                <div class="col-md-6 mb-3">
                  <label class="form-label"><i class="bi bi-signpost"></i> Km</label>
                  <input type="number" step="0.1" name="kilometros" class="form-control" required>
                </div>
              </div>

            </div>

            <!-- DERECHA -->
            <div class="col-lg-6">

              <div class="mb-3">
                <label class="form-label"><i class="bi bi-geo-alt"></i> Punto de inicio</label>
                <input type="text" name="punto_inicio" class="form-control" required>
              </div>

              <div class="row">
                <div class="col-md-6 mb-3">
                  <label class="form-label"><i class="bi bi-arrow-up"></i> Desnivel +</label>
                  <input type="number" name="desnivel_positivo" class="form-control">
                </div>

                <div class="col-md-6 mb-3">
                  <label class="form-label"><i class="bi bi-arrow-down"></i> Desnivel -</label>
                  <input type="number" name="desnivel_negativo" class="form-control">
                </div>
              </div>

              <div class="mb-3">
                <label class="form-label"><i class="bi bi-triangle"></i> Cimas</label>
                <input type="text" name="cimas" class="form-control" required>
              </div>

              <div class="mb-3">
                <label class="form-label"><i class="bi bi-images"></i> Imágenes</label>
                <input type="file" id="imagenes" name="imagenes[]" class="form-control" multiple accept="image/*" required>
              </div>
              <div id="preview" class="row g-2"></div>
            </div>

          </div>

          <!-- BOTÓN -->
          <div class="d-grid mt-4">
            <button type="submit" class="btn btn-custom btn-lg">
              <i class="bi bi-upload"></i> Publicar ruta
            </button>
          </div>

        </form>

      </div>

    </div>
  </div>

</div>

</body>
</html>
</main>


<?php include("footer.php"); ?>
<!-- Bootstrap JS -->
<script>
document.addEventListener("DOMContentLoaded", function() {

  const input = document.getElementById('imagenes');
  const preview = document.getElementById('preview');

  let archivos = [];

  input.addEventListener('change', function(e) {

    const nuevosArchivos = Array.from(e.target.files);

    // 🔥 CLAVE: acumular en vez de reemplazar
    archivos = archivos.concat(nuevosArchivos);

    actualizarInput();
    mostrarPreview();
  });

  function mostrarPreview() {

    preview.innerHTML = "";

    archivos.forEach((file, index) => {

      if (!file.type.startsWith("image/")) return;

      const reader = new FileReader();

      reader.onload = function(e) {

        const col = document.createElement("div");
        col.className = "col-12 col-md-6 col-lg-4 position-relative";

        const img = document.createElement("img");
        img.src = e.target.result;
        img.className = "img-fluid rounded shadow";
        img.style.cssText = "height:250px; width:100%; object-fit:cover;";

        const btn = document.createElement("button");
        btn.innerHTML = "×";
        btn.className = "btn btn-danger position-absolute top-0 end-0 m-2 rounded-circle";
        btn.style.width = "35px";
        btn.style.height = "35px";

        btn.onclick = function() {
          archivos.splice(index, 1);
          actualizarInput();
          mostrarPreview();
        };

        col.appendChild(img);
        col.appendChild(btn);
        preview.appendChild(col);
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
