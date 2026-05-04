<?php
require_once __DIR__ . "/../modelo/Publicaciones.php";
session_start();


function recogerCampo($campo) {
    return isset($_POST[$campo]) && $_POST[$campo] !== ''
        ? trim($_POST[$campo])
        : null;
}

function guardarImagenes($imagenes, $idPublicacion, $idUsuario, $publicacion) {
    if (!isset($imagenes['name']) || !is_array($imagenes['name'])) {
        return;
    }

    $carpetaDestino = __DIR__ . "/../imagenes/publicaciones/";
    $urlCarpeta = "imagenes/publicaciones/";

    if (!is_dir($carpetaDestino)) {
        mkdir($carpetaDestino, 0777, true);
    }

    $extensionesPermitidas = ['jpg', 'jpeg', 'png', 'gif', 'webp'];

    foreach ($imagenes['name'] as $indice => $nombreOriginal) {
        if ($imagenes['error'][$indice] !== UPLOAD_ERR_OK) {
            continue;
        }

        $tmpName = $imagenes['tmp_name'][$indice];
        $extension = strtolower(pathinfo($nombreOriginal, PATHINFO_EXTENSION));

        if (!in_array($extension, $extensionesPermitidas)) {
            continue;
        }

        if (getimagesize($tmpName) === false) {
            continue;
        }

        $nombreArchivo = "publicacion_" . $idPublicacion . "_" . uniqid() . "." . $extension;
        $rutaDestino = $carpetaDestino . $nombreArchivo;

        if (move_uploaded_file($tmpName, $rutaDestino)) {
            $parametrosImagen = [
                "publicacion_id" => $idPublicacion,
                "usuario_id" => $idUsuario,
                "url_imagen" => $urlCarpeta . $nombreArchivo
            ];

            $publicacion->insertarImagen($parametrosImagen);
        }
    }
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
    'usuario_id' => $_SESSION['idUsuario'] ?? null
];

// Imágenes (fuera del array)
$publicacion = new Publicaciones();
$idPublicacion = $publicacion->insertarPubli($datos);

if ($idPublicacion) {
    $imagenes = $_FILES['imagenes'] ?? null;
    guardarImagenes($imagenes, $idPublicacion, $datos['usuario_id'], $publicacion);
}

?>
