<?php

require_once('../nucleo/seccion_encuesta.php');
$objseccion_encuesta = new seccion_encuesta();

require_once('../nucleo/encuesta.php');
$objencuesta = new encuesta();

if (isset($_POST['op'])) {
    switch ($_POST['op']) {
        case 'add':
            $objseccion_encuesta->setVar('id', $_POST['id']);
            $objseccion_encuesta->setVar('titulo', $_POST['titulo']);
            $objseccion_encuesta->setVar('id_encuesta', $_POST['id_encuesta']);

            echo json_encode($objseccion_encuesta->insertDB());
            break;

        case 'mod':
            $objseccion_encuesta->setVar('id', $_POST['id']);
            $objseccion_encuesta->setVar('titulo', $_POST['titulo']);
            $objseccion_encuesta->setVar('id_encuesta', $_POST['id_encuesta']);

            echo json_encode($objseccion_encuesta->updateDB());
            break;

        case 'del':
            $objseccion_encuesta->setVar('id', $_POST['id']);
            echo json_encode($objseccion_encuesta->deleteDB());
            break;

        case 'get':
            $res = $objseccion_encuesta->searchDB($_POST['id'], 'id', 1);
            $res[0]['id_encuesta'] = $objencuesta->searchDB($res[0]['id_encuesta'], 'id', 1);
            $res[0]['id_encuesta'] = $res[0]['id_encuesta'][0];
            echo json_encode($res[0]);
            break;

        case 'list':
            $res = $objseccion_encuesta->listDB();
            foreach ($res as &$act) {
                $act['id_encuesta'] = $objencuesta->searchDB($act['id_encuesta'], 'id', 1);
                $act['id_encuesta'] = $act['id_encuesta'][0];
            }
            echo json_encode($res);
            break;

        case 'search':
            $res = $objseccion_encuesta->searchDB($_POST['data'], $_POST['value'], $_POST['type']);
            foreach ($res as &$act) {
                $act['id_encuesta'] = $objencuesta->searchDB($act['id_encuesta'], 'id', 1);
                $act['id_encuesta'] = $act['id_encuesta'][0];
            }
            echo json_encode($res);
            break;
    }
}?>