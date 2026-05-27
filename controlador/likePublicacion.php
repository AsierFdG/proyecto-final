<?php
require_once __DIR__ . "/../modelo/Publicaciones.php";

session_start();

$idPublicacion = $_POST['publicacion_id'] ?? $_GET['id'] ?? null;
$origen = $_POST['origen'] ?? $_GET['origen'] ?? 'perfil';
$idUsuario = $_SESSION['idUsuario'] ?? null;

if ($idPublicacion && $idUsuario) {
    $publicacion = new Publicaciones();
    $publicacion->alternarLike($idPublicacion, $idUsuario);
}

header("Location: ../vistas/ver.php?id=" . urlencode((string) $idPublicacion) . "&origen=" . urlencode((string) $origen));
exit;

?>
