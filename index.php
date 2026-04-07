<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Menditrack</title>

    <!-- Bootstrap CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet">

    <!-- Bootstrap Icons -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.1/font/bootstrap-icons.css" rel="stylesheet">
</head>
<body>

<nav class="navbar navbar-expand-lg navbar-dark bg-dark">
    <div class="container">
        <a class="navbar-brand d-flex align-items-center" href="#">
            <img src="imagenes/logo.png" alt="Logo" width="100" height="80" class="me-2">
            Menditrack
        </a>

        <div class="ms-auto">
            <a href="login.php" class="btn btn-outline-light me-2">Iniciar sesión</a>
            <a href="registro.php" class="btn btn-success">Registro</a>
        </div>
    </div>
</nav>

<section class="py-5">
    <div class="container">
        <div class="row align-items-center">

            <div class="col-md-6 mb-4 mb-md-0">
                <img src="imagenes/monte.jpg" class="img-fluid rounded" alt="Montaña">
            </div>

            <div class="col-md-6">
                <h1 class="display-5">Descubre y comparte rutas de montaña</h1>
                <p class="lead">
                    Menditrack es una plataforma donde los usuarios pueden subir rutas de montaña,
                    compartir experiencias y descubrir nuevos recorridos creados por la comunidad.
                </p>
                <a href="registro.php" class="btn btn-primary btn-lg">Comenzar</a>
            </div>

        </div>
    </div>
</section>


<section class="bg-light py-5">
    <div class="container text-center">
        <h2 class="mb-5">¿Qué puedes hacer en Menditrack?</h2>

        <div class="row">

            <div class="col-md-4 mb-4">
                <div class="card h-100 shadow-sm">
                    <div class="card-body">
                        <i class="bi bi-map fs-1 mb-3"></i>
                        <h4>Subir rutas</h4>
                        <p>Publica tus rutas de montaña con información, imágenes y dificultad.</p>
                    </div>
                </div>
            </div>

            <div class="col-md-4 mb-4">
                <div class="card h-100 shadow-sm">
                    <div class="card-body">
                        <i class="bi bi-compass fs-1 mb-3"></i>
                        <h4>Explorar rutas</h4>
                        <p>Descubre rutas subidas por otros usuarios y encuentra nuevas aventuras.</p>
                    </div>
                </div>
            </div>

            <div class="col-md-4 mb-4">
                <div class="card h-100 shadow-sm">
                    <div class="card-body">
                        <i class="bi bi-chat-dots fs-1 mb-3"></i>
                        <h4>Interactuar</h4>
                        <p>Comenta, valora rutas y comparte tu experiencia con la comunidad.</p>
                    </div>
                </div>
            </div>

        </div>
    </div>
</section>


<section class="bg-dark text-white text-center py-5">
    <div class="container">
        <h2>Únete a la comunidad Menditrack</h2>
        <p>Crea una cuenta y empieza a compartir tus rutas de montaña.</p>
        <a href="registro.php" class="btn btn-success">Registrarse</a>
    </div>
</section>


<footer class="bg-light text-center p-3">
    <p>© 2026 Menditrack - Proyecto DAW</p>
</footer>

<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js"></script>

</body>
</html>