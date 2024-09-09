<?php
class FiscaliasModel extends Query{
    public function __construct() {
        parent::__construct();
    }

    public function insertarFiscalia($nombre) {
        $sql = "INSERT INTO tbl_dependencia (nom_dependencia, registro_borrado) VALUES(?,?)";
        $array = array($nombre,'A');
        
        $result = $this->insertar($sql, $array);

        $this->cerrarConexion();
        return $result;
    }

    public function obtenerFiscalia($id)
    {
        $sql = " SELECT nom_dependencia FROM tbl_dependencia WHERE id_dependencia = $id";
        $result = $this->select($sql);

        $this->cerrarConexion();
        return $result;
    }

    public function getFiscalias()
    {
        $sql = " SELECT * FROM tbl_dependencia WHERE registro_borrado = 'A'";
        $result = $this->selectAll($sql);

        $this->cerrarConexion();
        return $result;
    }

    public function eliminarFiscalia($id)
    {
        $sql = "UPDATE tbl_dependencia SET registro_borrado='I' WHERE id_dependencia=?";
        $array = array($id);
        return $this->save($sql, $array);

        $this->cerrarConexion();
        return $result;
    }

    public function actualizarFiscalia($nombre, $id)
    {
        $sql = "UPDATE tbl_dependencia SET nom_dependencia=?  WHERE id_dependencia=?";
        $array = array($nombre, $id);
        return $this->save($sql, $array);

        $this->cerrarConexion();
        return $result;
    }

}