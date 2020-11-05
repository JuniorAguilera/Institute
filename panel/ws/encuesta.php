<?php

require_once('../nucleo/encuesta.php');
$objencuesta = new encuesta();

if (isset($_POST['op'])) {
    switch ($_POST['op']) {
        case 'add':
            $objencuesta->setVar('id', $_POST['id']);
            $objencuesta->setVar('titulo', $_POST['titulo']);
            $objencuesta->setVar('fecha_limite', $_POST['fecha_limite']);

            echo json_encode($objencuesta->insertDB());
            break;

        case 'mod':
            $objencuesta->setVar('id', $_POST['id']);
            $objencuesta->setVar('titulo', $_POST['titulo']);
            $objencuesta->setVar('fecha_limite', $_POST['fecha_limite']);

            echo json_encode($objencuesta->updateDB());
            break;

        case 'del':
            $objencuesta->setVar('id', $_POST['id']);
            echo json_encode($objencuesta->deleteDB());
            break;

        case 'get':
            $res = $objencuesta->searchDB($_POST['id'], 'id', 1);
            echo json_encode($res[0]);
            break;

        case 'list':
            $res = $objencuesta->listDB();
            echo json_encode($res);
            break;

        case 'search':
            $res = $objencuesta->searchDB($_POST['data'], $_POST['value'], $_POST['type']);
            echo json_encode($res);
            break;
    }
}?>