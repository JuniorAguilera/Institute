<?php require_once('../../globales_sistema.php'); ?>
function insert(){
var id = $('#id').val();

var titulo = $('#titulo').val();

var fecha_limite = $('#fecha_limite').val();

$.post('ws/encuesta.php', {op: 'add',id:id,titulo:titulo,fecha_limite:fecha_limite}, function(data) {
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

var fecha_limite = $('#fecha_limite').val();

$.post('ws/encuesta.php', {op: 'mod',id:id,titulo:titulo,fecha_limite:fecha_limite}, function(data) {
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
$.post('ws/encuesta.php', {op: 'get', id: id}, function(data) {
if(data !== 0){

$('#id').val(data.id);

$('#titulo').val(data.titulo);

$('#fecha_limite').val(data.fecha_limite);

}
}, 'json');
}
function del(id){
$.post('ws/encuesta.php', {op: 'del', id: id}, function(data) {
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

$('#fecha_limite').datepicker({dateFormat: 'yy-mm-dd',
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
