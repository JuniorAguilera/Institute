<?php

require_once('../nucleo/administrador.php');
$objadministrador = new administrador();

if (isset($_POST['op'])) {
    switch ($_POST['op']) {
        case 'add':
            $objadministrador->setVar('id', $_POST['id']);
            $objadministrador->setVar('user', $_POST['user']);
            $objadministrador->setVar('pass', $_POST['pass']);
            $objadministrador->setVar('habilitado', $_POST['habilitado']);

            echo json_encode($objadministrador->insertDB());
            break;

        case 'mod':
            $objadministrador->setVar('id', $_POST['id']);
            $objadministrador->setVar('user', $_POST['user']);
            $objadministrador->setVar('pass', $_POST['pass']);
            $objadministrador->setVar('habilitado', $_POST['habilitado']);

            echo json_encode($objadministrador->updateDB());
            break;

        case 'del':
            $objadministrador->setVar('id', $_POST['id']);
            echo json_encode($objadministrador->deleteDB());
            break;

        case 'get':
            $res = $objadministrador->searchDB($_POST['id'], 'id', 1);
            echo json_encode($res[0]);
            break;

        case 'list':
            $res = $objadministrador->listDB();
            echo json_encode($res);
            break;

        case 'search':
            $res = $objadministrador->searchDB($_POST['data'], $_POST['value'], $_POST['type']);
            echo json_encode($res);
            break;
    }
}?>