<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <title>Registro</title>

    <!-- Bootstrap -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet">
</head>

<body class="bg-light">

<div class="container d-flex justify-content-center align-items-center vh-100">

    <div class="row w-100 justify-content-center">

        <div class="col-12 col-md-6 col-lg-4">
            
            <div class="card shadow border-0 rounded-4 p-4">

                <!-- Botón volver -->
                <div class="d-flex justify-content-start mb-3">
                    <a href="../index.php" class="btn btn-link text-decoration-none p-0">
                        ← Volver
                    </a>
                </div>

                <!-- Encabezado -->
                <div class="text-center mb-4">
                    <h2 class="fw-bold">Crear cuenta</h2>
                    <p class="text-muted mb-0">Únete a la aplicación</p>
                </div>

                <!-- Formulario -->
                <form action="../controlador/registroControl.php" method="POST">

                    <div class="mb-3">
                        <label class="form-label fw-semibold">Nombre</label>
                        <input type="text" name="nombre" class="form-control form-control-lg" required>
                    </div>

                    <div class="mb-3">
                        <label class="form-label fw-semibold">Email</label>
                        <input type="email" name="correo" class="form-control form-control-lg" required>
                    </div>

                    <div class="mb-4">
                        <label class="form-label fw-semibold">Contraseña</label>
                        <input type="password" name="contraseña" class="form-control form-control-lg" required>
                    </div>

                    <button type="submit" class="btn btn-dark w-100 fw-semibold py-2">
                        Crear cuenta
                    </button>

                </form>

                <!-- Footer -->
                <div class="text-center mt-4">
                    <small class="text-muted">
                        ¿Ya tienes cuenta? 
                        <a href="login.php" class="fw-semibold text-decoration-none">Inicia sesión</a>
                    </small>
                </div>

            </div>

        </div>

    </div>

</div>

<script src="../js/validaciones.js"></script>
</body>
</html>
