<?php

require_once('../nucleo/alternativa_sugerida.php');
$objalternativa_sugerida = new alternativa_sugerida();

require_once('../nucleo/pregunta_encuesta.php');
$objpregunta_encuesta = new pregunta_encuesta();

require_once('../nucleo/estudiante.php');
$objestudiante = new estudiante();

if (isset($_POST['op'])) {
    switch ($_POST['op']) {
        case 'add':
            $objalternativa_sugerida->setVar('id_pregunta_encuesta', $_POST['id_pregunta_encuesta']);
            $objalternativa_sugerida->setVar('texto', $_POST['texto']);
            $objalternativa_sugerida->setVar('id_estudiante', $_POST['id_estudiante']);
            echo json_encode($objalternativa_sugerida->insertDB());
            break;

        case 'mod':
            $objalternativa_sugerida->setVar('id', $_POST['id']);
            $objalternativa_sugerida->setVar('id_pregunta_encuesta', $_POST['id_pregunta_encuesta']);
            $objalternativa_sugerida->setVar('texto', $_POST['texto']);
            $objalternativa_sugerida->setVar('id_estudiante', $_POST['id_estudiante']);
            $objalternativa_sugerida->setVar('fecha', $_POST['fecha']);

            echo json_encode($objalternativa_sugerida->updateDB());
            break;

        case 'del':
            $objalternativa_sugerida->setVar('id', $_POST['id']);
            echo json_encode($objalternativa_sugerida->deleteDB());
            break;

        case 'get':
            $res = $objalternativa_sugerida->searchDB($_POST['id'], 'id', 1);
            $res[0]['id_pregunta_encuesta'] = $objpregunta_encuesta->searchDB($res[0]['id_pregunta_encuesta'], 'id', 1);
            $res[0]['id_pregunta_encuesta'] = $res[0]['id_pregunta_encuesta'][0];
            $res[0]['id_estudiante'] = $objestudiante->searchDB($res[0]['id_estudiante'], 'id', 1);
            $res[0]['id_estudiante'] = $res[0]['id_estudiante'][0];
            echo json_encode($res[0]);
            break;

        case 'list':
            $res = $objalternativa_sugerida->listDB();
            foreach ($res as &$act) {
                $act['id_pregunta_encuesta'] = $objpregunta_encuesta->searchDB($act['id_pregunta_encuesta'], 'id', 1);
                $act['id_pregunta_encuesta'] = $act['id_pregunta_encuesta'][0];
                $act['id_estudiante'] = $objestudiante->searchDB($act['id_estudiante'], 'id', 1);
                $act['id_estudiante'] = $act['id_estudiante'][0];
            }
            echo json_encode($res);
            break;

        case 'search':
            $res = $objalternativa_sugerida->searchDB($_POST['data'], $_POST['value'], $_POST['type']);
            foreach ($res as &$act) {
                $act['id_pregunta_encuesta'] = $objpregunta_encuesta->searchDB($act['id_pregunta_encuesta'], 'id', 1);
                $act['id_pregunta_encuesta'] = $act['id_pregunta_encuesta'][0];
                $act['id_estudiante'] = $objestudiante->searchDB($act['id_estudiante'], 'id', 1);
                $act['id_estudiante'] = $act['id_estudiante'][0];
            }
            echo json_encode($res);
            break;
    }
}?>