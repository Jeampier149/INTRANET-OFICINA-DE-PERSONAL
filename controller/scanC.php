<?php
require '../model/model_scan.php';
$MU = new Modelo_Scan(); //Instaciamos

switch ($_REQUEST['tipo']) {

    case 'listar':
        $inicio = $_POST['fechainicio'];
        $fin = $_POST['fechafin'];
        $idarea = $_POST['idarea'];
        $consulta = $MU->Listar_Scan($inicio, $fin, $idarea);
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
        $ndoc = $_POST['ndoc'];
        $tipo = $_POST['tdoc'];
        $asun = $_POST['asun'];
        $idusu = $_POST['idusu'];
        $idarea = $_POST['idarea'];
        $nombrearchivo = strtoupper(htmlentities($_POST['nombrearchivo'], ENT_QUOTES, 'UTF-8'));
        $ruta = 'controller/doc_scan/' . $nombrearchivo;
        $consulta = $MU->Registrar_Scan($ndoc, $tipo, $asun, $idusu, $idarea, $ruta);
        if ($consulta) {
            if ($nombrearchivo != "") {

                move_uploaded_file($_FILES['archivoobj']['tmp_name'], "doc_scan/" . $nombrearchivo);
            }
            echo $consulta;
        }
        break;
    case 'editar':
        $ndoc = $_POST['ndoc'];
        $ndoc_actual = $_POST['ndoc_actual'];
        $tipo = $_POST['tdoc'];
        $asun = $_POST['asun'];
        $iddoc = $_POST['iddoc'];
        $consulta = $MU->Editar_Scan($ndoc, $ndoc_actual, $tipo, $asun, $iddoc);
        echo $consulta;
        break;
    case 'editar_doc':
        $id_doc = $_POST['id_doc'];
        $nombre_archivo = $_POST['nombre_archivo'];
        $doc_actual=$_POST['name'];
        if (is_array($_FILES) && count($_FILES) > 0) {
            unlink('doc_scan/'.$doc_actual);
            if (move_uploaded_file($_FILES['archivoobj']['tmp_name'], "doc_scan/" . $nombre_archivo)) {
                $ruta = "controller/doc_scan/" . $nombre_archivo;
                $consulta = $MU->Editar_doc_scan($id_doc, $ruta);
                echo 1;
            } else {
                echo 0;
            }
        } else {
            echo 0;
        }

     
        break;
}
