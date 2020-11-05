<?php

require_once('../nucleo/empresa.php');
$objempresa = new empresa();

if (isset($_POST['op'])) {
    switch ($_POST['op']) {
        case 'add':
            $objempresa->setVar('razon_social', $_POST['razon_social']);
            $objempresa->setVar('ruc', $_POST['ruc']);
            $objempresa->setVar('direccion', $_POST['direccion']);
            $objempresa->setVar('telefono', $_POST['telefono']);
            $objempresa->setVar('correo', $_POST['correo']);
            $idu = $objempresa->insertDB();
            //Verficamos imagenes
            if ($_FILES["ima"]["error"] == 0) {
                $id_usuario = $idu;
                $tipo = 0;
                $tipo_imagen = $_FILES["ima"]['type'];
                if (strpos($tipo_imagen, "gif")) {
                    $tipo = 1;
                    if (file_exists("../../img/perfil/empresa/" . $id_usuario . ".gif")) {
                        unlink("../../img/perfil/empresa/" . $id_usuario . ".gif");
                    }
                } else {
                    if (strpos($tipo_imagen, "jpeg")) {
                        $tipo = 2;
                        if (file_exists("../../img/perfil/empresa/" . $id_usuario . ".jpg")) {
                            unlink("../../img/perfil/empresa/" . $id_usuario . ".jpg");
                        }
                    } else {
                        if (strpos($tipo_imagen, "jpg")) {
                            $tipo = 2;
                            if (file_exists("../../img/perfil/empresa/" . $id_usuario . ".jpg")) {
                                unlink("../../img/perfil/empresa/" . $id_usuario . ".jpg");
                            }
                        } else {
                            if (strpos($tipo_imagen, "png")) {
                                $tipo = 3;
                                if (file_exists("../../img/perfil/empresa/" . $id_usuario . ".png")) {
                                    unlink("../../img/perfil/empresa/" . $id_usuario . ".png");
                                }
                            } else {
                                $tipo = 0;
                            }
                        }
                    }
                }
                if ($tipo > 0) {
                    $nombre_archivo = $id_usuario;
                    $imagen_original = 0;
                    switch ($tipo) {
                        case 1:
                            $imagen_original = imagecreatefromgif($_FILES["ima"]["tmp_name"]);
                            break;
                        case 2:
                            $imagen_original = imagecreatefromjpeg($_FILES["ima"]["tmp_name"]);
                            break;
                        case 3:
                            $imagen_original = imagecreatefrompng($_FILES["ima"]["tmp_name"]);
                            break;
                    }
                    $ancho_original = imagesx($imagen_original);
                    $alto_original = imagesy($imagen_original);
                    $imagen_redimensionada = imagecreatetruecolor(256, 167);
                    imagecopyresampled($imagen_redimensionada, $imagen_original, 0, 0, 0, 0, 256, 167, $ancho_original, $alto_original);
                    switch ($tipo) {
                        case 1:
                            $ruta = '../../img/perfil/empresa/' . $nombre_archivo . '.gif';
                            imagegif($imagen_redimensionada, $ruta);
                            break;
                        case 2:
                            $ruta = '../../img/perfil/empresa/' . $nombre_archivo . '.jpg';
                            imagejpeg($imagen_redimensionada, $ruta);
                            break;
                        case 3:
                            $ruta = '../../img/perfil/empresa/' . $nombre_archivo . '.png';
                            imagepng($imagen_redimensionada, $ruta);
                            break;
                    }
                    imagedestroy($imagen_original);
                    imagedestroy($imagen_redimensionada);
                }
            }
            echo json_encode($idu);
            break;

        case 'mod':
            $objempresa->setVar('id', $_POST['id']);
            $objempresa->setVar('razon_social', $_POST['razon_social']);
            $objempresa->setVar('ruc', $_POST['ruc']);
            $objempresa->setVar('direccion', $_POST['direccion']);
            $objempresa->setVar('telefono', $_POST['telefono']);
            $objempresa->setVar('correo', $_POST['correo']);
            echo json_encode($objempresa->updateDB());
            //Verficamos imagenes
            if ($_FILES["ima"]["error"] == 0) {
                $id_usuario = $_POST['id'];
                $tipo = 0;
                $tipo_imagen = $_FILES["ima"]['type'];
                if (strpos($tipo_imagen, "gif")) {
                    $tipo = 1;
                    if (file_exists("../../img/perfil/empresa/" . $id_usuario . ".gif")) {
                        unlink("../../img/perfil/empresa/" . $id_usuario . ".gif");
                    }
                } else {
                    if (strpos($tipo_imagen, "jpeg")) {
                        $tipo = 2;
                        if (file_exists("../../img/perfil/empresa/" . $id_usuario . ".jpg")) {
                            unlink("../../img/perfil/empresa/" . $id_usuario . ".jpg");
                        }
                    } else {
                        if (strpos($tipo_imagen, "jpg")) {
                            $tipo = 2;
                            if (file_exists("../../img/perfil/empresa/" . $id_usuario . ".jpg")) {
                                unlink("../../img/perfil/empresa/" . $id_usuario . ".jpg");
                            }
                        } else {
                            if (strpos($tipo_imagen, "png")) {
                                $tipo = 3;
                                if (file_exists("../../img/perfil/empresa/" . $id_usuario . ".png")) {
                                    unlink("../../img/perfil/empresa/" . $id_usuario . ".png");
                                }
                            } else {
                                $tipo = 0;
                            }
                        }
                    }
                }
                if ($tipo > 0) {
                    $nombre_archivo = $id_usuario;
                    $imagen_original = 0;
                    switch ($tipo) {
                        case 1:
                            $imagen_original = imagecreatefromgif($_FILES["ima"]["tmp_name"]);
                            break;
                        case 2:
                            $imagen_original = imagecreatefromjpeg($_FILES["ima"]["tmp_name"]);
                            break;
                        case 3:
                            $imagen_original = imagecreatefrompng($_FILES["ima"]["tmp_name"]);
                            break;
                    }
                    $ancho_original = imagesx($imagen_original);
                    $alto_original = imagesy($imagen_original);
                    $imagen_redimensionada = imagecreatetruecolor(256, 167);
                    imagecopyresampled($imagen_redimensionada, $imagen_original, 0, 0, 0, 0, 256, 167, $ancho_original, $alto_original);
                    switch ($tipo) {
                        case 1:
                            $ruta = '../../img/perfil/empresa/' . $nombre_archivo . '.gif';
                            imagegif($imagen_redimensionada, $ruta);
                            break;
                        case 2:
                            $ruta = '../../img/perfil/empresa/' . $nombre_archivo . '.jpg';
                            imagejpeg($imagen_redimensionada, $ruta);
                            break;
                        case 3:
                            $ruta = '../../img/perfil/empresa/' . $nombre_archivo . '.png';
                            imagepng($imagen_redimensionada, $ruta);
                            break;
                    }
                    imagedestroy($imagen_original);
                    imagedestroy($imagen_redimensionada);
                }
            }
            break;

        case 'del':
            $objempresa->setVar('id', $_POST['id']);
            echo json_encode($objempresa->deleteDB());
            break;

        case 'get':
            $res = $objempresa->searchDB($_POST['id'], 'id', 1);
            echo json_encode($res[0]);
            break;

        case 'list':
            $res = $objempresa->listDB();
            echo json_encode($res);
            break;

        case 'search':
            $res = $objempresa->searchDB($_POST['data'], $_POST['value'], $_POST['type']);
            echo json_encode($res);
            break;
    }
}?>