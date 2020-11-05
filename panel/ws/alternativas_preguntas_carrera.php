<?php

require_once('../nucleo/alternativas_preguntas_carrera.php');
$objalternativas_preguntas_carrera = new alternativas_preguntas_carrera();

require_once('../nucleo/alternativas_pregunta.php');
$objalternativas_pregunta = new alternativas_pregunta();

require_once('../nucleo/carrera.php');
$objcarrera = new carrera();

if (isset($_POST['op'])) {
    switch ($_POST['op']) {
        case 'add':
            $objalternativas_preguntas_carrera->setVar('id', $_POST['id']);
            $objalternativas_preguntas_carrera->setVar('id_alternativas_pregunta', $_POST['id_alternativas_pregunta']);
            $objalternativas_preguntas_carrera->setVar('id_carrera', $_POST['id_carrera']);

            echo json_encode($objalternativas_preguntas_carrera->insertDB());
            break;

        case 'mod':
            $objalternativas_preguntas_carrera->setVar('id', $_POST['id']);
            $objalternativas_preguntas_carrera->setVar('id_alternativas_pregunta', $_POST['id_alternativas_pregunta']);
            $objalternativas_preguntas_carrera->setVar('id_carrera', $_POST['id_carrera']);

            echo json_encode($objalternativas_preguntas_carrera->updateDB());
            break;

        case 'del':
            $objalternativas_preguntas_carrera->setVar('id', $_POST['id']);
            echo json_encode($objalternativas_preguntas_carrera->deleteDB());
            break;

        case 'get':
            $res = $objalternativas_preguntas_carrera->searchDB($_POST['id'], 'id', 1);
            $res[0]['id_alternativas_pregunta'] = $objalternativas_pregunta->searchDB($res[0]['id_alternativas_pregunta'], 'id', 1);
            $res[0]['id_alternativas_pregunta'] = $res[0]['id_alternativas_pregunta'][0];
            $res[0]['id_carrera'] = $objcarrera->searchDB($res[0]['id_carrera'], 'id', 1);
            $res[0]['id_carrera'] = $res[0]['id_carrera'][0];
            echo json_encode($res[0]);
            break;

        case 'list':
            $res = $objalternativas_preguntas_carrera->listDB();
            foreach ($res as &$act) {
                $act['id_alternativas_pregunta'] = $objalternativas_pregunta->searchDB($act['id_alternativas_pregunta'], 'id', 1);
                $act['id_alternativas_pregunta'] = $act['id_alternativas_pregunta'][0];
                $act['id_carrera'] = $objcarrera->searchDB($act['id_carrera'], 'id', 1);
                $act['id_carrera'] = $act['id_carrera'][0];
            }
            echo json_encode($res);
            break;

        case 'search':
            $res = $objalternativas_preguntas_carrera->searchDB($_POST['data'], $_POST['value'], $_POST['type']);
            foreach ($res as &$act) {
                $act['id_alternativas_pregunta'] = $objalternativas_pregunta->searchDB($act['id_alternativas_pregunta'], 'id', 1);
                $act['id_alternativas_pregunta'] = $act['id_alternativas_pregunta'][0];
                $act['id_carrera'] = $objcarrera->searchDB($act['id_carrera'], 'id', 1);
                $act['id_carrera'] = $act['id_carrera'][0];
            }
            echo json_encode($res);
            break;
    }
}?>