<?php
require_once __DIR__ . "/../controlador/perfilControl.php";


if (isset($_GET['id'])) {

    $id = $_GET['id'];
    $borrado=eliminarPublicacionById($id);
    $_SESSION['toast_guardado'] = "Publicación eliminada correctamente";
    header("Location: ../vistas/perfil.php");

}

?>