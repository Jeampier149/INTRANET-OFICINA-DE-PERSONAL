<?php
    require_once  'model_conexion.php';

    class Modelo_Scan extends conexionBD{
    

        public function Listar_Scan($inicio , $fin,$idarea){
            $c = conexionBD::conexionPDO();
            $sql = "CALL SP_LISTAR_SCAN(?,?,?)";
            $arreglo = array();
            $query  = $c->prepare($sql);
            $query -> bindParam(1,$inicio);
            $query -> bindParam(2,$fin);
            $query -> bindParam(3,$idarea);
            $query->execute();
            $resultado = $query->fetchAll(PDO::FETCH_ASSOC);
            foreach($resultado as $resp){
                $arreglo["data"][]=$resp;
            }
            return $arreglo;
            conexionBD::cerrar_conexion();
        }

        public function Registrar_Scan($ndoc,$tdoc,$asun,$idusu,$idarea,$ruta){
            $c = conexionBD::conexionPDO();
            $sql = "CALL SP_REGISTRAR_SCAN(?,?,?,?,?,?)";
            $arreglo = array();
            $query  = $c->prepare($sql);
            $query -> bindParam(1,$ndoc);
            $query -> bindParam(2,$tdoc);
            $query -> bindParam(3,$asun);
            $query -> bindParam(4,$idarea);
            $query -> bindParam(5,$idusu);
            $query -> bindParam(6,$ruta);
            $query->execute();
            if($row = $query->fetchColumn()){
                    return $row;
            }
            conexionBD::cerrar_conexion();
        }

        public function Modificar_Scan($id,$area,$esta){
            $c = conexionBD::conexionPDO();
            $sql = "CALL SP_MODIFICAR_SCAN(?,?,?)";
            $arreglo = array();
            $query  = $c->prepare($sql);
            $query -> bindParam(1,$id);
            $query -> bindParam(2,$area);
            $query -> bindParam(3,$esta);
            $query->execute();
            if($row = $query->fetchColumn()){
                    return $row;
            }
            conexionBD::cerrar_conexion();
        }



    }

?>