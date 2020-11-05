<?php

require_once('include/SuperClass.php');

class encuesta_carrera extends SuperClass {

    private $inputvars = array();
    private $inputname = 'encuesta_carrera';

    function __construct($id = NULL, $id_encuesta = NULL, $id_carrera = NULL) {
        $this->inputvars["id"] = $id;
        $this->inputvars["id_encuesta"] = $id_encuesta;
        $this->inputvars["id_carrera"] = $id_carrera;

        parent::__construct($this->inputvars, $this->inputname);
    }

    public function setId($newval) {
        parent::setVar("id", $newval);
    }

    public function getId() {
        parent::getVar("id");
    }

    public function setIdEncuesta($newval) {
        parent::setVar("id_encuesta", $newval);
    }

    public function getIdEncuesta() {
        parent::getVar("id_encuesta");
    }

    public function setIdCarrera($newval) {
        parent::setVar("id_carrera", $newval);
    }

    public function getIdCarrera() {
        parent::getVar("id_carrera");
    }

}

?>