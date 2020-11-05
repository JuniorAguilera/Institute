<?php

require_once('include/SuperClass.php');

class carrera extends SuperClass {

    private $inputvars = array();
    private $inputname = 'carrera';

    function __construct($id = NULL, $nombre = NULL, $id_tipo_carrera = NULL) {
        $this->inputvars["id"] = $id;
        $this->inputvars["nombre"] = $nombre;
        $this->inputvars["id_tipo_carrera"] = $id_tipo_carrera;

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

    public function setIdTipoCarrera($newval) {
        parent::setVar("id_tipo_carrera", $newval);
    }

    public function getIdTipoCarrera() {
        parent::getVar("id_tipo_carrera");
    }

}

?>