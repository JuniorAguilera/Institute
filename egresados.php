<?php
$titulo = "Perfiles de mi Promoción";
require_once 'cvista/head.php';
require_once 'panel/nucleo/estudiante.php';
$objEstudiante = new estudiante();
$objEstudiante->setVar("id", $_COOKIE["idu"]);
$objEstudiante->getDB();
require_once 'panel/nucleo/include/MasterConexion.php';
$objConn = new MasterConexion();
$query = "Select * from estudiante where id <> " . $_COOKIE["idu"] . " AND id_carrera = " . $objEstudiante->getVar("id_carrera") . " AND ano_ingreso =" . $objEstudiante->getVar("ano_ingreso") . "";
$res = $objConn->consulta_matriz($query);
?>
<div class="container">
    <div class="row">
        <div class="span12">
            <h2>Perfiles de mis conocidos</h2>
            <ul class="thumbnails">
                <?php
                if (is_array($res)):
                    foreach ($res as $eg):
                        ?>
                        <li class="thumbnail span3">
                            <div class="maxheight">
                                <figure class="img-polaroid"><img src="<?php
                                    $imagen_usuario = "img/page2-img1.jpg";
                                    if (file_exists("img/perfil/egresado/" . $eg["id"] . ".jpg")) {
                                        $imagen_usuario = "img/perfil/egresado/" . $eg["id"] . ".jpg";
                                    }
                                    if (file_exists("img/perfil/egresado/" . $eg["id"] . ".png")) {
                                        $imagen_usuario = "img/perfil/egresado/" . $eg["id"] . ".png";
                                    }
                                    if (file_exists("img/perfil/egresado/" . $eg["id"] . ".gif")) {
                                        $imagen_usuario = "img/perfil/egresado/" . $eg["id"] . ".gif";
                                    }
                                    echo $imagen_usuario;
                                    ?>" alt=""></figure>
                                <p class="font-1"><a href="#" class="lead"><?php echo $eg["nombres"] . " " . $eg["apellidos"]; ?></a><br>
                                    <?php echo $eg["email"]; ?><br/>
                                    <?php echo $eg["telefono_fijo"]; ?><br/>
                                    <?php echo $eg["telefono_celular"]; ?><br/></p>
                            </div>
                        </li>
                        <?php
                    endforeach;
                endif;
                ?>
            </ul>   
        </div>
    </div>     
</div> 
<?php
require_once 'cvista/footer.php';
?>