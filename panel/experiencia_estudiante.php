<?php
require_once('globales_sistema.php');
if (!isset($_COOKIE['nombre_usuario'])) {
    header('Location: index.php');
}
$titulo_pagina = 'Experiencia Egresado';
$titulo_sistema = 'Seguimiento';
require_once('recursos/componentes/header.php');
?>
<input type='hidden' id='id' name='id' value='0'/>

<div class='control-group'>
    <label>Estudiante</label>
    <label class='form-control' id='txt_id_estudiante'>...</label>
    <p class='help-block'><a href='#modal_id_estudiante' data-toggle='modal'>Seleccionar</a></p>
    <input type='hidden' name='id_estudiante' id='id_estudiante' value=''/>
</div>
<div class='control-group'>
    <label>Lugar</label>
    <input class='form-control' placeholder='Lugar' id='lugar' name='lugar' />
</div>
<div class='control-group'>
    <label>Descripcion</label>
    <input class='form-control' placeholder='Descripcion' id='descripcion' name='descripcion' />
</div>
<div class='control-group'>
    <label>Ano Ingreso</label>
    <input class='form-control' placeholder='00' id='ano_ingreso' name='ano_ingreso' />
</div>
<div class='control-group'>
    <label>Ano Salida</label>
    <input class='form-control' placeholder='00' id='ano_salida' name='ano_salida' required/>
</div>
<div class='control-group'>
    <label>Tipo Experiencia</label>
    <label class='form-control' id='txt_id_tipo_experiencia'>...</label>
    <p class='help-block'><a href='#modal_id_tipo_experiencia' data-toggle='modal'>Seleccionar</a></p>
    <input type='hidden' name='id_tipo_experiencia' id='id_tipo_experiencia' value=''/>
</div>
<div class='form-actions'>
    <button type='button' class='btn btn-primary btn-large' onclick='save()'>Guardar</button>
    <button type='reset' class='btn-large'>Limpiar</button>
</div>
</form>
<hr/>
<?php
include_once('nucleo/experiencia_estudiante.php');
$obj = new experiencia_estudiante();
$objs = $obj->listDB();
?>
<table class='table table-bordered table-hover tablesorter display' id='tb'>
    <thead>
        <tr>
            <th>Id</th><th>Estudiante</th><th>Lugar</th><th>Descripcion</th><th>Ano Ingreso</th><th>Ano Salida</th><th>Tipo Experiencia</th>
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
                        echo $objestudiante->getVar($gl_experiencia_estudiante_id_estudiante);
                        ?></td><td><?php echo $o['lugar']; ?></td><td><?php echo $o['descripcion']; ?></td><td><?php echo $o['ano_ingreso']; ?></td><td><?php echo $o['ano_salida']; ?></td><td>
                        <?php
                        include_once('nucleo/tipo_experiencia.php');
                        $objtipo_experiencia = new tipo_experiencia();
                        $objtipo_experiencia->setVar('id', $o['id_tipo_experiencia']);
                        $objtipo_experiencia->getDB();
                        echo $objtipo_experiencia->getVar($gl_experiencia_estudiante_id_tipo_experiencia);
                        ?></td>
                    <td><a href='#' onclick='sel(<?php echo $o['id']; ?>)'>MOD</a> - <a href='#' onclick='del(<?php echo $o['id']; ?>)'>DEL</a></td>
                </tr>
                <?php
            endforeach;
        endif;
        ?>
        <?php
        $nombre_tabla = 'experiencia_estudiante';
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
    <div id='modal_id_tipo_experiencia' class='modal hide fade span9' tabindex='-1' role='dialog' aria-labelledby='myModalLabel' aria-hidden='true' style='left:15% !important;'>
        <div class='modal-header'>
            <button type='button' class='close' data-dismiss='modal' aria-hidden='true'>×</button>
            <h3 id='myModalLabel'>Tipo Experiencia</h3>
        </div>
        <div class='modal-body'>
            <table class='table table-striped table-bordered table-highlight' id='tbl_modal_id_tipo_experiencia'>
                <thead>
                    <tr><th>Id</th><th>Nombre</th>
                        <th></th>                       
                    </tr>
                </thead>
                <tbody id='data_tbl_modal_id_tipo_experiencia'>

                </tbody>
            </table>
        </div>
        <div class='modal-footer'>
            <button class='btn' data-dismiss='modal' aria-hidden='true'>Cerrar</button>
        </div>
    </div>
    <!--Fin Modal-->