<?php

require_once('include/SuperClass.php');

class administrador extends SuperClass {

    private $inputvars = array();
    private $inputname = 'administrador';

    function __construct($id = NULL, $user = NULL, $pass = NULL, $habilitado = NULL) {
        $this->inputvars["id"] = $id;
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