<?php
require '../model/model_area.php';
$MU = new Modelo_Area(); //Instaciamos

switch ($_REQUEST['tipo']) {

    case 'listar':
        $consulta = $MU->Listar_Area();
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
        $area = strtoupper(htmlspecialchars($_POST['a'], ENT_QUOTES, 'UTF-8'));
        $consulta = $MU->Registrar_Area($area);
        echo $consulta;
        break;
    case 'modificar':
        $id = strtoupper(htmlspecialchars($_POST['id'], ENT_QUOTES, 'UTF-8'));
        $are = strtoupper(htmlspecialchars($_POST['are'], ENT_QUOTES, 'UTF-8'));
        $esta = strtoupper(htmlspecialchars($_POST['esta'], ENT_QUOTES, 'UTF-8'));
        $consulta = $MU->Modificar_Area($id, $are, $esta);
        echo $consulta;
        break;
}
