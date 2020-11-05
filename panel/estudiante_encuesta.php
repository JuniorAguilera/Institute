<?php
require_once('globales_sistema.php');
if (!isset($_COOKIE['nombre_usuario'])) {
    header('Location: index.php');
}
$titulo_pagina = 'Egresado Encuesta';
$titulo_sistema = 'Seguimiento';
require_once('recursos/componentes/header.php');
?>
</form>
<hr/>
<?php
include_once('nucleo/estudiante_encuesta.php');
$obj = new estudiante_encuesta();
$objs = $obj->listDB();
?>
<table class='table table-bordered table-hover tablesorter display' id='tb'>
    <thead>
        <tr>
            <th>Id</th><th>Estudiante</th><th>Encuesta</th><th>Fecha</th>
            <th>OPC</th>
        </tr>
    </thead>
    <tbody>
        <?php
        if (is_array($objs)):
            foreach ($objs as $o):
                ?>
                <tr><td><?php echo $o['id']; ?></td><td>
                        <?php
                        include_once('nucleo/estudiante.php');
                        $objestudiante = new estudiante();
                        $objestudiante->setVar('id', $o['id_estudiante']);
                        $objestudiante->getDB();
                        echo $objestudiante->getVar($gl_estudiante_encuesta_id_estudiante);
                        ?></td><td>
                        <?php
                        include_once('nucleo/encuesta.php');
                        $objencuesta = new encuesta();
                        $objencuesta->setVar('id', $o['id_encuesta']);
                        $objencuesta->getDB();
                        echo $objencuesta->getVar($gl_estudiante_encuesta_id_encuesta);
                        ?></td><td><?php echo $o['fecha']; ?></td>
                    <td><a href='#' onclick='sel(<?php echo $o['id']; ?>)'>MOD</a> - <a href='#' onclick='del(<?php echo $o['id']; ?>)'>DEL</a></td>
                </tr>
                <?php
            endforeach;
        endif;
        ?>
        <?php
        $nombre_tabla = 'estudiante_encuesta';
        require_once('recursos/componentes/footer.php');
        ?>    
        <!--Inicio Modal-->
    <div id='modal_id_estudiante' class='modal hide fade span9' tabindex='-1' role='dialog' aria-labelledby='myModalLabel' aria-hidden='true' style='left:15% !important;'>
        <div class='modal-header'>
            <button type='button' class='close' data-dismiss='modal' aria-hidden='true'>×</button>
            <h3 id='myModalLabel'>Estudiante</h3>
        </div>
        <div class='modal-body'>
            <table class='table table-striped table-bordered table-highlight' id='tbl_modal_id_estudiante'>
                <thead>
                    <tr><th>Id</th><th>Nombres</th><th>Apellidos</th><th>Telefono Fijo</th><th>Telefono Celular</th><th>Direccion</th><th>Email</th><th>Dni</th><th>Cod Universitario</th><th>Ano Ingreso</th><th>Ano Salida</th><th>Carrera</th><th>Estado Estudiante</th><th>User</th><th>Pass</th><th>Habilitado</th>
                        <th></th>                       
                    </tr>
                </thead>
                <tbody id='data_tbl_modal_id_estudiante'>

                </tbody>
            </table>
        </div>
        <div class='modal-footer'>
            <button class='btn' data-dismiss='modal' aria-hidden='true'>Cerrar</button>
        </div>
    </div>
    <!--Fin Modal-->    
    <!--Inicio Modal-->
    <div id='modal_id_encuesta' class='modal hide fade span9' tabindex='-1' role='dialog' aria-labelledby='myModalLabel' aria-hidden='true' style='left:15% !important;'>
        <div class='modal-header'>
            <button type='button' class='close' data-dismiss='modal' aria-hidden='true'>×</button>
            <h3 id='myModalLabel'>Encuesta</h3>
        </div>
        <div class='modal-body'>
            <table class='table table-striped table-bordered table-highlight' id='tbl_modal_id_encuesta'>
                <thead>
                    <tr><th>Id</th><th>Titulo</th><th>Fecha Limite</th>
                        <th></th>                       
                    </tr>
                </thead>
                <tbody id='data_tbl_modal_id_encuesta'>

                </tbody>
            </table>
        </div>
        <div class='modal-footer'>
            <button class='btn' data-dismiss='modal' aria-hidden='true'>Cerrar</button>
        </div>
    </div>
    <!--Fin Modal-->