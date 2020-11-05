<?php
require_once('globales_sistema.php');
if (!isset($_COOKIE['nombre_usuario'])) {
    header('Location: index.php');
}
$titulo_pagina = 'Habilidad Oferta Laboral';
$titulo_sistema = 'Seguimiento';
require_once('recursos/componentes/header.php');
?>
<input type='hidden' id='id' name='id' value='0'/>

<div class='control-group'>
    <label>Nombre</label>
    <input class='form-control' placeholder='Nombre' id='nombre' name='nombre' />
</div>
<div class='control-group'>
    <label>Nivel</label>
    <input class='form-control' placeholder='00' id='nivel' name='nivel' />
</div>
<div class='control-group'>
    <label>Oferta Laboral</label>
    <label class='form-control' id='txt_id_oferta_laboral'>...</label>
    <p class='help-block'><a href='#modal_id_oferta_laboral' data-toggle='modal'>Seleccionar</a></p>
    <input type='hidden' name='id_oferta_laboral' id='id_oferta_laboral' value=''/>
</div>
<div class='form-actions'>
    <button type='button' class='btn btn-primary btn-large' onclick='save()'>Guardar</button>
    <button type='reset' class='btn-large'>Limpiar</button>
</div>
</form>
<hr/>
<?php
include_once('nucleo/habilidad_oferta_laboral.php');
$obj = new habilidad_oferta_laboral();
$objs = $obj->listDB();
?>
<table class='table table-bordered table-hover tablesorter display' id='tb'>
    <thead>
        <tr>
            <th>Id</th><th>Nombre</th><th>Nivel</th><th>Oferta Laboral</th>
            <th>OPC</th>
        </tr>
    </thead>
    <tbody>
        <?php
        if (is_array($objs)):
            foreach ($objs as $o):
                ?>
                <tr><td><?php echo $o['id']; ?></td><td><?php echo $o['nombre']; ?></td><td><?php echo $o['nivel']; ?></td><td>
                        <?php
                        include_once('nucleo/oferta_laboral.php');
                        $objoferta_laboral = new oferta_laboral();
                        $objoferta_laboral->setVar('id', $o['id_oferta_laboral']);
                        $objoferta_laboral->getDB();
                        echo $objoferta_laboral->getVar($gl_habilidad_oferta_laboral_id_oferta_laboral);
                        ?></td>
                    <td><a href='#' onclick='sel(<?php echo $o['id']; ?>)'>MOD</a> - <a href='#' onclick='del(<?php echo $o['id']; ?>)'>DEL</a></td>
                </tr>
                <?php
            endforeach;
        endif;
        ?>
        <?php
        $nombre_tabla = 'habilidad_oferta_laboral';
        require_once('recursos/componentes/footer.php');
        ?>    
        <!--Inicio Modal-->
    <div id='modal_id_oferta_laboral' class='modal hide fade span9' tabindex='-1' role='dialog' aria-labelledby='myModalLabel' aria-hidden='true' style='left:15% !important;'>
        <div class='modal-header'>
            <button type='button' class='close' data-dismiss='modal' aria-hidden='true'>×</button>
            <h3 id='myModalLabel'>Oferta Laboral</h3>
        </div>
        <div class='modal-body'>
            <table class='table table-striped table-bordered table-highlight' id='tbl_modal_id_oferta_laboral'>
                <thead>
                    <tr><th>Id</th><th>Vacantes</th><th>Titulo</th><th>Descripcion</th><th>Lugar</th><th>Experiencia</th><th>Tipo Oferta Laboral</th><th>Empresa</th><th>Fecha</th>
                        <th></th>                       
                    </tr>
                </thead>
                <tbody id='data_tbl_modal_id_oferta_laboral'>

                </tbody>
            </table>
        </div>
        <div class='modal-footer'>
            <button class='btn' data-dismiss='modal' aria-hidden='true'>Cerrar</button>
        </div>
    </div>
    <!--Fin Modal-->