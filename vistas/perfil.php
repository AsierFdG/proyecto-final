<?php 
include("cabecera.php");
require_once __DIR__ . "/../controlador/perfilControl.php";

?>
<!-- ================= CONTENIDO ================= -->
<main class="container my-5 flex-grow-1">
    <h1 class="text-center mb-4">Perfil</h1>

    <div class="text-center text-muted">
        
<?php

$publi = mostrarPublicaciones();
$publicaciones = [
  ["id"=>1,"titulo"=>"Ruta por el monte","dificultad"=>"Fácil","tiempo_estimado"=>"2h","kilometros"=>"5"],
  ["id"=>2,"titulo"=>"Sendero costero","dificultad"=>"Media","tiempo_estimado"=>"4h","kilometros"=>"12"],
  ["id"=>3,"titulo"=>"Ascenso a la montaña","dificultad"=>"Difícil","tiempo_estimado"=>"6h","kilometros"=>"18"]
];

$colores = [
  "Fácil" => "success",
  "Media" => "warning",
  "Difícil" => "danger",
  "Muy difícil" => "dark"
];

$mensaje = null;
if (isset($_SESSION['toast_guardado'])) {
    $mensaje = $_SESSION['toast_guardado'];
    unset($_SESSION['toast_guardado']); 
    }
?>

<!DOCTYPE html>
<html lang="es">
<head>
  <meta charset="UTF-8">
  <title>Mis publicaciones</title>

  <!-- BOOTSTRAP -->
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet">
</head>

<body class="bg-light">

<div class="container py-5">

  <!-- CABECERA -->
  <div class="d-flex justify-content-between align-items-center mb-5">
    <div>
      <h2 class="fw-bold mb-2">Mis publicaciones</h2>
      <p class="text-muted mb-0">Gestiona tus rutas creadas</p>
    </div>

    <a href="crear.php" class="btn btn-success px-4 py-2">
      + Nueva publicación
    </a>
  </div>


  <!--  VISTA ESCRITORIO -->

  <div class="d-none d-md-block">

    <div class="table-responsive">

      <table class="table table-hover align-middle bg-white shadow-sm">
  
        <thead class="table-light">
          <tr class="text-center">
            <th class="py-3">Título</th>
            <th class="py-3">Dificultad</th>
            <th class="py-3">Duración</th>
            <th class="py-3">Km</th>
            <th class="py-3">Acciones</th>
          </tr>
        </thead>

        <tbody>

        <?php if(!empty($publi)): ?>

          <?php foreach($publi as $pub): ?>

          <?php
           
           $color = $colores[$pub['dificultad']] ?? "secondary";
          ?>

          <tr class="text-center">

            <td class="fw-semibold py-4">
              <?= $pub['titulo'] ?>
            </td>

            <td>
              <span class="badge bg-<?= $color ?> px-3 py-2">
                <?= $pub['dificultad'] ?>
              </span>
            </td>

            <td><?= $pub['tiempo_estimado'] ?></td>

            <td><?= $pub['kilometros'] ?> km</td>

            <td>
              <div class="d-flex justify-content-center gap-2">

                <a href="ver.php?id=<?= $pub['id'] ?>" 
                   class="btn btn-outline-success btn-sm px-3">
                  Ver
                </a>

                <a href="editar.php?id=<?= $pub['id'] ?>" 
                   class="btn btn-outline-warning btn-sm px-3">
                  Editar
                </a>

                <a href="../controlador/eliminarPubli.php?id=<?= $pub['id'] ?>" 
                   class="btn btn-outline-danger btn-sm px-3">
                  Borrar
                </a>

              </div>
            </td>

          </tr>

          <?php endforeach; ?>

        <?php else: ?>

          <tr>
            <td colspan="5" class="text-center py-5 text-muted">
              No tienes publicaciones todavía
            </td>
          </tr>

        <?php endif; ?>

        </tbody>

      </table>

    </div>

  </div>

  
  <!-- VISTA MÓVIL -->
  <div class="d-block d-md-none">

    <?php if(!empty($publicaciones)): 

       foreach($publi as $pub): 

      
     $color = $colores[$pub['dificultad']] ?? "secondary";
      ?>

      <div class="card mb-3 shadow border-0">

        <div class="card-body">

          <h5 class="fw-bold mb-2"><?= $pub['titulo'] ?></h5>

          <div class="mb-2">
            <span class="badge bg-<?= $color ?>">
              <?= $pub['dificultad'] ?>
            </span>
          </div>

          <p class="mb-1">
            <strong>Duración:</strong> <?= $pub['tiempo_estimado'] ?>
          </p>

          <p class="mb-3">
            <strong>Km:</strong> <?= $pub['kilometros'] ?> km
          </p>

          <div class="d-flex justify-content-between gap-1">

            <a href="ver.php?id=<?= $pub['id'] ?>" 
               class="btn btn-outline-success btn-sm w-100">
              Ver
            </a>

            <a href="editar.php?id=<?= $pub['id'] ?>" 
               class="btn btn-outline-warning btn-sm w-100">
              Editar
            </a>

            <a href="borrar.php?id=<?= $pub['id'] ?>" 
               class="btn btn-outline-danger btn-sm w-100">
              Borrar
            </a>

          </div>

        </div>

      </div>

      <?php endforeach; ?>

    <?php else: ?>

      <div class="alert alert-info text-center">
        No tienes publicaciones todavía
      </div>

    <?php endif; ?>

  </div>

</div>

</body>
</html>
```

    </div>
</main>
<?php if ($mensaje): ?>

<script>
window.addEventListener("DOMContentLoaded", function () {
    const toast = document.createElement("div");
    toast.innerText = "<?= $mensaje ?>";
    toast.style.position = "fixed";
    toast.style.top = "20px";
    toast.style.right = "20px";

    <?php if ($mensaje == "Publicación guardada correctamente"): ?>
    toast.style.background = "#28a745";

    <?php elseif ($mensaje== "Publicación eliminada correctamente"): ?>
    toast.style.background = "#dc3545";

    <?php endif; ?>

    toast.style.color = "white";
    toast.style.padding = "12px 18px";
    toast.style.borderRadius = "8px";
    toast.style.zIndex = "9999";

    document.body.appendChild(toast);

    setTimeout(() => {
        toast.remove();
    }, 5000);
});
</script>
<?php endif; ?>

<?php include("footer.php"); ?>
<!-- Bootstrap JS -->
