<?php
require_once("conectar.php");

class Publicaciones {

    function __construct () {}

    public function insertarPubli($parametros) {
        $bd=getConnection();       

        $sql = "INSERT INTO publicaciones 
            (usuario_id,
            titulo,
            descripcion,
            dificultad,
            tiempo_estimado,
            kilometros,
            punto_inicio,
            desnivel_positivo,
            desnivel_negativo,
            cimas) 
            VALUES 
            ('{$parametros['usuario_id']}',
            '{$parametros['titulo']}',
            '{$parametros['descripcion']}',
            '{$parametros['dificultad']}',
            '{$parametros['tiempo']}',
            '{$parametros['kilometros']}',
            '{$parametros['punto_inicio']}',
            '{$parametros['desnivel_positivo']}',
            '{$parametros['desnivel_negativo']}',
            '{$parametros['cimas']}')";

        // Se ejecuta la consulta		
        if ($resultado = $bd->query ($sql)) {
            if ($bd->affected_rows == 1) {
                $ultimo_id =  $bd->insert_id;
                echo "<br>Nueva publicacion en la base de datos con id " . $ultimo_id;
                return $ultimo_id;
            }
        } else {
            echo "<br>Error: " . $sql . "<br>" . $bd->error;
        }

        return false;
    }


    public function insertarImagen($parametros) {

    $bd = getConnection();

    $sql = "INSERT INTO imagenes
            (publicacion_id,
            usuario_id,
            url_imagen)
            VALUES
            ('{$parametros['publicacion_id']}',
            '{$parametros['usuario_id']}',
            '{$parametros['url_imagen']}')";
    // Se ejecuta la consulta
    if ($resultado = $bd->query($sql)) {

        if ($bd->affected_rows == 1) {

            $ultimo_id = $bd->insert_id;

            echo "<br>Nueva imagen insertada con id " . $ultimo_id;
        }

    } else {

        echo "<br>Error: " . $sql . "<br>" . $bd->error;
    }
}


}
