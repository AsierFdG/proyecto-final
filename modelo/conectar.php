<?php
	
function getConnection() {		
    $bd = new mysqli("localhost", "root", "", 'mi_app');
    if($bd->connect_error)
    die('<br>Conexión fallida');

    return $bd;
}

?>