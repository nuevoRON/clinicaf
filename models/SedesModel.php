<?php
class SedesModel extends Query{
    public function __construct() {
        parent::__construct();
    }

    public function insertarSede($depatamento,$municipio,$ubicacion) {
        $sql = "INSERT INTO tbl_sedes (fk_departamento,fk_municipio,ubucacion) VALUES(?,?,?)";
        $array = array($depatamento,$municipio,$ubicacion);
        return $this->insertar($sql, $array);
    }

    public function obtenerSede($id)
    {
        $sql = " SELECT * FROM tbl_sedes WHERE id_sede = $id";
        return $this->select($sql);
    }

    public function getSedes()
    {
        $sql = " SELECT * FROM tbl_sedes";
        return $this->selectAll($sql);
    }

    public function eliminarSede($id)
    {
        $sql = " DELETE FROM tbl_sedes WHERE id_sede = $id";
        return $this->select($sql);
    }

    public function actualizarSede($departamento, $municipio, $ubicacion, $id)
    {
        $sql = "UPDATE tbl_sedes SET fk_departamento=?, fk_municipio=?, ubucacion=?   WHERE id_sede=?";
        $array = array($departamento, $municipio, $ubicacion, $id);
        return $this->save($sql, $array);
    }

}