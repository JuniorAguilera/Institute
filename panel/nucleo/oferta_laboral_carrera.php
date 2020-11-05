<?php

require_once('include/SuperClass.php');

class oferta_laboral_carrera extends SuperClass {

    private $inputvars = array();
    private $inputname = 'oferta_laboral_carrera';

    function __construct($id = NULL, $id_oferta_laboral = NULL, $id_carrera = NULL) {
        $this->inputvars["id"] = $id;
        $this->inputvars["id_oferta_laboral"] = $id_oferta_laboral;
        $this->inputvars["id_carrera"] = $id_carrera;

        parent::__construct($this->inputvars, $this->inputname);
    }

    public function setId($newval) {
        parent::setVar("id", $newval);
    }

    public function getId() {
        parent::getVar("id");
    }

    public function setIdOfertaLaboral($newval) {
        parent::setVar("id_oferta_laboral", $newval);
    }

    public function getIdOfertaLaboral() {
        parent::getVar("id_oferta_laboral");
    }

    public function setIdCarrera($newval) {
        parent::setVar("id_carrera", $newval);
    }

    public function getIdCarrera() {
        parent::getVar("id_carrera");
    }

}

?>