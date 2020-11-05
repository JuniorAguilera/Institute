<?php
$titulo = "ISTP Señor de Chocan";
require_once 'cvista/head.php';
?>
<script type="text/javascript" src="js/camera.js"></script>
<script type="text/javascript">
    $(document).ready(function() {
        jQuery('.camera_wrap').camera();
    });
</script>	
<div class="container">
    <div class="row">
        <div class="span12">
            <div class="slider">
                <div class="camera_wrap">
                    <div data-src="img/slide-1.jpg">
                        <div class="camera_caption fadeIn">
                            <strong>En linea</strong><br>
                            <span>24/7 todo el año</span>
                        </div>
                    </div>
                    <div data-src="img/slide-2.jpg">
                        <div class="camera_caption fadeIn">
                            <strong>Cerca</strong><br>
                            <span>Atencion Rapida</span>
                        </div>
                    </div>
                    <div data-src="img/slide-3.jpg">
                        <div class="camera_caption fadeIn">
                            <strong>Robusto</strong><br>
                            <span>Sistema de Comunicacion</span>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>     
</div>      
<div class="container">
    <div class="row">
        <div class="span12">
            <strong class="title-1">Bienvenidos!</strong>
            <p class="lead font-1">Este es el portal de egresados del ISTP Señor de Chocan<br>
        </div> 
    </div>
    <div class="row">
        <div class="span12 border-bottom"></div>
    </div>
    <div class="row">
        <div class="block-2">
            <div class="span3">
                <div class="clearfix">
                    <img src="img/page1-icon1.png" alt="">
                    <h2>Egresados</h2>
                </div>
                <p class="lead">Encuentra egresados con excelente perfil profesional</p>
                Las empresas ahora pueden buscar egresados que cumplan sus expectativas, sin esperar a que aparezcan<br>
            </div>
            <div class="span3">
                <div class="clearfix">
                    <img src="img/page1-icon2.png" alt="">
                    <h2>Crecimiento Mutuo</h2>
                </div>
                <p class="lead">Empresas e Instituto crecen en conjunto</p>
                Ahora al saber el perfil profesional buscado, podemos capacitar mejor a nuestros estudiantes.<br>
            </div>
            <div class="span3">
                <div class="clearfix">
                    <img src="img/page1-icon3.png" alt="">
                    <h2>Bolsa de Trabajo</h2>
                </div>
                <p class="lead">Busqueda de trabajo online</p>
                Nuestros egresados pueden encontrar el trabajo que mas se adecue a sus expectativas.<br>
            </div>
            <div class="span3">
                <div class="clearfix">
                    <img src="img/page1-icon4.png" alt="">
                    <h2>24 horas, 7 dias</h2>
                </div>
                <p class="lead">Disponible los 365 dias del año</p>
                Ya no esperes mas, sea de mañana, tarde o madrugada puedes usar nuestra plataforma<br>
            </div>
        </div>
    </div>
</div>
<?php
require_once 'cvista/footer.php';
?>