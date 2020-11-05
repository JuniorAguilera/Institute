<?php require_once('../../globales_sistema.php'); ?>
function insert(){
var id = $('#id').val();

var nombre = $('#nombre').val();

var id_tipo_carrera = $('#id_tipo_carrera').val();

$.post('ws/carrera.php', {op: 'add',id:id,nombre:nombre,id_tipo_carrera:id_tipo_carrera}, function(data) {
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

var nombre = $('#nombre').val();

var id_tipo_carrera = $('#id_tipo_carrera').val();

$.post('ws/carrera.php', {op: 'mod',id:id,nombre:nombre,id_tipo_carrera:id_tipo_carrera}, function(data) {
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
$.post('ws/carrera.php', {op: 'get', id: id}, function(data) {
if(data !== 0){

$('#id').val(data.id);

$('#nombre').val(data.nombre);

$('#id_tipo_carrera').val(data.id_tipo_carrera.id);
$('#txt_id_tipo_carrera').val(data.id_tipo_carrera.<?php
echo $gl_carrera_id_tipo_carrera;
?>);

}
}, 'json');
}
function del(id){
$.post('ws/carrera.php', {op: 'del', id: id}, function(data) {
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

$.post('ws/tipo_carrera.php', {op: 'list'}, function(data) {
if(data != 0){
$('#data_tbl_modal_id_tipo_carrera').html('');
var ht = '';
$.each(data, function(key, value) {
ht += '<tr>';ht += '<td>'+value.id+'</td>';ht += '<td>'+value.nombre+'</td>';
    ht += '<td><a href="#" onclick="sel_id_tipo_carrera('+value.id+')">SEL</a></td>';
    ht += '</tr>';
});
$('#data_tbl_modal_id_tipo_carrera').html(ht);
$('#tbl_modal_id_tipo_carrera').dataTable( {
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

function sel_id_tipo_carrera(id_e){
$.post('ws/tipo_carrera.php', {op: 'get', id:id_e}, function(data) {
if(data != 0){
$('#id_tipo_carrera').val(data.id);
$('#txt_id_tipo_carrera').html(data.<?php
echo $gl_carrera_id_tipo_carrera;
?>);
$('#modal_id_tipo_carrera').modal('hide');
}
}, 'json');
}