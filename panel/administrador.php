<?php
require_once('globales_sistema.php');
if (!isset($_COOKIE['nombre_usuario'])) {
    header('Location: index.php');
}
$titulo_pagina = 'Administrador';
$titulo_sistema = 'Seguimiento';
require_once('recursos/componentes/header.php');
?>
<input type='hidden' id='id' name='id' value='0'/>

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
include_once('nucleo/administrador.php');
$obj = new administrador();
$objs = $obj->listDB();
?>
<table class='table table-bordered table-hover tablesorter display' id='tb'>
    <thead>
        <tr>
            <th>Id</th><th>User</th><th>Pass</th><th>Habilitado</th>
            <th>OPC</th>
        </tr>
    </thead>
    <tbody>
        <?php
        if (is_array($objs)):
            foreach ($objs as $o):
                ?>
                <tr><td><?php echo $o['id']; ?></td><td><?php echo $o['user']; ?></td><td><?php echo $o['pass']; ?></td><td><?php echo $o['habilitado']; ?></td>
                    <td><a href='#' onclick='sel(<?php echo $o['id']; ?>)'>MOD</a> - <a href='#' onclick='del(<?php echo $o['id']; ?>)'>DEL</a></td>
                </tr>
                <?php
            endforeach;
        endif;
        ?>
        <?php
        $nombre_tabla = 'administrador';
        require_once('recursos/componentes/footer.php');
        ?>