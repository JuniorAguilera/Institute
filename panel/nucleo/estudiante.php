<?php

require_once('include/SuperClass.php');

class estudiante extends SuperClass {

    private $inputvars = array();
    private $inputname = 'estudiante';

    function __construct($id = NULL, $nombres = NULL, $apellidos = NULL, $telefono_fijo = NULL, $telefono_celular = NULL, $direccion = NULL, $email = NULL, $dni = NULL, $cod_universitario = NULL, $ano_ingreso = NULL, $ano_salida = NULL, $id_carrera = NULL, $id_estado_estudiante = NULL, $user = NULL, $pass = NULL, $habilitado = NULL) {
        $this->inputvars["id"] = $id;
        $this->inputvars["nombres"] = $nombres;
        $this->inputvars["apellidos"] = $apellidos;
        $this->inputvars["telefono_fijo"] = $telefono_fijo;
        $this->inputvars["telefono_celular"] = $telefono_celular;
        $this->inputvars["direccion"] = $direccion;
        $this->inputvars["email"] = $email;
        $this->inputvars["dni"] = $dni;
        $this->inputvars["cod_universitario"] = $cod_universitario;
        $this->inputvars["ano_ingreso"] = $ano_ingreso;
        $this->inputvars["ano_salida"] = $ano_salida;
        $this->inputvars["id_carrera"] = $id_carrera;
        $this->inputvars["id_estado_estudiante"] = $id_estado_estudiante;
        $this->inputvars["user"] = $user;
        $this->inputvars["pass"] = $pass;
        $this->inputvars["habilitado"] = $habilitado;

        parent::__construct($this->inputvars, $this->inputname);
    }

    public function setId($newval) {
        parent::setVar("id", $newval);
    }

    public function getId() {
        parent::getVar("id");
    }

    public function setNombres($newval) {
        parent::setVar("nombres", $newval);
    }

    public function getNombres() {
        parent::getVar("nombres");
    }

    public function setApellidos($newval) {
        parent::setVar("apellidos", $newval);
    }

    public function getApellidos() {
        parent::getVar("apellidos");
    }

    public function setTelefonoFijo($newval) {
        parent::setVar("telefono_fijo", $newval);
    }

    public function getTelefonoFijo() {
        parent::getVar("telefono_fijo");
    }

    public function setTelefonoCelular($newval) {
        parent::setVar("telefono_celular", $newval);
    }

    public function getTelefonoCelular() {
        parent::getVar("telefono_celular");
    }

    public function setDireccion($newval) {
        parent::setVar("direccion", $newval);
    }

    public function getDireccion() {
        parent::getVar("direccion");
    }

    public function setEmail($newval) {
        parent::setVar("email", $newval);
    }

    public function getEmail() {
        parent::getVar("email");
    }

    public function setDni($newval) {
        parent::setVar("dni", $newval);
    }

    public function getDni() {
        parent::getVar("dni");
    }

    public function setCodUniversitario($newval) {
        parent::setVar("cod_universitario", $newval);
    }

    public function getCodUniversitario() {
        parent::getVar("cod_universitario");
    }

    public function setAnoIngreso($newval) {
        parent::setVar("ano_ingreso", $newval);
    }

    public function getAnoIngreso() {
        parent::getVar("ano_ingreso");
    }

    public function setAnoSalida($newval) {
        parent::setVar("ano_salida", $newval);
    }

    public function getAnoSalida() {
        parent::getVar("ano_salida");
    }

    public function setIdCarrera($newval) {
        parent::setVar("id_carrera", $newval);
    }

    public function getIdCarrera() {
        parent::getVar("id_carrera");
    }

    public function setIdEstadoEstudiante($newval) {
        parent::setVar("id_estado_estudiante", $newval);
    }

    public function getIdEstadoEstudiante() {
        parent::getVar("id_estado_estudiante");
    }

    public function setUser($newval) {
        parent::setVar("user", $newval);
    }

    public function getUser() {
        parent::getVar("user");
    }

    public function setPass($newval) {
        parent::setVar("pass", $newval);
    }

    public function getPass() {
        parent::getVar("pass");
    }

    public function setHabilitado($newval) {
        parent::setVar("habilitado", $newval);
    }

    public function getHabilitado() {
        parent::getVar("habilitado");
    }

}

?>