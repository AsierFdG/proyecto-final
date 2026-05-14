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

        $publicacion['imagenes'] = $imagenes;

        return $publicacion;
    }

    function eliminarPublicacionById($id) {
        $publi = new Publicaciones();

        return $publi->eliminarPublicacionById($id);

    }


?>