<?php
class DependenciasModel extends Query{
    public function __construct() {
        parent::__construct();
    }

    public function getDependencias()
    {
        $sql = "SELECT * from tbl_dependencia WHERE registro_borrado = 'A'";
        $result = $this->selectAll($sql);

        $this->cerrarConexion();
        return $result;
    }


    public function getDepartamentos()
    {
        $sql = "SELECT * from tbl_departamento";
        $result = $this->selectAll($sql);

        $this->cerrarConexion();
        return $result;
    }


    public function getMunicipios($id)
    {
        $sql = " SELECT * FROM tbl_municipio WHERE id_departamento = $id";
        $result = $this->selectAll($sql);

        $this->cerrarConexion();
        return $result;
    }


    public function registrarPuesto($nombres,$descripcion,$salario) {
        $sql = "INSERT INTO tbl_puesto (NOMBRE,DESCRIPCION,SALARIO) VALUES(?,?,?)";
        $array = array($nombres,$descripcion,$salario);
        $result = $this->insertar($sql, $array);

        $this->cerrarConexion();
        return $result;
    }

    public function editarPuesto($id)
    {
        $sql = " SELECT * FROM tbl_puesto WHERE ID_PUESTO = $id";
        $result = $this->select($sql);

        $this->cerrarConexion();
        return $result;
    }

    public function eliminarPuesto($id)
    {
        $sql = " DELETE FROM tbl_puesto WHERE ID_PUESTO = $id";
        $result = $this->select($sql);

        $this->cerrarConexion();
        return $result;
    }

    public function actualizarPuesto($nombres,$descripcion,$salario,$id)
    {
        $sql = "UPDATE tbl_puesto SET NOMBRE=?, DESCRIPCION=?, SALARIO=? WHERE ID_PUESTO=?";
        $array = array($nombres, $descripcion,$salario,$id);
        $result = $this->save($sql, $array);

        $this->cerrarConexion();
        return $result;
    }

}