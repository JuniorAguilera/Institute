<?php

/**
 * @author GinoX
 * @copyright 2013
 */
include_once('MasterConexion.php');

class SuperClass extends MasterConexion {

    private $allvars = array();
    private $my_name;

    function __construct($imput_vars, $imput_name) {
        parent::__construct();
        $this->allvars = $imput_vars;
        $this->my_name = $imput_name;
    }

    function setVar($name, $value) {
        $this->allvars[$name] = $value;
        return true;
    }

    function getVar($name_v) {
        return $this->allvars[$name_v];
    }

    function insertDB() {
        $query = "Insert into " . $this->my_name . " (";
        for ($i = 0; $i < count($this->allvars); $i++) {
            $query.="" . key($this->allvars) . ",";
            next($this->allvars);
        }
        $query = substr($query, 0, -1);
        $query.=") values(";
        reset($this->allvars);
        for ($i = 0; $i < count($this->allvars); $i++) {
            if (current($this->allvars) == NULL) {
                $query.="NULL,";
            } else {
                $query.="'" . utf8_encode(current($this->allvars)) . "',";
            }
            next($this->allvars);
        }
        $query = substr($query, 0, -1);
        $query.=")";
        $this->allvars["id"] = parent::consulta_id($query);
        return $this->allvars["id"];
    }

    function getDB() {
        for ($i = 0; $i < count($this->allvars); $i++) {
            $query = "Select " . key($this->allvars) . " FROM " . $this->my_name . " WHERE id = '" . $this->allvars["id"] . "'";
            $resultado = parent::consulta_arreglo($query);
            $this->allvars[key($this->allvars)] = $resultado[0];
            next($this->allvars);
        }
    }

    function searchDB($rule, $variable_name, $type = 1) {
        //rule = valor a buscar
        //variable_name = variable a comparar
        //type = 1 exacta, 2 aproximada
        if ($type == 1) {
            $query = "Select * from " . $this->my_name . " where " . $variable_name . " = '" . $rule . "'";
            $resultado = parent::consulta_matriz($query);
            return $resultado;
        } else {
            $query = "Select * from " . $this->my_name . " where " . $variable_name . " LIKE '" . $rule . "%'";
            $resultado = parent::consulta_matriz($query);
            return $resultado;
        }
    }

    function deleteDB() {
        $query = "Delete from " . $this->my_name . " WHERE id = '" . $this->allvars["id"] . "' ";
        return parent::consulta_simple($query);
    }

    function updateDB() {
        for ($i = 0; $i < count($this->allvars); $i++) {
            if (current($this->allvars) != NULL) {
                $query = "UPDATE " . $this->my_name . " SET " . key($this->allvars) . " = '" . current($this->allvars) . "' WHERE id = '" . $this->allvars["id"] . "'";
                $resultado = parent::consulta_simple($query);
            }
            next($this->allvars);
        }
        return $resultado;
    }

    function getNumberofRows() {
        $query = "Select * from " . $this->my_name . " ";
        return parent::consulta_cantidad($query);
    }

    function listDB($limit = 10, $pagination = 0) {
        $resultado = array();
        if ($pagination == 0) {
            $query = "Select * from " . $this->my_name . "";
            $resultado = parent::consulta_matriz($query);
            return $resultado;
        } else {
            $total = $this->getNumberofRows();
            $total_paginas = round(($total / $limit), 0, PHP_ROUND_HALF_EVEN);
            $actual = 0;
            $proximo = 10;
            for ($i = 0; $i < $total_paginas; $i++) {
                $query = "Select * from " . $this->my_name . " LIMIT " . $actual . "," . $proximo . "";
                $resultado[$i] = parent::consulta_matriz($query);
                $actual = $actual + 10;
                $proximo = $proximo + 10;
            }
            return $resultado;
        }
    }

    function __destruct() {
        parent::__destruct();
    }

    function returnObject() {
        return $this->allvars;
    }

}

?>