<?php

require_once('../nucleo/experiencia_estudiante.php');
$objexperiencia_estudiante = new experiencia_estudiante();

require_once('../nucleo/estudiante.php');
$objestudiante = new estudiante();

require_once('../nucleo/tipo_experiencia.php');
$objtipo_experiencia = new tipo_experiencia();

if (isset($_POST['op'])) {
    switch ($_POST['op']) {
        case 'add':
            $objexperiencia_estudiante->setVar('id', $_POST['id']);
            $objexperiencia_estudiante->setVar('id_estudiante', $_POST['id_estudiante']);
            $objexperiencia_estudiante->setVar('lugar', $_POST['lugar']);
            $objexperiencia_estudiante->setVar('descripcion', $_POST['descripcion']);
            $objexperiencia_estudiante->setVar('ano_ingreso', $_POST['ano_ingreso']);
            $objexperiencia_estudiante->setVar('ano_salida', $_POST['ano_salida']);
            $objexperiencia_estudiante->setVar('id_tipo_experiencia', $_POST['id_tipo_experiencia']);

            echo json_encode($objexperiencia_estudiante->insertDB());
            break;

        case 'mod':
            $objexperiencia_estudiante->setVar('id', $_POST['id']);
            $objexperiencia_estudiante->setVar('id_estudiante', $_POST['id_estudiante']);
            $objexperiencia_estudiante->setVar('lugar', $_POST['lugar']);
            $objexperiencia_estudiante->setVar('descripcion', $_POST['descripcion']);
            $objexperiencia_estudiante->setVar('ano_ingreso', $_POST['ano_ingreso']);
            $objexperiencia_estudiante->setVar('ano_salida', $_POST['ano_salida']);
            $objexperiencia_estudiante->setVar('id_tipo_experiencia', $_POST['id_tipo_experiencia']);

            echo json_encode($objexperiencia_estudiante->updateDB());
            break;

        case 'del':
            $objexperiencia_estudiante->setVar('id', $_POST['id']);
            echo json_encode($objexperiencia_estudiante->deleteDB());
            break;

        case 'get':
            $res = $objexperiencia_estudiante->searchDB($_POST['id'], 'id', 1);
            $res[0]['id_estudiante'] = $objestudiante->searchDB($res[0]['id_estudiante'], 'id', 1);
            $res[0]['id_estudiante'] = $res[0]['id_estudiante'][0];
            $res[0]['id_tipo_experiencia'] = $objtipo_experiencia->searchDB($res[0]['id_tipo_experiencia'], 'id', 1);
            $res[0]['id_tipo_experiencia'] = $res[0]['id_tipo_experiencia'][0];
            echo json_encode($res[0]);
            break;

        case 'list':
            $res = $objexperiencia_estudiante->listDB();
            foreach ($res as &$act) {
                $act['id_estudiante'] = $objestudiante->searchDB($act['id_estudiante'], 'id', 1);
                $act['id_estudiante'] = $act['id_estudiante'][0];
                $act['id_tipo_experiencia'] = $objtipo_experiencia->searchDB($act['id_tipo_experiencia'], 'id', 1);
                $act['id_tipo_experiencia'] = $act['id_tipo_experiencia'][0];
            }
            echo json_encode($res);
            break;

        case 'search':
            $res = $objexperiencia_estudiante->searchDB($_POST['data'], $_POST['value'], $_POST['type']);
            foreach ($res as &$act) {
                $act['id_estudiante'] = $objestudiante->searchDB($act['id_estudiante'], 'id', 1);
                $act['id_estudiante'] = $act['id_estudiante'][0];
                $act['id_tipo_experiencia'] = $objtipo_experiencia->searchDB($act['id_tipo_experiencia'], 'id', 1);
                $act['id_tipo_experiencia'] = $act['id_tipo_experiencia'][0];
            }
            echo json_encode($res);
            break;
    }
}?>