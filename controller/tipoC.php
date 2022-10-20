<?php
require '../model/model_tipo.php';
$MU = new Modelo_Tipo(); //Instaciamos

switch ($_REQUEST['tipo']) {
    case 'listar':
        $consulta = $MU->Listar_Tipo();
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
        $tipo = strtoupper(htmlspecialchars($_POST['tip'], ENT_QUOTES, 'UTF-8'));
        $consulta = $MU->Registrar_Tipo($tipo);
        echo $consulta;
        break;
    case 'modificar':
        $id = strtoupper(htmlspecialchars($_POST['id'], ENT_QUOTES, 'UTF-8'));
        $tipo = strtoupper(htmlspecialchars($_POST['tip'], ENT_QUOTES, 'UTF-8'));
        $esta = strtoupper(htmlspecialchars($_POST['esta'], ENT_QUOTES, 'UTF-8'));
        $consulta = $MU->Modificar_Tipo($id, $tipo, $esta);
        echo $consulta;
        break;
}
