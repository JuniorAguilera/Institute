<?php
	require_once('include/SuperClass.php');
	class pre_estudiante extends SuperClass{
		private $inputvars = array();
		private $inputname = 'pre_estudiante';
        function __construct($id=NULL,$dni=NULL,$nombres=NULL,$apellidos=NULL,$telefono_fijo=NULL,$telefono_celular=NULL,$direccion=NULL,$email=NULL,$id_carrera=NULL)
		{
        $this->inputvars["id"] = $id;
		  $this->inputvars["dni"] = $dni;
		  $this->inputvars["nombres"] = $nombres;
		  $this->inputvars["apellidos"] = $apellidos;
		  $this->inputvars["telefono_fijo"] = $telefono_fijo;
		  $this->inputvars["telefono_celular"] = $telefono_celular;
		  $this->inputvars["direccion"] = $direccion;
		  $this->inputvars["email"] = $email;
		  $this->inputvars["id_carrera"] = $id_carrera;
		  
			parent::__construct($this->inputvars,$this->inputname);
		}
	
          public function setId($newval){
              parent::setVar("id",$newval);
          }
          
          public function getId(){
              return parent::getVar("id");
          }
          public function setDni($newval){
              parent::setVar("dni",$newval);
          }
          
          public function getDni(){
              return parent::getVar("dni");
          }
          public function setNombres($newval){
              parent::setVar("nombres",$newval);
          }
          
          public function getNombres(){
              return parent::getVar("nombres");
          }
          public function setApellidos($newval){
              parent::setVar("apellidos",$newval);
          }
          
          public function getApellidos(){
              return parent::getVar("apellidos");
          }
          public function setTelefonoFijo($newval){
              parent::setVar("telefono_fijo",$newval);
          }
          
          public function getTelefonoFijo(){
              return parent::getVar("telefono_fijo");
          }
          public function setTelefonoCelular($newval){
              parent::setVar("telefono_celular",$newval);
          }
          
          public function getTelefonoCelular(){
              return parent::getVar("telefono_celular");
          }
          public function setDireccion($newval){
              parent::setVar("direccion",$newval);
          }
          
          public function getDireccion(){
              return parent::getVar("direccion");
          }
          public function setEmail($newval){
              parent::setVar("email",$newval);
          }
          
          public function getEmail(){
              return parent::getVar("email");
          }
          public function setIdCarrera($newval){
              parent::setVar("id_carrera",$newval);
          }
          
          public function getIdCarrera(){
              return parent::getVar("id_carrera");
          }
        }?>