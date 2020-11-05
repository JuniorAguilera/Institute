<?php require_once('../../globales_sistema.php'); ?>
function insert(){
var id = $('#id').val();

var id_estudiante = $('#id_estudiante').val();

var id_encuesta = $('#id_encuesta').val();

var fecha = $('#fecha').val();

$.post('ws/estudiante_encuesta.php', {op: 'add',id:id,id_estudiante:id_estudiante,id_encuesta:id_encuesta,fecha:fecha}, function(data) {
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

var id_estudiante = $('#id_estudiante').val();

var id_encuesta = $('#id_encuesta').val();

var fecha = $('#fecha').val();

$.post('ws/estudiante_encuesta.php', {op: 'mod',id:id,id_estudiante:id_estudiante,id_encuesta:id_encuesta,fecha:fecha}, function(data) {
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
$.post('ws/estudiante_encuesta.php', {op: 'get', id: id}, function(data) {
if(data !== 0){

$('#id').val(data.id);

$('#id_estudiante').val(data.id_estudiante.id);
$('#txt_id_estudiante').val(data.id_estudiante.<?php
echo $gl_estudiante_encuesta_id_estudiante;
?>);

$('#id_encuesta').val(data.id_encuesta.id);
$('#txt_id_encuesta').val(data.id_encuesta.<?php
echo $gl_estudiante_encuesta_id_encuesta;
?>);

$('#fecha').val(data.fecha);

}
}, 'json');
}
function del(id){
$.post('ws/estudiante_encuesta.php', {op: 'del', id: id}, function(data) {
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

$.post('ws/estudiante.php', {op: 'list'}, function(data) {
if(data != 0){
$('#data_tbl_modal_id_estudiante').html('');
var ht = '';
$.each(data, function(key, value) {
ht += '<tr>';ht += '<td>'+value.id+'</td>';ht += '<td>'+value.nombres+'</td>';ht += '<td>'+value.apellidos+'</td>';ht += '<td>'+value.telefono_fijo+'</td>';ht += '<td>'+value.telefono_celular+'</td>';ht += '<td>'+value.direccion+'</td>';ht += '<td>'+value.email+'</td>';ht += '<td>'+value.dni+'</td>';ht += '<td>'+value.cod_universitario+'</td>';ht += '<td>'+value.ano_ingreso+'</td>';ht += '<td>'+value.ano_salida+'</td>';ht += '<td>'+value.id_carrera.<?php
        echo $gl_estudiante_id_carrera;
        ?>+'</td>';ht += '<td>'+value.id_estado_estudiante.<?php
        echo $gl_estudiante_id_estado_estudiante;
        ?>+'</td>';ht += '<td>'+value.user+'</td>';ht += '<td>'+value.pass+'</td>';ht += '<td>'+value.habilitado+'</td>';
    ht += '<td><a href="#" onclick="sel_id_estudiante('+value.id+')">SEL</a></td>';
    ht += '</tr>';
});
$('#data_tbl_modal_id_estudiante').html(ht);
$('#tbl_modal_id_estudiante').dataTable( {
sDom: "<'row'<'span6'l><'span6'f>r>t<'row'<'span6'i><'span6'p>>",
sPaginationType: "bootstrap",
oLanguage: {
"sLengthMenu": "_MENU_ records per page"
}});
}
}, 'json');
$.post('ws/encuesta.php', {op: 'list'}, function(data) {
if(data != 0){
$('#data_tbl_modal_id_encuesta').html('');
var ht = '';
$.each(data, function(key, value) {
ht += '<tr>';ht += '<td>'+value.id+'</td>';ht += '<td>'+value.titulo+'</td>';ht += '<td>'+value.fecha_limite+'</td>';
    ht += '<td><a href="#" onclick="sel_id_encuesta('+value.id+')">SEL</a></td>';
    ht += '</tr>';
});
$('#data_tbl_modal_id_encuesta').html(ht);
$('#tbl_modal_id_encuesta').dataTable( {
sDom: "<'row'<'span6'l><'span6'f>r>t<'row'<'span6'i><'span6'p>>",
sPaginationType: "bootstrap",
oLanguage: {
"sLengthMenu": "_MENU_ records per page"
}});
}
}, 'json');
$('#fecha').datepicker({dateFormat: 'yy-mm-dd',
changeMonth: true,
changeYear: true
});
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

function sel_id_estudiante(id_e){
$.post('ws/estudiante.php', {op: 'get', id:id_e}, function(data) {
if(data != 0){
$('#id_estudiante').val(data.id);
$('#txt_id_estudiante').html(data.<?php
echo $gl_estudiante_encuesta_id_estudiante;
?>);
$('#modal_id_estudiante').modal('hide');
}
}, 'json');
}
function sel_id_encuesta(id_e){
$.post('ws/encuesta.php', {op: 'get', id:id_e}, function(data) {
if(data != 0){
$('#id_encuesta').val(data.id);
$('#txt_id_encuesta').html(data.<?php
echo $gl_estudiante_encuesta_id_encuesta;
?>);
$('#modal_id_encuesta').modal('hide');
}
}, 'json');
}