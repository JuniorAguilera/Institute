<?php

require_once('../nucleo/carrera.php');
$objcarrera = new carrera();

require_once('../nucleo/tipo_carrera.php');
$objtipo_carrera = new tipo_carrera();

if (isset($_POST['op'])) {
    switch ($_POST['op']) {
        case 'add':
            $objcarrera->setVar('id', $_POST['id']);
            $objcarrera->setVar('nombre', $_POST['nombre']);
            $objcarrera->setVar('id_tipo_carrera', $_POST['id_tipo_carrera']);

            echo json_encode($objcarrera->insertDB());
            break;

        case 'mod':
            $objcarrera->setVar('id', $_POST['id']);
            $objcarrera->setVar('nombre', $_POST['nombre']);
            $objcarrera->setVar('id_tipo_carrera', $_POST['id_tipo_carrera']);

            echo json_encode($objcarrera->updateDB());
            break;

        case 'del':
            $objcarrera->setVar('id', $_POST['id']);
            echo json_encode($objcarrera->deleteDB());
            break;

        case 'get':
            $res = $objcarrera->searchDB($_POST['id'], 'id', 1);
            $res[0]['id_tipo_carrera'] = $objtipo_carrera->searchDB($res[0]['id_tipo_carrera'], 'id', 1);
            $res[0]['id_tipo_carrera'] = $res[0]['id_tipo_carrera'][0];
            echo json_encode($res[0]);
            break;

        case 'list':
            $res = $objcarrera->listDB();
            foreach ($res as &$act) {
                $act['id_tipo_carrera'] = $objtipo_carrera->searchDB($act['id_tipo_carrera'], 'id', 1);
                $act['id_tipo_carrera'] = $act['id_tipo_carrera'][0];
            }
            echo json_encode($res);
            break;

        case 'search':
            $res = $objcarrera->searchDB($_POST['data'], $_POST['value'], $_POST['type']);
            foreach ($res as &$act) {
                $act['id_tipo_carrera'] = $objtipo_carrera->searchDB($act['id_tipo_carrera'], 'id', 1);
                $act['id_tipo_carrera'] = $act['id_tipo_carrera'][0];
            }
            echo json_encode($res);
            break;
    }
}?>