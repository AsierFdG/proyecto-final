<?php
require_once __DIR__ . "/../modelo/Publicaciones.php";
session_start();

    function mostrarPublicaciones() {  
        $publi = new Publicaciones();
        $idUsuario=$_SESSION['idUsuario'] ?? null;

        return $publi->publicacionesByIdUsuario($idUsuario);
    }

    function mostrarPublicacionById($id) {
        $publi = new Publicaciones();
        $publicacion = $publi->publicacionById($id);
        $imagenes = $publi->imagenesByPublicacion($id);
        $idUsuario = $_SESSION['idUsuario'] ?? null;

        $publicacion['imagenes'] = $imagenes;
        $publicacion['likes'] = $publi->contarLikesPublicacion($id);
        $publicacion['usuario_dio_like'] = $idUsuario ? $publi->usuarioDioLike($id, $idUsuario) : false;

        return $publicacion;
    }

    function eliminarPublicacionById($id) {
        $publi = new Publicaciones();

        return $publi->eliminarPublicacionById($id);

    }


?>
