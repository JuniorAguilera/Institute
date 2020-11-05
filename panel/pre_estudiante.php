<?php
    require_once('globales_sistema.php');
    if(!isset($_COOKIE['nombre_usuario'])){
        header('Location: index.php');
    }
    $titulo_pagina = 'Pre Estudiante';
    $titulo_sistema = 'Seguimiento';
    require_once('recursos/componentes/header.php');
    ?>
                <input type='hidden' id='id' name='id' value='0'/>
                
                        <div class='control-group'>
                        <label>Dni</label>
                            <input class='form-control' placeholder='00' id='dni' name='dni' />
                        </div>
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
                            <input class='form-control' placeholder='00' id='telefono_fijo' name='telefono_fijo' />
                        </div>
                        <div class='control-group'>
                        <label>Telefono Celular</label>
                            <input class='form-control' placeholder='00' id='telefono_celular' name='telefono_celular' />
                        </div>
            <div class='control-group'>
            <label>Direccion</label>
                <input class='form-control' placeholder='Direccion' id='direccion' name='direccion' />
            </div>
            <div class='control-group'>
            <label>Email</label>
                <input class='form-control' placeholder='Email' id='email' name='email' />
            </div>
                    <div class='control-group'>
                    <label>Carrera</label>
                    <label class='form-control' id='txt_id_carrera'>...</label>
                    <p class='help-block'><a href='#modal_id_carrera' data-toggle='modal'>Seleccionar</a></p>
                    <input type='hidden' name='id_carrera' id='id_carrera' value=''/>
                    </div>
    <div class='form-actions'>
    <button type='button' class='btn btn-primary btn-large' onclick='save()'>Guardar</button>
    <button type='reset' class='btn-large'>Limpiar</button>
    </div>
    </form>
    <hr/>
    <?php
    include_once('nucleo/pre_estudiante.php');
    $obj = new pre_estudiante();
    $objs = $obj->listDB();
    
                    include_once('nucleo/carrera.php');
                    
    ?>
    <table class='table table-bordered table-hover tablesorter display' id='tb'>
    <thead>
    <tr>
    <th>Id</th><th>Dni</th><th>Nombres</th><th>Apellidos</th><th>Telefono Fijo</th><th>Telefono Celular</th><th>Direccion</th><th>Email</th><th>Carrera</th>
    <th>OPC</th>
    </tr>
    </thead>
    <tbody>
    <?php
        if (is_array($objs)):
        foreach ($objs as $o):
    ?>
    <tr><td><?php echo $o['id']; ?></td><td><?php echo $o['dni']; ?></td><td><?php echo $o['nombres']; ?></td><td><?php echo $o['apellidos']; ?></td><td><?php echo $o['telefono_fijo']; ?></td><td><?php echo $o['telefono_celular']; ?></td><td><?php echo $o['direccion']; ?></td><td><?php echo $o['email']; ?></td><td>
                    <?php 
                    $objcarrera = new carrera();
                    $objcarrera->setVar('id',$o['id_carrera']);
                    $objcarrera->getDB();
                    echo  $objcarrera->getVar($gl_pre_estudiante_id_carrera);
                    ?></td>
    <td><a href='#' onclick='sel(<?php echo $o['id']; ?>)'>MOD</a> - <a href='#' onclick='del(<?php echo $o['id']; ?>)'>DEL</a></td>
    </tr>
    <?php
        endforeach;
        endif;
    ?>
    <?php
    $nombre_tabla = 'pre_estudiante';
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