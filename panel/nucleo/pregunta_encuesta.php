<?php

require_once('include/SuperClass.php');

class pregunta_encuesta extends SuperClass {

    private $inputvars = array();
    private $inputname = 'pregunta_encuesta';

    function __construct($id = NULL, $enunciado = NULL, $id_tipo_pregunta = NULL, $id_seccion_encuesta = NULL, $id_pregunta_encuesta = NULL, $id_pregunta_encuesta_1 = NULL, $id_pregunta_encuesta_2 = NULL, $id_pregunta_encuesta_3 = NULL) {
        $this->inputvars["id"] = $id;
        $this->inputvars["enunciado"] = $enunciado;
        $this->inputvars["id_tipo_pregunta"] = $id_tipo_pregunta;
        $this->inputvars["id_seccion_encuesta"] = $id_seccion_encuesta;
        $this->inputvars["id_pregunta_encuesta"] = $id_pregunta_encuesta;
        $this->inputvars["id_pregunta_encuesta_1"] = $id_pregunta_encuesta_1;
        $this->inputvars["id_pregunta_encuesta_2"] = $id_pregunta_encuesta_2;
        $this->inputvars["id_pregunta_encuesta_3"] = $id_pregunta_encuesta_3;

        parent::__construct($this->inputvars, $this->inputname);
    }

    public function setId($newval) {
        parent::setVar("id", $newval);
    }

    public function getId() {
        parent::getVar("id");
    }

    public function setEnunciado($newval) {
        parent::setVar("enunciado", $newval);
    }

    public function getEnunciado() {
        parent::getVar("enunciado");
    }

    public function setIdTipoPregunta($newval) {
        parent::setVar("id_tipo_pregunta", $newval);
    }

    public function getIdTipoPregunta() {
        parent::getVar("id_tipo_pregunta");
    }

    public function setIdSeccionEncuesta($newval) {
        parent::setVar("id_seccion_encuesta", $newval);
    }

    public function getIdSeccionEncuesta() {
        parent::getVar("id_seccion_encuesta");
    }

    public function setIdPreguntaEncuesta($newval) {
        parent::setVar("id_pregunta_encuesta", $newval);
    }

    public function getIdPreguntaEncuesta() {
        parent::getVar("id_pregunta_encuesta");
    }

}

?>