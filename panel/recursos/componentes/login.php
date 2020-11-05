<?php
$err = 0;
if (isset($_COOKIE['nombre_usuario'])) {
    header('Location: dashboard_sistema.php');
} else {
    if (isset($_REQUEST['user']) && isset($_REQUEST['pass'])) {
        include_once('nucleo/include/MasterConexion.php');
        $conn = new MasterConexion();
        $query = "Select * from administrador where user = '" . $_REQUEST['user'] . "' AND pass = '" . $_REQUEST['pass'] . "' AND habilitado = 1";
        $res = $conn->consulta_arreglo($query);
        if ($res !== 0) {
            setcookie("nombre_usuario", $res["user"]);
            header('Location: dashboard_sistema.php');
        } else {
            $err = 1;
        }
    }
}
?>
<!DOCTYPE html>
<html lang="es">
    <head>
        <meta charset="utf-8">
        <title><?php echo $titulo_sistema; ?></title>
        <meta name="viewport" content="width=device-width, initial-scale=1.0, maximum-scale=1.0, user-scalable=no">
        <meta name="apple-mobile-web-app-capable" content="yes">   

        <!-- Styles -->
        <link href="recursos/css/bootstrap.css" rel="stylesheet">
        <link href="recursos/css/bootstrap-responsive.css" rel="stylesheet">
        <link href="recursos/css/bootstrap-overrides.css" rel="stylesheet">
        <link href="recursos/css/ui-lightness/jquery-ui-1.8.21.custom.css" rel="stylesheet">
        <link href="recursos/css/slate.css" rel="stylesheet">
        <link href="recursos/css/components/signin.css" rel="stylesheet" type="text/css">   

        <!-- Javascript -->
        <script src="recursos/js/jquery-1.7.2.min.js"></script>
        <script src="recursos/js/jquery-ui-1.8.21.custom.min.js"></script>    
        <script src="recursos/js/jquery.ui.touch-punch.min.js"></script>
        <script src="recursos/js/bootstrap.js"></script>
    </head>
    <body>

        <div class="account-container login">
            <div class="content clearfix">
                <?php if ($err == 1) : ?>
                    <div class="alert alert-danger alert-dismissable" style="display:none;" id="merror">
                        <button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>
                        Error de Credenciales
                    </div>
                <?php endif; ?>		
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
                        <button class="button btn btn-secondary btn-large">Entrar</button>
                        <a href='../index.php'>Regresar al portal</a>
                    </div> <!-- .actions -->
                </form>
            </div> <!-- /content -->
        </div> <!-- /account-container -->
    </body>
</html>
