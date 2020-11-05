<?php
require_once 'panel/nucleo/include/MasterConexion.php';
$objConn = new MasterConexion();
require_once 'panel/nucleo/empresa.php';
$objEmpresa = new empresa();
require_once 'panel/nucleo/tipo_oferta_laboral.php';
$objTipoOfertaLaboral = new tipo_oferta_laboral();
require_once 'panel/nucleo/oferta_laboral.php';
$objOfertaLaboral = new oferta_laboral();
require_once 'panel/nucleo/oferta_laboral_carrera.php';
$objOfertaCarrera = new oferta_laboral_carrera();
require_once 'panel/nucleo/habilidad_oferta_laboral.php';
$objHabilidadOfertaLaboral = new habilidad_oferta_laboral();
require_once 'panel/nucleo/carrera.php';
$objCarrera = new carrera();
//Obtenemos id oferta laboral
$ido = 0;
if(isset($_REQUEST["id"]))
{
    $ido = $_REQUEST["id"];
}
 else {
     header("Location: index.php");
}
$objOfertaLaboral->setVar("id", $ido);
$objOfertaLaboral->getDB();
$titulo = $objOfertaLaboral->getVar("titulo");
require_once 'cvista/head.php';
?>
<div class="container">
    <div class="row">
        	<div class="span12">
                    <h2><?php
                    $objEmpresa->setVar("id",$objOfertaLaboral->getVar("id_empresa"));
                    $objEmpresa->getDB();
                    echo $objEmpresa->getVar("razon_social");
                    ?></h2>
                    <div class="block-3 clearfix" style="border-bottom: 0px;">
                    <figure class="img-polaroid"><img src="
                      <?php
                      $imagen_usuario = "img/page4-img5.jpg";
                      if (file_exists("img/perfil/empresa/" . $objEmpresa->getVar("id") . ".jpg")) {
                          $imagen_usuario = "img/perfil/empresa/" .  $objEmpresa->getVar("id") . ".jpg";
                      }
                      if (file_exists("img/perfil/empresa/" .  $objEmpresa->getVar("id") . ".png")) {
                          $imagen_usuario = "img/perfil/empresa/" .  $objEmpresa->getVar("id") . ".png";
                      }
                      if (file_exists("img/perfil/empresa/" .  $objEmpresa->getVar("id") . ".gif")) {
                          $imagen_usuario = "img/perfil/empresa/" . $objEmpresa->getVar("id") . ".gif";
                      }
                      echo $imagen_usuario;
                      ?>" alt="">
                    <p class="lead">Datos de la Empresa</p>
                    <p><strong>Teléfono: <?php echo $objEmpresa->getVar("telefono");?></strong></p> 
                    <p><strong>Correo: <?php echo $objEmpresa->getVar("correo");?></strong></p>
                    <p><strong>Dirección: <?php echo $objEmpresa->getVar("direccion");?></strong></p> 
                    </figure>
                    <p class="lead"><?php echo $objOfertaLaboral->getVar("titulo");?></p>
                    <p><?php echo $objOfertaLaboral->getVar("descripcion");?></p>
                    <p><strong>Vacantes:</strong> <?php echo $objOfertaLaboral->getVar("vacantes");?></p>
                    <p><strong>Mínima Experiencia requerida:</strong> <?php echo $objOfertaLaboral->getVar("experiencia");?> (Años)</p>
                    <p><strong>Lugar:</strong> <?php echo $objOfertaLaboral->getVar("lugar");?></p>
                    <div class="lists">
                        <ul class="list">
                            <p><strong>Habilidades Deseadas:</strong></p>
                            <?php 
                                $habs = $objHabilidadOfertaLaboral->searchDB($ido,"id_oferta_laboral");
                                if(is_array($habs)):
                                foreach($habs as $ha):
                            ?>
                                <li><a href="#"><?php echo $ha["nombre"]?> - <?php echo $ha["nivel"];?></a></li>
                            <?php endforeach;
                                  endif;?>                     
                        </ul>
                        <ul class="list">
                            <p><strong>Carreras a la que aplica:</strong></p>
                            <?php 
                                $cars = $objOfertaCarrera->searchDB($ido,"id_oferta_laboral");
                                if(is_array($cars)):
                                foreach($cars as $ca):
                            ?>
                                <li><a href="#"><?php 
                                $objCarrera->setVar("id", $ca["id_carrera"]);
                                $objCarrera->getDB();
                                echo $objCarrera->getVar("nombre");?></a></li>
                            <?php endforeach;
                                  endif;?>  
                        </ul>
                    </div>

            	</div>
            </div>
    </div>
</div> 
<?php
require_once 'cvista/footer.php';
?>