<?php

require_once('../nucleo/oferta_laboral.php');
$objoferta_laboral = new oferta_laboral();

require_once('../nucleo/tipo_oferta_laboral.php');
$objtipo_oferta_laboral = new tipo_oferta_laboral();

require_once('../nucleo/empresa.php');
$objempresa = new empresa();

if (isset($_POST['op'])) {
    switch ($_POST['op']) {
        case 'add':
            $objoferta_laboral->setVar('id', $_POST['id']);
            $objoferta_laboral->setVar('vacantes', $_POST['vacantes']);
            $objoferta_laboral->setVar('titulo', $_POST['titulo']);
            $objoferta_laboral->setVar('descripcion', $_POST['descripcion']);
            $objoferta_laboral->setVar('lugar', $_POST['lugar']);
            $objoferta_laboral->setVar('experiencia', $_POST['experiencia']);
            $objoferta_laboral->setVar('id_tipo_oferta_laboral', $_POST['id_tipo_oferta_laboral']);
            $objoferta_laboral->setVar('id_empresa', $_POST['id_empresa']);
            $objoferta_laboral->setVar('fecha', $_POST['fecha']);

            echo json_encode($objoferta_laboral->insertDB());
            break;

        case 'mod':
            $objoferta_laboral->setVar('id', $_POST['id']);
            $objoferta_laboral->setVar('vacantes', $_POST['vacantes']);
            $objoferta_laboral->setVar('titulo', $_POST['titulo']);
            $objoferta_laboral->setVar('descripcion', $_POST['descripcion']);
            $objoferta_laboral->setVar('lugar', $_POST['lugar']);
            $objoferta_laboral->setVar('experiencia', $_POST['experiencia']);
            $objoferta_laboral->setVar('id_tipo_oferta_laboral', $_POST['id_tipo_oferta_laboral']);
            $objoferta_laboral->setVar('id_empresa', $_POST['id_empresa']);
            $objoferta_laboral->setVar('fecha', $_POST['fecha']);

            echo json_encode($objoferta_laboral->updateDB());
            break;

        case 'del':
            $objoferta_laboral->setVar('id', $_POST['id']);
            echo json_encode($objoferta_laboral->deleteDB());
            break;

        case 'get':
            $res = $objoferta_laboral->searchDB($_POST['id'], 'id', 1);
            $res[0]['id_tipo_oferta_laboral'] = $objtipo_oferta_laboral->searchDB($res[0]['id_tipo_oferta_laboral'], 'id', 1);
            $res[0]['id_tipo_oferta_laboral'] = $res[0]['id_tipo_oferta_laboral'][0];
            $res[0]['id_empresa'] = $objempresa->searchDB($res[0]['id_empresa'], 'id', 1);
            $res[0]['id_empresa'] = $res[0]['id_empresa'][0];
            echo json_encode($res[0]);
            break;

        case 'list':
            $res = $objoferta_laboral->listDB();
            foreach ($res as &$act) {
                $act['id_tipo_oferta_laboral'] = $objtipo_oferta_laboral->searchDB($act['id_tipo_oferta_laboral'], 'id', 1);
                $act['id_tipo_oferta_laboral'] = $act['id_tipo_oferta_laboral'][0];
                $act['id_empresa'] = $objempresa->searchDB($act['id_empresa'], 'id', 1);
                $act['id_empresa'] = $act['id_empresa'][0];
            }
            echo json_encode($res);
            break;

        case 'search':
            $res = $objoferta_laboral->searchDB($_POST['data'], $_POST['value'], $_POST['type']);
            foreach ($res as &$act) {
                $act['id_tipo_oferta_laboral'] = $objtipo_oferta_laboral->searchDB($act['id_tipo_oferta_laboral'], 'id', 1);
                $act['id_tipo_oferta_laboral'] = $act['id_tipo_oferta_laboral'][0];
                $act['id_empresa'] = $objempresa->searchDB($act['id_empresa'], 'id', 1);
                $act['id_empresa'] = $act['id_empresa'][0];
            }
            echo json_encode($res);
            break;
    }
}?>