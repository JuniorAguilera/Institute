<?php
require_once('globales_sistema.php');
if (!isset($_COOKIE['nombre_usuario'])) {
    header('Location: index.php');
}
$titulo_pagina = 'Oferta Laboral';
$titulo_sistema = 'Seguimiento';
require_once('recursos/componentes/header.php');
?>
<input type='hidden' id='id' name='id' value='0'/>

<div class='control-group'>
    <label>Vacantes</label>
    <input class='form-control' placeholder='00' id='vacantes' name='vacantes' />
</div>
<div class='control-group'>
    <label>Titulo</label>
    <input class='form-control' placeholder='Titulo' id='titulo' name='titulo' />
</div>
<div class='control-group'>
    <label>Descripcion</label>
    <textarea class='form-control' rows='3' id='descripcion' name='descripcion' ></textarea>   
</div>
<div class='control-group'>
    <label>Lugar</label>
    <input class='form-control' placeholder='Lugar' id='lugar' name='lugar' />
</div>
<div class='control-group'>
    <label>Experiencia</label>
    <input class='form-control' placeholder='00' id='experiencia' name='experiencia' />
</div>
<div class='control-group'>
    <label>Tipo Oferta Laboral</label>
    <label class='form-control' id='txt_id_tipo_oferta_laboral'>...</label>
    <p class='help-block'><a href='#modal_id_tipo_oferta_laboral' data-toggle='modal'>Seleccionar</a></p>
    <input type='hidden' name='id_tipo_oferta_laboral' id='id_tipo_oferta_laboral' value=''/>
</div>
<div class='control-group'>
    <label>Empresa</label>
    <label class='form-control' id='txt_id_empresa'>...</label>
    <p class='help-block'><a href='#modal_id_empresa' data-toggle='modal'>Seleccionar</a></p>
    <input type='hidden' name='id_empresa' id='id_empresa' value=''/>
</div>
<div class='control-group'>
    <label>Fecha</label>
    <input class='form-control' placeholder='AAAA-MM-DD' id='fecha' name='fecha' />
</div>
<div class='form-actions'>
    <button type='button' class='btn btn-primary btn-large' onclick='save()'>Guardar</button>
    <button type='reset' class='btn-large'>Limpiar</button>
</div>
</form>
<hr/>
<?php
include_once('nucleo/oferta_laboral.php');
$obj = new oferta_laboral();
$objs = $obj->listDB();
?>
<table class='table table-bordered table-hover tablesorter display' id='tb'>
    <thead>
        <tr>
            <th>Id</th><th>Vacantes</th><th>Titulo</th><th>Descripcion</th><th>Lugar</th><th>Experiencia</th><th>Tipo Oferta Laboral</th><th>Empresa</th><th>Fecha</th>
            <th>OPC</th>
        </tr>
    </thead>
    <tbody>
        <?php
        if (is_array($objs)):
            foreach ($objs as $o):
                ?>
                <tr><td><?php echo $o['id']; ?></td><td><?php echo $o['vacantes']; ?></td><td><?php echo $o['titulo']; ?></td><td><?php echo $o['descripcion']; ?></td><td><?php echo $o['lugar']; ?></td><td><?php echo $o['experiencia']; ?></td><td>
                        <?php
                        include_once('nucleo/tipo_oferta_laboral.php');
                        $objtipo_oferta_laboral = new tipo_oferta_laboral();
                        $objtipo_oferta_laboral->setVar('id', $o['id_tipo_oferta_laboral']);
                        $objtipo_oferta_laboral->getDB();
                        echo $objtipo_oferta_laboral->getVar($gl_oferta_laboral_id_tipo_oferta_laboral);
                        ?></td><td>
                        <?php
                        include_once('nucleo/empresa.php');
                        $objempresa = new empresa();
                        $objempresa->setVar('id', $o['id_empresa']);
                        $objempresa->getDB();
                        echo $objempresa->getVar($gl_oferta_laboral_id_empresa);
                        ?></td><td><?php echo $o['fecha']; ?></td>
                    <td><a href='#' onclick='sel(<?php echo $o['id']; ?>)'>MOD</a> - <a href='#' onclick='del(<?php echo $o['id']; ?>)'>DEL</a></td>
                </tr>
                <?php
            endforeach;
        endif;
        ?>
        <?php
        $nombre_tabla = 'oferta_laboral';
        require_once('recursos/componentes/footer.php');
        ?>    
        <!--Inicio Modal-->
    <div id='modal_id_tipo_oferta_laboral' class='modal hide fade span9' tabindex='-1' role='dialog' aria-labelledby='myModalLabel' aria-hidden='true' style='left:15% !important;'>
        <div class='modal-header'>
            <button type='button' class='close' data-dismiss='modal' aria-hidden='true'>×</button>
            <h3 id='myModalLabel'>Tipo Oferta Laboral</h3>
        </div>
        <div class='modal-body'>
            <table class='table table-striped table-bordered table-highlight' id='tbl_modal_id_tipo_oferta_laboral'>
                <thead>
                    <tr><th>Id</th><th>Nombre</th>
                        <th></th>                       
                    </tr>
                </thead>
                <tbody id='data_tbl_modal_id_tipo_oferta_laboral'>

                </tbody>
            </table>
        </div>
        <div class='modal-footer'>
            <button class='btn' data-dismiss='modal' aria-hidden='true'>Cerrar</button>
        </div>
    </div>
    <!--Fin Modal-->    
    <!--Inicio Modal-->
    <div id='modal_id_empresa' class='modal hide fade span9' tabindex='-1' role='dialog' aria-labelledby='myModalLabel' aria-hidden='true' style='left:15% !important;'>
        <div class='modal-header'>
            <button type='button' class='close' data-dismiss='modal' aria-hidden='true'>×</button>
            <h3 id='myModalLabel'>Empresa</h3>
        </div>
        <div class='modal-body'>
            <table class='table table-striped table-bordered table-highlight' id='tbl_modal_id_empresa'>
                <thead>
                    <tr><th>Id</th><th>Razon Social</th><th>Ruc</th><th>Direccion</th><th>Telefono</th><th>Correo</th>
                        <th></th>                       
                    </tr>
                </thead>
                <tbody id='data_tbl_modal_id_empresa'>

                </tbody>
            </table>
        </div>
        <div class='modal-footer'>
            <button class='btn' data-dismiss='modal' aria-hidden='true'>Cerrar</button>
        </div>
    </div>
    <!--Fin Modal-->