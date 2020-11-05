<?php

require_once('include/SuperClass.php');

class tipo_pregunta extends SuperClass {

    private $inputvars = array();
    private $inputname = 'tipo_pregunta';

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