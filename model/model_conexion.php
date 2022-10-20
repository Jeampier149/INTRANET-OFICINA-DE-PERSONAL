<?php
class conexionBD
{

    private $pdo;
    public function conexionPDO(){
        $host       = "localhost";
        $usuario    = "root";
        $contrasena = "";
        $bdName     = "of_personal";
        try {
            $pdo = new PDO("mysql:host=$host;dbname=$bdName",$usuario,$contrasena);
            $pdo ->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
            $pdo ->exec("set names utf8");
            return $pdo;
        

        } catch (PDOException $e) {
            echo 'Falló la conexión: ' . $e->getMessage();
        }
    }
  public static function cerrar_conexion(){
       $pdo=null;
  }
   
}

?>