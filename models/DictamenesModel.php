<?php
class DictamenesModel extends Query{
    public function __construct() {
        parent::__construct();
    }

    public function getDictamenes(){
        $sql = "SELECT d.id_dictamen,
                       p.num_caso, 
                       d.tipo_documento,
                       CONCAT(u.nombre, ' ', u.apellido) AS nombre_completo,
                       d.fecha_evaluacion,
                       d.autoridad_solicitante,
                       d.fecha_entrega,
                       d.datos_extra
                FROM tbl_dictamenes d
                INNER JOIN tbl_proveidos p ON p.id_proveidos = d.numero_caso
                INNER JOIN tbl_usu u ON u.id_usu = d.medico
                WHERE d.registro_borrado = 'A'";
        return $this->selectAll($sql);
    }


    public function insertarDictamen($numeroCaso,$tipoDocumento,$fechaEvaluacion,$fechaEntrega,
        $autoridadSolicitante,$medico,$datosExtra) {
        $sql = "INSERT INTO tbl_dictamenes (numero_caso,medico,fecha_evaluacion,autoridad_solicitante,
        tipo_documento, fecha_entrega, datos_extra, registro_borrado) VALUES(?,?,?,?,?,?,?,?)";
        $array = array($numeroCaso,$medico,$fechaEvaluacion,$autoridadSolicitante,$tipoDocumento,
        $fechaEntrega, $datosExtra,'A');
        return $this->insertar($sql, $array);
    }


    public function getDictamen($id){
        $sql = "SELECT * FROM tbl_dictamenes WHERE id_dictamen = $id";
        return $this->select($sql);
    }

    public function getNumerosCasos()
    {
        $sql = "SELECT id_proveidos, num_caso FROM tbl_proveidos";
        return $this->selectAll($sql);
    }

    public function eliminarDictamen($id)
    {
        $sql = "UPDATE tbl_dictamenes SET registro_borrado = 'I' WHERE id_dictamen = ?";
        $array = array($id);
        return $this->save($sql, $array);
    }

    public function actualizarDictamen($numeroCaso,$tipoDocumento,$fechaEvaluacion,$fechaEntrega,
    $autoridadSolicitante,$medico,$datosExtra, $id)
    {
        $sql = "UPDATE tbl_dictamenes SET numero_caso=?, medico=?, fecha_evaluacion = ?, autoridad_solicitante =?,
        tipo_documento = ?, fecha_entrega = ?, datos_extra = ? WHERE id_dictamen = ?";
        $array = array($numeroCaso,$medico,$fechaEvaluacion,$autoridadSolicitante,$tipoDocumento,
        $fechaEntrega, $datosExtra, $id);
        return $this->save($sql, $array);
    }

}