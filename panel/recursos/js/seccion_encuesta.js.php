<?php require_once('../../globales_sistema.php'); ?>
function insert(){
var id = $('#id').val();

var titulo = $('#titulo').val();

var id_encuesta = $('#id_encuesta').val();

$.post('ws/seccion_encuesta.php', {op: 'add',id:id,titulo:titulo,id_encuesta:id_encuesta}, function(data) {
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

var titulo = $('#titulo').val();

var id_encuesta = $('#id_encuesta').val();

$.post('ws/seccion_encuesta.php', {op: 'mod',id:id,titulo:titulo,id_encuesta:id_encuesta}, function(data) {
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
$.post('ws/seccion_encuesta.php', {op: 'get', id: id}, function(data) {
if(data !== 0){

$('#id').val(data.id);

$('#titulo').val(data.titulo);

$('#id_encuesta').val(data.id_encuesta.id);
$('#txt_id_encuesta').val(data.id_encuesta.<?php
echo $gl_seccion_encuesta_id_encuesta;
?>);

}
}, 'json');
}
function del(id){
$.post('ws/seccion_encuesta.php', {op: 'del', id: id}, function(data) {
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

function sel_id_encuesta(id_e){
$.post('ws/encuesta.php', {op: 'get', id:id_e}, function(data) {
if(data != 0){
$('#id_encuesta').val(data.id);
$('#txt_id_encuesta').html(data.<?php
echo $gl_seccion_encuesta_id_encuesta;
?>);
$('#modal_id_encuesta').modal('hide');
}
}, 'json');
}