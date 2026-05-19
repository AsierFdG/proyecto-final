<?php
require_once __DIR__ . "/../modelo/Publicaciones.php";
require_once __DIR__ . "/funcionesPublicaciones.php";
session_start();

// Array con TODOS los campos del formulario
$datos = [

    'titulo' => recogerCampo('titulo'),
    'descripcion' => recogerCampo('descripcion'),
    'dificultad' => recogerCampo('dificultad'),
    'tiempo' => recogerCampo('tiempo'),
    'kilometros' => recogerCampo('kilometros'),

    'punto_inicio' => recogerCampo('punto_inicio'),
    'desnivel_positivo' => recogerCampo('desnivel_positivo'),
    'desnivel_negativo' => recogerCampo('desnivel_negativo'),
    'cimas' => recogerCampo('cimas'),

    // usuario desde sesion
    'usuario_id' => $_SESSION['idUsuario'] ?? null
];

// Imagenes (fuera del array)
$publicacion = new Publicaciones();
$idPublicacion = $publicacion->insertarPubli($datos);

if ($idPublicacion) {
    if (isset($_FILES['imagenes'])) {
        guardarImagenes($_FILES['imagenes'], $idPublicacion, $datos['usuario_id'], $publicacion);
        header("Location: ../vistas/perfil.php");
    }

    $_SESSION['toast_guardado'] = "Publicacion guardada correctamente";
    header("Location: ../vistas/perfil.php");
    exit;
}

?>
