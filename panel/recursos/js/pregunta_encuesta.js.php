<?php require_once('../../globales_sistema.php'); ?>
function insert(){
var id = $('#id').val();

var enunciado = $('#enunciado').val();

var id_tipo_pregunta = $('#id_tipo_pregunta').val();

var id_seccion_encuesta = $('#id_seccion_encuesta').val();

var id_pregunta_encuesta = $('#id_pregunta_encuesta').val();

var id_pregunta_encuesta_1 = $('#id_pregunta_encuesta1').val();

var id_pregunta_encuesta_2 = $('#id_pregunta_encuesta2').val();

var id_pregunta_encuesta_3 = $('#id_pregunta_encuesta3').val();

$.post('ws/pregunta_encuesta.php', {op: 'add',id:id,enunciado:enunciado,id_tipo_pregunta:id_tipo_pregunta,id_seccion_encuesta:id_seccion_encuesta,id_pregunta_encuesta:id_pregunta_encuesta,id_pregunta_encuesta_1:id_pregunta_encuesta_1,id_pregunta_encuesta_2:id_pregunta_encuesta_2,id_pregunta_encuesta_3:id_pregunta_encuesta_3}, function(data) {
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

var enunciado = $('#enunciado').val();

var id_tipo_pregunta = $('#id_tipo_pregunta').val();

var id_seccion_encuesta = $('#id_seccion_encuesta').val();

var id_pregunta_encuesta = $('#id_pregunta_encuesta').val();

var id_pregunta_encuesta_1 = $('#id_pregunta_encuesta1').val();

var id_pregunta_encuesta_2 = $('#id_pregunta_encuesta2').val();

var id_pregunta_encuesta_3 = $('#id_pregunta_encuesta3').val();

$.post('ws/pregunta_encuesta.php', {op: 'mod',id:id,enunciado:enunciado,id_tipo_pregunta:id_tipo_pregunta,id_seccion_encuesta:id_seccion_encuesta,id_pregunta_encuesta:id_pregunta_encuesta,id_pregunta_encuesta_1:id_pregunta_encuesta_1,id_pregunta_encuesta_2:id_pregunta_encuesta_2,id_pregunta_encuesta_3:id_pregunta_encuesta_3}, function(data) {
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
$.post('ws/pregunta_encuesta.php', {op: 'get', id: id}, function(data) {
    if(data !== 0){

    $('#id').val(data.id);

    $('#enunciado').val(data.enunciado);

    sel_id_tipo_pregunta(data.id_tipo_pregunta.id);
    sel_id_seccion_encuesta(data.id_seccion_encuesta.id);

    }
    }, 'json');
}

function del(id){
$.post('ws/pregunta_encuesta.php', {op: 'del', id: id}, function(data) {
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

$.post('ws/tipo_pregunta.php', {op: 'list'}, function(data) {
if(data != 0){
$('#data_tbl_modal_id_tipo_pregunta').html('');
var ht = '';
$.each(data, function(key, value) {
ht += '<tr>';ht += '<td>'+value.id+'</td>';ht += '<td>'+value.nombre+'</td>';
    ht += '<td><a href="#" onclick="sel_id_tipo_pregunta('+value.id+')">SEL</a></td>';
    ht += '</tr>';
});
$('#data_tbl_modal_id_tipo_pregunta').html(ht);
$('#tbl_modal_id_tipo_pregunta').dataTable( {
sDom: "<'row'<'span6'l><'span6'f>r>t<'row'<'span6'i><'span6'p>>",
sPaginationType: "bootstrap",
oLanguage: {
"sLengthMenu": "_MENU_ records per page"
}});
}
}, 'json');
$.post('ws/seccion_encuesta.php', {op: 'list'}, function(data) {
if(data != 0){
$('#data_tbl_modal_id_seccion_encuesta').html('');
var ht = '';
$.each(data, function(key, value) {
ht += '<tr>';ht += '<td>'+value.id+'</td>';ht += '<td>'+value.titulo+'</td>';ht += '<td>'+value.id_encuesta.<?php
        echo $gl_seccion_encuesta_id_encuesta;
        ?>+'</td>';
    ht += '<td><a href="#" onclick="sel_id_seccion_encuesta('+value.id+')">SEL</a></td>';
    ht += '</tr>';
});
$('#data_tbl_modal_id_seccion_encuesta').html(ht);
$('#tbl_modal_id_seccion_encuesta').dataTable( {
sDom: "<'row'<'span6'l><'span6'f>r>t<'row'<'span6'i><'span6'p>>",
sPaginationType: "bootstrap",
oLanguage: {
"sLengthMenu": "_MENU_ records per page"
}});
}
}, 'json');

$.post('ws/pregunta_encuesta.php', {op: 'list'}, function(data) {
if(data != 0){
$('#data_tbl_modal_id_pregunta_encuesta').html('');
var ht = '';
$.each(data, function(key, value) {
ht += '<tr>';ht += '<td>'+value.id+'</td>';ht += '<td>'+value.enunciado+'</td>';ht += '<td>'+value.id_tipo_pregunta.<?php
        echo $gl_pregunta_encuesta_id_tipo_pregunta;
        ?>+'</td>';ht += '<td>'+value.id_seccion_encuesta.<?php
        echo $gl_pregunta_encuesta_id_seccion_encuesta;
        ?>+'</td>';
    ht += '<td><a href="#" onclick="sel_id_pregunta_encuesta('+value.id+')">SEL</a></td>';
    ht += '</tr>';
});
$('#data_tbl_modal_id_pregunta_encuesta').html(ht);
$('#tbl_modal_id_pregunta_encuesta').dataTable( {
sDom: "<'row'<'span6'l><'span6'f>r>t<'row'<'span6'i><'span6'p>>",
sPaginationType: "bootstrap",
oLanguage: {
"sLengthMenu": "_MENU_ records per page"
}});
}
}, 'json');

$.post('ws/pregunta_encuesta.php', {op: 'list'}, function(data) {
if(data != 0){
$('#data_tbl_modal_id_pregunta_encuesta1').html('');
var ht = '';
$.each(data, function(key, value) {
ht += '<tr>';ht += '<td>'+value.id+'</td>';ht += '<td>'+value.enunciado+'</td>';ht += '<td>'+value.id_tipo_pregunta.<?php
        echo $gl_pregunta_encuesta_id_tipo_pregunta;
        ?>+'</td>';ht += '<td>'+value.id_seccion_encuesta.<?php
        echo $gl_pregunta_encuesta_id_seccion_encuesta;
        ?>+'</td>';
    ht += '<td><a href="#" onclick="sel_id_pregunta_encuesta1('+value.id+')">SEL</a></td>';
    ht += '</tr>';
});
$('#data_tbl_modal_id_pregunta_encuesta1').html(ht);
$('#tbl_modal_id_pregunta_encuesta1').dataTable( {
sDom: "<'row'<'span6'l><'span6'f>r>t<'row'<'span6'i><'span6'p>>",
sPaginationType: "bootstrap",
oLanguage: {
"sLengthMenu": "_MENU_ records per page"
}});
}
}, 'json');

$.post('ws/pregunta_encuesta.php', {op: 'list'}, function(data) {
if(data != 0){
$('#data_tbl_modal_id_pregunta_encuesta2').html('');
var ht = '';
$.each(data, function(key, value) {
ht += '<tr>';ht += '<td>'+value.id+'</td>';ht += '<td>'+value.enunciado+'</td>';ht += '<td>'+value.id_tipo_pregunta.<?php
        echo $gl_pregunta_encuesta_id_tipo_pregunta;
        ?>+'</td>';ht += '<td>'+value.id_seccion_encuesta.<?php
        echo $gl_pregunta_encuesta_id_seccion_encuesta;
        ?>+'</td>';
    ht += '<td><a href="#" onclick="sel_id_pregunta_encuesta2('+value.id+')">SEL</a></td>';
    ht += '</tr>';
});
$('#data_tbl_modal_id_pregunta_encuesta2').html(ht);
$('#tbl_modal_id_pregunta_encuesta2').dataTable( {
sDom: "<'row'<'span6'l><'span6'f>r>t<'row'<'span6'i><'span6'p>>",
sPaginationType: "bootstrap",
oLanguage: {
"sLengthMenu": "_MENU_ records per page"
}});
}
}, 'json');

$.post('ws/pregunta_encuesta.php', {op: 'list'}, function(data) {
if(data != 0){
$('#data_tbl_modal_id_pregunta_encuesta3').html('');
var ht = '';
$.each(data, function(key, value) {
ht += '<tr>';ht += '<td>'+value.id+'</td>';ht += '<td>'+value.enunciado+'</td>';ht += '<td>'+value.id_tipo_pregunta.<?php
        echo $gl_pregunta_encuesta_id_tipo_pregunta;
        ?>+'</td>';ht += '<td>'+value.id_seccion_encuesta.<?php
        echo $gl_pregunta_encuesta_id_seccion_encuesta;
        ?>+'</td>';
    ht += '<td><a href="#" onclick="sel_id_pregunta_encuesta3('+value.id+')">SEL</a></td>';
    ht += '</tr>';
});
$('#data_tbl_modal_id_pregunta_encuesta3').html(ht);
$('#tbl_modal_id_pregunta_encuesta3').dataTable( {
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

function sel_id_tipo_pregunta(id_e){
    $.post('ws/tipo_pregunta.php', {op: 'get', id:id_e}, function(data) {
        if(data != 0){
            $('#id_tipo_pregunta').val(data.id);
            $('#txt_id_tipo_pregunta').html(data.<?php echo $gl_pregunta_encuesta_id_tipo_pregunta;?>);
            $('#modal_id_tipo_pregunta').modal('hide');
            switch(data.id){
                case '3':
                    $("#t3").show('fast');
                break;
                default:
                    $("#t3").hide('fast');
                break;
            }
        }
    }, 'json');
}

function sel_id_seccion_encuesta(id_e){
$.post('ws/seccion_encuesta.php', {op: 'get', id:id_e}, function(data) {
if(data != 0){
$('#id_seccion_encuesta').val(data.id);
$('#txt_id_seccion_encuesta').html(data.<?php
echo $gl_pregunta_encuesta_id_seccion_encuesta;
?>);
$('#modal_id_seccion_encuesta').modal('hide');
}
}, 'json');
}

function sel_id_pregunta_encuesta(id_e){
$.post('ws/pregunta_encuesta.php', {op: 'get', id:id_e}, function(data) {
if(data != 0){
$('#id_pregunta_encuesta').val(data.id);
$('#txt_id_pregunta_encuesta').html(data.<?php
echo $gl_pregunta_encuesta_id_pregunta_encuesta;
?>);
$('#modal_id_pregunta_encuesta').modal('hide');
}
}, 'json');
}

function sel_id_pregunta_encuesta1(id_e){
$.post('ws/pregunta_encuesta.php', {op: 'get', id:id_e}, function(data) {
if(data != 0){
$('#id_pregunta_encuesta1').val(data.id);
$('#txt_id_pregunta_encuesta1').html(data.<?php echo $gl_pregunta_encuesta_id_pregunta_encuesta;?>);
$('#modal_id_pregunta_encuesta1').modal('hide');
}
}, 'json');
}

function sel_id_pregunta_encuesta2(id_e){
$.post('ws/pregunta_encuesta.php', {op: 'get', id:id_e}, function(data) {
if(data != 0){
$('#id_pregunta_encuesta2').val(data.id);
$('#txt_id_pregunta_encuesta2').html(data.<?php echo $gl_pregunta_encuesta_id_pregunta_encuesta;?>);
$('#modal_id_pregunta_encuesta2').modal('hide');
}
}, 'json');
}

function sel_id_pregunta_encuesta3(id_e){
$.post('ws/pregunta_encuesta.php', {op: 'get', id:id_e}, function(data) {
if(data != 0){
$('#id_pregunta_encuesta3').val(data.id);
$('#txt_id_pregunta_encuesta3').html(data.<?php echo $gl_pregunta_encuesta_id_pregunta_encuesta;?>);
$('#modal_id_pregunta_encuesta3').modal('hide');
}
}, 'json');
}