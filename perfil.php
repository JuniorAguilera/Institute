<?php
$res = -1;
if (!isset($_COOKIE['idu'])) {
    header('Location: index.php');
}
$titulo = "Mi Perfil";
require_once 'cvista/head.php';
require_once 'panel/nucleo/estudiante.php';
require_once 'panel/nucleo/carrera.php';
$objCarrera = new carrera();
require_once 'panel/nucleo/estado_estudiante.php';
$objEstado_estudiante = new estado_estudiante();
require_once 'panel/nucleo/experiencia_estudiante.php';
$objExperiencia_estudiante = new experiencia_estudiante();
require_once 'panel/nucleo/tipo_experiencia.php';
$objTipo_experiencia = new tipo_experiencia();
require_once 'panel/nucleo/habilidad_estudiante.php';
$objHabilidad_estudiante = new habilidad_estudiante();

//AQUI PROCESAMOS FORMULARIOS
if (isset($_POST["frm"])) {
    switch ($_POST["frm"]) {
        case "perfil":
            if ($_FILES["ima"]["error"] == 0) {
                $id_usuario = $_COOKIE["idu"];
                $tipo = 0;
                $tipo_imagen = $_FILES["ima"]['type'];
                if (strpos($tipo_imagen, "gif")) {
                    $tipo = 1;
                    if (file_exists("img/perfil/egresado/" . $id_usuario . ".gif")) {
                        unlink("img/perfil/egresado/" . $id_usuario . ".gif");
                    }
                } else {
                    if (strpos($tipo_imagen, "jpeg")) {
                        $tipo = 2;
                        if (file_exists("img/perfil/egresado/" . $id_usuario . ".jpg")) {
                            unlink("img/perfil/egresado/" . $id_usuario . ".jpg");
                        }
                    } else {
                        if (strpos($tipo_imagen, "jpg")) {
                            $tipo = 2;
                            if (file_exists("img/perfil/egresado/" . $id_usuario . ".jpg")) {
                                unlink("img/perfil/egresado/" . $id_usuario . ".jpg");
                            }
                        } else {
                            if (strpos($tipo_imagen, "png")) {
                                $tipo = 3;
                                if (file_exists("img/perfil/egresado/" . $id_usuario . ".png")) {
                                    unlink("img/perfil/egresado/" . $id_usuario . ".png");
                                }
                            } else {
                                $tipo = 0;
                            }
                        }
                    }
                }
                if ($tipo > 0) {
                    $nombre_archivo = $id_usuario;
                    $imagen_original = 0;
                    switch ($tipo) {
                        case 1:
                            $imagen_original = imagecreatefromgif($_FILES["ima"]["tmp_name"]);
                            break;
                        case 2:
                            $imagen_original = imagecreatefromjpeg($_FILES["ima"]["tmp_name"]);
                            break;
                        case 3:
                            $imagen_original = imagecreatefrompng($_FILES["ima"]["tmp_name"]);
                            break;
                    }
                    $ancho_original = imagesx($imagen_original);
                    $alto_original = imagesy($imagen_original);
                    $imagen_redimensionada = imagecreatetruecolor(256, 207);
                    imagecopyresampled($imagen_redimensionada, $imagen_original, 0, 0, 0, 0, 256, 207, $ancho_original, $alto_original);
                    switch ($tipo) {
                        case 1:
                            $ruta = 'img/perfil/egresado/' . $nombre_archivo . '.gif';
                            imagegif($imagen_redimensionada, $ruta);
                            break;
                        case 2:
                            $ruta = 'img/perfil/egresado/' . $nombre_archivo . '.jpg';
                            imagejpeg($imagen_redimensionada, $ruta);
                            break;
                        case 3:
                            $ruta = 'img/perfil/egresado/' . $nombre_archivo . '.png';
                            imagepng($imagen_redimensionada, $ruta);
                            break;
                    }
                    imagedestroy($imagen_original);
                    imagedestroy($imagen_redimensionada);
                }
            }
            break;

        case "datos":
            $objUE = new estudiante();
            $objUE->setVar("id", $_POST["id"]);
            $objUE->setVar("nombres", $_POST["nombres"]);
            $objUE->setVar("apellidos", $_POST["apellidos"]);
            $objUE->setVar("telefono_fijo", $_POST["telefono_fijo"]);
            $objUE->setVar("telefono_celular", $_POST["telefono_celular"]);
            $objUE->setVar("direccion", $_POST["direccion"]);
            $objUE->setVar("email", $_POST["email"]);
            $objUE->setVar("dni", $_POST["dni"]);
            $objUE->setVar("ano_ingreso", $_POST["ano_ingreso"]);
            $objUE->setVar("ano_salida", $_POST["ano_salida"]);
            $objUE->setVar("id_carrera", $_POST["id_carrera"]);
            $objUE->setVar("id_estado_estudiante", $_POST["id_estado_estudiante"]);
            $objUE->setVar("user", $_POST["user"]);
            $objUE->setVar("pass", $_POST["pass"]);
            $res = $objUE->updateDB();
            break;

        case "experiencia":
            $objExp = new experiencia_estudiante();
            $objExp->setVar("id_estudiante", $_POST["id"]);
            $objExp->setVar("lugar", $_POST["lugar"]);
            $objExp->setVar("descripcion", $_POST["descripcion"]);
            $objExp->setVar("ano_ingreso", $_POST["ano_ingreso"]);
            $objExp->setVar("ano_salida", $_POST["ano_salida"]);
            $objExp->setVar("id_tipo_experiencia", $_POST["id_tipo_experiencia"]);
            $res = $objExp->insertDB();
            break;

        case "habilidad":
            $objHab = new habilidad_estudiante();
            $objHab->setVar("id_estudiante", $_POST["id"]);
            $objHab->setVar("habilidad", $_POST["habilidad"]);
            $objHab->setVar("nivel", $_POST["nivel"]);
            $res = $objHab->insertDB();
            break;
    }
}
//Obtenemos Datos Actualziados
$objEstudiante = new estudiante();
$objEstudiante->setVar("id", $_COOKIE["idu"]);
$objEstudiante->getDB();
$miexp = $objExperiencia_estudiante->searchDB($_COOKIE["idu"], "id_estudiante");
$mihab = $objHabilidad_estudiante->searchDB($_COOKIE["idu"], "id_estudiante");
?>
<style>
    label.error{
        margin-left: 7.5%;
        margin-top: 1%;
        color: red;
    }
    label.valid{
        color: green;
    }
</style>
<script src="js/validate.js"></script>
<script>
    $().ready(function() {
        $("#frmdat").validate({
            rules: {
                    dni: {
                            required: true,
                            rangelength: [8, 8],
                            digits: true
                    },
                    nombres: {
                            required: true,
                            minlength: 2
                    },
                    apellidos: {
                            required: true,
                            minlength: 2
                    },
                    telefono_fijo: {
                            required: true,
                            digits: true,
                            rangelength: [6, 12]
                    },
                    telefono_celular: {
                            required: true,
                            digits: true,
                            rangelength: [9, 12]
                    },
                    direccion: {
                            required: true,
                            minlength: 5
                    },
                    email: {
                            required: true,
                            email: true
                    },
                    ano_ingreso: {
                            required: true,
                            rangelength: [4, 4],
                            digits: true
                    },
                    ano_salida: {
                            rangelength: [4, 4],
                            digits: true
                    },
                    user: {
                            required: true,
                            rangelength: [4, 25]
                    },
                    pass: {
                            required: true,
                            rangelength: [4, 25]
                    }
            },
            messages: {
                  dni: {
                            required: 'Este dato es NECESARIO',
                            rangelength: 'Sólo 8 dígitos',
                            digits: 'Solo dígitos'
                    },
                    nombres: {
                            required: 'Este dato es NECESARIO',
                            minlength: 'Mínimo 2 caracteres'
                    },
                    apellidos: {
                            required: 'Este dato es NECESARIO',
                            minlength: 'Mínimo 2 caracteres'
                    },
                    telefono_fijo: {
                            required: 'Este dato es NECESARIO',
                            digits: 'Solo dígitos',
                            rangelength: 'Entre 6 y 12 dígitos'
                    },
                    telefono_celular: {
                            required: 'Este dato es NECESARIO',
                            digits: 'Solo dígitos',
                            rangelength: 'Entre 9 y 12 dígitos'
                    },
                    direccion: {
                            required: 'Este dato es NECESARIO',
                            minlength: 'Mínimo 5 caracteres'
                    },
                    email: {
                            required: 'Este dato es NECESARIO',
                            email: 'Debe tener formato de email'
                    },
                    ano_ingreso: {
                            required: 'Este dato es NECESARIO',
                            rangelength: 'Sólo 4 dígitos',
                            digits: 'Solo dígitos'
                    },
                    ano_salida: {
                            rangelength: 'Sólo 4 dígitos',
                            digits: 'Solo dígitos'
                    },
                    user: {
                            required: 'Este dato es NECESARIO',
                            rangelength: 'Entre 4 y 25 caracteres'
                    },
                    pass: {
                            required: 'Este dato es NECESARIO',
                            rangelength: 'Entre 4 y 25 caracteres'
                    }
            },
	   
	    success: function(label) {
	    	label
	    		.text('OK!').addClass('valid')
		}

            });
    });
    
    function elimina_exp(id){
        $.post('panel/ws/experiencia_estudiante.php', {op: 'del', id: id}, function(data) {
            if(data === 0){
                alert("Hubo un error, reintenta!");
            }
            else{
                location.reload();
            }
        }, 'json');
    }
    
    function elimina_hab(id){
        $.post('panel/ws/habilidad_estudiante.php', {op: 'del', id: id}, function(data) {
            if(data === 0){
                alert("Hubo un error, reintenta!");
            }
            else{
                location.reload();
            }
        }, 'json');
    }
</script>
<div class="container">
    <div class="row">
        <div class="span3">
            <h2>Mi Perfil</h2>
            <p class="lead">
            <figure class="img-polaroid"><img src="<?php
                $imagen_usuario = "img/page2-img1.jpg";
                if (file_exists("img/perfil/egresado/" . $_COOKIE["idu"] . ".jpg")) {
                    $imagen_usuario = "img/perfil/egresado/" . $_COOKIE["idu"] . ".jpg";
                }
                if (file_exists("img/perfil/egresado/" . $_COOKIE["idu"] . ".png")) {
                    $imagen_usuario = "img/perfil/egresado/" . $_COOKIE["idu"] . ".png";
                }
                if (file_exists("img/perfil/egresado/" . $_COOKIE["idu"] . ".gif")) {
                    $imagen_usuario = "img/perfil/egresado/" . $_COOKIE["idu"] . ".gif";
                }
                echo $imagen_usuario;
                ?>" alt=""></figure>
            <p></p>
            <form method="POST" enctype="multipart/form-data">
                <center>
                    <p><span>Reemplazar imagen de perfil</span></p>
                    <p><input type="file" name="ima"/></p>
                    <input type="hidden" name="id" value="<?php echo $objEstudiante->getVar("id"); ?>"/>
                    <input type="hidden" name="frm" value="perfil"/>
                    <p><input type="submit" id="bimg" value="Subir"/></p>
                </center>
            </form>
            </p>
            <div class="border-bottom"></div>
        </div>
        <div class="span9">
            <?php if ($res == 1): ?>
                <p class="text-success">Se Realizó la Operación con Éxito</p>
                <?php
            endif;
            ?>
            <?php if ($res == 0): ?>
                <p class="text-warning">Hubo un Error al Realizar la Operación, Reintenta</p>
                <?php
            endif;
            ?>
            <h2><?php echo $_COOKIE["nombre_usuario"]; ?></h2>
            <form method="POST" id="frmdat">
                <fieldset>
                    <input type="hidden" name="id" value="<?php echo $objEstudiante->getVar("id"); ?>"/>
                    <input type="hidden" name="frm" value="datos"/>
                    <p style="position: relative;">Nombres: <input required type="text" value="<?php echo $objEstudiante->getVar("nombres"); ?>" name="nombres" style="width:60%;position: absolute;left: 85px;"></p>						
                    <p></p>						
                    <p style="position: relative;">Apellidos: <input required type="text" value="<?php echo $objEstudiante->getVar("apellidos"); ?>" name="apellidos" style="width:60%;position: absolute;left: 85px;"></p>						
                    <p></p>
                    <p style="position: relative;">Tel Fijo: <input required type="text" value="<?php echo $objEstudiante->getVar("telefono_fijo"); ?>" name="telefono_fijo" style="width:60%;position: absolute;left: 85px;"></p>						
                    <p></p>	
                    <p style="position: relative;">Celular: <input required type="text" value="<?php echo $objEstudiante->getVar("telefono_celular"); ?>" name="telefono_celular" style="width:60%;position: absolute;left: 85px;"></p>						
                    <p></p>
                    <p style="position: relative;">Direcci&oacute;n: <input required type="text" value="<?php echo $objEstudiante->getVar("direccion"); ?>" name="direccion" style="width:60%;position: absolute;left: 85px;"></p>						
                    <p></p>
                    <p style="position: relative;">Email: <input required type="email" value="<?php echo $objEstudiante->getVar("email"); ?>" name="email" style="width:60%;position: absolute;left: 85px;"></p>						
                    <p></p>
                    <p style="position: relative;">DNI: <input required type="text" value="<?php echo $objEstudiante->getVar("dni"); ?>" name="dni" style="width:60%;position: absolute;left: 85px;"></p>						
                    <p></p>
                    <p style="position: relative;">Año Ingreso: <input required type="text" value="<?php echo $objEstudiante->getVar("ano_ingreso"); ?>" name="ano_ingreso" style="width:60%;position: absolute;left: 85px;"></p>						
                    <p></p>
                    <p style="position: relative;">Año Salida: <input required type="text" value="<?php echo $objEstudiante->getVar("ano_salida"); ?>" name="ano_salida" style="width:60%;position: absolute;left: 85px;"></p>						
                    <p></p>
                    <p style="position: relative;">Carrera: <select required name="id_carrera" style="width:60%;position: absolute;left: 85px;">
                            <?php
                            $carreras = $objCarrera->listDB();
                            if (is_array($carreras)):
                                foreach ($carreras as $c):
                                    ?>
                                    <option value="<?php echo $c["id"] ?>" <?php
                                    if ($objEstudiante->getVar("id_carrera") == $c["id"]) {
                                        echo "selected";
                                    }
                                    ?>><?php echo $c["nombre"]; ?></option>
                                            <?php
                                        endforeach;
                                    endif;
                                    ?>
                        </select></p>
                    <p style="position: relative;">Estado: <select required name="id_estado_estudiante" style="width:60%;position: absolute;left: 85px;">
                            <?php
                            $estados = $objEstado_estudiante->listDB();
                            if (is_array($estados)):
                                foreach ($estados as $e):
                                    ?>
                                    <option value="<?php echo $e["id"] ?>" <?php
                                    if ($objEstudiante->getVar("id_estado_estudiante") == $e["id"]) {
                                        echo "selected";
                                    }
                                    ?>><?php echo $e["nombre"]; ?></option>
                                            <?php
                                        endforeach;
                                    endif;
                                    ?>
                        </select></p>
                    <p></p>
                    <p style="position: relative;">Usuario: <input required type="text" value="<?php echo $objEstudiante->getVar("user"); ?>" name="user" style="width:60%;position: absolute;left: 85px;"></p>						
                    <p></p>
                    <p style="position: relative;">Contrase&ntilde;a: <input required type="text" value="<?php echo $objEstudiante->getVar("pass"); ?>" name="pass" style="width:60%;position: absolute;left: 85px;"></p>						
                    <p></p>
                    <p><input type="submit" value="Actualizar Datos"/></p>
                </fieldset>
            </form>
            <div class="border-bottom"></div>
            <h2>Mi Experiencia</h2>
            <div class="table-responsive">
                <table class="table table-bordered table-hover">
                    <thead><tr><td>Lugar</td><td>Descripcion</td><td>A&ntilde;o Ingreso</td><td>A&ntilde;o Salida</td><td>Tipo</td><td></td></tr></thead>
                    <tbody>
                        <?php
                        if (is_array($miexp)):
                            foreach ($miexp as $me):
                                ?>
                                <tr>
                                    <td><?php echo $me["lugar"]; ?></td>
                                    <td><?php echo $me["descripcion"]; ?></td>
                                    <td><?php echo $me["ano_ingreso"]; ?></td>
                                    <td><?php echo $me["ano_salida"]; ?></td>
                                    <td><?php
                                        $objTipo_experiencia->setVar("id", $me["id_tipo_experiencia"]);
                                        $objTipo_experiencia->getDB();
                                        echo $objTipo_experiencia->getVar("nombre");
                                        ?></td>
                                    <td><a href="#" title="Eliminar" onclick="elimina_exp(<?php echo $me["id"]; ?>)">X</a></td>
                                </tr>
                                <?php
                            endforeach;
                        endif;
                        ?>
                        <tr>
                    <form method="POST">
                        <td>
                            <input required type="text" name="lugar" style="width: 80%"/>
                        </td>
                        <td>
                            <input required type="text" name="descripcion" style="width: 80%"/>
                        </td>
                        <td>
                            <input required type="text" name="ano_ingreso" style="width: 80%"/>
                        </td>
                        <td>
                            <input required type="text" name="ano_salida" style="width: 80%"/>
                        </td>
                        <td>
                            <select required name="id_tipo_experiencia" style="width:80%;">
                                <?php
                                $tipose = $objTipo_experiencia->listDB();
                                if (is_array($tipose)):
                                    foreach ($tipose as $te):
                                        ?>
                                        <option value="<?php echo $te["id"] ?>"><?php echo $te["nombre"]; ?></option>
                                        <?php
                                    endforeach;
                                endif;
                                ?>
                            </select>
                        </td>
                        <td>
                            <input type="hidden" name="id" value="<?php echo $objEstudiante->getVar("id"); ?>"/>
                            <input type="hidden" name="frm" value="experiencia"/>
                            <input type="submit" value="Agregar"/>
                        </td>
                    </form>
                    </tr>
                    </tbody>
                </table>
            </div>
            <div class="border-bottom"></div>
            <h2>Mis Habilidades</h2>
            <div class="table-responsive">
                <table class="table table-bordered table-hover">
                    <thead><tr><td>Habilidad</td><td>Nivel</td><td></td></tr></thead>
                    <tbody>
                        <?php
                        if (is_array($mihab)):
                            foreach ($mihab as $mh):
                                ?>
                                <tr>
                                    <td><?php echo $mh["habilidad"]; ?></td>
                                    <td><?php
                                        switch ($mh["nivel"]) {
                                            case 1:
                                                echo "Básico";
                                                break;

                                            case 2:
                                                echo "Intermedio";
                                                break;

                                            case 3:
                                                echo "Avanzado";
                                                break;
                                        }
                                        ?></td>
                                    <td><a href="#" title="Eliminar" onclick="elimina_hab(<?php echo $mh["id"]; ?>)">X</a></td>
                                </tr>
                                <?php
                            endforeach;
                        endif;
                        ?>
                        <tr>
                    <form method="POST">
                        <td>
                            <input required type="text" name="habilidad" style="width: 80%"/>
                        </td>
                        <td>
                            <select required name="nivel" style="width: 80%">
                                <option value="1">Básico</option>
                                <option value="2">Intermedio</option>
                                <option value="3">Avanzado</option>
                            </select>
                        </td>
                        <td>
                            <input type="hidden" name="id" value="<?php echo $objEstudiante->getVar("id"); ?>"/>
                            <input type="hidden" name="frm" value="habilidad"/>
                            <input type="submit" value="Agregar"/>
                        </td>
                    </form>
                    </tr>
                    </tbody>
                </table>
            </div>
        </div>    
    </div>
</div>
<?php
require_once 'cvista/footer.php';
?>