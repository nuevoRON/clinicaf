<?php
class ReconocimientoModel extends Query{
    public function __construct() {
        parent::__construct();
    }

    public function insertarReconocimientos($nom_reco) {
        $sql = "INSERT INTO tbl_reconocimiento (nom_reconocimiento) VALUES(?)";
        $array = array($nom_reco);
        return $this->insertar($sql, $array);
    }

    public function obtenerReconocimientos($id)
    {
        $sql = " SELECT * FROM tbl_reconocimiento WHERE id_reconocimiento = $id";
        return $this->select($sql);
    }

    public function getReconocimientos()
    {
        $sql = "SELECT * FROM tbl_reconocimiento";
        return $this->selectAll($sql);
    }
    


  /*    public function getReconocimientos()
     {
         $sql = "SELECT * FROM tbl_reconocimiento";
         return $this->selectAll($sql);
     } */

    public function eliminarReconocimientos($id)
    {
        $sql = " DELETE FROM tbl_reconocimiento WHERE id_reconocimiento = $id";
        return $this->select($sql);
    }

    public function actualizarReconocimientos($nom_reco, $id)
    {
        $sql = "UPDATE tbl_reconocimiento SET nom_reconocimiento=?   WHERE id_reconocimiento=?";
        $array = array($nom_reco, $id);
        return $this->save($sql, $array);
    }

}