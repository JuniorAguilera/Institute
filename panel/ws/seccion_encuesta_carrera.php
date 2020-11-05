<?php

require_once('../nucleo/seccion_encuesta_carrera.php');
$objseccion_encuesta_carrera = new seccion_encuesta_carrera();

require_once('../nucleo/seccion_encuesta.php');
$objseccion_encuesta = new seccion_encuesta();

require_once('../nucleo/carrera.php');
$objcarrera = new carrera();

if (isset($_POST['op'])) {
    switch ($_POST['op']) {
        case 'add':
            $objseccion_encuesta_carrera->setVar('id', $_POST['id']);
            $objseccion_encuesta_carrera->setVar('id_seccion_encuesta', $_POST['id_seccion_encuesta']);
            $objseccion_encuesta_carrera->setVar('id_carrera', $_POST['id_carrera']);

            echo json_encode($objseccion_encuesta_carrera->insertDB());
            break;

        case 'mod':
            $objseccion_encuesta_carrera->setVar('id', $_POST['id']);
            $objseccion_encuesta_carrera->setVar('id_seccion_encuesta', $_POST['id_seccion_encuesta']);
            $objseccion_encuesta_carrera->setVar('id_carrera', $_POST['id_carrera']);

            echo json_encode($objseccion_encuesta_carrera->updateDB());
            break;

        case 'del':
            $objseccion_encuesta_carrera->setVar('id', $_POST['id']);
            echo json_encode($objseccion_encuesta_carrera->deleteDB());
            break;

        case 'get':
            $res = $objseccion_encuesta_carrera->searchDB($_POST['id'], 'id', 1);
            $res[0]['id_seccion_encuesta'] = $objseccion_encuesta->searchDB($res[0]['id_seccion_encuesta'], 'id', 1);
            $res[0]['id_seccion_encuesta'] = $res[0]['id_seccion_encuesta'][0];
            $res[0]['id_carrera'] = $objcarrera->searchDB($res[0]['id_carrera'], 'id', 1);
            $res[0]['id_carrera'] = $res[0]['id_carrera'][0];
            echo json_encode($res[0]);
            break;

        case 'list':
            $res = $objseccion_encuesta_carrera->listDB();
            foreach ($res as &$act) {
                $act['id_seccion_encuesta'] = $objseccion_encuesta->searchDB($act['id_seccion_encuesta'], 'id', 1);
                $act['id_seccion_encuesta'] = $act['id_seccion_encuesta'][0];
                $act['id_carrera'] = $objcarrera->searchDB($act['id_carrera'], 'id', 1);
                $act['id_carrera'] = $act['id_carrera'][0];
            }
            echo json_encode($res);
            break;

        case 'search':
            $res = $objseccion_encuesta_carrera->searchDB($_POST['data'], $_POST['value'], $_POST['type']);
            foreach ($res as &$act) {
                $act['id_seccion_encuesta'] = $objseccion_encuesta->searchDB($act['id_seccion_encuesta'], 'id', 1);
                $act['id_seccion_encuesta'] = $act['id_seccion_encuesta'][0];
                $act['id_carrera'] = $objcarrera->searchDB($act['id_carrera'], 'id', 1);
                $act['id_carrera'] = $act['id_carrera'][0];
            }
            echo json_encode($res);
            break;
    }
}?>