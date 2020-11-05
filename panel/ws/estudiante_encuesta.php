<?php

require_once('../nucleo/estudiante_encuesta.php');
$objestudiante_encuesta = new estudiante_encuesta();

require_once('../nucleo/estudiante.php');
$objestudiante = new estudiante();

require_once('../nucleo/encuesta.php');
$objencuesta = new encuesta();

if (isset($_POST['op'])) {
    switch ($_POST['op']) {
        case 'add':
            $objestudiante_encuesta->setVar('id', $_POST['id']);
            $objestudiante_encuesta->setVar('id_estudiante', $_POST['id_estudiante']);
            $objestudiante_encuesta->setVar('id_encuesta', $_POST['id_encuesta']);
            $objestudiante_encuesta->setVar('fecha', $_POST['fecha']);

            echo json_encode($objestudiante_encuesta->insertDB());
            break;

        case 'mod':
            $objestudiante_encuesta->setVar('id', $_POST['id']);
            $objestudiante_encuesta->setVar('id_estudiante', $_POST['id_estudiante']);
            $objestudiante_encuesta->setVar('id_encuesta', $_POST['id_encuesta']);
            $objestudiante_encuesta->setVar('fecha', $_POST['fecha']);

            echo json_encode($objestudiante_encuesta->updateDB());
            break;

        case 'del':
            $objestudiante_encuesta->setVar('id', $_POST['id']);
            echo json_encode($objestudiante_encuesta->deleteDB());
            break;

        case 'get':
            $res = $objestudiante_encuesta->searchDB($_POST['id'], 'id', 1);
            $res[0]['id_estudiante'] = $objestudiante->searchDB($res[0]['id_estudiante'], 'id', 1);
            $res[0]['id_estudiante'] = $res[0]['id_estudiante'][0];
            $res[0]['id_encuesta'] = $objencuesta->searchDB($res[0]['id_encuesta'], 'id', 1);
            $res[0]['id_encuesta'] = $res[0]['id_encuesta'][0];
            echo json_encode($res[0]);
            break;

        case 'list':
            $res = $objestudiante_encuesta->listDB();
            foreach ($res as &$act) {
                $act['id_estudiante'] = $objestudiante->searchDB($act['id_estudiante'], 'id', 1);
                $act['id_estudiante'] = $act['id_estudiante'][0];
                $act['id_encuesta'] = $objencuesta->searchDB($act['id_encuesta'], 'id', 1);
                $act['id_encuesta'] = $act['id_encuesta'][0];
            }
            echo json_encode($res);
            break;

        case 'search':
            $res = $objestudiante_encuesta->searchDB($_POST['data'], $_POST['value'], $_POST['type']);
            foreach ($res as &$act) {
                $act['id_estudiante'] = $objestudiante->searchDB($act['id_estudiante'], 'id', 1);
                $act['id_estudiante'] = $act['id_estudiante'][0];
                $act['id_encuesta'] = $objencuesta->searchDB($act['id_encuesta'], 'id', 1);
                $act['id_encuesta'] = $act['id_encuesta'][0];
            }
            echo json_encode($res);
            break;
    }
}?>