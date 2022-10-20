<?php
require '../model/model_tramite.php';
$MU = new Modelo_Tramite(); //Instaciamos
switch ($_REQUEST['tipo']) {
    case 'listar':
        $inicio=$_POST['fechainicio'];
        $fin=$_POST['fechafin'];
        $consulta = $MU->Listar_Tramite($inicio,$fin);
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

    case 'cargar_select_tip':
        $consulta = $MU->Cargara_Select_Tipo();
        echo json_encode($consulta);

        break;
    case 'registro':
        //DATOS DEL REMIENTE
        $dni = strtoupper(htmlspecialchars($_POST['dni'], ENT_QUOTES, 'UTF-8'));
        $nom = strtoupper(htmlspecialchars($_POST['nom'], ENT_QUOTES, 'UTF-8'));
        $apt = strtoupper(htmlspecialchars($_POST['apt'], ENT_QUOTES, 'UTF-8'));
        $apm = strtoupper(htmlspecialchars($_POST['apm'], ENT_QUOTES, 'UTF-8'));
        $cel = strtoupper(htmlspecialchars($_POST['cel'], ENT_QUOTES, 'UTF-8'));
        $ema = strtoupper(htmlspecialchars($_POST['ema'], ENT_QUOTES, 'UTF-8'));

     

        //DATOS DEL DOCUMENTO 
        $arp = strtoupper(htmlspecialchars($_POST['arp'], ENT_QUOTES, 'UTF-8'));
        $ard = strtoupper(htmlspecialchars($_POST['ard'], ENT_QUOTES, 'UTF-8'));
        $tip = strtoupper(htmlspecialchars($_POST['tip'], ENT_QUOTES, 'UTF-8'));
        $ndo = strtoupper(htmlspecialchars($_POST['ndo'], ENT_QUOTES, 'UTF-8'));
        $asu = $_POST['asu'];
        $nombrearchivo = strtoupper(htmlentities($_POST['nombrearchivo'], ENT_QUOTES, 'UTF-8'));
        $fol = strtoupper(htmlspecialchars($_POST['fol'], ENT_QUOTES, 'UTF-8'));
        $idusu = strtoupper(htmlspecialchars($_POST['idusu'], ENT_QUOTES, 'UTF-8'));

        $ruta = 'controller/doc/' . $nombrearchivo;
        $consulta = $MU->Registrar_Tramite($dni, $nom, $apt, $apm, $cel, $ema, $arp, $ard, $tip, $ndo, $asu, $ruta, $fol, $idusu);
        if ($consulta) {
            if ($nombrearchivo != "") {

                move_uploaded_file($_FILES['archivoobj']['tmp_name'], "doc/" . $nombrearchivo);
            }
            echo $consulta;
        }
        break;
    case 'listar_seguimiento':
        $id = strtoupper(htmlspecialchars($_POST['id'], ENT_QUOTES, 'UTF-8'));
        $consulta = $MU->Listar_Tramite_Seguimiento($id);
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
}
