<?php

require_once('include/SuperClass.php');

class experiencia_estudiante extends SuperClass {

    private $inputvars = array();
    private $inputname = 'experiencia_estudiante';

    function __construct($id = NULL, $id_estudiante = NULL, $lugar = NULL, $descripcion = NULL, $ano_ingreso = NULL, $ano_salida = NULL, $id_tipo_experiencia = NULL) {
        $this->inputvars["id"] = $id;
        $this->inputvars["id_estudiante"] = $id_estudiante;
        $this->inputvars["lugar"] = $lugar;
        $this->inputvars["descripcion"] = $descripcion;
        $this->inputvars["ano_ingreso"] = $ano_ingreso;
        $this->inputvars["ano_salida"] = $ano_salida;
        $this->inputvars["id_tipo_experiencia"] = $id_tipo_experiencia;

        parent::__construct($this->inputvars, $this->inputname);
    }

    public function setId($newval) {
        parent::setVar("id", $newval);
    }

    public function getId() {
        parent::getVar("id");
    }

    public function setIdEstudiante($newval) {
        parent::setVar("id_estudiante", $newval);
    }

    public function getIdEstudiante() {
        parent::getVar("id_estudiante");
    }

    public function setLugar($newval) {
        parent::setVar("lugar", $newval);
    }

    public function getLugar() {
        parent::getVar("lugar");
    }

    public function setDescripcion($newval) {
        parent::setVar("descripcion", $newval);
    }

    public function getDescripcion() {
        parent::getVar("descripcion");
    }

    public function setAnoIngreso($newval) {
        parent::setVar("ano_ingreso", $newval);
    }

    public function getAnoIngreso() {
        parent::getVar("ano_ingreso");
    }

    public function setAnoSalida($newval) {
        parent::setVar("ano_salida", $newval);
    }

    public function getAnoSalida() {
        parent::getVar("ano_salida");
    }

    public function setIdTipoExperiencia($newval) {
        parent::setVar("id_tipo_experiencia", $newval);
    }

    public function getIdTipoExperiencia() {
        parent::getVar("id_tipo_experiencia");
    }

}

?>