<?php
require_once("conectar.php");

class Usuarios {

    private $id;
    private $nombre;
    private $correo;
    private $contraseña;


    function __construct ($id ="", $nombre= "" ,$correo= "", $contraseña="") {	
    $this->id=$id;		
    $this->nombre=$nombre;			
    $this->correo=$correo;
    $this->contraseña=$contraseña;
    }

    public function __set($propiedad,$valor){
    $this->$propiedad=$valor;
    }

    public function __get($propiedad)	{
    if (property_exists($this, $propiedad)){
        return $this->$propiedad;
    }
    }

    public function mostrarDatos() {
    $bd=getConnection();
    $sql = "SELECT * FROM usuarios";
        if ($resultado = $bd->query ( $sql )) {
            if ($resultado->num_rows > 0) {
            $datos=[];
                while ($array=mysqli_fetch_assoc($resultado)){
                    $datos[]=$array;
                
                }
            }
        }
        
    return $datos;
    }

    public function insertarUsuario() {
        $bd=getConnection();

        $nombre=$_POST["nombre"];
        $correo=$_POST["correo"];
        $contraseña=$_POST["contraseña"];

        $sql = "INSERT INTO usuarios (nombre,email, contraseña) VALUES ('$nombre','$correo', '$contraseña')";

        // Se ejecuta la consulta		
        if ($resultado = $bd->query ($sql)) {
            if ($bd->affected_rows == 1)
                $ultimo_id =  $bd->insert_id;
                echo "<br>Nueva Usuario en la base de datos con id " . $ultimo_id;
            } else {
                echo "<br>Error: " . $sql . "<br>" . $bd->error;
            }
    }

    public function borrarUsuario() {
        $bd=getConnection();
        if(isset($_POST["opciones"])){
        $id=$_POST["opciones"];

        $sql="Delete from usuario where id='$id'";

        if ($resultado=$bd->query($sql)){

        if ($bd->affected_rows> 0){
            echo "Usuario con DNI: " . $id ." ha sido eliminado";
            
        }
        }else {
        echo "error";
        }
        }

    }


       public function buscar($nombre, $contraseña){

    $bd = getConnection();

    $sql = "SELECT * FROM usuarios 
            WHERE nombre = '$nombre' 
            AND contraseña = '$contraseña'";

    if ($resultado = $bd->query($sql)) {

        if ($resultado->num_rows > 0) {

            $usuario = $resultado->fetch_assoc(); 
            return $usuario;

        } else {
            return false;
        }
    }

    return false;
}

    

    

    public function modificarcontra(){
    $bd=getConnection();
    if(isset($_POST["id"])){
    $id=$_POST["id"];
    $contra=$_POST["contra"];
    }

    $sql = "UPDATE usuario SET contraseña = '$contra' WHERE id = '$id'";
    if ($resultado=$bd->query($sql)){

    if ($bd->affected_rows> 0){
        echo "Usuario con DNI: " . $id ." ha sido modificado";
        
    }
    }else {
    echo "error";
    }


    }



    }
    ?>