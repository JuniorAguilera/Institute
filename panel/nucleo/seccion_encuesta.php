<?php

require_once('include/SuperClass.php');

class seccion_encuesta extends SuperClass {

    private $inputvars = array();
    private $inputname = 'seccion_encuesta';

    function __construct($id = NULL, $titulo = NULL, $id_encuesta = NULL) {
        $this->inputvars["id"] = $id;
        $this->inputvars["titulo"] = $titulo;
        $this->inputvars["id_encuesta"] = $id_encuesta;

        parent::__construct($this->inputvars, $this->inputname);
    }

    public function setId($newval) {
        parent::setVar("id", $newval);
    }

    public function getId() {
        parent::getVar("id");
    }

    public function setTitulo($newval) {
        parent::setVar("titulo", $newval);
    }

    public function getTitulo() {
        parent::getVar("titulo");
    }

    public function setIdEncuesta($newval) {
        parent::setVar("id_encuesta", $newval);
    }

    public function getIdEncuesta() {
        parent::getVar("id_encuesta");
    }

}

?>