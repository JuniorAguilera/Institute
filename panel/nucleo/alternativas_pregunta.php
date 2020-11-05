<?php

require_once('include/SuperClass.php');

class alternativas_pregunta extends SuperClass {

    private $inputvars = array();
    private $inputname = 'alternativas_pregunta';

    function __construct($id = NULL, $id_pregunta_encuesta = NULL, $texto = NULL) {
        $this->inputvars["id"] = $id;
        $this->inputvars["id_pregunta_encuesta"] = $id_pregunta_encuesta;
        $this->inputvars["texto"] = $texto;

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

    public function setTexto($newval) {
        parent::setVar("texto", $newval);
    }

    public function getTexto() {
        parent::getVar("texto");
    }

}

?>