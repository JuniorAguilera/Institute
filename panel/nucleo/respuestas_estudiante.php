<?php

require_once('include/SuperClass.php');

class respuestas_estudiante extends SuperClass {

    private $inputvars = array();
    private $inputname = 'respuestas_estudiante';

    function __construct($id = NULL, $id_estudiante = NULL, $id_pregunta_encuesta = NULL, $respuesta = NULL) {
        $this->inputvars["id"] = $id;
        $this->inputvars["id_estudiante"] = $id_estudiante;
        $this->inputvars["id_pregunta_encuesta"] = $id_pregunta_encuesta;
        $this->inputvars["respuesta"] = $respuesta;

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

    public function setIdPreguntaEncuesta($newval) {
        parent::setVar("id_pregunta_encuesta", $newval);
    }

    public function getIdPreguntaEncuesta() {
        parent::getVar("id_pregunta_encuesta");
    }

    public function setRespuesta($newval) {
        parent::setVar("respuesta", $newval);
    }

    public function getRespuesta() {
        parent::getVar("respuesta");
    }

}

?>