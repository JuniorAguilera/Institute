<?php

require_once('../nucleo/pre_estudiante.php');
$objpre_estudiante = new pre_estudiante();

require_once('../nucleo/carrera.php');
$objcarrera = new carrera();

if (isset($_POST['op'])) {
    switch ($_POST['op']) {
        case 'add':
            $objpre_estudiante->setVar('id', $_POST['id']);
            $objpre_estudiante->setVar('dni', $_POST['dni']);
            $objpre_estudiante->setVar('nombres', $_POST['nombres']);
            $objpre_estudiante->setVar('apellidos', $_POST['apellidos']);
            $objpre_estudiante->setVar('telefono_fijo', $_POST['telefono_fijo']);
            $objpre_estudiante->setVar('telefono_celular', $_POST['telefono_celular']);
            $objpre_estudiante->setVar('direccion', $_POST['direccion']);
            $objpre_estudiante->setVar('email', $_POST['email']);
            $objpre_estudiante->setVar('id_carrera', $_POST['id_carrera']);

            echo json_encode($objpre_estudiante->insertDB());
            break;

        case 'mod':
            $objpre_estudiante->setVar('id', $_POST['id']);
            $objpre_estudiante->setVar('dni', $_POST['dni']);
            $objpre_estudiante->setVar('nombres', $_POST['nombres']);
            $objpre_estudiante->setVar('apellidos', $_POST['apellidos']);
            $objpre_estudiante->setVar('telefono_fijo', $_POST['telefono_fijo']);
            $objpre_estudiante->setVar('telefono_celular', $_POST['telefono_celular']);
            $objpre_estudiante->setVar('direccion', $_POST['direccion']);
            $objpre_estudiante->setVar('email', $_POST['email']);
            $objpre_estudiante->setVar('id_carrera', $_POST['id_carrera']);

            echo json_encode($objpre_estudiante->updateDB());
            break;

        case 'del':
            $objpre_estudiante->setVar('id', $_POST['id']);
            echo json_encode($objpre_estudiante->deleteDB());
            break;

        case 'get':
            $res = $objpre_estudiante->searchDB($_POST['id'], 'id', 1);
            $res[0]['id_carrera'] = $objcarrera->searchDB($res[0]['id_carrera'], 'id', 1);
            $res[0]['id_carrera'] = $res[0]['id_carrera'][0];
            echo json_encode($res[0]);
            break;

        case 'list':
            $res = $objpre_estudiante->listDB();
            foreach ($res as &$act) {
                $act['id_carrera'] = $objcarrera->searchDB($act['id_carrera'], 'id', 1);
                $act['id_carrera'] = $act['id_carrera'][0];
            }
            echo json_encode($res);
            break;

        case 'search':
            $res = $objpre_estudiante->searchDB($_POST['data'], $_POST['value'], $_POST['type']);
            foreach ($res as &$act) {
                $act['id_carrera'] = $objcarrera->searchDB($act['id_carrera'], 'id', 1);
                $act['id_carrera'] = $act['id_carrera'][0];
            }
            echo json_encode($res);
            break;
    }
}?>