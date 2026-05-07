<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <title>Menditrack - Inicio</title>

    <!-- Bootstrap CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet">
    
    <!-- Bootstrap Icons -->
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.0/font/bootstrap-icons.css">
</head>

<?php
$paginaActiva = basename($_SERVER['PHP_SELF']);
?>
<body class="d-flex flex-column min-vh-100">


<nav class="navbar navbar-expand-lg navbar-dark bg-dark">
  <div class="container">

    <a class="navbar-brand d-flex align-items-center gap-2" href="#">
      <i class="bi bi-geo-alt-fill"></i>
      <span class="fw-bold">Menditrack</span>
    </a>

    <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#menuNav">
      <span class="navbar-toggler-icon"></span>
    </button>

    <div class="collapse navbar-collapse" id="menuNav">
      <ul class="navbar-nav ms-auto text-center">

        <li class="nav-item">
          <a class="nav-link <?php echo ($paginaActiva == 'publicaciones.php') ? 'active' : ''; ?>" href="publicaciones.php">
            <i class="bi bi-house"></i> Inicio
          </a>
        </li>

        <li class="nav-item">
          <a class="nav-link <?php echo ($paginaActiva == 'crear.php') ? 'active' : ''; ?>" href="crear.php">
            <i class="bi bi-plus-circle"></i> Crear
          </a>
        </li>

        <li class="nav-item">
          <a class="nav-link <?php echo ($paginaActiva == 'perfil.php') ? 'active' : ''; ?>" href="perfil.php">
            <i class="bi bi-person"></i> Perfil
          </a>
        </li>

        <li class="nav-item">
          <a class="nav-link <?php echo ($paginaActiva == 'editar.php') ? 'active' : ''; ?>" href="editar.php">
            <i class="bi bi-pencil-square"></i> Editar
          </a>
        </li>

        <li class="nav-item">
          <a class="btn btn-outline-light mt-2 mt-lg-0 ms-lg-3" href="#">
            <i class="bi bi-box-arrow-right"></i> Salir
          </a>
        </li>

      </ul>
    </div>

  </div>
</nav>

</body>

<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js"></script>

</html>