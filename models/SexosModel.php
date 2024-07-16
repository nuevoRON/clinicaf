<?php
class SexosModel extends Query{
    public function __construct() {
        parent::__construct();
    }

    public function insertarSexo($nombre) {
        $sql = "INSERT INTO tbl_sexo (nom_sexo) VALUES(?)";
        $array = array($nombre);
        return $this->insertar($sql, $array);
    }

    public function obtenerSexo($id)
    {
        $sql = " SELECT * FROM tbl_sexo WHERE id_sexo = $id";
        return $this->select($sql);
    }

    public function getSexos()
    {
        $sql = " SELECT * FROM tbl_sexo";
        return $this->selectAll($sql);
    }

    public function eliminarSexo($id)
    {
        $sql = " DELETE FROM tbl_sexo WHERE id_sexo = $id";
        return $this->select($sql);
    }

    public function actualizarSexo($nombre, $id)
    {
        $sql = "UPDATE tbl_sexo SET nom_sexo=?  WHERE id_sexo=?";
        $array = array($nombre, $id);
        return $this->save($sql, $array);
    }

}