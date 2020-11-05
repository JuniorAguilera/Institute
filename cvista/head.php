<!DOCTYPE html>
<html lang="en">
    <head>
        <title><?php echo $titulo; ?></title>
        <meta charset="utf-8">
        <link rel="icon" href="img/favicon.ico" type="image/x-icon">
        <link rel="shortcut icon" href="img/favicon.ico" type="image/x-icon" />
        <meta name="description" content="Your description">
        <meta name="keywords" content="Your keywords">
        <meta name="author" content="Your name">
        <link rel="stylesheet" href="css/bootstrap.css" type="text/css" media="screen">
        <link rel="stylesheet" href="css/responsive.css" type="text/css" media="screen">
        <link rel="stylesheet" href="css/style.css" type="text/css" media="screen">
        <link rel="stylesheet" href="css/camera.css" type="text/css" media="screen">
        <script type="text/javascript" src="js/jquery.js"></script>
        <script type="text/javascript" src="js/jquery.easing.1.3.js"></script>
        <script type="text/javascript" src="js/superfish.js"></script>
        <script type="text/javascript" src="js/jquery.mobilemenu.js"></script>
        <script type="text/javascript" src="js/jquery.cookie.js"></script>

        <script type="text/javascript" src="js/jquery.equalheights.js"></script>
        <!--[if (gt IE 9)|!(IE)]><!-->
        <script type="text/javascript" src="js/jquery.mobile.customized.min.js"></script>
        <!--<![endif]-->

        <!--[if lt IE 8]>
                <div style='text-align:center'><a href="http://www.microsoft.com/windows/internet-explorer/default.aspx?ocid=ie6_countdown_bannercode"><img src="http://www.theie6countdown.com/img/upgrade.jpg"border="0"alt=""/></a></div>  
        <![endif]-->
        <!--[if lt IE 9]>
          <link rel="stylesheet" href="css/docs.css" type="text/css" media="screen">
          <link rel="stylesheet" href="css/ie.css" type="text/css" media="screen">
          <script src="http://html5shim.googlecode.com/svn/trunk/html5.js"></script>
        <![endif]-->
    </head>

    <body>
        <!--==============================header=================================-->      
        <header>
            <div class="container">
                <div class="row">
                    <div class="span12 main-header clearfix">
                        <h1 class="brand"><a href="index.php"><span>ISTP Señor de Chocan</span></a></h1>
                        <div class="navbar navbar_ clearfix">
                            <div class="navbar-inner">                                                 
                                <div class="nav-collapse nav-collapse_ collapse">
                                    <ul class="nav sf-menu clearfix">
                                        <?php
                                        if (isset($_COOKIE["idu"])):
                                            ?>
                                            <li><a href="perfil.php">Mi Perfil</a></li>
                                            <li><a href="ofertas.php">Ofertas de Trabajo</a></li>
                                            <li><a href="egresados.php">Mi Promoci&oacute;n</a></li>
                                            <li><a href="encuestas.php">Encuestas</a></li>
                                            <li><a href="salir.php">Cerrar Sesi&oacute;n</a></li>
                                            <?php
                                        endif;
                                        ?>
                                        <?php
                                        if (!isset($_COOKIE["idu"])):
                                            ?>
                                            <li><a href="login.php">Identificate</a></li>
                                            <li><a href="inscripcion.php">Inscríbete</a></li>
                                            <li><a href="panel/index.php">Administracion</a></li>
                                            <?php
                                        endif;
                                        ?>
                                    </ul>
                                </div>
                            </div>
                        </div>  
                    </div> 
                </div>
            </div>    
        </header>
        <!--==============================content=================================-->
        <div id="content">

