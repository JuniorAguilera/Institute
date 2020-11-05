<?php require_once('../../globales_sistema.php'); ?>
function insert(){
var id = $('#id').val();

var user = $('#user').val();

var pass = $('#pass').val();

var habilitado = $('#habilitado').find('option:selected').val();

$.post('ws/administrador.php', {op: 'add',id:id,user:user,pass:pass,habilitado:habilitado}, function(data) {
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

var user = $('#user').val();

var pass = $('#pass').val();

var habilitado = $('#habilitado').find('option:selected').val();

$.post('ws/administrador.php', {op: 'mod',id:id,user:user,pass:pass,habilitado:habilitado}, function(data) {
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
$.post('ws/administrador.php', {op: 'get', id: id}, function(data) {
if(data !== 0){

$('#id').val(data.id);

$('#user').val(data.user);

$('#pass').val(data.pass);

$('#habilitado option[value="+data.habilitado+"]').attr('selected', true);

}
}, 'json');
}
function del(id){
$.post('ws/administrador.php', {op: 'del', id: id}, function(data) {
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
