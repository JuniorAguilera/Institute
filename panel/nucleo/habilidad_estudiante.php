<?php

require_once('include/SuperClass.php');

class habilidad_estudiante extends SuperClass {

    private $inputvars = array();
    private $inputname = 'habilidad_estudiante';

    function __construct($id = NULL, $id_estudiante = NULL, $habilidad = NULL, $nivel = NULL) {
        $this->inputvars["id"] = $id;
        $this->inputvars["id_estudiante"] = $id_estudiante;
        $this->inputvars["habilidad"] = $habilidad;
        $this->inputvars["nivel"] = $nivel;

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

    public function setHabilidad($newval) {
        parent::setVar("habilidad", $newval);
    }

    public function getHabilidad() {
        parent::getVar("habilidad");
    }

    public function setNivel($newval) {
        parent::setVar("nivel", $newval);
    }

    public function getNivel() {
        parent::getVar("nivel");
    }

}

?>