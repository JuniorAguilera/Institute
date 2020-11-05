<?php

require_once('../nucleo/tipo_carrera.php');
$objtipo_carrera = new tipo_carrera();

if (isset($_POST['op'])) {
    switch ($_POST['op']) {
        case 'add':
            $objtipo_carrera->setVar('id', $_POST['id']);
            $objtipo_carrera->setVar('nombre', $_POST['nombre']);

            echo json_encode($objtipo_carrera->insertDB());
            break;

        case 'mod':
            $objtipo_carrera->setVar('id', $_POST['id']);
            $objtipo_carrera->setVar('nombre', $_POST['nombre']);

            echo json_encode($objtipo_carrera->updateDB());
            break;

        case 'del':
            $objtipo_carrera->setVar('id', $_POST['id']);
            echo json_encode($objtipo_carrera->deleteDB());
            break;

        case 'get':
            $res = $objtipo_carrera->searchDB($_POST['id'], 'id', 1);
            echo json_encode($res[0]);
            break;

        case 'list':
            $res = $objtipo_carrera->listDB();
            echo json_encode($res);
            break;

        case 'search':
            $res = $objtipo_carrera->searchDB($_POST['data'], $_POST['value'], $_POST['type']);
            echo json_encode($res);
            break;
    }
}?>