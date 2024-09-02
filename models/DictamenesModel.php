<?php
class DictamenesModel extends Query
{
    public function __construct()
    {
        parent::__construct();
    }

    public function getDictamenes()
    {
        $sql = "SELECT d.id_dictamen,
                       p.num_caso, 
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


    public function getNumerosCasosTranscripcion()
    {
        $sql = "SELECT 
                        d.id_dictamen, 
                        p.num_caso 
                from tbl_dictamenes d
                inner join tbl_proveidos p on p.id_proveidos = d.numero_caso
                where d.registro_borrado = 'A';";
        return $this->selectAll($sql);
    }


    public function insertarDictamen(
        $numeroCaso,
        $fechaEvaluacion,
        $fechaEntrega,
        $autoridadSolicitante,
        $medico,
        $datosExtra
    ) {
        $sql = "INSERT INTO tbl_dictamenes (numero_caso,medico,fecha_evaluacion,autoridad_solicitante,
                 fecha_entrega, datos_extra, registro_borrado) VALUES(?,?,?,?,?,?,?)";
        $array = array(
            $numeroCaso,
            $medico,
            $fechaEvaluacion,
            $autoridadSolicitante,
            $fechaEntrega,
            $datosExtra,
            'A'
        );
        return $this->insertar($sql, $array);
    }

    public function getDictamen($id)
    {
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

    public function actualizarDictamen(
        $numeroCaso,
        $fechaEvaluacion,
        $fechaEntrega,
        $autoridadSolicitante,
        $medico,
        $datosExtra,
        $id
    ) {
        $sql = "UPDATE tbl_dictamenes SET numero_caso=?, medico=?, fecha_evaluacion = ?, autoridad_solicitante =?,
         fecha_entrega = ?, datos_extra = ? WHERE id_dictamen = ?";
        $array = array(
            $numeroCaso,
            $medico,
            $fechaEvaluacion,
            $autoridadSolicitante,
            $fechaEntrega,
            $datosExtra,
            $id
        );
        return $this->save($sql, $array);
    }

    public function verExistenciaCaso($numeroCaso)
    {
        $sql = "SELECT * 
                FROM tbl_dictamenes
                WHERE numero_caso = ? and registro_borrado = 'A'";
        $params = [$numeroCaso];
        $types = [PDO::PARAM_INT];

        return $this->select($sql, $params, $types);
    }


    public function getTranscripciones()
    {
        $sql = "SELECT d.id,
                       p.num_caso, 
                       d.tipo_documento,
                       CONCAT(u.nombre, ' ', u.apellido) AS nombre_completo,
                       d.fecha_evaluacion,
                       d.autoridad_solicitante,
                       d.fecha_entrega,
                       d.datos_extra
                FROM tbl_dictamen_transcripcion d
                inner join tbl_dictamenes td on td.id_dictamen = d.id_dictamen 
                INNER JOIN tbl_proveidos p ON p.id_proveidos = td.numero_caso
                INNER JOIN tbl_usu u ON u.id_usu = d.medico
                WHERE d.registro_borrado = 'A'";
        return $this->selectAll($sql);
    }


    public function insertarTranscripcion(
        $idDictamen,
        $fechaEvaluacion,
        $fechaEntrega,
        $autoridadSolicitante,
        $medico,
        $datosExtra,
        $tipoDocumento
    ) {
        $sql = "INSERT INTO tbl_dictamen_transcripcion (id_dictamen,medico,fecha_evaluacion,autoridad_solicitante,
         fecha_entrega, datos_extra, registro_borrado,tipo_documento) VALUES(?,?,?,?,?,?,?,?)";
        $array = array(
            $idDictamen,
            $medico,
            $fechaEvaluacion,
            $autoridadSolicitante,
            $fechaEntrega,
            $datosExtra,
            'A',
            $tipoDocumento
        );
        return $this->insertar($sql, $array);
    }


    public function getTranscripcion($id)
    {
        $sql = "SELECT * FROM tbl_dictamen_transcripcion WHERE id = $id";
        return $this->select($sql);
    }


    public function actualizarTranscripcion(
        $idDictamen,
        $fechaEvaluacion,
        $fechaEntrega,
        $autoridadSolicitante,
        $medico,
        $datosExtra,
        $tipoDocumento,
        $id
    ) {
        $sql = "UPDATE tbl_dictamen_transcripcion SET id_dictamen=?, medico=?, fecha_evaluacion = ?, autoridad_solicitante =?,
         fecha_entrega = ?, datos_extra = ?, tipo_documento = ? WHERE id = ?";
        $array = array(
            $idDictamen,
            $medico,
            $fechaEvaluacion,
            $autoridadSolicitante,
            $fechaEntrega,
            $datosExtra,
            $tipoDocumento,
            $id
        );
        return $this->save($sql, $array);
    }


    public function eliminarTranscripcion($id)
    {
        $sql = "UPDATE tbl_dictamen_transcripcion SET registro_borrado = 'I' WHERE id = ?";
        $array = array($id);
        return $this->save($sql, $array);
    }
}
