<?php
require_once('globales_sistema.php');
if (!isset($_COOKIE['nombre_usuario'])) {
    header('Location: index.php');
}
$titulo_pagina = 'Egresado';
$titulo_sistema = 'Seguimiento';
require_once('recursos/componentes/header.php');
?>
<input type='hidden' id='id' name='id' value='0'/>

<div class='control-group'>
    <label>Nombres</label>
    <input class='form-control' placeholder='Nombres' id='nombres' name='nombres' />
</div>
<div class='control-group'>
    <label>Apellidos</label>
    <input class='form-control' placeholder='Apellidos' id='apellidos' name='apellidos' />
</div>
<div class='control-group'>
    <label>Telefono Fijo</label>
    <input type="number" min="0" max="999999999" class='form-control' id='telefono_fijo' name='telefono_fijo' />
</div>
<div class='control-group'>
    <label>Telefono Celular</label>
    <input type="number" min="0" max="999999999" class='form-control' id='telefono_celular' name='telefono_celular' />
</div>
<div class='control-group'>
    <label>Direccion</label>
    <input class='form-control' placeholder='Direccion' id='direccion' name='direccion' />
</div>
<div class='control-group'>
    <label>Email</label>
    <input type="email" class='form-control' placeholder='Email' id='email' name='email' />
</div>
<div class='control-group'>
    <label>Dni</label>
    <input type="number" min="0" max="99999999" class='form-control' id='dni' name='dni' />
</div>
<div class='control-group'>
    <label>Ano Ingreso</label>
    <input type="number" min="0" max="9999" class='form-control' id='ano_ingreso' name='ano_ingreso' />
</div>
<div class='control-group'>
    <label>Ano Salida</label>
    <input type="number" min="0" max="9999" class='form-control' id='ano_salida' name='ano_salida' required/>
</div>
<div class='control-group'>
    <label>Carrera</label>
    <label class='form-control' id='txt_id_carrera'>...</label>
    <p class='help-block'><a href='#modal_id_carrera' data-toggle='modal'>Seleccionar</a></p>
    <input type='hidden' name='id_carrera' id='id_carrera' value=''/>
</div>
<div class='control-group'>
    <label>Estado Estudiante</label>
    <label class='form-control' id='txt_id_estado_estudiante'>...</label>
    <p class='help-block'><a href='#modal_id_estado_estudiante' data-toggle='modal'>Seleccionar</a></p>
    <input type='hidden' name='id_estado_estudiante' id='id_estado_estudiante' value=''/>
</div>
<div class='control-group'>
    <label>User</label>
    <input class='form-control' placeholder='User' id='user' name='user' />
</div>
<div class='control-group'>
    <label>Pass</label>
    <input class='form-control' placeholder='Pass' id='pass' name='pass' />
</div>
<div class='control-group'>
    <label>Habilitado</label>
    <select class='form-control' id='habilitado' name='habilitado' >
        <option value='1'>Habilitado</option>
        <option value='0'>Inhabilitado</option>
    </select>
</div>
<div class='form-actions'>
    <button type='button' class='btn btn-primary btn-large' onclick='save()'>Guardar</button>
    <button type='reset' class='btn-large'>Limpiar</button>
</div>
</form>
<hr/>
<?php
include_once('nucleo/estudiante.php');
$obj = new estudiante();
$objs = $obj->listDB();
?>
<table class='table table-bordered table-hover tablesorter display' id='tb'>
    <thead>
        <tr>
            <th>Id</th>
            <th>Nombres</th>
            <th>Apellidos</th>
            <th>Telefono Fijo</th>
            <th>Telefono Celular</th>
            <th>Direccion</th>
            <th>Email</th>
            <th>Dni</th>
            <th>Ano Ingreso</th>
            <th>Ano Salida</th>
            <th>Carrera</th>
            <th>Estado Estudiante</th>
            <th>Habilitado</th>
            <th>OPC</th>
        </tr>
    </thead>
    <tbody>
        <?php
        if (is_array($objs)):
            foreach ($objs as $o):
                ?>
                <tr>
                    <td><?php echo $o['id']; ?></td>
                    <td><?php echo $o['nombres']; ?></td>
                    <td><?php echo $o['apellidos']; ?></td>
                    <td><?php echo $o['telefono_fijo']; ?></td>
                    <td><?php echo $o['telefono_celular']; ?></td>
                    <td><?php echo $o['direccion']; ?></td>
                    <td><?php echo $o['email']; ?></td>
                    <td><?php echo $o['dni']; ?></td>
                    <td><?php echo $o['ano_ingreso']; ?></td>
                    <td><?php echo $o['ano_salida']; ?></td><td>
                        <?php
                        include_once('nucleo/carrera.php');
                        $objcarrera = new carrera();
                        $objcarrera->setVar('id', $o['id_carrera']);
                        $objcarrera->getDB();
                        echo $objcarrera->getVar($gl_estudiante_id_carrera);
                        ?></td><td>
                        <?php
                        include_once('nucleo/estado_estudiante.php');
                        $objestado_estudiante = new estado_estudiante();
                        $objestado_estudiante->setVar('id', $o['id_estado_estudiante']);
                        $objestado_estudiante->getDB();
                        echo $objestado_estudiante->getVar($gl_estudiante_id_estado_estudiante);
                        ?></td>
                    <td><?php if($o['habilitado'] === "1")
                    {echo "SI";}
                    else {echo "NO";}?></td>
                    <td><a href='#' onclick='sel(<?php echo $o['id']; ?>)'>MOD</a> - <a href='#' onclick='del(<?php echo $o['id']; ?>)'>DEL</a></td>
                </tr>
                <?php
            endforeach;
        endif;
        ?>
        <?php
        $nombre_tabla = 'estudiante';
        require_once('recursos/componentes/footer.php');
        ?>    
        <!--Inicio Modal-->
    <div id='modal_id_carrera' class='modal hide fade span9' tabindex='-1' role='dialog' aria-labelledby='myModalLabel' aria-hidden='true' style='left:15% !important;'>
        <div class='modal-header'>
            <button type='button' class='close' data-dismiss='modal' aria-hidden='true'>×</button>
            <h3 id='myModalLabel'>Carrera</h3>
        </div>
        <div class='modal-body'>
            <table class='table table-striped table-bordered table-highlight' id='tbl_modal_id_carrera'>
                <thead>
                    <tr><th>Id</th><th>Nombre</th><th>Tipo Carrera</th>
                        <th></th>                       
                    </tr>
                </thead>
                <tbody id='data_tbl_modal_id_carrera'>

                </tbody>
            </table>
        </div>
        <div class='modal-footer'>
            <button class='btn' data-dismiss='modal' aria-hidden='true'>Cerrar</button>
        </div>
    </div>
    <!--Fin Modal-->    
    <!--Inicio Modal-->
    <div id='modal_id_estado_estudiante' class='modal hide fade span9' tabindex='-1' role='dialog' aria-labelledby='myModalLabel' aria-hidden='true' style='left:15% !important;'>
        <div class='modal-header'>
            <button type='button' class='close' data-dismiss='modal' aria-hidden='true'>×</button>
            <h3 id='myModalLabel'>Estado Estudiante</h3>
        </div>
        <div class='modal-body'>
            <table class='table table-striped table-bordered table-highlight' id='tbl_modal_id_estado_estudiante'>
                <thead>
                    <tr><th>Id</th><th>Nombre</th>
                        <th></th>                       
                    </tr>
                </thead>
                <tbody id='data_tbl_modal_id_estado_estudiante'>

                </tbody>
            </table>
        </div>
        <div class='modal-footer'>
            <button class='btn' data-dismiss='modal' aria-hidden='true'>Cerrar</button>
        </div>
    </div>
    <!--Fin Modal-->