<?php require_once('../../globales_sistema.php'); ?>
function insert(){
var id = $('#id').val();

var vacantes = $('#vacantes').val();

var titulo = $('#titulo').val();

var descripcion = $('#descripcion').val();

var lugar = $('#lugar').val();

var experiencia = $('#experiencia').val();

var id_tipo_oferta_laboral = $('#id_tipo_oferta_laboral').val();

var id_empresa = $('#id_empresa').val();

var fecha = $('#fecha').val();

$.post('ws/oferta_laboral.php', {op: 'add',id:id,vacantes:vacantes,titulo:titulo,descripcion:descripcion,lugar:lugar,experiencia:experiencia,id_tipo_oferta_laboral:id_tipo_oferta_laboral,id_empresa:id_empresa,fecha:fecha}, function(data) {
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

var vacantes = $('#vacantes').val();

var titulo = $('#titulo').val();

var descripcion = $('#descripcion').val();

var lugar = $('#lugar').val();

var experiencia = $('#experiencia').val();

var id_tipo_oferta_laboral = $('#id_tipo_oferta_laboral').val();

var id_empresa = $('#id_empresa').val();

var fecha = $('#fecha').val();

$.post('ws/oferta_laboral.php', {op: 'mod',id:id,vacantes:vacantes,titulo:titulo,descripcion:descripcion,lugar:lugar,experiencia:experiencia,id_tipo_oferta_laboral:id_tipo_oferta_laboral,id_empresa:id_empresa,fecha:fecha}, function(data) {
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
$.post('ws/oferta_laboral.php', {op: 'get', id: id}, function(data) {
if(data !== 0){

$('#id').val(data.id);

$('#vacantes').val(data.vacantes);

$('#titulo').val(data.titulo);

$('#descripcion').val(data.descripcion);

$('#lugar').val(data.lugar);

$('#experiencia').val(data.experiencia);

$('#id_tipo_oferta_laboral').val(data.id_tipo_oferta_laboral.id);
$('#txt_id_tipo_oferta_laboral').val(data.id_tipo_oferta_laboral.<?php
echo $gl_oferta_laboral_id_tipo_oferta_laboral;
?>);

$('#id_empresa').val(data.id_empresa.id);
$('#txt_id_empresa').val(data.id_empresa.<?php
echo $gl_oferta_laboral_id_empresa;
?>);

$('#fecha').val(data.fecha);

}
}, 'json');
}
function del(id){
$.post('ws/oferta_laboral.php', {op: 'del', id: id}, function(data) {
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

$.post('ws/tipo_oferta_laboral.php', {op: 'list'}, function(data) {
if(data != 0){
$('#data_tbl_modal_id_tipo_oferta_laboral').html('');
var ht = '';
$.each(data, function(key, value) {
ht += '<tr>';ht += '<td>'+value.id+'</td>';ht += '<td>'+value.nombre+'</td>';
    ht += '<td><a href="#" onclick="sel_id_tipo_oferta_laboral('+value.id+')">SEL</a></td>';
    ht += '</tr>';
});
$('#data_tbl_modal_id_tipo_oferta_laboral').html(ht);
$('#tbl_modal_id_tipo_oferta_laboral').dataTable( {
sDom: "<'row'<'span6'l><'span6'f>r>t<'row'<'span6'i><'span6'p>>",
sPaginationType: "bootstrap",
oLanguage: {
"sLengthMenu": "_MENU_ records per page"
}});
}
}, 'json');
$.post('ws/empresa.php', {op: 'list'}, function(data) {
if(data != 0){
$('#data_tbl_modal_id_empresa').html('');
var ht = '';
$.each(data, function(key, value) {
ht += '<tr>';ht += '<td>'+value.id+'</td>';ht += '<td>'+value.razon_social+'</td>';ht += '<td>'+value.ruc+'</td>';ht += '<td>'+value.direccion+'</td>';ht += '<td>'+value.telefono+'</td>';ht += '<td>'+value.correo+'</td>';
    ht += '<td><a href="#" onclick="sel_id_empresa('+value.id+')">SEL</a></td>';
    ht += '</tr>';
});
$('#data_tbl_modal_id_empresa').html(ht);
$('#tbl_modal_id_empresa').dataTable( {
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

function sel_id_tipo_oferta_laboral(id_e){
$.post('ws/tipo_oferta_laboral.php', {op: 'get', id:id_e}, function(data) {
if(data != 0){
$('#id_tipo_oferta_laboral').val(data.id);
$('#txt_id_tipo_oferta_laboral').html(data.<?php
echo $gl_oferta_laboral_id_tipo_oferta_laboral;
?>);
$('#modal_id_tipo_oferta_laboral').modal('hide');
}
}, 'json');
}
function sel_id_empresa(id_e){
$.post('ws/empresa.php', {op: 'get', id:id_e}, function(data) {
if(data != 0){
$('#id_empresa').val(data.id);
$('#txt_id_empresa').html(data.<?php
echo $gl_oferta_laboral_id_empresa;
?>);
$('#modal_id_empresa').modal('hide');
}
}, 'json');
}