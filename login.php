<?php

$titulo = "Ingreso al Sistema";
require_once 'cvista/head.php';
$err = 0;
if (isset($_COOKIE['nombre_usuario'])) {
    header('Location: index.php');
} else {
    if (isset($_REQUEST['user']) && isset($_REQUEST['pass'])) {
        include_once('panel/nucleo/include/MasterConexion.php');
        $conn = new MasterConexion();
        $query = "Select * from estudiante where user = '" . $_REQUEST['user'] . "' AND pass = '" . $_REQUEST['pass'] . "' AND habilitado = 1";
        $res = $conn->consulta_arreglo($query);
        if ($res !== 0) {
            setcookie("nombre_usuario", $res["nombres"] . " " . $res["apellidos"]);
            setcookie("idu", $res["id"]);
            header('Location: perfil.php');
        } else {
            $err = 1;
        }
    }
}
?>
<center>
    <form role="form" method="POST">
        <h1>Inicio de Sesi&oacute;n</h1>		
        <div class="login-fields">
            <div class="field">
                <label for="username">Usuario:</label>
                <input type="text" id="username" name="user" value="" placeholder="Usuario" class="login username-field" />
            </div> <!-- /field -->
            <div class="field">
                <label for="password">Clave:</label>
                <input type="password" id="password" name="pass" value="" placeholder="Clave" class="login password-field"/>
            </div> <!-- /password -->
        </div> <!-- /login-fields -->
        <div class="login-actions">
            <button class="button">Entrar</button>
        </div> <!-- .actions -->
    </form>
</center>
<?php

require_once 'cvista/footer.php';
?>
