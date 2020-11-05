<?php

require_once('include/SuperClass.php');

class seccion_encuesta_carrera extends SuperClass {

    private $inputvars = array();
    private $inputname = 'seccion_encuesta_carrera';

    function __construct($id = NULL, $id_seccion_encuesta = NULL, $id_carrera = NULL) {
        $this->inputvars["id"] = $id;
        $this->inputvars["id_seccion_encuesta"] = $id_seccion_encuesta;
        $this->inputvars["id_carrera"] = $id_carrera;

        parent::__construct($this->inputvars, $this->inputname);
    }

    public function setId($newval) {
        parent::setVar("id", $newval);
    }

    public function getId() {
        parent::getVar("id");
    }

    public function setIdSeccionEncuesta($newval) {
        parent::setVar("id_seccion_encuesta", $newval);
    }

    public function getIdSeccionEncuesta() {
        parent::getVar("id_seccion_encuesta");
    }

    public function setIdCarrera($newval) {
        parent::setVar("id_carrera", $newval);
    }

    public function getIdCarrera() {
        parent::getVar("id_carrera");
    }

}

?>