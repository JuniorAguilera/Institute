<?php

require_once('include/SuperClass.php');

class alternativas_preguntas_carrera extends SuperClass {

    private $inputvars = array();
    private $inputname = 'alternativas_preguntas_carrera';

    function __construct($id = NULL, $id_alternativas_pregunta = NULL, $id_carrera = NULL) {
        $this->inputvars["id"] = $id;
        $this->inputvars["id_alternativas_pregunta"] = $id_alternativas_pregunta;
        $this->inputvars["id_carrera"] = $id_carrera;

        parent::__construct($this->inputvars, $this->inputname);
    }

    public function setId($newval) {
        parent::setVar("id", $newval);
    }

    public function getId() {
        parent::getVar("id");
    }

    public function setIdAlternativasPregunta($newval) {
        parent::setVar("id_alternativas_pregunta", $newval);
    }

    public function getIdAlternativasPregunta() {
        parent::getVar("id_alternativas_pregunta");
    }

    public function setIdCarrera($newval) {
        parent::setVar("id_carrera", $newval);
    }

    public function getIdCarrera() {
        parent::getVar("id_carrera");
    }

}

?>