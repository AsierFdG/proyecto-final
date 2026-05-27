<?php 
include("cabecera.php"); 

require_once __DIR__ . "/../controlador/perfilControl.php";
require_once __DIR__ . "/../controlador/funcionesPublicaciones.php";


if (isset($_GET['id']) && !empty($_GET['id'])) {
    $id = $_GET['id'];
}

$pub=mostrarPublicacionById($id);
$imagenes = $pub['imagenes'];
$total = count($imagenes);
$dificultad = nombreDificultad($pub['dificultad']);
$colorDificultad = colorDificultad($dificultad);
$likes = (int) ($pub['likes'] ?? 0);
$usuarioDioLike = !empty($pub['usuario_dio_like']);
$origen = $_GET['origen'] ?? 'perfil';
$paginasVolver = [
    'perfil' => 'perfil.php',
    'publicaciones' => 'publicaciones.php'
];
$volver = $paginasVolver[$origen] ?? 'perfil.php';

?>

<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <title><?php echo $pub['titulo']; ?></title>

</head>

<body class="bg-light">

<div class="container py-5">

    <div class="row justify-content-center">
        <div class="col-lg-8">

            <div class="card shadow">

                <div class="card-header bg-dark text-white">
                    <small>Publicado por:</small><br>
                    <strong><?php echo $pub['usuario_nombre']; ?></strong>
                </div>

<?php if ($total > 0): ?>

    <?php if ($total == 1): ?>

        <img src="/Proyecto-final/<?php echo $imagenes[0]; ?>" 
             class="card-img-top img-fluid"
             style="max-height:400px; object-fit:cover;">

    <?php else: ?>

        <div id="carouselPublicacion" class="carousel slide">

            <div class="carousel-inner">

                <?php foreach ($imagenes as $index => $img): ?>
                    <div class="carousel-item <?php echo ($index === 0) ? 'active' : ''; ?>">
                        <img src="/Proyecto-final/<?php echo $img; ?>" 
                             class="d-block w-100"
                             style="max-height:400px; object-fit:contain;">
                    </div>
                <?php endforeach; ?>

            </div>

            <button class="carousel-control-prev" type="button" data-bs-target="#carouselPublicacion" data-bs-slide="prev">
                <span class="carousel-control-prev-icon"></span>
            </button>

            <button class="carousel-control-next" type="button" data-bs-target="#carouselPublicacion" data-bs-slide="next">
                <span class="carousel-control-next-icon"></span>
            </button>

        </div>

    <?php endif; ?>

    <div class="text-center mt-2 text-muted">
        <?php echo $total; ?> imagen<?php echo ($total > 1) ? 'es' : ''; ?>
    </div>

<?php else: ?>

    <div class="text-center p-4 bg-light">
        <em>No hay imágenes disponibles</em>
    </div>

<?php endif; ?>

                <div class="card-body">

                    <h2 class="card-title mb-3">
                        <?php echo $pub['titulo']; ?>
                    </h2>

                    <p class="card-text">
                        <?php echo nl2br($pub['descripcion']); ?>
                    </p>

                    <hr>

                    <div class="row">

                        <div class="col-md-6 mb-2">
                            <strong>Dificultad:</strong>
                            <span class="badge bg-<?php echo campoPublicacion($colorDificultad); ?> px-3 py-2">
                                <?php echo campoPublicacion($dificultad); ?>
                            </span>
                        </div>

                        <div class="col-md-6 mb-2">
                            <strong>Tiempo estimado:</strong>
                            <?php echo $pub['tiempo_estimado']; ?>
                        </div>

                        <div class="col-md-6 mb-2">
                            <strong>Kilómetros:</strong>
                            <?php echo $pub['kilometros']; ?> km
                        </div>

                        <div class="col-md-6 mb-2">
                            <strong>Punto de inicio:</strong>
                            <?php echo $pub['punto_inicio']; ?>
                        </div>

                        <div class="col-md-6 mb-2">
                            <strong>Desnivel +:</strong>
                            <?php echo $pub['desnivel_positivo']; ?> m
                        </div>

                        <div class="col-md-6 mb-2">
                            <strong>Desnivel -:</strong>
                            <?php echo $pub['desnivel_negativo']; ?> m
                        </div>

                        <div class="col-12 mb-2">
                            <strong>Cimas:</strong>
                            <?php echo $pub['cimas']; ?>
                        </div>

                        <div class="col-12 mb-2 d-flex justify-content-between align-items-center gap-3 flex-wrap">
                            <span class="text-muted">
                                Publicado el:
                                <?php echo date("d/m/Y", strtotime($pub['fecha_publicacion'])); ?>
                            </span>

                            <form action="../controlador/likePublicacion.php" method="POST" class="d-inline-flex align-items-center gap-2">
                                <input type="hidden" name="publicacion_id" value="<?php echo campoPublicacion($pub['id']); ?>">
                                <input type="hidden" name="origen" value="<?php echo campoPublicacion($origen); ?>">

                                <button type="submit"
                                        class="btn <?php echo $usuarioDioLike ? 'btn-danger' : 'btn-outline-danger'; ?> btn-sm d-inline-flex align-items-center gap-2"
                                        aria-label="<?php echo $usuarioDioLike ? 'Quitar like' : 'Dar like'; ?>">
                                    <i class="bi <?php echo $usuarioDioLike ? 'bi-heart-fill' : 'bi-heart'; ?>"></i>
                                    <span><?php echo $likes; ?></span>
                                </button>
                            </form>
                        </div>

                    </div>

                </div>
            </div>

            <div class="mt-3 text-center">
                <a href="<?php echo $volver; ?>" class="btn btn-secondary">
                    Volver
                </a>
            </div>

        </div>
    </div>

</div>

</body>


<?php include("footer.php"); ?>

