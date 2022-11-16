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

        public function Editar_Scan($ndoc,$ndoc_actual,$tipo,$asun,$iddoc){
            $c = conexionBD::conexionPDO();
            $sql = "CALL SP_EDITAR_SCAN(?,?,?,?,?)";
            $query  = $c->prepare($sql);
            $query -> bindParam(1,$ndoc);
            $query -> bindParam(2,$ndoc_actual);
            $query -> bindParam(3,$tipo);
            $query -> bindParam(4,$asun);
            $query -> bindParam(5,$iddoc);
            $query->execute();
            if($row = $query->fetchColumn()){
                    return $row;
            }
            conexionBD::cerrar_conexion();
        }
        public function Editar_doc_scan($iddoc,$ruta){
            $c = conexionBD::conexionPDO();
            $sql = "CALL SP_MODIFICAR_DOC_SCAN(?,?)";
            $query  = $c->prepare($sql);
            $query -> bindParam(1,$iddoc);
            $query -> bindParam(2,$ruta);
            $query->execute();
            if($row = $query->fetchColumn()){
                    return $row;
            }
            conexionBD::cerrar_conexion();
        }



    }

?>