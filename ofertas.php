<?php
require_once 'panel/nucleo/estudiante_encuesta.php';
require_once 'panel/nucleo/empresa.php';
$objEmpresa = new empresa();
require_once 'panel/nucleo/tipo_oferta_laboral.php';
$objTipoOfertaLaboral = new tipo_oferta_laboral();
require_once 'panel/nucleo/include/MasterConexion.php';
$objConn = new MasterConexion();
require_once 'panel/nucleo/estudiante.php';
$objEstudiante = new estudiante();
require_once 'panel/nucleo/habilidad_estudiante.php';
$objHabilidad = new habilidad_estudiante();
require_once 'panel/nucleo/oferta_laboral_carrera.php';
$objOfertaCarrera = new oferta_laboral_carrera();
$titulo = "Ofertas de Trabajo";
require_once 'cvista/head.php';
//Obtenemos Experiencia en años del Estudiante
$objEstudiante->setVar("id", $_COOKIE["idu"]);
$objEstudiante->getDB();
$exp = 0;
if ($objEstudiante->getVar("ano_salida") == null || $objEstudiante->getVar("ano_salida") == "") {
    $exp = 0;
} else {
    $exp = date("Y") - $objEstudiante->getVar("ano_salida");
}
$ofertas_disponibles = 0;
$all = 0;
if(isset($_GET["tipo"]))
{
    if($_GET["tipo"] === "mi")
    {    
        $hay = 0;
        //Obtenemos habilidades Estudiante
        $habs = $objHabilidad->searchDB($_COOKIE["idu"], "id_estudiante");
        //obtenemos Ofertas para su carrera
        $oxcarr = $objOfertaCarrera->searchDB($objEstudiante->getVar("id_carrera"), "id_carrera");
        //Obtenemos ofertas laborales para su carrera y habilidades
        $query = "Select DISTINCT id_oferta_laboral from habilidad_oferta_laboral where ";
        if (is_array($oxcarr)) {
            $hay = 1;
            $query.="(";
            foreach ($oxcarr as $oc) {
                $query.=" id_oferta_laboral = " . $oc['id'] . " OR";
            }
            $query = substr($query, 0, -3);
            $query.=")";
        }
        //Si hay ofertas para su carrera le agregamos las habilidades si las hubiera
        if ($hay == 1) {
            if (is_array($habs)) {
                $query.="AND (";
                foreach ($habs as $h) {
                    $query.=" nombre Like '%" . $h["habilidad"] . "%' OR";
                }
                $query = substr($query, 0, -3);
                $query.=")";
            }
            $res = $objConn->consulta_matriz($query);
            //una ves obteninas las ofertas por carrera y habilidades las depuramos por experiencia
            $query1 = "Select * from oferta_laboral WHERE experiencia <= " . $exp . " AND ";
            //si el trabajo no ha registrado habilidades filtramos por experiencia y carrera
            if (is_array($res)) {
                foreach ($res as $ofep) {
                    $query1.= " id = " . $ofep["id_oferta_laboral"] . " OR";
                }
                $query1 = substr($query, 0, -3);
                $ofertas_disponibles = $objConn->consulta_matriz($query1);
            } else {
                foreach ($oxcarr as $oc) {
                    $query1.=" id = " . $oc['id'] . " OR";
                }
                $query1 = substr($query1, 0, -3);
                $ofertas_disponibles = $objConn->consulta_matriz($query1);
            }
        }
    }
    else
    {
            $all = 1;
            //obtenemos todo
            $queryall = "Select * from oferta_laboral";
            $ofertas_disponibles = $objConn->consulta_matriz($queryall);
    }
}
else
{
        $hay = 0;
        //Obtenemos habilidades Estudiante
        $habs = $objHabilidad->searchDB($_COOKIE["idu"], "id_estudiante");
        //obtenemos Ofertas para su carrera
        $oxcarr = $objOfertaCarrera->searchDB($objEstudiante->getVar("id_carrera"), "id_carrera");
        //Obtenemos ofertas laborales para su carrera y habilidades
        $query = "Select DISTINCT id_oferta_laboral from habilidad_oferta_laboral where ";
        if (is_array($oxcarr)) {
            $hay = 1;
            $query.="(";
            foreach ($oxcarr as $oc) {
                $query.=" id_oferta_laboral = " . $oc['id'] . " OR";
            }
            $query = substr($query, 0, -3);
            $query.=")";
        }
        //Si hay ofertas para su carrera le agregamos las habilidades si las hubiera
        if ($hay == 1) {
            if (is_array($habs)) {
                $query.="AND (";
                foreach ($habs as $h) {
                    $query.=" nombre Like '%" . $h["habilidad"] . "%' OR";
                }
                $query = substr($query, 0, -3);
                $query.=")";
            }
            $res = $objConn->consulta_matriz($query);
            //una ves obteninas las ofertas por carrera y habilidades las depuramos por experiencia
            $query1 = "Select * from oferta_laboral WHERE experiencia <= " . $exp . " AND ";
            //si el trabajo no ha registrado habilidades filtramos por experiencia y carrera
            if (is_array($res)) {
                foreach ($res as $ofep) {
                    $query1.= " id = " . $ofep["id_oferta_laboral"] . " OR";
                }
                $query1 = substr($query, 0, -3);
                $ofertas_disponibles = $objConn->consulta_matriz($query1);
            } else {
                foreach ($oxcarr as $oc) {
                    $query1.=" id = " . $oc['id'] . " OR";
                }
                $query1 = substr($query1, 0, -3);
                $ofertas_disponibles = $objConn->consulta_matriz($query1);
            }
        }   
}
?>
<div class="container">
    <div class="row">
        <div class="span12">
            <?php 
                $objEE = new estudiante_encuesta();
                $hay = $objEE->searchDB($_COOKIE["idu"],"id_estudiante");
                if(is_array($hay)):
            ?>
            <h2><?php if($all === 1){echo "Todas las Ofertas";}else{echo "Ofertas para Mí";}?></h2>
            <div style="width: 100%; text-align: right;">
                <strong>Filtrar: </strong> 
                <?php if($all === 1) {echo "<strong>";}?>
                <a href="ofertas.php?tipo=todo">Todo</a>
                <?php if($all === 1) {echo "</strong>";}?>
                |
                <?php if($all === 0) {echo "<strong>";}?>
                <a href="ofertas.php?tipo=mi">Especiales para mi</a>
                <?php if($all === 0) {echo "</strong>";}?>
            </div>
            <ul class="thumbnails">
                <?php
                if (is_array($ofertas_disponibles)):
                    foreach ($ofertas_disponibles as $od):
                        ?>
                        <li class="thumbnail span3">
                            <div class="maxheight">
                                <figure class="img-polaroid"><img src="<?php
                                    $imagen_usuario = "img/page4-img5.jpg";
                                    if (file_exists("img/perfil/empresa/" . $od['id_empresa'] . ".jpg")) {
                                        $imagen_usuario = "img/perfil/empresa/" . $od['id_empresa'] . ".jpg";
                                    }
                                    if (file_exists("img/perfil/empresa/" . $od['id_empresa'] . ".png")) {
                                        $imagen_usuario = "img/perfil/empresa/" . $od['id_empresa'] . ".png";
                                    }
                                    if (file_exists("img/perfil/empresa/" . $od['id_empresa'] . ".gif")) {
                                        $imagen_usuario = "img/perfil/empresa/" . $od['id_empresa'] . ".gif";
                                    }
                                    echo $imagen_usuario;
                                    ?>" alt=""></figure>
                                <p class="font-1"><a href="#" class="lead"><?php echo $od['titulo']; ?></a><br>
                                <p>Tipo: <?php
                                    $objTipoOfertaLaboral->setVar("id", $od['id_tipo_oferta_laboral']);
                                    $objTipoOfertaLaboral->getDB();
                                    echo $objTipoOfertaLaboral->getVar("nombre");
                                    ?></p>
                                <p>Lugar: <?php echo $od["lugar"]; ?></p>
                                <p><?php echo $od['descripcion']; ?>
                                <a href="detalle_oferta.php?id=<?php echo $od['id']; ?>" class="link-1"></a></p>
                            </div>
                        </li>
                        <?php
                    endforeach;
                endif;
                ?>
            </ul>
            <?php else:?>
                <p>Responde al menos una encuesta y podrás acceder a la bolsa laboral</p>
                <p><a href='encuestas.php'>Ir a Encuestas >></a></p>
            <?php endif;?>
            
        </div>
    </div>
</div> 
<?php
require_once 'cvista/footer.php';
?>