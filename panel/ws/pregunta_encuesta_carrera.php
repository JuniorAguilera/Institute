<?php

require_once('../nucleo/pregunta_encuesta_carrera.php');
$objpregunta_encuesta_carrera = new pregunta_encuesta_carrera();

require_once('../nucleo/pregunta_encuesta.php');
$objpregunta_encuesta = new pregunta_encuesta();

require_once('../nucleo/carrera.php');
$objcarrera = new carrera();

if (isset($_POST['op'])) {
    switch ($_POST['op']) {
        case 'add':
            $objpregunta_encuesta_carrera->setVar('id', $_POST['id']);
            $objpregunta_encuesta_carrera->setVar('id_pregunta_encuesta', $_POST['id_pregunta_encuesta']);
            $objpregunta_encuesta_carrera->setVar('id_carrera', $_POST['id_carrera']);

            echo json_encode($objpregunta_encuesta_carrera->insertDB());
            break;

        case 'mod':
            $objpregunta_encuesta_carrera->setVar('id', $_POST['id']);
            $objpregunta_encuesta_carrera->setVar('id_pregunta_encuesta', $_POST['id_pregunta_encuesta']);
            $objpregunta_encuesta_carrera->setVar('id_carrera', $_POST['id_carrera']);

            echo json_encode($objpregunta_encuesta_carrera->updateDB());
            break;

        case 'del':
            $objpregunta_encuesta_carrera->setVar('id', $_POST['id']);
            echo json_encode($objpregunta_encuesta_carrera->deleteDB());
            break;

        case 'get':
            $res = $objpregunta_encuesta_carrera->searchDB($_POST['id'], 'id', 1);
            $res[0]['id_pregunta_encuesta'] = $objpregunta_encuesta->searchDB($res[0]['id_pregunta_encuesta'], 'id', 1);
            $res[0]['id_pregunta_encuesta'] = $res[0]['id_pregunta_encuesta'][0];
            $res[0]['id_carrera'] = $objcarrera->searchDB($res[0]['id_carrera'], 'id', 1);
            $res[0]['id_carrera'] = $res[0]['id_carrera'][0];
            echo json_encode($res[0]);
            break;

        case 'list':
            $res = $objpregunta_encuesta_carrera->listDB();
            foreach ($res as &$act) {
                $act['id_pregunta_encuesta'] = $objpregunta_encuesta->searchDB($act['id_pregunta_encuesta'], 'id', 1);
                $act['id_pregunta_encuesta'] = $act['id_pregunta_encuesta'][0];
                $act['id_carrera'] = $objcarrera->searchDB($act['id_carrera'], 'id', 1);
                $act['id_carrera'] = $act['id_carrera'][0];
            }
            echo json_encode($res);
            break;

        case 'search':
            $res = $objpregunta_encuesta_carrera->searchDB($_POST['data'], $_POST['value'], $_POST['type']);
            foreach ($res as &$act) {
                $act['id_pregunta_encuesta'] = $objpregunta_encuesta->searchDB($act['id_pregunta_encuesta'], 'id', 1);
                $act['id_pregunta_encuesta'] = $act['id_pregunta_encuesta'][0];
                $act['id_carrera'] = $objcarrera->searchDB($act['id_carrera'], 'id', 1);
                $act['id_carrera'] = $act['id_carrera'][0];
            }
            echo json_encode($res);
            break;
    }
}?>