<?php

require_once('../nucleo/habilidad_oferta_laboral.php');
$objhabilidad_oferta_laboral = new habilidad_oferta_laboral();

require_once('../nucleo/oferta_laboral.php');
$objoferta_laboral = new oferta_laboral();

if (isset($_POST['op'])) {
    switch ($_POST['op']) {
        case 'add':
            $objhabilidad_oferta_laboral->setVar('id', $_POST['id']);
            $objhabilidad_oferta_laboral->setVar('nombre', $_POST['nombre']);
            $objhabilidad_oferta_laboral->setVar('nivel', $_POST['nivel']);
            $objhabilidad_oferta_laboral->setVar('id_oferta_laboral', $_POST['id_oferta_laboral']);

            echo json_encode($objhabilidad_oferta_laboral->insertDB());
            break;

        case 'mod':
            $objhabilidad_oferta_laboral->setVar('id', $_POST['id']);
            $objhabilidad_oferta_laboral->setVar('nombre', $_POST['nombre']);
            $objhabilidad_oferta_laboral->setVar('nivel', $_POST['nivel']);
            $objhabilidad_oferta_laboral->setVar('id_oferta_laboral', $_POST['id_oferta_laboral']);

            echo json_encode($objhabilidad_oferta_laboral->updateDB());
            break;

        case 'del':
            $objhabilidad_oferta_laboral->setVar('id', $_POST['id']);
            echo json_encode($objhabilidad_oferta_laboral->deleteDB());
            break;

        case 'get':
            $res = $objhabilidad_oferta_laboral->searchDB($_POST['id'], 'id', 1);
            $res[0]['id_oferta_laboral'] = $objoferta_laboral->searchDB($res[0]['id_oferta_laboral'], 'id', 1);
            $res[0]['id_oferta_laboral'] = $res[0]['id_oferta_laboral'][0];
            echo json_encode($res[0]);
            break;

        case 'list':
            $res = $objhabilidad_oferta_laboral->listDB();
            foreach ($res as &$act) {
                $act['id_oferta_laboral'] = $objoferta_laboral->searchDB($act['id_oferta_laboral'], 'id', 1);
                $act['id_oferta_laboral'] = $act['id_oferta_laboral'][0];
            }
            echo json_encode($res);
            break;

        case 'search':
            $res = $objhabilidad_oferta_laboral->searchDB($_POST['data'], $_POST['value'], $_POST['type']);
            foreach ($res as &$act) {
                $act['id_oferta_laboral'] = $objoferta_laboral->searchDB($act['id_oferta_laboral'], 'id', 1);
                $act['id_oferta_laboral'] = $act['id_oferta_laboral'][0];
            }
            echo json_encode($res);
            break;
    }
}?>