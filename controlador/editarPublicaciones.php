<?php
require_once __DIR__ . "/../modelo/Publicaciones.php";
require_once __DIR__ . "/funcionesPublicaciones.php";
session_start();
$idPublicacion = recogerCampo('id');
$idUsuario = $_SESSION['idUsuario'] ?? null;

if (!$idPublicacion || !$idUsuario) {
    header("Location: ../vistas/perfil.php");
    exit;
}

$datos = [
    'id' => $idPublicacion,
    'usuario_id' => $idUsuario,
    'titulo' => recogerCampo('titulo'),
    'descripcion' => recogerCampo('descripcion'),
    'dificultad' => recogerCampo('dificultad'),
    'tiempo' => recogerCampo('tiempo'),
    'kilometros' => recogerCampo('kilometros'),
    'punto_inicio' => recogerCampo('punto_inicio'),
    'desnivel_positivo' => recogerCampo('desnivel_positivo'),
    'desnivel_negativo' => recogerCampo('desnivel_negativo'),
    'cimas' => recogerCampo('cimas')
];

$publicacion = new Publicaciones();
$publicacionEditada = $publicacion->editarPublicacionById($datos);

if ($publicacionEditada) {
    $imagenesActuales = $_POST['imagenes_actuales'] ?? [];
    $publicacion->eliminarImagenesNoIncluidas($idPublicacion, $imagenesActuales);

    if (isset($_FILES['imagenes'])) {
        guardarImagenes($_FILES['imagenes'], $idPublicacion, $idUsuario, $publicacion);
    }

    $_SESSION['toast_guardado'] = "Publicacion editada correctamente";
}

header("Location: ../vistas/perfil.php");
exit;
?>
