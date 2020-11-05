<?php

require_once('../nucleo/pregunta_encuesta.php');
$objpregunta_encuesta = new pregunta_encuesta();

require_once('../nucleo/tipo_pregunta.php');
$objtipo_pregunta = new tipo_pregunta();

require_once('../nucleo/seccion_encuesta.php');
$objseccion_encuesta = new seccion_encuesta();

require_once('../nucleo/pregunta_encuesta.php');
$objpregunta_encuesta = new pregunta_encuesta();

if (isset($_POST['op'])) {
    switch ($_POST['op']) {
        case 'add':
            $objpregunta_encuesta->setVar('enunciado', $_POST['enunciado']);
            $objpregunta_encuesta->setVar('id_tipo_pregunta', $_POST['id_tipo_pregunta']);
            $objpregunta_encuesta->setVar('id_seccion_encuesta', $_POST['id_seccion_encuesta']);
            $objpregunta_encuesta->setVar('id_pregunta_encuesta', $_POST['id_pregunta_encuesta']);
            $objpregunta_encuesta->setVar('id_pregunta_encuesta_1', $_POST['id_pregunta_encuesta_1']);
            $objpregunta_encuesta->setVar('id_pregunta_encuesta_2', $_POST['id_pregunta_encuesta_2']);
            $objpregunta_encuesta->setVar('id_pregunta_encuesta_3', $_POST['id_pregunta_encuesta_3']);
            echo json_encode($objpregunta_encuesta->insertDB());
            break;

        case 'mod':
            $objpregunta_encuesta->setVar('id', $_POST['id']);
            $objpregunta_encuesta->setVar('enunciado', $_POST['enunciado']);
            $objpregunta_encuesta->setVar('id_tipo_pregunta', $_POST['id_tipo_pregunta']);
            $objpregunta_encuesta->setVar('id_seccion_encuesta', $_POST['id_seccion_encuesta']);
            $objpregunta_encuesta->setVar('id_pregunta_encuesta', $_POST['id_pregunta_encuesta']);
            $objpregunta_encuesta->setVar('id_pregunta_encuesta_1', $_POST['id_pregunta_encuesta_1']);
            $objpregunta_encuesta->setVar('id_pregunta_encuesta_2', $_POST['id_pregunta_encuesta_2']);
            $objpregunta_encuesta->setVar('id_pregunta_encuesta_3', $_POST['id_pregunta_encuesta_3']);

            echo json_encode($objpregunta_encuesta->updateDB());
            break;

        case 'del':
            $objpregunta_encuesta->setVar('id', $_POST['id']);
            echo json_encode($objpregunta_encuesta->deleteDB());
            break;

        case 'get':
            $res = $objpregunta_encuesta->searchDB($_POST['id'], 'id', 1);
            $res[0]['id_tipo_pregunta'] = $objtipo_pregunta->searchDB($res[0]['id_tipo_pregunta'], 'id', 1);
            $res[0]['id_tipo_pregunta'] = $res[0]['id_tipo_pregunta'][0];
            $res[0]['id_seccion_encuesta'] = $objseccion_encuesta->searchDB($res[0]['id_seccion_encuesta'], 'id', 1);
            $res[0]['id_seccion_encuesta'] = $res[0]['id_seccion_encuesta'][0];
            $res[0]['id_pregunta_encuesta'] = $objpregunta_encuesta->searchDB($res[0]['id_pregunta_encuesta'], 'id', 1);
            $res[0]['id_pregunta_encuesta'] = $res[0]['id_pregunta_encuesta'][0];
            $res[0]['id_pregunta_encuesta_1'] = $objpregunta_encuesta->searchDB($res[0]['id_pregunta_encuesta_1'], 'id', 1);
            $res[0]['id_pregunta_encuesta_1'] = $res[0]['id_pregunta_encuesta_1'][0];
            $res[0]['id_pregunta_encuesta_2'] = $objpregunta_encuesta->searchDB($res[0]['id_pregunta_encuesta_2'], 'id', 1);
            $res[0]['id_pregunta_encuesta_2'] = $res[0]['id_pregunta_encuesta_2'][0];
            $res[0]['id_pregunta_encuesta_3'] = $objpregunta_encuesta->searchDB($res[0]['id_pregunta_encuesta_3'], 'id', 1);
            $res[0]['id_pregunta_encuesta_3'] = $res[0]['id_pregunta_encuesta_3'][0];
            echo json_encode($res[0]);
            break;

        case 'list':
            $res = $objpregunta_encuesta->listDB();
            foreach ($res as &$act) {
                $act['id_tipo_pregunta'] = $objtipo_pregunta->searchDB($act['id_tipo_pregunta'], 'id', 1);
                $act['id_tipo_pregunta'] = $act['id_tipo_pregunta'][0];
                $act['id_seccion_encuesta'] = $objseccion_encuesta->searchDB($act['id_seccion_encuesta'], 'id', 1);
                $act['id_seccion_encuesta'] = $act['id_seccion_encuesta'][0];
                $act['id_pregunta_encuesta'] = $objpregunta_encuesta->searchDB($act['id_pregunta_encuesta'], 'id', 1);
                $act['id_pregunta_encuesta'] = $act['id_pregunta_encuesta'][0];
                $act['id_pregunta_encuesta_1'] = $objpregunta_encuesta->searchDB($act['id_pregunta_encuesta_1'], 'id', 1);
                $act['id_pregunta_encuesta_1'] = $act['id_pregunta_encuesta_1'][0];
                $act['id_pregunta_encuesta_2'] = $objpregunta_encuesta->searchDB($act['id_pregunta_encuesta_2'], 'id', 1);
                $act['id_pregunta_encuesta_2'] = $act['id_pregunta_encuesta_2'][0];
                $act['id_pregunta_encuesta_3'] = $objpregunta_encuesta->searchDB($act['id_pregunta_encuesta_3'], 'id', 1);
                $act['id_pregunta_encuesta_3'] = $act['id_pregunta_encuesta_3'][0];
            }
            echo json_encode($res);
            break;

        case 'search':
            $res = $objpregunta_encuesta->searchDB($_POST['data'], $_POST['value'], $_POST['type']);
            foreach ($res as &$act) {
                $act['id_tipo_pregunta'] = $objtipo_pregunta->searchDB($act['id_tipo_pregunta'], 'id', 1);
                $act['id_tipo_pregunta'] = $act['id_tipo_pregunta'][0];
                $act['id_seccion_encuesta'] = $objseccion_encuesta->searchDB($act['id_seccion_encuesta'], 'id', 1);
                $act['id_seccion_encuesta'] = $act['id_seccion_encuesta'][0];
                $act['id_pregunta_encuesta'] = $objpregunta_encuesta->searchDB($act['id_pregunta_encuesta'], 'id', 1);
                $act['id_pregunta_encuesta'] = $act['id_pregunta_encuesta'][0];
                $act['id_pregunta_encuesta_1'] = $objpregunta_encuesta->searchDB($act['id_pregunta_encuesta_1'], 'id', 1);
                $act['id_pregunta_encuesta_1'] = $act['id_pregunta_encuesta_1'][0];
                $act['id_pregunta_encuesta_2'] = $objpregunta_encuesta->searchDB($act['id_pregunta_encuesta_2'], 'id', 1);
                $act['id_pregunta_encuesta_2'] = $act['id_pregunta_encuesta_2'][0];
                $act['id_pregunta_encuesta_3'] = $objpregunta_encuesta->searchDB($act['id_pregunta_encuesta_3'], 'id', 1);
                $act['id_pregunta_encuesta_3'] = $act['id_pregunta_encuesta_3'][0];
            }
            echo json_encode($res);
            break;
    }
}?>