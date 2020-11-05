<?php require_once('../../globales_sistema.php'); ?>
function insert(){
var archivo = document.getElementById("img");
var img = 0;
try {
img = archivo.files[0];
}
catch (err)
{
}
var razon_social = $('#razon_social').val();
var ruc = $('#ruc').val();
var direccion = $('#direccion').val();
var telefono = $('#telefono').val();
var correo = $('#correo').val();
var data = new FormData();
data.append('op','add');
data.append('razon_social', razon_social);
data.append('ruc', ruc);
data.append('direccion', direccion);
data.append('telefono', telefono);
data.append('correo', correo);
data.append('ima', img);
var request = $.ajax({
url: 'ws/empresa.php',
type: 'POST',
contentType: false,
data: data,
processData: false,
cache: false
});
request.done(function() {
$('#msuccess').show('fast').delay(4000).hide('fast');
location.reload();
});
request.fail(function() {
$('#merror').show('fast').delay(4000).hide('fast');
});
}

function update(){
var archivo = document.getElementById("img");
var img = 0;
try {
img = archivo.files[0];
}
catch (err)
{
}
var id = $('#id').val();
var razon_social = $('#razon_social').val();
var ruc = $('#ruc').val();
var direccion = $('#direccion').val();
var telefono = $('#telefono').val();
var correo = $('#correo').val();
var data = new FormData();
data.append('op','mod');
data.append('id',id);
data.append('razon_social', razon_social);
data.append('ruc', ruc);
data.append('direccion', direccion);
data.append('telefono', telefono);
data.append('correo', correo);
data.append('ima', img);
var request = $.ajax({
url: 'ws/empresa.php',
type: 'POST',
contentType: false,
data: data,
processData: false,
cache: false
});
request.done(function() {
$('#msuccess').show('fast').delay(4000).hide('fast');
location.reload();
});
request.fail(function() {
$('#merror').show('fast').delay(4000).hide('fast');
});
}


function sel(id){
$.post('ws/empresa.php', {op: 'get', id: id}, function(data) {
if(data !== 0){

$('#id').val(data.id);

$('#razon_social').val(data.razon_social);

$('#ruc').val(data.ruc);

$('#direccion').val(data.direccion);

$('#telefono').val(data.telefono);

$('#correo').val(data.correo);

}
}, 'json');
}
function del(id){
$.post('ws/empresa.php', {op: 'del', id: id}, function(data) {
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
