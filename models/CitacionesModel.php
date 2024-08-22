<?php
class CitacionesModel extends Query{
    public function __construct() {
        parent::__construct();
    }

    public function getCitaciones(){
        $sql = "SELECT c.id_citacion,
                       p.num_caso, 
                       c.tipo_citacion,
                       c.fecha_recep_citacion,
                       c.fecha_citacion,
                       u.nombre,
                       u.apellido,
                       c.lugar_citacion
                FROM tbl_citaciones c
                INNER JOIN tbl_proveidos p ON p.id_proveidos = c.numero_caso
                INNER JOIN tbl_usu u ON u.id_usu = c.medico
                WHERE c.registro_borrado = 'A'";
        return $this->selectAll($sql);
    }


    public function insertarCitacion($numeroCaso,$tipoCitacion,$fechaRecibe,$fechaCitacion,$medico,$lugarCitacion) {
        $sql = "INSERT INTO tbl_citaciones (numero_caso,tipo_citacion,fecha_recep_citacion,fecha_citacion,medico,
        lugar_citacion, registro_borrado) VALUES(?,?,?,?,?,?,?)";
        $array = array($numeroCaso,$tipoCitacion,$fechaRecibe,$fechaCitacion,$medico,$lugarCitacion, 'A');
        return $this->insertar($sql, $array);
    }


    public function getCitacion($id){
        $sql = "SELECT *
                FROM tbl_citaciones c
                WHERE id_citacion = $id";
        return $this->select($sql);
    }

    public function getNumerosCasos()
    {
        $sql = "SELECT id_proveidos, num_caso FROM tbl_proveidos";
        return $this->selectAll($sql);
    }

    public function eliminarCitacion($id)
    {
        $sql = "UPDATE tbl_citaciones SET registro_borrado = 'I' WHERE id_citacion = ?";
        $array = array($id);
        return $this->save($sql, $array);
    }

    public function actualizarCitacion($numeroCaso,$tipoCitacion,$fechaRecibe,$fechaCitacion,$medico,$lugarCitacion, $id)
    {
        $sql = "UPDATE tbl_citaciones SET numero_caso=?, tipo_citacion=?, fecha_recep_citacion = ?,
        fecha_citacion = ?, medico = ?, lugar_citacion = ? WHERE id_citacion = ?";
        $array = array($numeroCaso,$tipoCitacion,$fechaRecibe,$fechaCitacion,$medico,$lugarCitacion, $id);
        return $this->save($sql, $array);
    }

}