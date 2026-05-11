<?php
require_once __DIR__ . "/../modelo/Publicaciones.php";
session_start();

    function mostrarPublicaciones() {  
        $publi = new Publicaciones();
        $idUsuario=$_SESSION['idUsuario'] ?? null;

        return $publi->publicacionesByIdUsuario($idUsuario);
    }


?>