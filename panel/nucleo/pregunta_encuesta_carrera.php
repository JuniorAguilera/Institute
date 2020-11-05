<?php

require_once('include/SuperClass.php');

class pregunta_encuesta_carrera extends SuperClass {

    private $inputvars = array();
    private $inputname = 'pregunta_encuesta_carrera';

    function __construct($id = NULL, $id_pregunta_encuesta = NULL, $id_carrera = NULL) {
        $this->inputvars["id"] = $id;
        $this->inputvars["id_pregunta_encuesta"] = $id_pregunta_encuesta;
        $this->inputvars["id_carrera"] = $id_carrera;

        parent::__construct($this->inputvars, $this->inputname);
    }

    public function setId($newval) {
        parent::setVar("id", $newval);
    }

    public function getId() {
        parent::getVar("id");
    }

    public function setIdPreguntaEncuesta($newval) {
        parent::setVar("id_pregunta_encuesta", $newval);
    }

    public function getIdPreguntaEncuesta() {
        parent::getVar("id_pregunta_encuesta");
    }

    public function setIdCarrera($newval) {
        parent::setVar("id_carrera", $newval);
    }

    public function getIdCarrera() {
        parent::getVar("id_carrera");
    }

}

?>