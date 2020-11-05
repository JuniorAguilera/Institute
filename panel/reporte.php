<?php
require_once('globales_sistema.php');
if (!isset($_COOKIE['nombre_usuario'])) {
    header('Location: index.php');
}
$titulo_pagina = 'Consolidado Encuesta';
$titulo_sistema = 'Seguimiento';
require_once('recursos/componentes/header.php');
?>
<link href="recursos/css/dataTables.tableTools.css" rel="stylesheet"> 
<script src="recursos/js/dataTables.tableTools.js"></script>
<div class='control-group'>
    <label>Encuesta</label>
    <select id="ide" class='form-control'>
        <?php
            $ies = 0;
            $id1 = 0;
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
                        }
                    }
                    echo">".$s["titulo"]."</option>";
                }
            }
        ?>
    </select>
</div>

<div class='control-group'>
    <label>Carrera</label>
    <select id="idc" class='form-control'>
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
                        }
                    }
                    echo">".$c["nombre"]."</option>";
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
<?php
include_once('nucleo/include/MasterConexion.php');
$conn = new MasterConexion();
$res = null;
if(isset($_GET["ide"])){
    $res = $conn->consulta_matriz("Select * from pregunta_encuesta where id_seccion_encuesta = '".$_GET["ids"]."'");
}
?>
<table class='table table-bordered table-hover tablesorter display' id='tb'>
    <thead>
        <tr>
            <th>ID</th>
            <th>Enunciado</th>
            <th>Tipo Pregunta</th>

        </tr>
    </thead>
    <tbody>
        <?php
        if (is_array($res)):
            foreach ($res as $re):
                ?>
                <tr>
                    <th><?php echo $re["id"];?></th>
                    <th><?php echo $re["enunciado"];?></th>
                    <th><?php
                    require_once 'nucleo/tipo_pregunta.php';
                    $objTipo = new tipo_pregunta();
                    $objTipo->setVar("id", $re["id_tipo_pregunta"]);
                    $objTipo->getDB();
                    echo $objTipo->getVar("nombre");
                    ?></th>
                </tr>
                <tr>
                    <th>ID</th>
                    <th>Alternativa</th>
                    <th>Total</th>
                </tr>
                <?php
                    switch($re["id_tipo_pregunta"])
                    {
                        case 1:
                            $r1 = $conn->consulta_matriz("select ap.* from alternativas_pregunta ap, alternativas_preguntas_carrera apc where ap.id = apc.id_alternativas_pregunta AND apc.id_carrera = '".$_GET["idc"]."' AND ap.id_pregunta_encuesta = '".$re["id"]."'");
                            if(is_array($r1))
                            {
                                foreach ($r1 as $al){
                                    echo "<tr>";
                                    echo "<td>".$al["id"]."</td>";
                                    echo "<td>".$al["texto"]."</td>";
                                    $to = 0;
                                    $rr = $conn->consulta_matriz("Select re.* from respuestas_estudiante re, estudiante e where re.id_estudiante = e.id AND e.id_carrera = '".$_GET["idc"]."' AND re.id_pregunta_encuesta = '".$re["id"]."'");
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
                                    echo "<td>".$to."</td>";
                                    echo "</tr>";
                                }
                            }
                        break;
                    
                        case 2:
                            echo "<tr>";
                            echo "<td>--</td>";
                            echo "<td>SI</td>";
                            $tos = 0;
                            $ton = 0;
                            $rr = $conn->consulta_matriz("Select re.* from respuestas_estudiante re, estudiante e where re.id_estudiante = e.id AND e.id_carrera = '".$_GET["idc"]."' AND re.id_pregunta_encuesta = '".$re["id"]."'");
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
                            echo "<td>".$tos."</td>";
                            echo "</tr>";
                            echo "<tr>";
                            echo "<td>--</td>";
                            echo "<td>NO</td>";
                            echo "<td>".$ton."</td>";
                            echo "</tr>";
                        break;
                    
                        case 3:
                            echo "<tr>";
                            echo "<td>--</td>";
                            echo "<td>SI</td>";
                            $tos = 0;
                            $ton = 0;
                            $rr = $conn->consulta_matriz("Select re.* from respuestas_estudiante re, estudiante e where re.id_estudiante = e.id AND e.id_carrera = '".$_GET["idc"]."' AND re.id_pregunta_encuesta = '".$re["id"]."'");
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
                            echo "<td>".$tos."</td>";
                            echo "</tr>";
                            echo "<tr>";
                            echo "<td>--</td>";
                            echo "<td>NO</td>";
                            echo "<td>".$ton."</td>";
                            echo "</tr>";
                        break;
                    
                        case 4:
                            $r1 = $conn->consulta_matriz("select ap.* from alternativas_pregunta ap, alternativas_preguntas_carrera apc where ap.id = apc.id_alternativas_pregunta AND apc.id_carrera = '".$_GET["idc"]."' AND ap.id_pregunta_encuesta = '".$re["id"]."'");
                            if(is_array($r1))
                            {
                                foreach ($r1 as $al){
                                    echo "<tr>";
                                    echo "<td>".$al["id"]."</td>";
                                    echo "<td>".$al["texto"]."</td>";
                                    $to = 0;
                                    $rr = $conn->consulta_matriz("Select re.* from respuestas_estudiante re, estudiante e where re.id_estudiante = e.id AND e.id_carrera = '".$_GET["idc"]."' AND re.id_pregunta_encuesta = '".$re["id"]."'");
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
                                    echo "<td>".$to."</td>";
                                    echo "</tr>";
                                }
                            }
                        break;
                    
                        case 5:
                            $r1 = $conn->consulta_matriz("select ap.* from alternativas_pregunta ap, alternativas_preguntas_carrera apc where ap.id = apc.id_alternativas_pregunta AND apc.id_carrera = '".$_GET["idc"]."' AND ap.id_pregunta_encuesta = '".$re["id"]."'");
                            if(is_array($r1))
                            {
                                foreach ($r1 as $al){
                                    echo "<tr>";
                                    echo "<td>".$al["id"]."</td>";
                                    echo "<td>".$al["texto"]."</td>";
                                    $to = 0;
                                    $rr = $conn->consulta_matriz("Select re.* from respuestas_estudiante re, estudiante e where re.id_estudiante = e.id AND e.id_carrera = '".$_GET["idc"]."' AND re.id_pregunta_encuesta = '".$re["id"]."'");
                                    if(is_array($rr))
                                    {
                                        foreach($rr as $rpta)
                                        {
                                            if ($rpta["respuesta"] == $al["id"]) {
                                                $to = $to+1;
                                            }
                                        }
                                    }
                                    echo "<td>".$to."</td>";
                                    echo "</tr>";
                                }
                            }
                        break;
                    }
                    
                ?>
                <?php
            endforeach;
        endif;
        ?>
</tbody>
</table>
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
    location.href = 'reporte.php?ide='+ide+'&ids='+ids+'&idc='+idc;
}
$(document).ready(function() {
   $('#tb').DataTable({
            sDom: "T<'clear'><'row'<'span6'l><'span6'f>r>t<'row'<'span6'i><'span6'p>>",
            "iDisplayLength": 1000,
            "bSort": false,
            "bFilter": false,
            "bInfo": false,
            "bPaginate": false,
            "oTableTools": {
                    "sSwfPath": "recursos/swf/copy_csv_xls_pdf.swf"
            }
        });
});
</script>
</body>
</html>
