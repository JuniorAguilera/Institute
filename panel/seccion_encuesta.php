<?php
require_once('globales_sistema.php');
if (!isset($_COOKIE['nombre_usuario'])) {
    header('Location: index.php');
}
$titulo_pagina = 'Seccion Encuesta';
$titulo_sistema = 'Seguimiento';
require_once('recursos/componentes/header.php');
?>
<input type='hidden' id='id' name='id' value='0'/>

<div class='control-group'>
    <label>Titulo</label>
    <input class='form-control' placeholder='Titulo' id='titulo' name='titulo' />
</div>
<div class='control-group'>
    <label>Encuesta</label>
    <label class='form-control' id='txt_id_encuesta'>...</label>
    <p class='help-block'><a href='#modal_id_encuesta' data-toggle='modal'>Seleccionar</a></p>
    <input type='hidden' name='id_encuesta' id='id_encuesta' value=''/>
</div>
<div class='form-actions'>
    <button type='button' class='btn btn-primary btn-large' onclick='save()'>Guardar</button>
    <button type='reset' class='btn-large'>Limpiar</button>
</div>
</form>
<hr/>
<?php
include_once('nucleo/seccion_encuesta.php');
$obj = new seccion_encuesta();
$objs = $obj->listDB();
?>
<table class='table table-bordered table-hover tablesorter display' id='tb'>
    <thead>
        <tr>
            <th>Id</th><th>Titulo</th><th>Encuesta</th>
            <th>OPC</th>
        </tr>
    </thead>
    <tbody>
        <?php
        if (is_array($objs)):
            foreach ($objs as $o):
                ?>
                <tr><td><?php echo $o['id']; ?></td><td><?php echo $o['titulo']; ?></td><td>
                        <?php
                        include_once('nucleo/encuesta.php');
                        $objencuesta = new encuesta();
                        $objencuesta->setVar('id', $o['id_encuesta']);
                        $objencuesta->getDB();
                        echo $objencuesta->getVar($gl_seccion_encuesta_id_encuesta);
                        ?></td>
                    <td><a href='#' onclick='sel(<?php echo $o['id']; ?>)'>MOD</a> - <a href='#' onclick='del(<?php echo $o['id']; ?>)'>DEL</a></td>
                </tr>
                <?php
            endforeach;
        endif;
        ?>
        <?php
        $nombre_tabla = 'seccion_encuesta';
        require_once('recursos/componentes/footer.php');
        ?>    
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