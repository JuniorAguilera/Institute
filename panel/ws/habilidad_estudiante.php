<?php

require_once('../nucleo/habilidad_estudiante.php');
$objhabilidad_estudiante = new habilidad_estudiante();

require_once('../nucleo/estudiante.php');
$objestudiante = new estudiante();

if (isset($_POST['op'])) {
    switch ($_POST['op']) {
        case 'add':
            $objhabilidad_estudiante->setVar('id', $_POST['id']);
            $objhabilidad_estudiante->setVar('id_estudiante', $_POST['id_estudiante']);
            $objhabilidad_estudiante->setVar('habilidad', $_POST['habilidad']);
            $objhabilidad_estudiante->setVar('nivel', $_POST['nivel']);

            echo json_encode($objhabilidad_estudiante->insertDB());
            break;

        case 'mod':
            $objhabilidad_estudiante->setVar('id', $_POST['id']);
            $objhabilidad_estudiante->setVar('id_estudiante', $_POST['id_estudiante']);
            $objhabilidad_estudiante->setVar('habilidad', $_POST['habilidad']);
            $objhabilidad_estudiante->setVar('nivel', $_POST['nivel']);

            echo json_encode($objhabilidad_estudiante->updateDB());
            break;

        case 'del':
            $objhabilidad_estudiante->setVar('id', $_POST['id']);
            echo json_encode($objhabilidad_estudiante->deleteDB());
            break;

        case 'get':
            $res = $objhabilidad_estudiante->searchDB($_POST['id'], 'id', 1);
            $res[0]['id_estudiante'] = $objestudiante->searchDB($res[0]['id_estudiante'], 'id', 1);
            $res[0]['id_estudiante'] = $res[0]['id_estudiante'][0];
            echo json_encode($res[0]);
            break;

        case 'list':
            $res = $objhabilidad_estudiante->listDB();
            foreach ($res as &$act) {
                $act['id_estudiante'] = $objestudiante->searchDB($act['id_estudiante'], 'id', 1);
                $act['id_estudiante'] = $act['id_estudiante'][0];
            }
            echo json_encode($res);
            break;

        case 'search':
            $res = $objhabilidad_estudiante->searchDB($_POST['data'], $_POST['value'], $_POST['type']);
            foreach ($res as &$act) {
                $act['id_estudiante'] = $objestudiante->searchDB($act['id_estudiante'], 'id', 1);
                $act['id_estudiante'] = $act['id_estudiante'][0];
            }
            echo json_encode($res);
            break;
    }
}?>