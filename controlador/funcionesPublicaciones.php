<?php
require_once __DIR__ . "/../modelo/Publicaciones.php";

function recogerCampo($campo) {
    return isset($_POST[$campo]) && $_POST[$campo] !== ''
        ? trim($_POST[$campo])
        : null;
}

function campoPublicacion($valor) {
    return htmlspecialchars((string) ($valor ?? ''), ENT_QUOTES, 'UTF-8');
}

function nombreDificultad($dificultad) {
    $dificultades = [
        "Facil" => "Facil",
        "Media" => "Media",
        "Dificil" => "Dificil",
        "Muy dificil" => "Muy dificil"
    ];

    return $dificultades[(string) $dificultad] ?? (string) $dificultad;
}

function colorDificultad($dificultad) {
    $colores = [
        "Facil" => "success",
        "Media" => "warning",
        "Dificil" => "danger",
        "Muy dificil" => "dark"
    ];

    return $colores[nombreDificultad($dificultad)] ?? "secondary";
}

function obtenerDatosPublicaciones() {
    $modeloPublicaciones = new Publicaciones();
    $resultadoPublicaciones = $modeloPublicaciones->getTodoPublicaciones();
    $publicaciones = [];
    $usuarios = [];

    if ($resultadoPublicaciones) {
        while ($fila = $resultadoPublicaciones->fetch_assoc()) {
            $fila['dificultad_nombre'] = nombreDificultad($fila['dificultad']);
            $publicaciones[] = $fila;
            $usuarios[$fila['usuario_id']] = $fila['nombre_usuario'];
        }
    }

    asort($usuarios);

    return [
        "publicaciones" => $publicaciones,
        "usuarios" => $usuarios
    ];
}

function guardarImagenes($imagenes, $idPublicacion, $idUsuario, $publicacion) {
    if (!isset($imagenes['name']) || !is_array($imagenes['name'])) {
         echo "No llegan imagenes correctamente";
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

?>
