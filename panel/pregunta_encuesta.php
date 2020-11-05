<?php
require_once('globales_sistema.php');
if (!isset($_COOKIE['nombre_usuario'])) {
    header('Location: index.php');
}
$titulo_pagina = 'Pregunta Encuesta';
$titulo_sistema = 'Seguimiento';
require_once('recursos/componentes/header.php');
?>
<script>
    $(document).ready(function() {
        sel_id_tipo_pregunta(1);
    });
</script>
<input type='hidden' id='id' name='id' value='0'/>

<div class='control-group'>
    <label>Enunciado</label>
    <input class='form-control' placeholder='Enunciado' id='enunciado' name='enunciado' />
</div>
<div class='control-group'>
    <label>Tipo Pregunta</label>
    <label class='form-control' id='txt_id_tipo_pregunta'>...</label>
    <p class='help-block'><a href='#modal_id_tipo_pregunta' data-toggle='modal'>Seleccionar</a></p>
    <input type='hidden' name='id_tipo_pregunta' id='id_tipo_pregunta' value=''/>
</div>
<div class='control-group'>
    <label>Seccion Encuesta</label>
    <label class='form-control' id='txt_id_seccion_encuesta'>...</label>
    <p class='help-block'><a href='#modal_id_seccion_encuesta' data-toggle='modal'>Seleccionar</a></p>
    <input type='hidden' name='id_seccion_encuesta' id='id_seccion_encuesta' value=''/>
</div>
<div id="t3" style="display:none;">
<div class='control-group'>
    <label>Pregunta a Desactivar(1)</label>
    <label class='form-control' id='txt_id_pregunta_encuesta'>...</label>
    <p class='help-block'><a href='#modal_id_pregunta_encuesta' data-toggle='modal'>Seleccionar</a></p>
    <input type='hidden' name='id_pregunta_encuesta' id='id_pregunta_encuesta' value=''/>
</div>
<div class='control-group'>
    <label>Pregunta a Desactivar(2)</label>
    <label class='form-control' id='txt_id_pregunta_encuesta1'>...</label>
    <p class='help-block'><a href='#modal_id_pregunta_encuesta1' data-toggle='modal'>Seleccionar</a></p>
    <input type='hidden' name='id_pregunta_encuesta1' id='id_pregunta_encuesta1' value=''/>
</div>
<div class='control-group'>
    <label>Pregunta a Desactivar(3)</label>
    <label class='form-control' id='txt_id_pregunta_encuesta2'>...</label>
    <p class='help-block'><a href='#modal_id_pregunta_encuesta2' data-toggle='modal'>Seleccionar</a></p>
    <input type='hidden' name='id_pregunta_encuesta2' id='id_pregunta_encuesta2' value=''/>
</div>
<div class='control-group'>
    <label>Pregunta a Desactivar(4)</label>
    <label class='form-control' id='txt_id_pregunta_encuesta3'>...</label>
    <p class='help-block'><a href='#modal_id_pregunta_encuesta3' data-toggle='modal'>Seleccionar</a></p>
    <input type='hidden' name='id_pregunta_encuesta3' id='id_pregunta_encuesta3' value=''/>
</div>
</div>
<div class='form-actions'>
    <button type='button' class='btn btn-primary btn-large' onclick='save()'>Guardar</button>
    <button type='reset' class='btn-large'>Limpiar</button>
</div>
</form>
<hr/>
<?php
include_once('nucleo/pregunta_encuesta.php');
$obj = new pregunta_encuesta();
$objs = $obj->listDB();
?>
<table class='table table-bordered table-hover tablesorter display' id='tb'>
    <thead>
        <tr>
            <th>Id</th>
            <th>Enunciado</th>
            <th>Tipo Pregunta</th>
            <th>Seccion Encuesta</th>
            <th>Desct 1</th>
            <th>Desct 2</th>
            <th>Desct 3</th>
            <th>Desct 4</th>
            <th>OPC</th>
        </tr>
    </thead>
    <tbody>
        <?php
        if (is_array($objs)):
            foreach ($objs as $o):
                ?>
                <tr><td><?php echo $o['id']; ?></td><td><?php echo $o['enunciado']; ?></td><td>
                        <?php
                        include_once('nucleo/tipo_pregunta.php');
                        $objtipo_pregunta = new tipo_pregunta();
                        $objtipo_pregunta->setVar('id', $o['id_tipo_pregunta']);
                        $objtipo_pregunta->getDB();
                        echo $objtipo_pregunta->getVar($gl_pregunta_encuesta_id_tipo_pregunta);
                        ?></td><td>
                        <?php
                        include_once('nucleo/seccion_encuesta.php');
                        $objseccion_encuesta = new seccion_encuesta();
                        $objseccion_encuesta->setVar('id', $o['id_seccion_encuesta']);
                        $objseccion_encuesta->getDB();
                        echo $objseccion_encuesta->getVar($gl_pregunta_encuesta_id_seccion_encuesta);
                        ?></td>
                        <td><?php
                        include_once('nucleo/pregunta_encuesta.php');
                        $objpregunta_encuesta = new pregunta_encuesta();
                        $objpregunta_encuesta->setVar('id', $o['id_pregunta_encuesta']);
                        $objpregunta_encuesta->getDB();
                        echo $objpregunta_encuesta->getVar($gl_pregunta_encuesta_id_pregunta_encuesta);
                        ?></td>
                        <td><?php
                        include_once('nucleo/pregunta_encuesta.php');
                        $objpregunta_encuesta1 = new pregunta_encuesta();
                        $objpregunta_encuesta1->setVar('id', $o['id_pregunta_encuesta_1']);
                        $objpregunta_encuesta1->getDB();
                        echo $objpregunta_encuesta1->getVar($gl_pregunta_encuesta_id_pregunta_encuesta);
                        ?></td>
                        <td><?php
                        include_once('nucleo/pregunta_encuesta.php');
                        $objpregunta_encuesta2 = new pregunta_encuesta();
                        $objpregunta_encuesta2->setVar('id', $o['id_pregunta_encuesta_2']);
                        $objpregunta_encuesta2->getDB();
                        echo $objpregunta_encuesta2->getVar($gl_pregunta_encuesta_id_pregunta_encuesta);
                        ?></td>
                        <td><?php
                        include_once('nucleo/pregunta_encuesta.php');
                        $objpregunta_encuesta3 = new pregunta_encuesta();
                        $objpregunta_encuesta3->setVar('id', $o['id_pregunta_encuesta_3']);
                        $objpregunta_encuesta3->getDB();
                        echo $objpregunta_encuesta3->getVar($gl_pregunta_encuesta_id_pregunta_encuesta);
                        ?></td>
                    <td><a href='#' onclick='sel(<?php echo $o['id']; ?>)'>MOD</a> - <a href='#' onclick='del(<?php echo $o['id']; ?>)'>DEL</a></td>
                </tr>
                <?php
            endforeach;
        endif;
        ?>
        <?php
        $nombre_tabla = 'pregunta_encuesta';
        require_once('recursos/componentes/footer.php');
        ?>    
        <!--Inicio Modal-->
    <div id='modal_id_tipo_pregunta' class='modal hide fade span9' tabindex='-1' role='dialog' aria-labelledby='myModalLabel' aria-hidden='true' style='left:15% !important;'>
        <div class='modal-header'>
            <button type='button' class='close' data-dismiss='modal' aria-hidden='true'>×</button>
            <h3 id='myModalLabel'>Tipo Pregunta</h3>
        </div>
        <div class='modal-body'>
            <table class='table table-striped table-bordered table-highlight' id='tbl_modal_id_tipo_pregunta'>
                <thead>
                    <tr><th>Id</th><th>Nombre</th>
                        <th></th>                       
                    </tr>
                </thead>
                <tbody id='data_tbl_modal_id_tipo_pregunta'>

                </tbody>
            </table>
        </div>
        <div class='modal-footer'>
            <button class='btn' data-dismiss='modal' aria-hidden='true'>Cerrar</button>
        </div>
    </div>
    <!--Fin Modal-->    
    <!--Inicio Modal-->
    <div id='modal_id_seccion_encuesta' class='modal hide fade span9' tabindex='-1' role='dialog' aria-labelledby='myModalLabel' aria-hidden='true' style='left:15% !important;'>
        <div class='modal-header'>
            <button type='button' class='close' data-dismiss='modal' aria-hidden='true'>×</button>
            <h3 id='myModalLabel'>Seccion Encuesta</h3>
        </div>
        <div class='modal-body'>
            <table class='table table-striped table-bordered table-highlight' id='tbl_modal_id_seccion_encuesta'>
                <thead>
                    <tr><th>Id</th><th>Titulo</th><th>Encuesta</th>
                        <th></th>                       
                    </tr>
                </thead>
                <tbody id='data_tbl_modal_id_seccion_encuesta'>

                </tbody>
            </table>
        </div>
        <div class='modal-footer'>
            <button class='btn' data-dismiss='modal' aria-hidden='true'>Cerrar</button>
        </div>
    </div>
    <!--Fin Modal-->    
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
    <!--Inicio Modal-->
    <div id='modal_id_pregunta_encuesta1' class='modal hide fade span9' tabindex='-1' role='dialog' aria-labelledby='myModalLabel' aria-hidden='true' style='left:15% !important;'>
    <div class='modal-header'>
        <button type='button' class='close' data-dismiss='modal' aria-hidden='true'>×</button>
        <h3 id='myModalLabel'>Pregunta Encuesta</h3>
    </div>
    <div class='modal-body'>
        <table class='table table-striped table-bordered table-highlight' id='tbl_modal_id_pregunta_encuesta1'>
            <thead>
                <tr><th>Id</th>
                    <th>Enunciado</th>
                    <th>Tipo Pregunta</th>
                    <th>Seccion Encuesta</th>
                    <th></th>                       
                </tr>
            </thead>
            <tbody id='data_tbl_modal_id_pregunta_encuesta1'>

            </tbody>
        </table>
    </div>
    <div class='modal-footer'>
        <button class='btn' data-dismiss='modal' aria-hidden='true'>Cerrar</button>
    </div>
    </div>
    <!--Fin Modal-->
    <!--Inicio Modal-->
    <div id='modal_id_pregunta_encuesta1' class='modal hide fade span9' tabindex='-1' role='dialog' aria-labelledby='myModalLabel' aria-hidden='true' style='left:15% !important;'>
    <div class='modal-header'>
        <button type='button' class='close' data-dismiss='modal' aria-hidden='true'>×</button>
        <h3 id='myModalLabel'>Pregunta Encuesta</h3>
    </div>
    <div class='modal-body'>
        <table class='table table-striped table-bordered table-highlight' id='tbl_modal_id_pregunta_encuesta2'>
            <thead>
                <tr><th>Id</th>
                    <th>Enunciado</th>
                    <th>Tipo Pregunta</th>
                    <th>Seccion Encuesta</th>
                    <th></th>                       
                </tr>
            </thead>
            <tbody id='data_tbl_modal_id_pregunta_encuesta2'>

            </tbody>
        </table>
    </div>
    <div class='modal-footer'>
        <button class='btn' data-dismiss='modal' aria-hidden='true'>Cerrar</button>
    </div>
    </div>
    <!--Fin Modal-->
    <!--Inicio Modal-->
    <div id='modal_id_pregunta_encuesta3' class='modal hide fade span9' tabindex='-1' role='dialog' aria-labelledby='myModalLabel' aria-hidden='true' style='left:15% !important;'>
    <div class='modal-header'>
    <button type='button' class='close' data-dismiss='modal' aria-hidden='true'>×</button>
    <h3 id='myModalLabel'>Pregunta Encuesta</h3>
    </div>
    <div class='modal-body'>
    <table class='table table-striped table-bordered table-highlight' id='tbl_modal_id_pregunta_encuesta3'>
        <thead>
            <tr><th>Id</th>
                <th>Enunciado</th>
                <th>Tipo Pregunta</th>
                <th>Seccion Encuesta</th>
                <th></th>                       
            </tr>
        </thead>
        <tbody id='data_tbl_modal_id_pregunta_encuesta3'>

        </tbody>
    </table>
    </div>
    <div class='modal-footer'>
    <button class='btn' data-dismiss='modal' aria-hidden='true'>Cerrar</button>
    </div>
    </div>
    <!--Fin Modal-->