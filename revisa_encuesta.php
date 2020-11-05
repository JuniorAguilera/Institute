<?php
$ide = 0;
if (isset($_POST["idenc"])) {
    $ide = $_POST["idenc"];
} else {
    header("Location: encuestas.php");
}
$titulo = "Encuesta Terminada";
require_once 'cvista/head.php';
require_once 'panel/nucleo/estudiante_encuesta.php';
require_once 'panel/nucleo/respuestas_estudiante.php';
require_once 'panel/nucleo/pregunta_encuesta.php';
require_once 'panel/nucleo/estudiante.php';
require_once 'panel/nucleo/alternativa_sugerida.php';
require_once 'panel/nucleo/include/MasterConexion.php';
$objConn = new MasterConexion();
//Obtenemos estudiante
$objEstudiante = new estudiante();
$objEstudiante->setVar("id", $_COOKIE["idu"]);
$objEstudiante->getDB();
//Grabamos su participacion en la encuesta
$objEstudianteEncuesta = new estudiante_encuesta();
$objEstudianteEncuesta->setVar("id_estudiante",$_COOKIE["idu"]);
$objEstudianteEncuesta->setVar("id_encuesta", $ide);
$objEstudianteEncuesta->setVar("fecha", date("Y-m-d h:i:s"));
$objEstudianteEncuesta->insertDB();
$q1 = "Select * from seccion_encuesta_carrera where id_carrera = '" . $objEstudiante->getVar("id_carrera") . "'";
$res1 = $objConn->consulta_matriz($q1);
foreach ($res1 as $s) {
    $q2 = "Select * from pregunta_encuesta where id_seccion_encuesta = '" . $s["id"] . "'";
    $res2 = $objConn->consulta_matriz($q2);
    foreach ($res2 as $pr) {
        $q3 = "Select * from pregunta_encuesta_carrera where id_carrera = '" . $objEstudiante->getVar("id_carrera") . "' AND id_pregunta_encuesta = " . $pr["id"] . "";
        $is = $objConn->consulta_arreglo($q3);
        if ($is !== 0) {
            if(isset($_POST["pr".$pr["id"]])){
                $objRE = new respuestas_estudiante();
                $objRE->setVar("id_estudiante",$_COOKIE["idu"]);
                $objRE->setVar("id_pregunta_encuesta", $pr["id"]);
                if(is_array($_POST["pr".$pr["id"]])){
                    $objRE->setVar("respuesta", implode(",",$_POST["pr".$pr["id"]]));
                }
                else {
                    $objRE->setVar("respuesta", $_POST["pr".$pr["id"]]);
                }
                $objRE->insertDB();
                
                if(isset($_POST["ot".$pr["id"]])){
                    $objSU = new alternativa_sugerida();
                    $objSU->setVar("id_estudiante",$_COOKIE["idu"]);
                    $objSU->setVar("id_pregunta_encuesta",$pr["id"]);
                    $objSU->setVar("texto",$_POST["ot".$pr["id"]]);
                    $objSU->insertDB();
                }   
            }
            
        }
    }
}

?>

<div class="container">
    <div class="row">
        <div class="span12">
            <center>
                <h1>Gracias por Responder la Encuesta</h1>
                <h2><a href="ofertas.php">Click Aquí</a> para regresar a la bolsa de trabajo</h2>
            </center>
        </div>
    </div>
</div> 
<?php
require_once 'cvista/footer.php';
?>