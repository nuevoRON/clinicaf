<?php
class SedesModel extends Query{
    public function __construct() {
        parent::__construct();
    }

    public function insertarSede($depatamento,$municipio,$ubicacion,$cod_alfabetico, $cod_numerico) {
        $sql = "INSERT INTO tbl_sedes (fk_departamento,fk_municipio,ubicacion,cod_alfabetico,cod_numerico) VALUES(?,?,?,?,?)";
        $array = array($depatamento,$municipio,$ubicacion,$cod_alfabetico, $cod_numerico);
        
        $result = $this->insertar($sql, $array);

        $this->cerrarConexion();
        return $result;
    }

    public function obtenerSede($id)
    {
        $sql = " SELECT * FROM tbl_sedes WHERE id_sede = $id";
        $result = $this->select($sql);

        $this->cerrarConexion();
        return $result;
    }

    public function getSedes()
    {
        $sql = " SELECT s.id_sede,
                        d.nombre_departamento,
                        m.nombre_municipio, 
                        s.ubicacion,
                        s.cod_alfabetico,
                        s.cod_numerico
                        FROM tbl_sedes s
                INNER JOIN tbl_departamento d on d.id_departamento = s.fk_departamento
                INNER JOIN tbl_municipio m on m.id_municipio = s.fk_municipio";
        $result = $this->selectAll($sql);

        $this->cerrarConexion();
        return $result;
    }

    public function eliminarSede($id)
    {
        $sql = " DELETE FROM tbl_sedes WHERE id_sede = $id";
        $result = $this->select($sql);

        $this->cerrarConexion();
        return $result;
    }

    public function actualizarSede($departamento, $municipio, $ubicacion, $cod_alfabetico, $cod_numerico, $id)
    {
        $sql = "UPDATE tbl_sedes SET fk_departamento=?, fk_municipio=?, ubicacion=?,  
                cod_alfabetico = ?, cod_numerico = ? WHERE id_sede=?";
        $array = array($departamento, $municipio, $ubicacion, $cod_alfabetico, $cod_numerico, $id);
        return $this->save($sql, $array);

        $this->cerrarConexion();
        return $result;
    }

}