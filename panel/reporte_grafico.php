<?php
require_once('globales_sistema.php');
if (!isset($_COOKIE['nombre_usuario'])) {
    header('Location: index.php');
}
$titulo_pagina = 'Respuestas por Pregunta';
$titulo_sistema = 'Seguimiento';
require_once('recursos/componentes/header.php');
?>
<link href="recursos/morris/morris.css" rel="stylesheet"> 
<script src="recursos/morris/morris.js"></script>
<script src="recursos/morris/raphael.js"></script>
<style>

</style>
<div class='control-group'>
    <label>Encuesta</label>
    <select id="ide" class='form-control'>
        <?php
            $ies = 0;
            $id1 = 0;
            $idss = 0;
            $idcs = 0;
            require_once 'nucleo/encuesta.php';
            $objEncuesta = new encuesta();
            $re = $objEncuesta->listDB();
            if(is_array($re))
            {
                foreach($re as $e)
                {
                    echo "<option value='".$e["id"]."'";
                    if(isset($_GET["ide"]))
                    {
                        if($_GET["ide"] == $e["id"])
                        {
                            echo " selected ";
                            $id1 = $e["id"];   
                        }
                    }
                    echo">".$e["titulo"]."</option>";
                    if($ies===0)
                    {
                        $id1 = $e["id"];
                        $ies=1;
                    }
                }
            }
        ?>
    </select>
</div>

<div class='control-group'>
    <label>Seccion</label>
    <select id="ids" class='form-control'>
        <?php 
            require_once 'nucleo/seccion_encuesta.php';
            $objSe = new seccion_encuesta();
            $rs = $objSe->searchDB($id1, "id_encuesta");
            if(is_array($rs)){
                foreach($rs as $s)
                {
                    echo "<option value='".$s["id"]."'";
                    if(isset($_GET["ids"]))
                    {
                        if($_GET["ids"] == $s["id"])
                        {
                            echo " selected ";
                            $idss = $s["id"];
                        }
                    }
                    echo">".$s["titulo"]."</option>";
                    if($idss == 0)
                    {
                        $idss = $s["id"];
                    }
                }
            }
        ?>
    </select>
</div>

<div class='control-group'>
    <label>Carrera</label>
    <select id="idc" class='form-control' onchange="filtrar()">
        <?php 
            require_once 'nucleo/carrera.php';
            $objCa = new carrera();
            $rc = $objCa->listDB();
            if(is_array($rc)){
                foreach($rc as $c)
                {
                    echo "<option value='".$c["id"]."'";
                    if(isset($_GET["idc"]))
                    {
                        if($_GET["idc"] == $c["id"])
                        {
                            echo " selected ";
                            $idcs = $c["id"];
                        }
                    }
                    echo">".$c["nombre"]."</option>";
                    if($idcs == 0){
                        $idcs = $c["id"];
                    }
                }
            }
        ?>
    </select>
</div>

<div class='control-group'>
    <label>Pregunta</label>
    <select id="idp" class='form-control'>
        <?php 
            require_once 'nucleo/pregunta_encuesta.php';
            $objPr = new pregunta_encuesta();
            $rp = $objPr->consulta_matriz("Select pe.* from pregunta_encuesta pe, pregunta_encuesta_carrera pec WHERE pe.id_seccion_encuesta =  '".$idss."' AND pec.id_pregunta_encuesta = pe.id AND pec.id_carrera = '".$idcs."'");
            if(is_array($rp)){
                foreach($rp as $p)
                {
                    echo "<option value='".$p["id"]."'";
                    if(isset($_GET["idp"]))
                    {
                        if($_GET["idp"] == $p["id"])
                        {
                            echo " selected ";   
                        }
                    }
                    echo">".$p["enunciado"]."</option>";
                }
            }
        ?>
    </select>
</div>

<div class='control-group'>
    <button type='button' class='btn btn-primary btn-large' onclick='filtrar()'>Filtrar</button>
</div>
</form>
<hr/>
    <div class="graph-container">
    <div id="hero-bar" class="graph" height="600"></div>
    </div>
</div> <!-- /widget-content -->
</div> <!-- /widget -->
</div> <!-- /.span12 -->
</div> <!-- /row -->
</div> <!-- /.container -->
</div> <!-- /#content -->
<div id="footer">	
    <div class="container">
        ISTP Señor de Chocan - 2014
    </div> <!-- /.container -->		
</div> <!-- /#footer -->
<script>
function filtrar(){
    var ide =  $('#ide').find('option:selected').val();
    var ids =  $('#ids').find('option:selected').val();
    var idc =  $('#idc').find('option:selected').val();
    var idp =  $('#idp').find('option:selected').val();
    location.href = 'reporte_grafico.php?ide='+ide+'&ids='+ids+'&idc='+idc+"&idp="+idp;
}
$(document).ready(function() {
     Morris.Bar({
        element: 'hero-bar',
        data: [
          <?php
          if(isset($_GET["idp"])){
            include_once('nucleo/include/MasterConexion.php');
            $conn = new MasterConexion();
            require_once 'nucleo/pregunta_encuesta.php';
            $objpenc = new pregunta_encuesta();
            $objpenc->setVar("id", $_GET["idp"]);
            $objpenc->getDB();
            switch($objpenc->getVar("id_tipo_pregunta"))
            {
            case 1:
            $r1 = $conn->consulta_matriz("select ap.* from alternativas_pregunta ap, alternativas_preguntas_carrera apc where ap.id = apc.id_alternativas_pregunta AND apc.id_carrera = '".$_GET["idc"]."' AND ap.id_pregunta_encuesta = '".$_GET["idp"]."'");
            if(is_array($r1))
            {
              foreach ($r1 as $al){
                  echo "{opcion: '".$al["texto"]."',";
                  $to = 0;
                  $rr = $conn->consulta_matriz("Select re.* from respuestas_estudiante re, estudiante e where re.id_estudiante = e.id AND e.id_carrera = '".$_GET["idc"]."' AND re.id_pregunta_encuesta = '".$_GET["idp"]."'");
                  if(is_array($rr))
                  {
                      foreach($rr as $rpta)
                      {
                          $ar = explode(",", $rpta["respuesta"]);
                          if (in_array($al["id"], $ar)) {
                              $to = $to+1;
                          }
                      }
                  }
                  echo "total: ".$to."},";
              }
            }
            break;

            case 2:
            echo "{opcion: 'SI',";
            $tos = 0;
            $ton = 0;
            $rr = $conn->consulta_matriz("Select re.* from respuestas_estudiante re, estudiante e where re.id_estudiante = e.id AND e.id_carrera = '".$_GET["idc"]."' AND re.id_pregunta_encuesta = '".$_GET["idp"]."'");
            if(is_array($rr))
            {
              foreach($rr as $rpta)
              {
                  if($rpta["respuesta"] == "SI"){
                      $tos = $tos +1;
                  }
                  else{
                      $ton = $ton +1;
                  }
              }
            }
            echo "total: ".$tos."},";
            echo "{opcion: 'NO', total: ".$ton."},";
            break;

            case 3:
            echo "{opcion: 'SI',";
            $tos = 0;
            $ton = 0;
            $rr = $conn->consulta_matriz("Select re.* from respuestas_estudiante re, estudiante e where re.id_estudiante = e.id AND e.id_carrera = '".$_GET["idc"]."' AND re.id_pregunta_encuesta = '".$_GET["idp"]."'");
            if(is_array($rr))
            {
              foreach($rr as $rpta)
              {
                  if($rpta["respuesta"] == "SI"){
                      $tos = $tos +1;
                  }
                  else{
                      $ton = $ton +1;
                  }
              }
            }
            echo "total: ".$tos."},";
            echo "{opcion: 'NO',total: ".$ton."},";
            break;

            case 4:
            $r1 = $conn->consulta_matriz("select ap.* from alternativas_pregunta ap, alternativas_preguntas_carrera apc where ap.id = apc.id_alternativas_pregunta AND apc.id_carrera = '".$_GET["idc"]."' AND ap.id_pregunta_encuesta = '".$_GET["idp"]."'");
            if(is_array($r1))
            {
              foreach ($r1 as $al){
                  echo "{opcion: '".$al["texto"]."',";
                  $to = 0;
                  $rr = $conn->consulta_matriz("Select re.* from respuestas_estudiante re, estudiante e where re.id_estudiante = e.id AND e.id_carrera = '".$_GET["idc"]."' AND re.id_pregunta_encuesta = '".$_GET["idp"]."'");
                  if(is_array($rr))
                  {
                      foreach($rr as $rpta)
                      {
                          $ar = explode(",", $rpta["respuesta"]);
                          if (in_array($al["id"], $ar)) {
                              $to = $to+1;
                          }
                      }
                  }
                  echo "total: ".$to."},";
              }
            }
            break;

            case 5:
            $r1 = $conn->consulta_matriz("select ap.* from alternativas_pregunta ap, alternativas_preguntas_carrera apc where ap.id = apc.id_alternativas_pregunta AND apc.id_carrera = '".$_GET["idc"]."' AND ap.id_pregunta_encuesta = '".$_GET["idp"]."'");
            if(is_array($r1))
            {
              foreach ($r1 as $al){
                  echo "{opcion: '".$al["texto"]."',";
                  $to = 0;
                  $rr = $conn->consulta_matriz("Select re.* from respuestas_estudiante re, estudiante e where re.id_estudiante = e.id AND e.id_carrera = '".$_GET["idc"]."' AND re.id_pregunta_encuesta = '".$_GET["idp"]."'");
                  if(is_array($rr))
                  {
                      foreach($rr as $rpta)
                      {
                          if ($rpta["respuesta"] == $al["id"]) {
                              $to = $to+1;
                          }
                      }
                  }
                  echo "total: ".$to."},";
              }
            }
            break;
            
            }
          }
          ?>
        ],
        xkey: 'opcion',
        ykeys: ['total'],
        labels: ['Total'],
        barRatio: 0.4,
        xLabelAngle: 90,
        hideHover: 'auto'
    });
    $("svg").css("height",550);
});
</script>
</body>
</html>
