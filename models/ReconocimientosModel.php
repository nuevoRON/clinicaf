<?php
class ReconocimientosModel extends Query{
    public function __construct() {
        parent::__construct();
    }

    public function getReconocimientos()
    {
        $sql = "SELECT * from tbl_reconocimiento";
        return $this->selectAll($sql);
    }

    public function registrarPuesto($nombres,$descripcion,$salario) {
        $sql = "INSERT INTO tbl_puesto (NOMBRE,DESCRIPCION,SALARIO) VALUES(?,?,?)";
        $array = array($nombres,$descripcion,$salario);
        return $this->insertar($sql, $array);
    }

    public function editarPuesto($id)
    {
        $sql = " SELECT * FROM tbl_puesto WHERE ID_PUESTO = $id";
        return $this->select($sql);
    }

    public function eliminarPuesto($id)
    {
        $sql = " DELETE FROM tbl_puesto WHERE ID_PUESTO = $id";
        return $this->select($sql);
    }

    public function actualizarPuesto($nombres,$descripcion,$salario,$id)
    {
        $sql = "UPDATE tbl_puesto SET NOMBRE=?, DESCRIPCION=?, SALARIO=? WHERE ID_PUESTO=?";
        $array = array($nombres, $descripcion,$salario,$id);
        return $this->save($sql, $array);
    }

}