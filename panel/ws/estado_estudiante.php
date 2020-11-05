<?php

require_once('../nucleo/estado_estudiante.php');
$objestado_estudiante = new estado_estudiante();

if (isset($_POST['op'])) {
    switch ($_POST['op']) {
        case 'add':
            $objestado_estudiante->setVar('id', $_POST['id']);
            $objestado_estudiante->setVar('nombre', $_POST['nombre']);

            echo json_encode($objestado_estudiante->insertDB());
            break;

        case 'mod':
            $objestado_estudiante->setVar('id', $_POST['id']);
            $objestado_estudiante->setVar('nombre', $_POST['nombre']);

            echo json_encode($objestado_estudiante->updateDB());
            break;

        case 'del':
            $objestado_estudiante->setVar('id', $_POST['id']);
            echo json_encode($objestado_estudiante->deleteDB());
            break;

        case 'get':
            $res = $objestado_estudiante->searchDB($_POST['id'], 'id', 1);
            echo json_encode($res[0]);
            break;

        case 'list':
            $res = $objestado_estudiante->listDB();
            echo json_encode($res);
            break;

        case 'search':
            $res = $objestado_estudiante->searchDB($_POST['data'], $_POST['value'], $_POST['type']);
            echo json_encode($res);
            break;
    }
}?>