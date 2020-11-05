<?php

require_once('../nucleo/tipo_pregunta.php');
$objtipo_pregunta = new tipo_pregunta();

if (isset($_POST['op'])) {
    switch ($_POST['op']) {
        case 'add':
            $objtipo_pregunta->setVar('id', $_POST['id']);
            $objtipo_pregunta->setVar('nombre', $_POST['nombre']);

            echo json_encode($objtipo_pregunta->insertDB());
            break;

        case 'mod':
            $objtipo_pregunta->setVar('id', $_POST['id']);
            $objtipo_pregunta->setVar('nombre', $_POST['nombre']);

            echo json_encode($objtipo_pregunta->updateDB());
            break;

        case 'del':
            $objtipo_pregunta->setVar('id', $_POST['id']);
            echo json_encode($objtipo_pregunta->deleteDB());
            break;

        case 'get':
            $res = $objtipo_pregunta->searchDB($_POST['id'], 'id', 1);
            echo json_encode($res[0]);
            break;

        case 'list':
            $res = $objtipo_pregunta->listDB();
            echo json_encode($res);
            break;

        case 'search':
            $res = $objtipo_pregunta->searchDB($_POST['data'], $_POST['value'], $_POST['type']);
            echo json_encode($res);
            break;
    }
}?>