<?php
class ModulosModel extends Query{
    public function __construct() {
        parent::__construct();
    }

    public function insertarModulo($nombre,$descripcion,$fechaCreacion,$creadoPor){
        $sql = "INSERT INTO tbl_modulos (nombre, fecha_creacion, creado_por, registro_borrado, descripcion) VALUES(?,?,?,?,?)";
        $array = array($nombre,$fechaCreacion,$creadoPor, 'A' ,$descripcion);
        return $this->insertar($sql, $array);
    }

    public function obtenerModulo($id)
    {
        $sql = " SELECT nombre, descripcion FROM tbl_modulos WHERE id = $id";
        return $this->select($sql);
    }

    public function getModulos()
    {
        $sql = " SELECT id, nombre, descripcion FROM tbl_modulos WHERE registro_borrado = 'A'";
        return $this->selectAll($sql);
    }


    public function getModulosSelect()
    {
        $sql = " SELECT id, nombre FROM tbl_modulos WHERE registro_borrado = 'A'";
        return $this->selectAll($sql);
    }

    public function eliminarModulo($id)
    {
        $sql = " UPDATE tbl_modulos SET registro_borrado = 'I' WHERE id = $id";
        return $this->select($sql);
    }

    public function actualizarModulo($nombre,$descripcion,$fechaModificacion,$modificadoPor, $id)
    {
        $sql = "UPDATE tbl_modulos SET nombre=?, fecha_modificacion= ?, descripcion=?,
        modificado_por=?  WHERE id=?";
        $array = array($nombre, $fechaModificacion, $descripcion, $modificadoPor, $id);
        return $this->save($sql, $array);
    }

}