<?php
require_once 'Publicacion.php';
session_start();


function recogerCampo($campo) {
    return isset($_POST[$campo]) && $_POST[$campo] !== ''
        ? trim($_POST[$campo])
        : null;
}

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

    // usuario desde sesión
    'usuario_id' => $_SESSION['usuario_id'] ?? null
];

// Imágenes (fuera del array)
$imagenes = $_FILES['imagenes'] ?? null;
$publicacion = new Publicacion();
$publicacion->insertarPubli($titulo, $contenido, $usuario_id, $imagenes);

?>