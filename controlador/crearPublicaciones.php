<?php
require_once __DIR__ . "/../modelo/Publicaciones.php";
session_start();


function recogerCampo($campo) {
    return isset($_POST[$campo]) && $_POST[$campo] !== ''
        ? trim($_POST[$campo])
        : null;
}
echo $_SESSION["idUsuario"];
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
    'usuario_id' => $_SESSION['idUsuario'] ?? null
];

// Imágenes (fuera del array)
$imagenes = $_FILES['imagenes'] ?? null;
$publicacion = new Publicaciones();
$publicacion->insertarPubli($datos);

?>