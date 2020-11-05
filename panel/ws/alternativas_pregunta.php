<?php

require_once('../nucleo/alternativas_pregunta.php');
$objalternativas_pregunta = new alternativas_pregunta();

require_once('../nucleo/pregunta_encuesta.php');
$objpregunta_encuesta = new pregunta_encuesta();

if (isset($_POST['op'])) {
    switch ($_POST['op']) {
        case 'add':
            $objalternativas_pregunta->setVar('id', $_POST['id']);
            $objalternativas_pregunta->setVar('id_pregunta_encuesta', $_POST['id_pregunta_encuesta']);
            $objalternativas_pregunta->setVar('texto', $_POST['texto']);

            echo json_encode($objalternativas_pregunta->insertDB());
            break;

        case 'mod':
            $objalternativas_pregunta->setVar('id', $_POST['id']);
            $objalternativas_pregunta->setVar('id_pregunta_encuesta', $_POST['id_pregunta_encuesta']);
            $objalternativas_pregunta->setVar('texto', $_POST['texto']);

            echo json_encode($objalternativas_pregunta->updateDB());
            break;

        case 'del':
            $objalternativas_pregunta->setVar('id', $_POST['id']);
            echo json_encode($objalternativas_pregunta->deleteDB());
            break;

        case 'get':
            $res = $objalternativas_pregunta->searchDB($_POST['id'], 'id', 1);
            $res[0]['id_pregunta_encuesta'] = $objpregunta_encuesta->searchDB($res[0]['id_pregunta_encuesta'], 'id', 1);
            $res[0]['id_pregunta_encuesta'] = $res[0]['id_pregunta_encuesta'][0];
            echo json_encode($res[0]);
            break;

        case 'list':
            $res = $objalternativas_pregunta->listDB();
            foreach ($res as &$act) {
                $act['id_pregunta_encuesta'] = $objpregunta_encuesta->searchDB($act['id_pregunta_encuesta'], 'id', 1);
                $act['id_pregunta_encuesta'] = $act['id_pregunta_encuesta'][0];
            }
            echo json_encode($res);
            break;

        case 'search':
            $res = $objalternativas_pregunta->searchDB($_POST['data'], $_POST['value'], $_POST['type']);
            foreach ($res as &$act) {
                $act['id_pregunta_encuesta'] = $objpregunta_encuesta->searchDB($act['id_pregunta_encuesta'], 'id', 1);
                $act['id_pregunta_encuesta'] = $act['id_pregunta_encuesta'][0];
            }
            echo json_encode($res);
            break;
    }
}?>