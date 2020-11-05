<?php

require_once('include/SuperClass.php');

class empresa extends SuperClass {

    private $inputvars = array();
    private $inputname = 'empresa';

    function __construct($id = NULL, $razon_social = NULL, $ruc = NULL, $direccion = NULL, $telefono = NULL, $correo = NULL) {
        $this->inputvars["id"] = $id;
        $this->inputvars["razon_social"] = $razon_social;
        $this->inputvars["ruc"] = $ruc;
        $this->inputvars["direccion"] = $direccion;
        $this->inputvars["telefono"] = $telefono;
        $this->inputvars["correo"] = $correo;

        parent::__construct($this->inputvars, $this->inputname);
    }

    public function setId($newval) {
        parent::setVar("id", $newval);
    }

    public function getId() {
        parent::getVar("id");
    }

    public function setRazonSocial($newval) {
        parent::setVar("razon_social", $newval);
    }

    public function getRazonSocial() {
        parent::getVar("razon_social");
    }

    public function setRuc($newval) {
        parent::setVar("ruc", $newval);
    }

    public function getRuc() {
        parent::getVar("ruc");
    }

    public function setDireccion($newval) {
        parent::setVar("direccion", $newval);
    }

    public function getDireccion() {
        parent::getVar("direccion");
    }

    public function setTelefono($newval) {
        parent::setVar("telefono", $newval);
    }

    public function getTelefono() {
        parent::getVar("telefono");
    }

    public function setCorreo($newval) {
        parent::setVar("correo", $newval);
    }

    public function getCorreo() {
        parent::getVar("correo");
    }

}

?>