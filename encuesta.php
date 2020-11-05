<?php
require_once 'panel/nucleo/encuesta.php';
$objEncuesta = new encuesta();
$ide = 0;
if(isset($_GET["id"]))
{
    $ide = $_GET["id"];
}
 else {
     header ("Location: encuestas.php");
}
$objEncuesta->setVar("id", $_GET["id"]);
$objEncuesta->getDB();
$titulo = $objEncuesta->getVar("titulo");
require_once 'cvista/head.php';
//Objetos necesarios
require_once 'panel/nucleo/include/MasterConexion.php';
$objConn = new MasterConexion();
require_once 'panel/nucleo/estudiante.php';
$objEstudiante = new estudiante();
$objEstudiante->setVar("id", $_COOKIE["idu"]);
$objEstudiante->getDB();
$q1 = "Select se.* from seccion_encuesta_carrera se, seccion_encuesta s where se.id_carrera = '".$objEstudiante->getVar("id_carrera")."' AND se.id_seccion_encuesta = s.id AND s.id_encuesta = '".$_GET["id"]."'";
$res1 = $objConn->consulta_matriz($q1);

?>
<link type="text/css" rel="stylesheet" href="stepy/jquery.stepy.css" />
<script type="text/javascript" src="stepy/jquery.stepy.js"></script>
<script src="panel/recursos/js/plugins/validate/jquery.validate.js"></script>
<script>
    var desactivadas = [];
    $(window).load(function() {
        $('#encuesta').stepy({
            nextLabel: 'Siguiente >',
            backLabel: '< Anterior',
            validate: true
        });
        $("#encuesta").validate({
            errorPlacement: function(error, element) {
                error.appendTo( element.parent("label").next("div"));
              } 
          });
    });

    function chekea()
    {
        if (!$("#encuesta").valid())
        {
            alert("Porfavor completa todas las preguntas");
        }
    }
              
    function desactiva(id){
    $.post('panel/ws/pregunta_encuesta.php', {op: 'get', id:id}, function(data) {
        if(data !== 0){
            if(data.id_pregunta_encuesta !== null)
            {
                desactivadas[parseInt(data.id_pregunta_encuesta.id)] = $("#ap"+data.id_pregunta_encuesta.id).html();
                $("#ap"+data.id_pregunta_encuesta.id).html("");
                $("#alter"+data.id_pregunta_encuesta.id).show('fast');
            }
            if(data.id_pregunta_encuesta_1 !== null)
            {
                desactivadas[parseInt(data.id_pregunta_encuesta_1.id)] = $("#ap"+data.id_pregunta_encuesta_1.id).html();
                $("#ap"+data.id_pregunta_encuesta_1.id).html("");
                $("#alter"+data.id_pregunta_encuesta_1.id).show('fast');
            }
            if(data.id_pregunta_encuesta_2 !== null)
            {
                desactivadas[parseInt(data.id_pregunta_encuesta_2.id)] = $("#ap"+data.id_pregunta_encuesta_2.id).html();
                $("#ap"+data.id_pregunta_encuesta_2.id).html("");
                $("#alter"+data.id_pregunta_encuesta_2.id).show('fast');
            }
            if(data.id_pregunta_encuesta_3 !== null)
            {
                desactivadas[parseInt(data.id_pregunta_encuesta_3.id)] = $("#ap"+data.id_pregunta_encuesta_3.id).html();
                $("#ap"+data.id_pregunta_encuesta_3.id).html("");
                $("#alter"+data.id_pregunta_encuesta_3.id).show('fast');
            }
        }
    }, 'json');
    }

    function activa(id){
        $.post('panel/ws/pregunta_encuesta.php', {op: 'get', id:id}, function(data) {
            if(data !== 0){
                if(data.id_pregunta_encuesta !== null)
                {
                    $("#ap"+data.id_pregunta_encuesta.id).html(desactivadas[parseInt(data.id_pregunta_encuesta.id)]);
                    $("#alter"+data.id_pregunta_encuesta.id).hide('fast');
                }
                if(data.id_pregunta_encuesta_1 !== null)
                {
                    $("#ap"+data.id_pregunta_encuesta_1.id).html(desactivadas[parseInt(data.id_pregunta_encuesta_1.id)]);
                    $("#alter"+data.id_pregunta_encuesta_1.id).hide('fast');
                }
                if(data.id_pregunta_encuesta_2 !== null)
                {
                    $("#ap"+data.id_pregunta_encuesta_2.id).html(desactivadas[parseInt(data.id_pregunta_encuesta_2.id)]);
                    $("#alter"+data.id_pregunta_encuesta_2.id).hide('fast');
                }
                if(data.id_pregunta_encuesta_3 !== null)
                {
                    $("#ap"+data.id_pregunta_encuesta_3.id).html(desactivadas[parseInt(data.id_pregunta_encuesta_3.id)]);
                    $("#alter"+data.id_pregunta_encuesta_3.id).hide('fast');
                }
            }
        }, 'json');
    }
    
</script>
<style>
    #encuesta-header{
        display:none;
    }
</style>
<div class="container">
    <div class="row">
        <div class="span12">
            <h2><?php echo $objEncuesta->getVar("titulo");?></h2>
            <form id='encuesta' action="revisa_encuesta.php" method="post">
                <?php
                    echo "<input type='hidden' id='idenc' name='idenc' value='".$_GET["id"]."'/>";
                    if(is_array($res1)){
                    foreach ($res1 as $s)
                    {
                        $q2 = "Select * from pregunta_encuesta where id_seccion_encuesta = '".$s["id_seccion_encuesta"]."'";
                        $res2 = $objConn->consulta_matriz($q2);
                        if(is_array($res2)){
                        foreach($res2 as $pr)
                        {
                            $q3 = "Select * from pregunta_encuesta_carrera where id_carrera = '".$objEstudiante->getVar("id_carrera")."' AND id_pregunta_encuesta = ".$pr["id"]."";
                            $is = $objConn->consulta_arreglo($q3);
                            if($is !== 0)
                            {
                                require_once 'panel/nucleo/seccion_encuesta.php';
                                $objSE = new seccion_encuesta();
                                $objSE->setVar("id", $s["id_seccion_encuesta"]);
                                $objSE->getDB();
                                echo "
                                <fieldset title='".$objSE->getVar("titulo")."'>
                                <legend>".$objSE->getVar("titulo")."</legend>
                                <div id='alter".$pr["id"]."' style='display:none;'>No necesitas responder esta pregunta...</div>
                                <div id='ap".$pr["id"]."'>";
                                echo "<span style='font-size:20px'>".$pr["enunciado"]."</span><br/>";
                                    switch($pr["id_tipo_pregunta"])
                                    {
                                        case '1':
                                            require_once "panel/nucleo/alternativas_pregunta.php";
                                            $objAP = new alternativas_pregunta();
                                            $res3 = $objAP->searchDB($pr["id"],"id_pregunta_encuesta");
                                            foreach($res3 as $alt)
                                            {
                                                $q4 = "Select * from alternativas_preguntas_carrera where id_alternativas_pregunta = '".$alt["id"]."' AND id_carrera = '".$objEstudiante->getVar("id_carrera")."'";
                                                $res4 = $objConn->consulta_arreglo($q4);
                                                if($res4 !== 0)
                                                {
                                                    echo "<input type='checkbox' name='pr".$pr["id"]."[]' value='".$alt["id"]."' required> ".$alt["texto"]."<br>";
                                                }    
                                            }   
                                        break;

                                        case '2':
                                            echo "<input type='radio' name='pr".$pr["id"]."' value='SI' required>SI<br>";
                                            echo "<input type='radio' name='pr".$pr["id"]."' value='NO' required>NO<br>";
                                        break;
                                    
                                        case '3':
                                            echo "<input type='radio' name='pr".$pr["id"]."' value='SI' onclick='activa(".$pr["id"].")' required>SI<br>";
                                            echo "<input type='radio' name='pr".$pr["id"]."' value='NO' onclick='desactiva(".$pr["id"].")' required>NO<br>";
                                        break;
                                    
                                        case '4':
                                            require_once "panel/nucleo/alternativas_pregunta.php";
                                            $objAP = new alternativas_pregunta();
                                            $res3 = $objAP->searchDB($pr["id"],"id_pregunta_encuesta");
                                            foreach($res3 as $alt)
                                            {
                                                $q4 = "Select * from alternativas_preguntas_carrera where id_alternativas_pregunta = '".$alt["id"]."' AND id_carrera = '".$objEstudiante->getVar("id_carrera")."'";
                                                $res4 = $objConn->consulta_arreglo($q4);
                                                if($res4 !== 0)
                                                {
                                                    echo "<input type='checkbox' name='pr".$pr["id"]."[]' value='".$alt["id"]."' required> ".$alt["texto"]."<br>";
                                                }    
                                            }
                                            echo "<input type='checkbox' name='pr".$pr["id"]."[]' value='OTRA' required> Otra: <input type='text' name='ot".$pr["id"]."'><br>";
                                        break;
                                        
                                        case '5':
                                            require_once "panel/nucleo/alternativas_pregunta.php";
                                            $objAP = new alternativas_pregunta();
                                            $res3 = $objAP->searchDB($pr["id"],"id_pregunta_encuesta");
                                            foreach($res3 as $alt)
                                            {
                                                $q4 = "Select * from alternativas_preguntas_carrera where id_alternativas_pregunta = '".$alt["id"]."' AND id_carrera = '".$objEstudiante->getVar("id_carrera")."'";
                                                $res4 = $objConn->consulta_arreglo($q4);
                                                if($res4 !== 0)
                                                {
                                                    echo "<input type='radio' name='pr".$pr["id"]."' value='".$alt["id"]."' required> ".$alt["texto"]."<br>";
                                                }    
                                            }   
                                        break;
                                    }
                                echo"</div></fieldset>
                                ";
                                }
                        }
                        }
                    } 
                    }
                ?>
                <input type="submit" onclick="chekea()"/>
            </form>
        </div>
    </div>
</div> 
<?php
require_once 'cvista/footer.php';
?>