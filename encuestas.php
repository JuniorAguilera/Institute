<?php
$titulo = "Encuestas";
require_once 'cvista/head.php';
require_once 'panel/nucleo/encuesta_carrera.php';
require_once 'panel/nucleo/estudiante_encuesta.php';
$objEncuestaCarrera = new encuesta_carrera();
require_once 'panel/nucleo/estudiante.php';
$objEstudiante = new estudiante();
$objEstudiante->setVar("id", $_COOKIE["idu"]);
$objEstudiante->getDB();

?>
<div class="container">
    <div class="row">
        <div class="span12">
            <h2>Encuestas para Egresados</h2>
            <ul class="list">
            <?php 
                $cnt = 0;
                $res = $objEncuestaCarrera->searchDB($objEstudiante->getVar("id_carrera"),"id_carrera");
                if(is_array($res)):
                foreach($res as $enc):
                    $objEE = new estudiante_encuesta();
                    $r = $objEE->verifica_encuesta($_COOKIE["idu"], $enc["id_encuesta"]);
                    if($r == 0):
                    require_once 'panel/nucleo/encuesta.php';
                    $objEncuesta = new encuesta();
                    $objEncuesta->setVar("id", $enc["id_encuesta"]);
                    $objEncuesta->getDB();
                    if($objEncuesta->getVar("fecha_limite") >= date("Y-m-d")):
                    $cnt = $cnt+1;
                    ?>
                    <li><a href="encuesta.php?id=<?php echo $objEncuesta->getVar("id");?>"><?php echo $objEncuesta->getVar("titulo");?></a></li>
            <?php
                endif;
                endif;
                endforeach;    
                endif;
                if(!is_array($res) || $cnt === 0):
            ?>
            <p>No hay encuestas pendientes...</p>
            <?php
            endif;?>
            </ul>
        </div>
    </div>
</div> 
<?php
require_once 'cvista/footer.php';
?>