<?php require_once('../../globales_sistema.php'); ?>
function insert(){
var id = $('#id').val();

var nombres = $('#nombres').val();

var apellidos = $('#apellidos').val();

var telefono_fijo = $('#telefono_fijo').val();

var telefono_celular = $('#telefono_celular').val();

var direccion = $('#direccion').val();

var email = $('#email').val();

var dni = $('#dni').val();

var ano_ingreso = $('#ano_ingreso').val();

var ano_salida = $('#ano_salida').val();

var id_carrera = $('#id_carrera').val();

var id_estado_estudiante = $('#id_estado_estudiante').val();

var user = $('#user').val();

var pass = $('#pass').val();

var habilitado = $('#habilitado').find('option:selected').val();

$.post('ws/estudiante.php', {op: 'add',id:id,nombres:nombres,apellidos:apellidos,telefono_fijo:telefono_fijo,telefono_celular:telefono_celular,direccion:direccion,email:email,dni:dni,ano_ingreso:ano_ingreso,ano_salida:ano_salida,id_carrera:id_carrera,id_estado_estudiante:id_estado_estudiante,user:user,pass:pass,habilitado:habilitado}, function(data) {
if(data === 0){
$('#merror').show('fast').delay(4000).hide('fast');
}
else{
$('#msuccess').show('fast').delay(4000).hide('fast');
location.reload();
}
}, 'json');
}

function update(){
var id = $('#id').val();

var nombres = $('#nombres').val();

var apellidos = $('#apellidos').val();

var telefono_fijo = $('#telefono_fijo').val();

var telefono_celular = $('#telefono_celular').val();

var direccion = $('#direccion').val();

var email = $('#email').val();

var dni = $('#dni').val();

var ano_ingreso = $('#ano_ingreso').val();

var ano_salida = $('#ano_salida').val();

var id_carrera = $('#id_carrera').val();

var id_estado_estudiante = $('#id_estado_estudiante').val();

var user = $('#user').val();

var pass = $('#pass').val();

var habilitado = $('#habilitado').find('option:selected').val();

$.post('ws/estudiante.php', {op: 'mod',id:id,nombres:nombres,apellidos:apellidos,telefono_fijo:telefono_fijo,telefono_celular:telefono_celular,direccion:direccion,email:email,dni:dni,ano_ingreso:ano_ingreso,ano_salida:ano_salida,id_carrera:id_carrera,id_estado_estudiante:id_estado_estudiante,user:user,pass:pass,habilitado:habilitado}, function(data) {
if(data === 0){
$('#merror').show('fast').delay(4000).hide('fast');
}
else{
$('#msuccess').show('fast').delay(4000).hide('fast');
location.reload();
}
}, 'json');
}

function sel(id){
$.post('ws/estudiante.php', {op: 'get', id: id}, function(data) {
if(data !== 0){

$('#id').val(data.id);

$('#nombres').val(data.nombres);

$('#apellidos').val(data.apellidos);

$('#telefono_fijo').val(data.telefono_fijo);

$('#telefono_celular').val(data.telefono_celular);

$('#direccion').val(data.direccion);

$('#email').val(data.email);

$('#dni').val(data.dni);

$('#ano_ingreso').val(data.ano_ingreso);

$('#ano_salida').val(data.ano_salida);

$('#id_carrera').val(data.id_carrera.id);
$('#txt_id_carrera').val(data.id_carrera.<?php
echo $gl_estudiante_id_carrera;
?>);

$('#id_estado_estudiante').val(data.id_estado_estudiante.id);
$('#txt_id_estado_estudiante').val(data.id_estado_estudiante.<?php
echo $gl_estudiante_id_estado_estudiante;
?>);

$('#user').val(data.user);

$('#pass').val(data.pass);

$("#habilitado option[value="+data.habilitado+"]").attr('selected', true);

}
}, 'json');
}

function del(id){
$.post('ws/estudiante.php', {op: 'del', id: id}, function(data) {
if(data === 0){
$('#merror').show('fast').delay(4000).hide('fast');
}
else{
$('#msuccess').show('fast').delay(4000).hide('fast');
location.reload();
}
}, 'json');
}

$(document).ready(function() {
var tbl = $('#tb').dataTable( {
sDom: "<'row'<'span6'l><'span6'f>r>t<'row'<'span6'i><'span6'p>>",
sPaginationType: "bootstrap",
oLanguage: {
"sLengthMenu": "_MENU_ records per page"
}});
tbl.fnSort( [ [0,'desc'] ] );

$.post('ws/carrera.php', {op: 'list'}, function(data) {
if(data != 0){
$('#data_tbl_modal_id_carrera').html('');
var ht = '';
$.each(data, function(key, value) {
ht += '<tr>';ht += '<td>'+value.id+'</td>';ht += '<td>'+value.nombre+'</td>';ht += '<td>'+value.id_tipo_carrera.<?php
        echo $gl_carrera_id_tipo_carrera;
        ?>+'</td>';
    ht += '<td><a href="#" onclick="sel_id_carrera('+value.id+')">SEL</a></td>';
    ht += '</tr>';
});
$('#data_tbl_modal_id_carrera').html(ht);
$('#tbl_modal_id_carrera').dataTable( {
sDom: "<'row'<'span6'l><'span6'f>r>t<'row'<'span6'i><'span6'p>>",
sPaginationType: "bootstrap",
oLanguage: {
"sLengthMenu": "_MENU_ records per page"
}});
}
}, 'json');
$.post('ws/estado_estudiante.php', {op: 'list'}, function(data) {
if(data != 0){
$('#data_tbl_modal_id_estado_estudiante').html('');
var ht = '';
$.each(data, function(key, value) {
ht += '<tr>';ht += '<td>'+value.id+'</td>';ht += '<td>'+value.nombre+'</td>';
    ht += '<td><a href="#" onclick="sel_id_estado_estudiante('+value.id+')">SEL</a></td>';
    ht += '</tr>';
});
$('#data_tbl_modal_id_estado_estudiante').html(ht);
$('#tbl_modal_id_estado_estudiante').dataTable( {
sDom: "<'row'<'span6'l><'span6'f>r>t<'row'<'span6'i><'span6'p>>",
sPaginationType: "bootstrap",
oLanguage: {
"sLengthMenu": "_MENU_ records per page"
}});
}
}, 'json');
});

function save(){
var vid = $('#id').val();
if(vid === '0')
{
insert();
}
else
{
update();
}
}

function sel_id_carrera(id_e){
$.post('ws/carrera.php', {op: 'get', id:id_e}, function(data) {
if(data != 0){
$('#id_carrera').val(data.id);
$('#txt_id_carrera').html(data.<?php
echo $gl_estudiante_id_carrera;
?>);
$('#modal_id_carrera').modal('hide');
}
}, 'json');
}
function sel_id_estado_estudiante(id_e){
$.post('ws/estado_estudiante.php', {op: 'get', id:id_e}, function(data) {
if(data != 0){
$('#id_estado_estudiante').val(data.id);
$('#txt_id_estado_estudiante').html(data.<?php
echo $gl_estudiante_id_estado_estudiante;
?>);
$('#modal_id_estado_estudiante').modal('hide');
}
}, 'json');
}