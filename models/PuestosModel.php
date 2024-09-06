<?php
class PuestosModel extends Query{
    public function __construct() {
        parent::__construct();
    }

    public function insertarPuestos($puesto,$estado) {
        $sql = "INSERT INTO tbl_puestos (nom_puesto,estado) VALUES(?,?)";
        $array = array($puesto,$estado);
        
        $result = $this->insertar($sql, $array);

        $this->cerrarConexion();
        return $result;
    }

    public function obtenerPuestos($id)
    {
        $sql = " SELECT * FROM tbl_puestos WHERE id_puesto = $id";
        $result = $this->select($sql);

        $this->cerrarConexion();
        return $result;
    }

    public function getPuestos()
    {
        $sql = "SELECT * FROM tbl_puestos";
        $result = $this->selectAll($sql);

        $this->cerrarConexion();
        return $result;
    }
    
    public function getPuestosSelect()
    {
        $sql = "SELECT id_puesto, nom_puesto FROM tbl_puestos";
        $result = $this->selectAll($sql);

        $this->cerrarConexion();
        return $result;
    }

    public function getEstados()
    {
        $sql = "SELECT * FROM tbl_puestos";
        $result = $this->selectAll($sql);

        $this->cerrarConexion();
        return $result;
    }

    public function eliminarPuestos($id)
    {
        $sql = " DELETE FROM tbl_puestos WHERE id_puesto = $id";
        $result = $this->select($sql);

        $this->cerrarConexion();
        return $result;
    }

    public function actualizarPuestos($puesto,$estado, $id)
    {
        $sql = "UPDATE tbl_puestos SET nom_puesto=?, estado=?   WHERE id_puesto=?";
        $array = array($puesto,$estado, $id);
        return $this->save($sql, $array);

        $this->cerrarConexion();
        return $result;
    }

}