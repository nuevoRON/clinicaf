<?php
class PlantillasModel extends Query{
    public function __construct() {
        parent::__construct();
    }

    public function listarPlantillas()
    {
        $sql = "SELECT id_archivo, 
                       split_part(ruta_archivo, '/',4) as ruta 
                FROM tbl_plantillas";
        $result = $this->selectAll($sql);

        $this->cerrarConexion();
        return $result;
    }

    public function obtenerRutaArchivo($id)
    {
        $sql = "SELECT ruta_archivo FROM tbl_plantillas WHERE id_archivo = ?";
        $params = [$id];
        $types = [PDO::PARAM_INT]; 

        $result =  $this->select($sql, $params, $types);
        $this->cerrarConexion();
        return $result;
    }

}