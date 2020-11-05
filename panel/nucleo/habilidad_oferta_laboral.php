<?php

require_once('include/SuperClass.php');

class habilidad_oferta_laboral extends SuperClass {

    private $inputvars = array();
    private $inputname = 'habilidad_oferta_laboral';

    function __construct($id = NULL, $nombre = NULL, $nivel = NULL, $id_oferta_laboral = NULL) {
        $this->inputvars["id"] = $id;
        $this->inputvars["nombre"] = $nombre;
        $this->inputvars["nivel"] = $nivel;
        $this->inputvars["id_oferta_laboral"] = $id_oferta_laboral;

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

    public function setNivel($newval) {
        parent::setVar("nivel", $newval);
    }

    public function getNivel() {
        parent::getVar("nivel");
    }

    public function setIdOfertaLaboral($newval) {
        parent::setVar("id_oferta_laboral", $newval);
    }

    public function getIdOfertaLaboral() {
        parent::getVar("id_oferta_laboral");
    }

}

?>