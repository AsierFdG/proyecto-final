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

    
    public function editarPublicacionById($parametros) {
        $bd = getConnection();

        $sql = "UPDATE publicaciones SET
                titulo = '{$parametros['titulo']}',
                descripcion = '{$parametros['descripcion']}',
                dificultad = '{$parametros['dificultad']}',
                tiempo_estimado = '{$parametros['tiempo']}',
                kilometros = '{$parametros['kilometros']}',
                punto_inicio = '{$parametros['punto_inicio']}',
                desnivel_positivo = '{$parametros['desnivel_positivo']}',
                desnivel_negativo = '{$parametros['desnivel_negativo']}',
                cimas = '{$parametros['cimas']}'
                WHERE id = '{$parametros['id']}'
                AND usuario_id = '{$parametros['usuario_id']}'";

        if ($resultado = $bd->query($sql)) {
            return true;
        } else {
            echo "<br>Error: " . $sql . "<br>" . $bd->error;
        }

        return false;
    }

    public function eliminarImagenesNoIncluidas($idPublicacion, $imagenesActuales) {
        $bd = getConnection();

        if (empty($imagenesActuales)) {
            $sql = "DELETE FROM imagenes WHERE publicacion_id = '$idPublicacion'";
            return $bd->query($sql);
        }

        $imagenesEscapadas = [];

        foreach ($imagenesActuales as $imagen) {
            $imagenesEscapadas[] = "'" . $bd->real_escape_string($imagen) . "'";
        }

        $imagenesPermitidas = implode(",", $imagenesEscapadas);

        $sql = "DELETE FROM imagenes
                WHERE publicacion_id = '$idPublicacion'
                AND url_imagen NOT IN ($imagenesPermitidas)";

        return $bd->query($sql);
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

    public function publicacionesByIdUsuario($idUsuario){

        $bd = getConnection();
        $sql = "SELECT
                id,
                titulo,
                dificultad,
                tiempo_estimado,
                kilometros
                FROM publicaciones
                WHERE usuario_id = '$idUsuario'";

        $resultado = $bd->query($sql);

        return $resultado;
    }

 public function getTodoPublicaciones() {

    $bd = getConnection();

    $sql = "SELECT
                publicaciones.id,
                publicaciones.titulo,
                publicaciones.dificultad,
                publicaciones.tiempo_estimado,
                publicaciones.kilometros,
                usuarios.id AS usuario_id,
                usuarios.nombre AS nombre_usuario
            FROM publicaciones
            INNER JOIN usuarios
            ON publicaciones.usuario_id = usuarios.id
            ORDER BY publicaciones.id DESC";

    $resultado = $bd->query($sql);

    return $resultado;
}

    public function publicacionById($id) {
        $bd = getConnection();
        $sql = "SELECT 
                p.id,
                p.titulo,
                p.descripcion,
                p.dificultad,
                p.tiempo_estimado,
                p.kilometros,
                p.punto_inicio,
                p.desnivel_positivo,
                p.desnivel_negativo,
                p.cimas,
                p.fecha_publicacion,
                u.nombre AS usuario_nombre
                FROM publicaciones p
                INNER JOIN usuarios u ON p.usuario_id = u.id
                WHERE p.id = '$id'";

        $resultado = $bd->query($sql);

    return $resultado->fetch_assoc(); 

    }

    public function imagenesByPublicacion($id){
        $bd = getConnection();
        $sql = "SELECT url_imagen
                FROM imagenes
                WHERE publicacion_id = '$id'";

        $resultado = $bd->query($sql);

        $imagenes = [];

        while ($fila = $resultado->fetch_assoc()) {
            $imagenes[] = $fila['url_imagen'];
        }

    return $imagenes;
    }

    public function eliminarPublicacionById($id){

        $bd = getConnection();
        $sql = "DELETE FROM publicaciones WHERE id = '$id'";

        $resultado = $bd->query($sql);

    return $resultado;
}




}
