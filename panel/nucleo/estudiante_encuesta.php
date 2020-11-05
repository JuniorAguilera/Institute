<?php

require_once('include/SuperClass.php');

class estudiante_encuesta extends SuperClass {

    private $inputvars = array();
    private $inputname = 'estudiante_encuesta';

    function __construct($id = NULL, $id_estudiante = NULL, $id_encuesta = NULL, $fecha = NULL) {
        $this->inputvars["id"] = $id;
        $this->inputvars["id_estudiante"] = $id_estudiante;
        $this->inputvars["id_encuesta"] = $id_encuesta;
        $this->inputvars["fecha"] = $fecha;

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

    public function setIdEncuesta($newval) {
        parent::setVar("id_encuesta", $newval);
    }

    public function getIdEncuesta() {
        parent::getVar("id_encuesta");
    }

    public function setFecha($newval) {
        parent::setVar("fecha", $newval);
    }

    public function getFecha() {
        parent::getVar("fecha");
    }
    
    public function verifica_encuesta($ideg,$iee){
        $query = "SELECT * from estudiante_encuesta where id_estudiante = '".$ideg."' AND id_encuesta = '".$iee."'";
        $res = parent::consulta_matriz($query);
        return $res;
    }

}

?>