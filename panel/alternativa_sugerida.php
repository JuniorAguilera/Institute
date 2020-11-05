<?php
require_once('globales_sistema.php');
if (!isset($_COOKIE['nombre_usuario'])) {
    header('Location: index.php');
}
$titulo_pagina = 'Alternativa Sugerida';
$titulo_sistema = 'Seguimiento';
require_once('recursos/componentes/header.php');
?>
<input type='hidden' id='id' name='id' value='0'/>
</form>
<hr/>
<?php
include_once('nucleo/alternativa_sugerida.php');
$obj = new alternativa_sugerida();
$objs = $obj->listDB();

include_once('nucleo/pregunta_encuesta.php');

include_once('nucleo/estudiante.php');
?>
<table class='table table-bordered table-hover tablesorter display' id='tb'>
    <thead>
        <tr>
            <th>Id</th>
            <th>Pregunta Encuesta</th>
            <th>Texto</th>
            <th>Estudiante</th>
            <th>Fecha</th>
            <th>OPC</th>
        </tr>
    </thead>
    <tbody>
        <?php
        if (is_array($objs)):
            foreach ($objs as $o):
                ?>
                <tr><td><?php echo $o['id']; ?></td>
                <td>
                        <?php
                        $objpregunta_encuesta = new pregunta_encuesta();
                        $objpregunta_encuesta->setVar('id', $o['id_pregunta_encuesta']);
                        $objpregunta_encuesta->getDB();
                        echo $objpregunta_encuesta->getVar($gl_alternativa_sugerida_id_pregunta_encuesta);
                        ?></td>
                <td><?php echo $o['texto']; ?></td>
                <td>
                        <?php
                        $objestudiante = new estudiante();
                        $objestudiante->setVar('id', $o['id_estudiante']);
                        $objestudiante->getDB();
                        echo $objestudiante->getVar($gl_alternativa_sugerida_id_estudiante);
                        ?></td>
                <td><?php echo $o['fecha']; ?></td>
                <td><a href='#' onclick='del(<?php echo $o['id']; ?>)'>DEL</a></td>
                </tr>
                <?php
            endforeach;
        endif;
        ?>
        <?php
        $nombre_tabla = 'alternativa_sugerida';
        require_once('recursos/componentes/footer.php');
        ?>    
        <!--Inicio Modal-->
    <div id='modal_id_pregunta_encuesta' class='modal hide fade span9' tabindex='-1' role='dialog' aria-labelledby='myModalLabel' aria-hidden='true' style='left:15% !important;'>
        <div class='modal-header'>
            <button type='button' class='close' data-dismiss='modal' aria-hidden='true'>×</button>
            <h3 id='myModalLabel'>Pregunta Encuesta</h3>
        </div>
        <div class='modal-body'>
            <table class='table table-striped table-bordered table-highlight' id='tbl_modal_id_pregunta_encuesta'>
                <thead>
                    <tr><th>Id</th><th>Enunciado</th><th>Tipo Pregunta</th><th>Seccion Encuesta</th><th>Pregunta Encuesta</th>
                        <th></th>                       
                    </tr>
                </thead>
                <tbody id='data_tbl_modal_id_pregunta_encuesta'>

                </tbody>
            </table>
        </div>
        <div class='modal-footer'>
            <button class='btn' data-dismiss='modal' aria-hidden='true'>Cerrar</button>
        </div>
    </div>
    <!--Fin Modal-->    
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