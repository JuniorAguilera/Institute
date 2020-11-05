<?php

if (!isset($_COOKIE['nombre_usuario'])) {
    header('Location: index.php');
}
$titulo_sistema = 'Seguimiento';
require_once('recursos/componentes/nav.php');
?>