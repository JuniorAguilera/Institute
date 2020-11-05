<?php

require_once('include/SuperClass.php');

class encuesta extends SuperClass {

    private $inputvars = array();
    private $inputname = 'encuesta';

    function __construct($id = NULL, $titulo = NULL, $fecha_limite = NULL) {
        $this->inputvars["id"] = $id;
        $this->inputvars["titulo"] = $titulo;
        $this->inputvars["fecha_limite"] = $fecha_limite;

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

    public function setFechaLimite($newval) {
        parent::setVar("fecha_limite", $newval);
    }

    public function getFechaLimite() {
        parent::getVar("fecha_limite");
    }

}

?>