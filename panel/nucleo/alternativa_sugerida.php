<?php

require_once('include/SuperClass.php');

class alternativa_sugerida extends SuperClass {

    private $inputvars = array();
    private $inputname = 'alternativa_sugerida';

    function __construct($id = NULL, $id_pregunta_encuesta = NULL, $texto = NULL, $id_estudiante = NULL, $fecha = NULL) {
        $this->inputvars["id"] = $id;
        $this->inputvars["id_pregunta_encuesta"] = $id_pregunta_encuesta;
        $this->inputvars["texto"] = $texto;
        $this->inputvars["id_estudiante"] = $id_estudiante;
        $this->inputvars["fecha"] = $fecha;

        parent::__construct($this->inputvars, $this->inputname);
    }

    public function setId($newval) {
        parent::setVar("id", $newval);
    }

    public function getId() {
        return parent::getVar("id");
    }

    public function setIdPreguntaEncuesta($newval) {
        parent::setVar("id_pregunta_encuesta", $newval);
    }

    public function getIdPreguntaEncuesta() {
        return parent::getVar("id_pregunta_encuesta");
    }

    public function setTexto($newval) {
        parent::setVar("texto", $newval);
    }

    public function getTexto() {
        return parent::getVar("texto");
    }

    public function setIdEstudiante($newval) {
        parent::setVar("id_estudiante", $newval);
    }

    public function getIdEstudiante() {
        return parent::getVar("id_estudiante");
    }

    public function setFecha($newval) {
        parent::setVar("fecha", $newval);
    }

    public function getFecha() {
        return parent::getVar("fecha");
    }

}

?>