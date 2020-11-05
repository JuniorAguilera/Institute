<?php
require_once('globales_sistema.php');
if (!isset($_COOKIE['nombre_usuario'])) {
    header('Location: index.php');
}
$titulo_pagina = 'Habilidad Egresado';
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
    <label>Habilidad</label>
    <input class='form-control' placeholder='Habilidad' id='habilidad' name='habilidad' />
</div>
<div class='control-group'>
    <label>Nivel</label>
    <input class='form-control' placeholder='00' id='nivel' name='nivel' />
</div>
<div class='form-actions'>
    <button type='button' class='btn btn-primary btn-large' onclick='save()'>Guardar</button>
    <button type='reset' class='btn-large'>Limpiar</button>
</div>
</form>
<hr/>
<?php
include_once('nucleo/habilidad_estudiante.php');
$obj = new habilidad_estudiante();
$objs = $obj->listDB();
?>
<table class='table table-bordered table-hover tablesorter display' id='tb'>
    <thead>
        <tr>
            <th>Id</th><th>Estudiante</th><th>Habilidad</th><th>Nivel</th>
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
                        echo $objestudiante->getVar($gl_habilidad_estudiante_id_estudiante);
                        ?></td><td><?php echo $o['habilidad']; ?></td><td><?php echo $o['nivel']; ?></td>
                    <td><a href='#' onclick='sel(<?php echo $o['id']; ?>)'>MOD</a> - <a href='#' onclick='del(<?php echo $o['id']; ?>)'>DEL</a></td>
                </tr>
                <?php
            endforeach;
        endif;
        ?>
        <?php
        $nombre_tabla = 'habilidad_estudiante';
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