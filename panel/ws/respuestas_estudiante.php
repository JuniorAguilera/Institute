<?php

require_once('../nucleo/respuestas_estudiante.php');
$objrespuestas_estudiante = new respuestas_estudiante();

require_once('../nucleo/estudiante.php');
$objestudiante = new estudiante();

require_once('../nucleo/pregunta_encuesta.php');
$objpregunta_encuesta = new pregunta_encuesta();

if (isset($_POST['op'])) {
    switch ($_POST['op']) {
        case 'add':
            $objrespuestas_estudiante->setVar('id', $_POST['id']);
            $objrespuestas_estudiante->setVar('id_estudiante', $_POST['id_estudiante']);
            $objrespuestas_estudiante->setVar('id_pregunta_encuesta', $_POST['id_pregunta_encuesta']);
            $objrespuestas_estudiante->setVar('respuesta', $_POST['respuesta']);

            echo json_encode($objrespuestas_estudiante->insertDB());
            break;

        case 'mod':
            $objrespuestas_estudiante->setVar('id', $_POST['id']);
            $objrespuestas_estudiante->setVar('id_estudiante', $_POST['id_estudiante']);
            $objrespuestas_estudiante->setVar('id_pregunta_encuesta', $_POST['id_pregunta_encuesta']);
            $objrespuestas_estudiante->setVar('respuesta', $_POST['respuesta']);

            echo json_encode($objrespuestas_estudiante->updateDB());
            break;

        case 'del':
            $objrespuestas_estudiante->setVar('id', $_POST['id']);
            echo json_encode($objrespuestas_estudiante->deleteDB());
            break;

        case 'get':
            $res = $objrespuestas_estudiante->searchDB($_POST['id'], 'id', 1);
            $res[0]['id_estudiante'] = $objestudiante->searchDB($res[0]['id_estudiante'], 'id', 1);
            $res[0]['id_estudiante'] = $res[0]['id_estudiante'][0];
            $res[0]['id_pregunta_encuesta'] = $objpregunta_encuesta->searchDB($res[0]['id_pregunta_encuesta'], 'id', 1);
            $res[0]['id_pregunta_encuesta'] = $res[0]['id_pregunta_encuesta'][0];
            echo json_encode($res[0]);
            break;

        case 'list':
            $res = $objrespuestas_estudiante->listDB();
            foreach ($res as &$act) {
                $act['id_estudiante'] = $objestudiante->searchDB($act['id_estudiante'], 'id', 1);
                $act['id_estudiante'] = $act['id_estudiante'][0];
                $act['id_pregunta_encuesta'] = $objpregunta_encuesta->searchDB($act['id_pregunta_encuesta'], 'id', 1);
                $act['id_pregunta_encuesta'] = $act['id_pregunta_encuesta'][0];
            }
            echo json_encode($res);
            break;

        case 'search':
            $res = $objrespuestas_estudiante->searchDB($_POST['data'], $_POST['value'], $_POST['type']);
            foreach ($res as &$act) {
                $act['id_estudiante'] = $objestudiante->searchDB($act['id_estudiante'], 'id', 1);
                $act['id_estudiante'] = $act['id_estudiante'][0];
                $act['id_pregunta_encuesta'] = $objpregunta_encuesta->searchDB($act['id_pregunta_encuesta'], 'id', 1);
                $act['id_pregunta_encuesta'] = $act['id_pregunta_encuesta'][0];
            }
            echo json_encode($res);
            break;
    }
}?>