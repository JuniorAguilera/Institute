<?php require_once('../../globales_sistema.php'); ?>
function insert(){
var id = $('#id').val();

var id_alternativas_pregunta = $('#id_alternativas_pregunta').val();

var id_carrera = $('#id_carrera').val();

$.post('ws/alternativas_preguntas_carrera.php', {op: 'add',id:id,id_alternativas_pregunta:id_alternativas_pregunta,id_carrera:id_carrera}, function(data) {
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

var id_alternativas_pregunta = $('#id_alternativas_pregunta').val();

var id_carrera = $('#id_carrera').val();

$.post('ws/alternativas_preguntas_carrera.php', {op: 'mod',id:id,id_alternativas_pregunta:id_alternativas_pregunta,id_carrera:id_carrera}, function(data) {
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
$.post('ws/alternativas_preguntas_carrera.php', {op: 'get', id: id}, function(data) {
if(data !== 0){

$('#id').val(data.id);

$('#id_alternativas_pregunta').val(data.id_alternativas_pregunta.id);
$('#txt_id_alternativas_pregunta').val(data.id_alternativas_pregunta.<?php
echo $gl_alternativas_preguntas_carrera_id_alternativas_pregunta;
?>);

$('#id_carrera').val(data.id_carrera.id);
$('#txt_id_carrera').val(data.id_carrera.<?php
echo $gl_alternativas_preguntas_carrera_id_carrera;
?>);

}
}, 'json');
}
function del(id){
$.post('ws/alternativas_preguntas_carrera.php', {op: 'del', id: id}, function(data) {
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

$.post('ws/alternativas_pregunta.php', {op: 'list'}, function(data) {
if(data != 0){
$('#data_tbl_modal_id_alternativas_pregunta').html('');
var ht = '';
$.each(data, function(key, value) {
ht += '<tr>';ht += '<td>'+value.id+'</td>';ht += '<td>'+value.id_pregunta_encuesta.<?php
        echo $gl_alternativas_pregunta_id_pregunta_encuesta;
        ?>+'</td>';ht += '<td>'+value.texto+'</td>';
    ht += '<td><a href="#" onclick="sel_id_alternativas_pregunta('+value.id+')">SEL</a></td>';
    ht += '</tr>';
});
$('#data_tbl_modal_id_alternativas_pregunta').html(ht);
$('#tbl_modal_id_alternativas_pregunta').dataTable( {
sDom: "<'row'<'span6'l><'span6'f>r>t<'row'<'span6'i><'span6'p>>",
sPaginationType: "bootstrap",
oLanguage: {
"sLengthMenu": "_MENU_ records per page"
}});
}
}, 'json');
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

function sel_id_alternativas_pregunta(id_e){
$.post('ws/alternativas_pregunta.php', {op: 'get', id:id_e}, function(data) {
if(data != 0){
$('#id_alternativas_pregunta').val(data.id);
$('#txt_id_alternativas_pregunta').html(data.<?php
echo $gl_alternativas_preguntas_carrera_id_alternativas_pregunta;
?>);
$('#modal_id_alternativas_pregunta').modal('hide');
}
}, 'json');
}
function sel_id_carrera(id_e){
$.post('ws/carrera.php', {op: 'get', id:id_e}, function(data) {
if(data != 0){
$('#id_carrera').val(data.id);
$('#txt_id_carrera').html(data.<?php
echo $gl_alternativas_preguntas_carrera_id_carrera;
?>);
$('#modal_id_carrera').modal('hide');
}
}, 'json');
}