<?php
require_once('globales_sistema.php');
if (!isset($_COOKIE['nombre_usuario'])) {
    header('Location: index.php');
}
$titulo_pagina = 'Alternativas Pregunta';
$titulo_sistema = 'Seguimiento';
require_once('recursos/componentes/header.php');
?>
<input type='hidden' id='id' name='id' value='0'/>

<div class='control-group'>
    <label>Pregunta Encuesta</label>
    <label class='form-control' id='txt_id_pregunta_encuesta'>...</label>
    <p class='help-block'><a href='#modal_id_pregunta_encuesta' data-toggle='modal'>Seleccionar</a></p>
    <input type='hidden' name='id_pregunta_encuesta' id='id_pregunta_encuesta' value=''/>
</div>
<div class='control-group'>
    <label>Texto</label>
    <input class='form-control' placeholder='Texto' id='texto' name='texto' />
</div>
<div class='form-actions'>
    <button type='button' class='btn btn-primary btn-large' onclick='save()'>Guardar</button>
    <button type='reset' class='btn-large'>Limpiar</button>
</div>
</form>
<hr/>
<?php
include_once('nucleo/alternativas_pregunta.php');
$obj = new alternativas_pregunta();
$objs = $obj->listDB();
?>
<table class='table table-bordered table-hover tablesorter display' id='tb'>
    <thead>
        <tr>
            <th>Id</th><th>Pregunta Encuesta</th><th>Texto</th>
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
                        include_once('nucleo/pregunta_encuesta.php');
                        $objpregunta_encuesta = new pregunta_encuesta();
                        $objpregunta_encuesta->setVar('id', $o['id_pregunta_encuesta']);
                        $objpregunta_encuesta->getDB();
                        echo $objpregunta_encuesta->getVar($gl_alternativas_pregunta_id_pregunta_encuesta);
                        ?></td><td><?php echo $o['texto']; ?></td>
                    <td><a href='#' onclick='sel(<?php echo $o['id']; ?>)'>MOD</a> - <a href='#' onclick='del(<?php echo $o['id']; ?>)'>DEL</a></td>
                </tr>
                <?php
            endforeach;
        endif;
        ?>
        <?php
        $nombre_tabla = 'alternativas_pregunta';
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
                    <tr><th>Id</th>
                        <th>Enunciado</th>
                        <th>Tipo Pregunta</th>
                        <th>Seccion Encuesta</th>
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