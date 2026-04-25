<?php
require_once("conectar.php");

class Publicaciones {

    function __construct () {}

    public function insertarPubli($parametros) {
        $bd=getConnection();

        $nombre=$_POST["nombre"];
        $correo=$_POST["correo"];
        $contraseña=$_POST["contraseña"];

        $sql = "INSERT INTO publicaciones 
        (usuario_id,titulo, descripcion, dificultad,
        tiempo_estimado, kilometros, punto_inicio, desnivel_positivo,
         desnivel_negativo, cimas) 
        VALUES ('$nombre','$correo', '$contraseña')";

        // Se ejecuta la consulta		
        if ($resultado = $bd->query ($sql)) {
            if ($bd->affected_rows == 1)
                $ultimo_id =  $bd->insert_id;
                echo "<br>Nueva Usuario en la base de datos con id " . $ultimo_id;
            } else {
                echo "<br>Error: " . $sql . "<br>" . $bd->error;
            }
    }


}