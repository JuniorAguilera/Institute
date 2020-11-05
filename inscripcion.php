<?php
$res = -1;
if (isset($_COOKIE['idu'])) {
    header('Location: buscador.php');
}
$titulo = "Inscríbete al Sistema";
require_once 'cvista/head.php';
require_once 'panel/nucleo/estudiante.php';
$objEstudiante = new estudiante();
require_once 'panel/nucleo/carrera.php';
$objCarrera = new carrera();
require_once 'panel/nucleo/estado_estudiante.php';
$objEstado_estudiante = new estado_estudiante();

//AQUI PROCESAMOS FORMULARIOS
if (isset($_POST["frm"])) {
            $objUE = new estudiante();
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
            if($_POST["hab"] == "NO")
            {
                $objUE->setVar("habilitado","0");
            }
            else {
                $objUE->setVar("habilitado","1");
            }
            $res = $objUE->insertDB();
}
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
        $("#frminsc").validate({
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
    
    function get_estudiante(){
        var dniac = $("#dni").val();
        $.post('panel/ws/pre_estudiante.php', {op: 'search', value: 'dni', data: dniac, type: '1'}, function(data) {
            if(data !== 0){
                $("#hab").val("SI");
                $.each(data, function(key, value) {
                    $("#dni").val(value.dni);
                    $("#nombres").val(value.nombres);
                    $("#apellidos").val(value.apellidos);
                    $("#telefono_fijo").val(value.telefono_fijo);
                    $("#direccion").val(value.direccion);
                    $("#email").val(value.email);
                    $("#carrera option[value="+data.id_carrera+"]").attr('selected', true);
                });
            }
            else
            {
                $("#hab").val("NO");
            }
        }, 'json');
        $.post('panel/ws/estudiante.php', {op: 'search', value: 'dni', data: dniac, type: '1'}, function(data) {
            if(data !== 0){
                alert("Ya estas registrado en el sistema, si has olvidado tus credenciales contacta con el administrador");
                location.href='index.php';
            }
        }, 'json');
    }
</script>
<div class="container">
    <div class="row">
        <div class="span12">
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
            <h2>Inscríbete al Sistema</h2>
            <form method="POST" id="frminsc">
                <fieldset>
                    <input type="hidden" name="frm" value="datos"/>
                    <input type="hidden" name="hab" value="NO"/>
                    <p style="position: relative;">DNI: <input onchange="get_estudiante()" required type="text" id="dni" name="dni" style="width:60%;position: absolute;left: 85px;"></p>						
                    <p></p>
                    <p style="position: relative;">Nombres: <input required type="text" id="nombres" name="nombres" style="width:60%;position: absolute;left: 85px;"></p>						
                    <p></p>						
                    <p style="position: relative;">Apellidos: <input required type="text" id="apellidos" name="apellidos" style="width:60%;position: absolute;left: 85px;"></p>						
                    <p></p>
                    <p style="position: relative;">Tel Fijo: <input required type="text" id="telefono_fijo" name="telefono_fijo" style="width:60%;position: absolute;left: 85px;"></p>						
                    <p></p>	
                    <p style="position: relative;">Celular: <input required type="text" id="telefono_celular" name="telefono_celular" style="width:60%;position: absolute;left: 85px;"></p>						
                    <p></p>
                    <p style="position: relative;">Direcci&oacute;n: <input required type="text" id="direccion" name="direccion" style="width:60%;position: absolute;left: 85px;"></p>						
                    <p></p>
                    <p style="position: relative;">Email: <input required type="email" id="email" name="email" style="width:60%;position: absolute;left: 85px;"></p>						
                    <p></p>
                    <p style="position: relative;">Año Ingreso: <input required type="text" id="ano_ingreso" name="ano_ingreso" style="width:60%;position: absolute;left: 85px;"></p>						
                    <p></p>
                    <p style="position: relative;">Año Salida: <input type="text" id="ano_salida" name="ano_salida" style="width:60%;position: absolute;left: 85px;"></p>						
                    <p></p>
                    <p style="position: relative;">Carrera: <select required id="id_carrera" name="id_carrera" style="width:60%;position: absolute;left: 85px;">
                            <?php
                            $carreras = $objCarrera->listDB();
                            if (is_array($carreras)):
                                foreach ($carreras as $c):
                                    ?>
                                    <option value="<?php echo $c["id"] ?>"><?php echo $c["nombre"]; ?></option>
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
                                    <option value="<?php echo $e["id"] ?>"><?php echo $e["nombre"]; ?></option>
                                            <?php
                                        endforeach;
                                    endif;
                                    ?>
                        </select></p>
                    <p></p>
                    <p style="position: relative;">Usuario: <input required type="text" name="user" style="width:60%;position: absolute;left: 85px;"></p>						
                    <p></p>
                    <p style="position: relative;">Contrase&ntilde;a: <input required type="text" name="pass" style="width:60%;position: absolute;left: 85px;"></p>						
                    <p></p>
                    <p><input type="submit" value="Registrarse en el Sistema"/></p>
                </fieldset>
            </form>
           
        </div>    
    </div>
</div>
<?php
require_once 'cvista/footer.php';
?>