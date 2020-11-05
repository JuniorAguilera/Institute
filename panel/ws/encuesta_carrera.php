<?php

require_once('../nucleo/encuesta_carrera.php');
$objencuesta_carrera = new encuesta_carrera();

require_once('../nucleo/encuesta.php');
$objencuesta = new encuesta();

require_once('../nucleo/carrera.php');
$objcarrera = new carrera();

if (isset($_POST['op'])) {
    switch ($_POST['op']) {
        case 'add':
            $objencuesta_carrera->setVar('id', $_POST['id']);
            $objencuesta_carrera->setVar('id_encuesta', $_POST['id_encuesta']);
            $objencuesta_carrera->setVar('id_carrera', $_POST['id_carrera']);

            echo json_encode($objencuesta_carrera->insertDB());
            break;

        case 'mod':
            $objencuesta_carrera->setVar('id', $_POST['id']);
            $objencuesta_carrera->setVar('id_encuesta', $_POST['id_encuesta']);
            $objencuesta_carrera->setVar('id_carrera', $_POST['id_carrera']);

            echo json_encode($objencuesta_carrera->updateDB());
            break;

        case 'del':
            $objencuesta_carrera->setVar('id', $_POST['id']);
            echo json_encode($objencuesta_carrera->deleteDB());
            break;

        case 'get':
            $res = $objencuesta_carrera->searchDB($_POST['id'], 'id', 1);
            $res[0]['id_encuesta'] = $objencuesta->searchDB($res[0]['id_encuesta'], 'id', 1);
            $res[0]['id_encuesta'] = $res[0]['id_encuesta'][0];
            $res[0]['id_carrera'] = $objcarrera->searchDB($res[0]['id_carrera'], 'id', 1);
            $res[0]['id_carrera'] = $res[0]['id_carrera'][0];
            echo json_encode($res[0]);
            break;

        case 'list':
            $res = $objencuesta_carrera->listDB();
            foreach ($res as &$act) {
                $act['id_encuesta'] = $objencuesta->searchDB($act['id_encuesta'], 'id', 1);
                $act['id_encuesta'] = $act['id_encuesta'][0];
                $act['id_carrera'] = $objcarrera->searchDB($act['id_carrera'], 'id', 1);
                $act['id_carrera'] = $act['id_carrera'][0];
            }
            echo json_encode($res);
            break;

        case 'search':
            $res = $objencuesta_carrera->searchDB($_POST['data'], $_POST['value'], $_POST['type']);
            foreach ($res as &$act) {
                $act['id_encuesta'] = $objencuesta->searchDB($act['id_encuesta'], 'id', 1);
                $act['id_encuesta'] = $act['id_encuesta'][0];
                $act['id_carrera'] = $objcarrera->searchDB($act['id_carrera'], 'id', 1);
                $act['id_carrera'] = $act['id_carrera'][0];
            }
            echo json_encode($res);
            break;
    }
}?>