<?php
require '../model/model_usuario.php';
$MU = new Modelo_Usuario();
switch ($_REQUEST['tipo']) {
    case 'iniciar':
        $usu = htmlspecialchars($_POST['u'], ENT_QUOTES, 'UTF-8');
        $con = htmlspecialchars($_POST['c'], ENT_QUOTES, 'UTF-8');
        $consulta = $MU->Verificar_Usuario($usu, $con);
        if (count($consulta) > 0) {
            echo json_encode($consulta);
        } else {
            echo 0;
        }
        break;

    case 'crear_s':
        session_start();
        $idusuario = htmlspecialchars($_POST['idusuario'], ENT_QUOTES, 'UTF-8');
        $usuario = htmlspecialchars($_POST['usuario'], ENT_QUOTES, 'UTF-8');
        $rol = htmlspecialchars($_POST['rol'], ENT_QUOTES, 'UTF-8');
        $area = htmlspecialchars($_POST['area'], ENT_QUOTES, 'UTF-8');
        $_SESSION['S_ID'] = $idusuario;
        $_SESSION['S_USU'] = $usuario;
        $_SESSION['S_ROL'] = $rol;
        $_SESSION['S_AREA'] = $area;
        break;

    case 'listar':
        $consulta = $MU->Listar_Usuario();
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
    case 'registrar':
        $usu = strtoupper(htmlspecialchars($_POST['usu'], ENT_QUOTES, 'UTF-8'));
        $con  = password_hash(htmlspecialchars($_POST['con'], ENT_QUOTES, 'UTF-8'), PASSWORD_DEFAULT, ['cost' => 12]);
        $ide = strtoupper(htmlspecialchars($_POST['ide'], ENT_QUOTES, 'UTF-8'));
        $ida = strtoupper(htmlspecialchars($_POST['ida'], ENT_QUOTES, 'UTF-8'));
        $rol = strtoupper(htmlspecialchars($_POST['rol'], ENT_QUOTES, 'UTF-8'));
        $consulta = $MU->Registrar_Usuario($usu, $con, $ide, $ida, $rol);
        echo $consulta;
        break;
    case 'modificar':
        $id = strtoupper(htmlspecialchars($_POST['id'], ENT_QUOTES, 'UTF-8'));
        $ide = strtoupper(htmlspecialchars($_POST['ide'], ENT_QUOTES, 'UTF-8'));
        $ida = strtoupper(htmlspecialchars($_POST['ida'], ENT_QUOTES, 'UTF-8'));
        $rol = strtoupper(htmlspecialchars($_POST['rol'], ENT_QUOTES, 'UTF-8'));
        $consulta = $MU->Modificar_Usuario($id, $ide, $ida, $rol);
        echo $consulta;
        break;
    case 'modificar_contra':
        $id = strtoupper(htmlspecialchars($_POST['id'], ENT_QUOTES, 'UTF-8'));
        $con  = password_hash(htmlspecialchars($_POST['con'], ENT_QUOTES, 'UTF-8'), PASSWORD_DEFAULT, ['cost' => 12]);
        $consulta = $MU->Modificar_Usuario_Contra($id, $con);
        echo $consulta;
        break;
    case 'modificar_estado':
        $id = strtoupper(htmlspecialchars($_POST['id'], ENT_QUOTES, 'UTF-8'));
        $estatus = strtoupper(htmlspecialchars($_POST['estatus'], ENT_QUOTES, 'UTF-8'));
        $consulta = $MU->Modificar_Usuario_Estatus($id, $estatus);
        echo $consulta;
        break;
    case 'cargar_select_emp':
        $consulta = $MU->Cargara_Select_Empleado();
        echo json_encode($consulta);


        break;
    case 'cargar_select_area':
        $consulta = $MU->Cargara_Select_Area();
        echo json_encode($consulta);

        break;
    case 'traer_data_segu':
        $numero = strtoupper(htmlspecialchars($_POST['numero'], ENT_QUOTES, 'UTF-8'));
        $dni = strtoupper(htmlspecialchars($_POST['dni'], ENT_QUOTES, 'UTF-8'));
        $consulta = $MU->Cargar_Select_Datos_Seguimiento($numero, $dni);
        echo json_encode($consulta);
        break;
    case 'traer_data_detalle_segu':
        $codigo = strtoupper(htmlspecialchars($_POST['codigo'], ENT_QUOTES, 'UTF-8'));
        $consulta = $MU->Traer_Datos_Detalle_Seguimiento($codigo);
        echo json_encode($consulta);

        break;
    case 'traer_data_usuario':
        $id=htmlspecialchars($_POST['usuario'],ENT_QUOTES,'UTF-8');
        $consulta=$MU->Traer_Datos_Usuario($id);
        echo json_encode($consulta);

        break;
    case 'cerrar_sesion':
        session_start();
        session_destroy();
        header('Location: ../index.php');
        break;
}
