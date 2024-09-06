<?php
class InicioModel extends Query{
    public function __construct() {
        parent::__construct();
    }

    public function countEmpleados()
    {
        $sql = "SELECT COUNT(*) AS cantidad_empleados
                FROM tbl_usu WHERE registro_borrado = 'A'";
        $result = $this->select($sql);

        $this->cerrarConexion();
        return $result;
    }

    public function countEvaluaciones()
    {
        $sql = "SELECT COUNT(*) AS cantidad_evaluados
                FROM tbl_proveidos WHERE registro_borrado = 'A'";
        $result = $this->select($sql);

        $this->cerrarConexion();
        return $result;
    }

    public function countCitaciones()
    {
        $sql = "SELECT COUNT(*) AS cantidad_citaciones
                FROM tbl_citaciones WHERE registro_borrado = 'A'";
        $result = $this->select($sql);

        $this->cerrarConexion();
        return $result;
    }

    public function countDictamenes()
    {
        $sql = "SELECT COUNT(*) AS cantidad_dictamenes
                FROM tbl_dictamenes WHERE registro_borrado = 'A'";
        $result = $this->select($sql);

        $this->cerrarConexion();
        return $result;
    }

    public function countPlantillas()
    {
        $sql = "SELECT COUNT(*) AS cantidad_plantillas
                FROM tbl_plantillas";
        $result = $this->select($sql);

        $this->cerrarConexion();
        return $result;
    }

}