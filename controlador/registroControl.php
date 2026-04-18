<?php	
require_once __DIR__ . "/../modelo/Usuario.php";

$usuario= new Usuarios();
$usuario->insertarUsuario();
header("Location: ../vistas/publicaciones.php");

?>