<?php
class PuestosModel extends Query{
    public function __construct() {
        parent::__construct();
    }

    public function insertarPuestos($puesto,$estado) {
        $sql = "INSERT INTO tbl_puestos (nom_puesto,estado) VALUES(?,?)";
        $array = array($puesto,$estado);
        return $this->insertar($sql, $array);
    }

    public function obtenerPuestos($id)
    {
        $sql = " SELECT * FROM tbl_puestos WHERE id_puesto = $id";
        return $this->select($sql);
    }

    public function getPuestos()
    {
        $sql = "SELECT * FROM tbl_puestos";
        return $this->selectAll($sql);
    }
    


    public function getEstados()
    {
        $sql = "SELECT * FROM tbl_estados";
        return $this->selectAll($sql);
    }

    public function eliminarPuestos($id)
    {
        $sql = " DELETE FROM tbl_puestos WHERE id_puesto = $id";
        return $this->select($sql);
    }

    public function actualizarPuestos($puesto,$estado, $id)
    {
        $sql = "UPDATE tbl_puestos SET nom_puesto=?, estsdo=?   WHERE id_puesto=?";
        $array = array($puesto,$estado, $id);
        return $this->save($sql, $array);
    }

}