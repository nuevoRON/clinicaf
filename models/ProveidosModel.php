<?php
class ProveidosModel extends Query{
    public function __construct() {
        parent::__construct();
    }

    public function getPuestos()
    {
        $sql = "SELECT * from tbl_puesto";
        return $this->selectAll($sql);
    }

    public function insertarProveido($numeroSolicitud, $fechaEmision, $fechaRecepcion, $fiscalia, $numeroExterno) {
        $sql = "INSERT INTO tbl_proveidos (num_caso,num_caso_ext,fech_emi_soli, fech_recep_soli,
        fiscalia_remitente) VALUES(?,?,?,?,?)";
        $array = array($numeroSolicitud,  $numeroExterno, $fechaEmision, $fechaRecepcion, $fiscalia);
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