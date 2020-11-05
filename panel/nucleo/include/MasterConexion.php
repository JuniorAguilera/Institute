<?php

class MasterConexion {

    private $abierta;
    private $host = "localhost";
    private $usuario = "root";
    private $contra = "";
    private $base = "seguimiento";

    public function __construct() {
        $this->abierta = (mysql_connect($this->host, $this->usuario, $this->contra)) or die(mysql_error());
        mysql_select_db($this->base, $this->abierta) or die(mysql_error());
    }

    public function consulta_simple($consulta) {
        if (mysql_query($consulta, $this->abierta)) {
            return 1;
        } else {
            return 0;
        }
    }

    public function consulta_id($consulta) {
        if (mysql_query($consulta, $this->abierta)) {
            return mysql_insert_id($this->abierta);
        } else {
            return 0;
        }
    }

    public function consulta_afectados($consulta) {
        if (mysql_query($consulta, $this->abierta)) {
            return mysql_affected_rows($this->abierta);
        } else {
            return 0;
        }
    }

    public function consulta_cantidad($consulta) {
        if ($resultado = mysql_query($consulta, $this->abierta)) {
            return mysql_num_rows($resultado);
        } else {
            return 0;
        }
    }

    public function consulta_arreglo($consulta) {
        if ($resultado = mysql_query($consulta, $this->abierta)) {
            if ($deshilachado = mysql_fetch_array($resultado)) {
                return array_map('utf8_decode', $deshilachado);
            } else {
                return 0;
            }
        } else {
            return 0;
        }
    }

    public function consulta_matriz($consulta) {
        $matriz = array();
        $resultado = mysql_query($consulta, $this->abierta);
        if ($deshilachar = mysql_fetch_array($resultado)) {
            $matriz[0] = array_map('utf8_decode', $deshilachar);
            $i = 1;
            while ($deshilachar = mysql_fetch_array($resultado)) {
                $matriz[$i] = array_map('utf8_decode', $deshilachar);
                $i = $i + 1;
            }
            return $matriz;
        } else {
            return 0;
        }
    }

    function __destruct() {
        
    }

}

?>