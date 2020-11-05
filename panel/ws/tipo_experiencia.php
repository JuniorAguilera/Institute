<?php

require_once('../nucleo/tipo_experiencia.php');
$objtipo_experiencia = new tipo_experiencia();

if (isset($_POST['op'])) {
    switch ($_POST['op']) {
        case 'add':
            $objtipo_experiencia->setVar('id', $_POST['id']);
            $objtipo_experiencia->setVar('nombre', $_POST['nombre']);

            echo json_encode($objtipo_experiencia->insertDB());
            break;

        case 'mod':
            $objtipo_experiencia->setVar('id', $_POST['id']);
            $objtipo_experiencia->setVar('nombre', $_POST['nombre']);

            echo json_encode($objtipo_experiencia->updateDB());
            break;

        case 'del':
            $objtipo_experiencia->setVar('id', $_POST['id']);
            echo json_encode($objtipo_experiencia->deleteDB());
            break;

        case 'get':
            $res = $objtipo_experiencia->searchDB($_POST['id'], 'id', 1);
            echo json_encode($res[0]);
            break;

        case 'list':
            $res = $objtipo_experiencia->listDB();
            echo json_encode($res);
            break;

        case 'search':
            $res = $objtipo_experiencia->searchDB($_POST['data'], $_POST['value'], $_POST['type']);
            echo json_encode($res);
            break;
    }
}?>