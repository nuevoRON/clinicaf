<?php
class PlazasModel extends Query{
    public function __construct() {
        parent::__construct();
    }
    
public function getPlazas()
    {
        $sql = "SELECT p.ID_PLAZA, p.NOMBRE, p.DESCRIPCION, p.REQUISITOS,p.BENEFICIOS,
        a.NOMBRE as AREA, p.FECHA_LIMITE, p.ESTADO_PLAZA FROM tbl_plaza p
        inner join tbl_area a on a.ID_AREA=p.ID_AREA
        WHERE p.FECHA_LIMITE>= CURDATE() AND p.BORRADO=0";
        return $this->selectAll($sql);
    }


    public function getPlazasCandidato()
    {
        $sql = "SELECT p.ID_PLAZA, p.NOMBRE, p.DESCRIPCION, p.REQUISITOS,p.BENEFICIOS,
        a.NOMBRE as AREA, p.FECHA_LIMITE, p.ESTADO_PLAZA FROM tbl_plaza p
        inner join tbl_area a on a.ID_AREA=p.ID_AREA
        WHERE p.FECHA_LIMITE>= CURDATE() AND p.BORRADO=0 and p.ESTADO_PLAZA=2";
        return $this->selectAll($sql);
    }

    public function getPlaza($id)
    {
        $sql = "SELECT p.ID_PLAZA, p.NOMBRE, p.DESCRIPCION, p.REQUISITOS, 
        p.BENEFICIOS,a.NOMBRE as AREA, p.FECHA_LIMITE FROM tbl_plaza p
        inner join tbl_area a on a.ID_AREA=p.ID_AREA
        where p.ID_PLAZA=$id";
        return $this->selectAll($sql);
    }

    public function contarPlazas()
    {
        $sql = "SELECT count(*)as CONTAR_PLAZAS FROM tbl_plaza p where BORRADO=0 and ESTADO_PLAZA=2 LIMIT 1";
        return $this->selectAll($sql);
    }

    public function registrarPlaza($nombres,$area,$descripcion,$requisitos,$beneficios,$fecha_limite,$estado) {
        $sql = "INSERT INTO tbl_plaza (NOMBRE,DESCRIPCION,REQUISITOS,BENEFICIOS,FECHA_LIMITE,ESTADO_PLAZA,ID_AREA) 
        VALUES(?,?,?,?,?,?,?)";
        $array = array($nombres,$descripcion,$requisitos,$beneficios,$fecha_limite,$estado,$area);
        return $this->insertar($sql, $array);
    }

    public function editarPlaza($id)
    {
        $sql = " SELECT * FROM tbl_plaza WHERE ID_PLAZA = $id";
        return $this->select($sql);
    }

    public function actualizarPlaza($nombres,$area,$descripcion,$requisitos,$beneficios,$fecha_limite,$estado,$id)
    {
        $sql = "UPDATE tbl_plaza SET NOMBRE=?, DESCRIPCION=?, REQUISITOS=?, BENEFICIOS=?,ID_AREA=?,
        FECHA_LIMITE=?, ESTADO_PLAZA=? WHERE ID_PLAZA=?";
        $array = array($nombres,$descripcion,$requisitos,$beneficios,$area,$fecha_limite,$estado,$id);
        return $this->save($sql, $array);
    }

    public function eliminar($id)
    {
        $sql = "UPDATE tbl_plaza SET BORRADO=1  WHERE ID_PLAZA=?";
        $array = array($id);
        return $this->save($sql, $array);
    }

}