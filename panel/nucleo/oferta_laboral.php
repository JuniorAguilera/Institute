<?php

require_once('include/SuperClass.php');

class oferta_laboral extends SuperClass {

    private $inputvars = array();
    private $inputname = 'oferta_laboral';

    function __construct($id = NULL, $vacantes = NULL, $titulo = NULL, $descripcion = NULL, $lugar = NULL, $experiencia = NULL, $id_tipo_oferta_laboral = NULL, $id_empresa = NULL, $fecha = NULL) {
        $this->inputvars["id"] = $id;
        $this->inputvars["vacantes"] = $vacantes;
        $this->inputvars["titulo"] = $titulo;
        $this->inputvars["descripcion"] = $descripcion;
        $this->inputvars["lugar"] = $lugar;
        $this->inputvars["experiencia"] = $experiencia;
        $this->inputvars["id_tipo_oferta_laboral"] = $id_tipo_oferta_laboral;
        $this->inputvars["id_empresa"] = $id_empresa;
        $this->inputvars["fecha"] = $fecha;

        parent::__construct($this->inputvars, $this->inputname);
    }

    public function setId($newval) {
        parent::setVar("id", $newval);
    }

    public function getId() {
        parent::getVar("id");
    }

    public function setVacantes($newval) {
        parent::setVar("vacantes", $newval);
    }

    public function getVacantes() {
        parent::getVar("vacantes");
    }

    public function setTitulo($newval) {
        parent::setVar("titulo", $newval);
    }

    public function getTitulo() {
        parent::getVar("titulo");
    }

    public function setDescripcion($newval) {
        parent::setVar("descripcion", $newval);
    }

    public function getDescripcion() {
        parent::getVar("descripcion");
    }

    public function setLugar($newval) {
        parent::setVar("lugar", $newval);
    }

    public function getLugar() {
        parent::getVar("lugar");
    }

    public function setExperiencia($newval) {
        parent::setVar("experiencia", $newval);
    }

    public function getExperiencia() {
        parent::getVar("experiencia");
    }

    public function setIdTipoOfertaLaboral($newval) {
        parent::setVar("id_tipo_oferta_laboral", $newval);
    }

    public function getIdTipoOfertaLaboral() {
        parent::getVar("id_tipo_oferta_laboral");
    }

    public function setIdEmpresa($newval) {
        parent::setVar("id_empresa", $newval);
    }

    public function getIdEmpresa() {
        parent::getVar("id_empresa");
    }

    public function setFecha($newval) {
        parent::setVar("fecha", $newval);
    }

    public function getFecha() {
        parent::getVar("fecha");
    }

}

?>