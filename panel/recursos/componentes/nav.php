<!DOCTYPE html>
<html lang="es">
    <head>
        <meta charset="utf-8">
        <title>Bienvenidos al Sistema</title>
        <meta name="viewport" content="width=device-width, initial-scale=1.0, maximum-scale=1.0, user-scalable=no">
        <meta name="apple-mobile-web-app-capable" content="yes">
        <!-- Styles -->
        <link href="recursos/css/bootstrap.css" rel="stylesheet">
        <link href="recursos/css/bootstrap-responsive.css" rel="stylesheet">
        <link href="recursos/css/bootstrap-overrides.css" rel="stylesheet">
        <link href="recursos/css/ui-lightness/jquery-ui-1.8.21.custom.css" rel="stylesheet">
        <link href="recursos/js/plugins/msgGrowl/css/msgGrowl.css" rel="stylesheet">
        <link href="recursos/js/plugins/msgAlert/css/msgAlert.css" rel="stylesheet">
        <link href="recursos/js/plugins/timepicker/jquery.ui.timepicker.css" rel="stylesheet"> 
        <link href="recursos/js/plugins/lightbox/themes/evolution-dark/jquery.lightbox.css" rel="stylesheet">  
        <link href="recursos/js/plugins/colorpicker/css/colorpicker.css" rel="stylesheet">
        <link href="recursos/css/slate.css" rel="stylesheet">
        <link href="recursos/css/slate-responsive.css" rel="stylesheet">  
        <link href="recursos/css/pages/ui-elements.css" rel="stylesheet">
        <link href="recursos/js/plugins/datatables/DT_bootstrap.css" rel="stylesheet">
        <link href="recursos/js/plugins/responsive-tables/responsive-tables.css" rel="stylesheet"> 

        <!-- Javascript -->
        <script src="recursos/js/jquery-1.7.2.min.js"></script>
        <script src="recursos/js/jquery-ui-1.8.21.custom.min.js"></script>
        <script src="recursos/js/jquery.ui.touch-punch.min.js"></script>
        <script src="recursos/js/bootstrap.js"></script>
        <script src="recursos/js/plugins/msgGrowl/js/msgGrowl.js"></script>
        <script src="recursos/js/plugins/msgAlert/js/msgAlert.js"></script>
        <script src="recursos/js/plugins/timepicker/jquery.ui.timepicker.min.js"></script>
        <script src="recursos/js/plugins/colorpicker/js/bootstrap-colorpicker.js"></script>
        <script src="recursos/js/plugins/lightbox/jquery.lightbox.js"></script>
        <script src="recursos/js/plugins/datatables/jquery.dataTables.js"></script>
        <script src="recursos/js/plugins/datatables/DT_bootstrap.js"></script>
        <script src="recursos/js/plugins/responsive-tables/responsive-tables.js"></script>
        <script src="recursos/js/Slate.js"></script>
        <!-- Le HTML5 shim, for IE6-8 support of HTML5 elements -->
        <!--[if lt IE 9]>
          <script src="http://html5shim.googlecode.com/svn/trunk/html5.js"></script>
        <![endif]-->
    </head>
    <body>	
        <div id="header">	
            <div class="container">			
                <h1><a href="index.php"><?php echo $titulo_sistema; ?></a></h1>			
                <div id="info">							
                    <a href="javascript:;" id="info-trigger">
                        <i class="icon-cog"></i>
                    </a>			
                    <div id="info-menu">				
                        <div class="info-details">				
                            <h4><?php
                                if (isset($_COOKIE["nombre_usuario"])) {
                                    echo $_COOKIE["nombre_usuario"];
                                }
                                ?></h4>					
                            <p>
                                <a href="logout_sistema.php">Cerrar Sesi&oacute;n</a>
                            </p>					
                        </div> <!-- /.info-details -->				
                        <div class="info-avatar">					
                            <img src="recursos/img/avatar.jpg" alt="avatar">			
                        </div> <!-- /.info-avatar -->				
                    </div> <!-- /#info-menu -->			
                </div> <!-- /#info -->	
            </div> <!-- /.container -->
        </div> <!-- /#header -->
        <div id="nav">	
            <div class="container">
                <a href="javascript:;" class="btn-navbar" data-toggle="collapse" data-target=".nav-collapse">
                    <i class="icon-reorder"></i></a>

                <div class="nav-collapse">
                    <ul class="nav">
                        <li class="nav-icon">
                            <a href="index.php">
                                <i class="icon-home"></i>
                                <span>Inicio</span>
                            </a>	    				
                        </li>
                        <?php include_once('navbar_sistema.php'); ?>
                    </ul>			
                </div> <!-- /.nav-collapse -->

            </div> <!-- /.container -->

        </div> <!-- /#nav -->

        <div id="content">		
            <div class="container">						
                <div class="row">
                    <div class="span12">
                        <h1>ISTP Señor de Chocan</h1>
                        <h2>Sistema de seguimiento a egresados y bolsa laboral</h2>
                    </div>
                </div> <!-- /row -->
            </div> <!-- /.container -->
        </div> <!-- /#content -->
        <div id="footer">	
            <div class="container">
                ISTP Señor de Chocan - 2014
            </div> <!-- /.container -->		
        </div> <!-- /#footer -->
    </body>
</html>
