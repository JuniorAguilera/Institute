<?php

require_once('../nucleo/estudiante.php');
$objestudiante = new estudiante();

require_once('../nucleo/carrera.php');
$objcarrera = new carrera();

require_once('../nucleo/estado_estudiante.php');
$objestado_estudiante = new estado_estudiante();

if (isset($_POST['op'])) {
    switch ($_POST['op']) {
        case 'add':
            if(is_numeric($_POST['telefono_fijo'])&&is_numeric($_POST['telefono_celular'])&&is_numeric($_POST['dni'])&&is_numeric($_POST['ano_salida'])&&is_numeric($_POST['ano_ingreso']))
            {
            $objestudiante->setVar('nombres', $_POST['nombres']);
            $objestudiante->setVar('apellidos', $_POST['apellidos']);
            $objestudiante->setVar('telefono_fijo', $_POST['telefono_fijo']);
            $objestudiante->setVar('telefono_celular', $_POST['telefono_celular']);
            $objestudiante->setVar('direccion', $_POST['direccion']);
            $objestudiante->setVar('email', $_POST['email']);
            $objestudiante->setVar('dni', $_POST['dni']);
            $objestudiante->setVar('ano_ingreso', $_POST['ano_ingreso']);
            $objestudiante->setVar('ano_salida', $_POST['ano_salida']);
            $objestudiante->setVar('id_carrera', $_POST['id_carrera']);
            $objestudiante->setVar('id_estado_estudiante', $_POST['id_estado_estudiante']);
            $objestudiante->setVar('user', $_POST['user']);
            $objestudiante->setVar('pass', $_POST['pass']);
            $objestudiante->setVar('habilitado', $_POST['habilitado']);
            echo json_encode($objestudiante->insertDB());
            }
            else
            {
                echo json_encode(0);
            }
            break;

        case 'mod':
            if(is_numeric($_POST['telefono_fijo'])&&is_numeric($_POST['telefono_celular'])&&is_numeric($_POST['dni'])&&is_numeric($_POST['ano_salida'])&&is_numeric($_POST['ano_ingreso']))
            {
            $objestudiante->setVar('id', $_POST['id']);
            $objestudiante->setVar('nombres', $_POST['nombres']);
            $objestudiante->setVar('apellidos', $_POST['apellidos']);
            $objestudiante->setVar('telefono_fijo', $_POST['telefono_fijo']);
            $objestudiante->setVar('telefono_celular', $_POST['telefono_celular']);
            $objestudiante->setVar('direccion', $_POST['direccion']);
            $objestudiante->setVar('email', $_POST['email']);
            $objestudiante->setVar('dni', $_POST['dni']);
            $objestudiante->setVar('ano_ingreso', $_POST['ano_ingreso']);
            $objestudiante->setVar('ano_salida', $_POST['ano_salida']);
            $objestudiante->setVar('id_carrera', $_POST['id_carrera']);
            $objestudiante->setVar('id_estado_estudiante', $_POST['id_estado_estudiante']);
            $objestudiante->setVar('user', $_POST['user']);
            $objestudiante->setVar('pass', $_POST['pass']);
            $objestudiante->setVar('habilitado', $_POST['habilitado']);
            echo json_encode($objestudiante->updateDB());
            }
            else
            {
                echo json_encode(0);
            }
            break;

        case 'del':
            $objestudiante->setVar('id', $_POST['id']);
            echo json_encode($objestudiante->deleteDB());
            break;

        case 'get':
            $res = $objestudiante->searchDB($_POST['id'], 'id', 1);
            $res[0]['id_carrera'] = $objcarrera->searchDB($res[0]['id_carrera'], 'id', 1);
            $res[0]['id_carrera'] = $res[0]['id_carrera'][0];
            $res[0]['id_estado_estudiante'] = $objestado_estudiante->searchDB($res[0]['id_estado_estudiante'], 'id', 1);
            $res[0]['id_estado_estudiante'] = $res[0]['id_estado_estudiante'][0];
            echo json_encode($res[0]);
            break;

        case 'list':
            $res = $objestudiante->listDB();
            foreach ($res as &$act) {
                $act['id_carrera'] = $objcarrera->searchDB($act['id_carrera'], 'id', 1);
                $act['id_carrera'] = $act['id_carrera'][0];
                $act['id_estado_estudiante'] = $objestado_estudiante->searchDB($act['id_estado_estudiante'], 'id', 1);
                $act['id_estado_estudiante'] = $act['id_estado_estudiante'][0];
            }
            echo json_encode($res);
            break;

        case 'search':
            $res = $objestudiante->searchDB($_POST['data'], $_POST['value'], $_POST['type']);
            foreach ($res as &$act) {
                $act['id_carrera'] = $objcarrera->searchDB($act['id_carrera'], 'id', 1);
                $act['id_carrera'] = $act['id_carrera'][0];
                $act['id_estado_estudiante'] = $objestado_estudiante->searchDB($act['id_estado_estudiante'], 'id', 1);
                $act['id_estado_estudiante'] = $act['id_estado_estudiante'][0];
            }
            echo json_encode($res);
            break;
    }
}?>