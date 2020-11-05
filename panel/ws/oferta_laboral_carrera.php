<?php

require_once('../nucleo/oferta_laboral_carrera.php');
$objoferta_laboral_carrera = new oferta_laboral_carrera();

require_once('../nucleo/oferta_laboral.php');
$objoferta_laboral = new oferta_laboral();

require_once('../nucleo/carrera.php');
$objcarrera = new carrera();

if (isset($_POST['op'])) {
    switch ($_POST['op']) {
        case 'add':
            $objoferta_laboral_carrera->setVar('id', $_POST['id']);
            $objoferta_laboral_carrera->setVar('id_oferta_laboral', $_POST['id_oferta_laboral']);
            $objoferta_laboral_carrera->setVar('id_carrera', $_POST['id_carrera']);

            echo json_encode($objoferta_laboral_carrera->insertDB());
            break;

        case 'mod':
            $objoferta_laboral_carrera->setVar('id', $_POST['id']);
            $objoferta_laboral_carrera->setVar('id_oferta_laboral', $_POST['id_oferta_laboral']);
            $objoferta_laboral_carrera->setVar('id_carrera', $_POST['id_carrera']);

            echo json_encode($objoferta_laboral_carrera->updateDB());
            break;

        case 'del':
            $objoferta_laboral_carrera->setVar('id', $_POST['id']);
            echo json_encode($objoferta_laboral_carrera->deleteDB());
            break;

        case 'get':
            $res = $objoferta_laboral_carrera->searchDB($_POST['id'], 'id', 1);
            $res[0]['id_oferta_laboral'] = $objoferta_laboral->searchDB($res[0]['id_oferta_laboral'], 'id', 1);
            $res[0]['id_oferta_laboral'] = $res[0]['id_oferta_laboral'][0];
            $res[0]['id_carrera'] = $objcarrera->searchDB($res[0]['id_carrera'], 'id', 1);
            $res[0]['id_carrera'] = $res[0]['id_carrera'][0];
            echo json_encode($res[0]);
            break;

        case 'list':
            $res = $objoferta_laboral_carrera->listDB();
            foreach ($res as &$act) {
                $act['id_oferta_laboral'] = $objoferta_laboral->searchDB($act['id_oferta_laboral'], 'id', 1);
                $act['id_oferta_laboral'] = $act['id_oferta_laboral'][0];
                $act['id_carrera'] = $objcarrera->searchDB($act['id_carrera'], 'id', 1);
                $act['id_carrera'] = $act['id_carrera'][0];
            }
            echo json_encode($res);
            break;

        case 'search':
            $res = $objoferta_laboral_carrera->searchDB($_POST['data'], $_POST['value'], $_POST['type']);
            foreach ($res as &$act) {
                $act['id_oferta_laboral'] = $objoferta_laboral->searchDB($act['id_oferta_laboral'], 'id', 1);
                $act['id_oferta_laboral'] = $act['id_oferta_laboral'][0];
                $act['id_carrera'] = $objcarrera->searchDB($act['id_carrera'], 'id', 1);
                $act['id_carrera'] = $act['id_carrera'][0];
            }
            echo json_encode($res);
            break;
    }
}?>