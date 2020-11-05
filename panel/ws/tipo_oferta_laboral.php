<?php

require_once('../nucleo/tipo_oferta_laboral.php');
$objtipo_oferta_laboral = new tipo_oferta_laboral();

if (isset($_POST['op'])) {
    switch ($_POST['op']) {
        case 'add':
            $objtipo_oferta_laboral->setVar('id', $_POST['id']);
            $objtipo_oferta_laboral->setVar('nombre', $_POST['nombre']);

            echo json_encode($objtipo_oferta_laboral->insertDB());
            break;

        case 'mod':
            $objtipo_oferta_laboral->setVar('id', $_POST['id']);
            $objtipo_oferta_laboral->setVar('nombre', $_POST['nombre']);

            echo json_encode($objtipo_oferta_laboral->updateDB());
            break;

        case 'del':
            $objtipo_oferta_laboral->setVar('id', $_POST['id']);
            echo json_encode($objtipo_oferta_laboral->deleteDB());
            break;

        case 'get':
            $res = $objtipo_oferta_laboral->searchDB($_POST['id'], 'id', 1);
            echo json_encode($res[0]);
            break;

        case 'list':
            $res = $objtipo_oferta_laboral->listDB();
            echo json_encode($res);
            break;

        case 'search':
            $res = $objtipo_oferta_laboral->searchDB($_POST['data'], $_POST['value'], $_POST['type']);
            echo json_encode($res);
            break;
    }
}?>