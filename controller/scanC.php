<?php
require '../model/model_scan.php';
$MU = new Modelo_Scan(); //Instaciamos

switch ($_REQUEST['tipo']) {

    case 'listar':
        $inicio=$_POST['fechainicio'];
        $fin=$_POST['fechafin'];
        $idarea=$_POST['idarea'];
        $consulta = $MU->Listar_Scan($inicio,$fin,$idarea);
        if ($consulta) {
            echo json_encode($consulta);
        } else {
            echo '{
                "sEcho": 1,
                "iTotalRecords": "0",
                "iTotalDisplayRecords": "0",
                "aaData": []
            }';
        }
        break;

    case 'registro':
        $ndoc=$_POST['ndoc'];
        $tipo=$_POST['tdoc'];
        $asun=$_POST['asun'];
        $idusu=$_POST['idusu'];
        $idarea=$_POST['idarea'];
        $nombrearchivo = strtoupper(htmlentities($_POST['nombrearchivo'], ENT_QUOTES, 'UTF-8'));
        $ruta = 'controller/doc_scan/' . $nombrearchivo;
        $consulta = $MU->Registrar_Scan($ndoc,$tipo,$asun,$idusu,$idarea,$ruta);
        if ($consulta) {
            if ($nombrearchivo != "") {

                move_uploaded_file($_FILES['archivoobj']['tmp_name'], "doc_scan/" . $nombrearchivo);
            }
            echo $consulta;
        }
        break;
    case 'modificar':
        $id = strtoupper(htmlspecialchars($_POST['id'], ENT_QUOTES, 'UTF-8'));
        $are = strtoupper(htmlspecialchars($_POST['are'], ENT_QUOTES, 'UTF-8'));
        $esta = strtoupper(htmlspecialchars($_POST['esta'], ENT_QUOTES, 'UTF-8'));
        $consulta = $MU->Modificar_Scan($id, $are, $esta);
        echo $consulta;
        break;
}
