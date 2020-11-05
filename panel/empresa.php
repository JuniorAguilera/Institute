<?php
require_once('globales_sistema.php');
if (!isset($_COOKIE['nombre_usuario'])) {
    header('Location: index.php');
}
$titulo_pagina = 'Empresa';
$titulo_sistema = 'Seguimiento';
require_once('recursos/componentes/header.php');
?>
<input type='hidden' id='id' name='id' value='0'/>

<div class='control-group'>
    <label>Razon Social</label>
    <input class='form-control' placeholder='Razon Social' id='razon_social' name='razon_social' />
</div>
<div class='control-group'>
    <label>Ruc</label>
    <input class='form-control' placeholder='Ruc' id='ruc' name='ruc' />
</div>
<div class='control-group'>
    <label>Direccion</label>
    <input class='form-control' placeholder='Direccion' id='direccion' name='direccion' />
</div>
<div class='control-group'>
    <label>Telefono</label>
    <input class='form-control' placeholder='Telefono' id='telefono' name='telefono' />
</div>
<div class='control-group'>
    <label>Correo</label>
    <input class='form-control' placeholder='Correo' id='correo' name='correo' />
</div>
<div class='control-group'>
    <label>Imagen</label>
    <input type='file' class='form-control' id='img' name='img' />
</div>
<div class='form-actions'>
    <button type='button' class='btn btn-primary btn-large' onclick='save()'>Guardar</button>
    <button type='reset' class='btn-large'>Limpiar</button>
</div>
</form>
<hr/>
<?php
include_once('nucleo/empresa.php');
$obj = new empresa();
$objs = $obj->listDB();
?>
<table class='table table-bordered table-hover tablesorter display' id='tb'>
    <thead>
        <tr>
            <th>Id</th><th>Imagen</th><th>Razon Social</th><th>Ruc</th><th>Direccion</th><th>Telefono</th><th>Correo</th>
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
                    <td><center><img src='
                <?php
                $imagen_usuario = "../img/page4-img5.jpg";
                if (file_exists("../img/perfil/empresa/" . $o['id'] . ".jpg")) {
                    $imagen_usuario = "../img/perfil/empresa/" . $o['id'] . ".jpg";
                }
                if (file_exists("../img/perfil/empresa/" . $o['id'] . ".png")) {
                    $imagen_usuario = "../img/perfil/empresa/" . $o['id'] . ".png";
                }
                if (file_exists("../img/perfil/empresa/" . $o['id'] . ".gif")) {
                    $imagen_usuario = "../img/perfil/empresa/" . $o['id'] . ".gif";
                }
                echo $imagen_usuario;
                ?>
                             ' width='128' height='83'/></center>
        </td>
        <td><?php echo $o['razon_social']; ?></td>
        <td><?php echo $o['ruc']; ?></td>
        <td><?php echo $o['direccion']; ?></td>
        <td><?php echo $o['telefono']; ?></td>
        <td><?php echo $o['correo']; ?></td>
        <td><a href='#' onclick='sel(<?php echo $o['id']; ?>)'>MOD</a> - <a href='#' onclick='del(<?php echo $o['id']; ?>)'>DEL</a></td>
        </tr>
        <?php
    endforeach;
endif;
?>
<?php
$nombre_tabla = 'empresa';
require_once('recursos/componentes/footer.php');
?>