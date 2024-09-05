<?php
class InicioModel extends Query{
    public function __construct() {
        parent::__construct();
    }

    public function countEmpleados()
    {
        $sql = "SELECT COUNT(*) AS cantidad_empleados
                FROM tbl_usu WHERE registro_borrado = 'A'";
        return $this->select($sql);
    }

    public function countEvaluaciones()
    {
        $sql = "SELECT COUNT(*) AS cantidad_evaluados
                FROM tbl_proveidos WHERE registro_borrado = 'A'";
        return $this->select($sql);
    }

    public function countCitaciones()
    {
        $sql = "SELECT COUNT(*) AS cantidad_citaciones
                FROM tbl_citaciones WHERE registro_borrado = 'A'";
        return $this->select($sql);
    }

    public function countDictamenes()
    {
        $sql = "SELECT COUNT(*) AS cantidad_dictamenes
                FROM tbl_dictamenes WHERE registro_borrado = 'A'";
        return $this->select($sql);
    }

    public function countPlantillas()
    {
        $sql = "SELECT COUNT(*) AS cantidad_plantillas
                FROM tbl_plantillas";
        return $this->select($sql);
    }

}