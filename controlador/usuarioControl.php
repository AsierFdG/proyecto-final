<?php

require_once __DIR__ . "/../modelo/Usuario.php";

session_start();

$nombre = $_POST["nombre"];
$contraseña = $_POST["contraseña"];

$modelo = new Usuarios();
$usuario = $modelo->buscar($nombre, $contraseña);

if ($usuario) {
    $_SESSION["usuario"] = $usuario["nombre"];
    header("Location: ../vistas/publicaciones.php");
} else {
    $_SESSION["error"] = "Usuario o contraseña incorrectos";
    header("Location: ../registro.php");
    exit;
}
		
?>