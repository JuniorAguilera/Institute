<?php

require_once('include/SuperClass.php');

class estado_estudiante extends SuperClass {

    private $inputvars = array();
    private $inputname = 'estado_estudiante';

    function __construct($id = NULL, $nombre = NULL) {
        $this->inputvars["id"] = $id;
        $this->inputvars["nombre"] = $nombre;

        parent::__construct($this->inputvars, $this->inputname);
    }

    public function setId($newval) {
        parent::setVar("id", $newval);
    }

    public function getId() {
        parent::getVar("id");
    }

    public function setNombre($newval) {
        parent::setVar("nombre", $newval);
    }

    public function getNombre() {
        parent::getVar("nombre");
    }

}

?>