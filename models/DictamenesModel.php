<?php
class DictamenesModel extends Query
{
    private $id_sede;
    private $puesto;

    public function __construct()
    {
        parent::__construct();
        session_start();
        if (!empty($_SESSION['id_usuario'])) {
            $this->id_sede = $_SESSION['id_sede'];
            $this->puesto = $_SESSION['puesto'];
        }
    }

    public function getDictamenes()
    {
        $puesto = $this->puesto;
        $sede = $this->id_sede;

        if($puesto == 'Administrador' || $puesto == 'Jefe') {
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
        }else{
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
            WHERE d.registro_borrado = 'A' AND u.sede = $sede";
        }
        $result = $this->selectAll($sql);

        $this->cerrarConexion();
        return $result;
    }


    public function getNumerosCasosTranscripcion()
    {
        $puesto = $this->puesto;
        $sede = $this->id_sede;

        if($puesto == 'Administrador' || $puesto == 'Jefe') {
            $sql = "SELECT 
                    d.id_dictamen, 
                    p.num_caso 
            from tbl_dictamenes d
            inner join tbl_proveidos p on p.id_proveidos = d.numero_caso
            where d.registro_borrado = 'A';";
        }else{
            $sql = "SELECT 
                        d.id_dictamen, 
                        p.num_caso 
                from tbl_dictamenes d
                inner join tbl_proveidos p on p.id_proveidos = d.numero_caso
                inner join tbl_proveido_reconocimiento pr on pr.id_proveido_reconocimiento = p.id_proveidos
                INNER JOIN tbl_usu u on u.id_usu = pr.medico
                WHERE d.registro_borrado = 'A' AND u.sede = $sede";
        }
        
        $result = $this->selectAll($sql);

        $this->cerrarConexion();
        return $result;
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
        $result = $this->insertar($sql, $array);

        $this->cerrarConexion();
        return $result;
    }

    public function getDictamen($id)
    {
        $sql = "SELECT * FROM tbl_dictamenes WHERE id_dictamen = $id";
        $result = $this->select($sql);

        $this->cerrarConexion();
        return $result;
    }

    public function getNumerosCasos()
    {
        $puesto = $this->puesto;
        $sede = $this->id_sede;

        if($puesto == 'Administrador' || $puesto == 'Jefe') {
            $sql = "SELECT id_proveidos, num_caso FROM tbl_proveidos";
        }else{
            $sql = "SELECT 
                    p.id_proveidos, 
                    p.num_caso 
            FROM tbl_proveidos p
            INNER JOIN tbl_proveido_reconocimiento pr on pr.id_proveido_reconocimiento = p.id_proveidos
            INNER JOIN tbl_reconocimiento r on r.id_reconocimiento = pr.tipo_reconocimiento
            INNER JOIN tbl_usu u on u.id_usu = pr.medico
            WHERE p.registro_borrado = 'A' AND u.sede = $sede";
        }
        
        $result = $this->selectAll($sql);

        $this->cerrarConexion();
        return $result;
    }

    public function eliminarDictamen($id)
    {
        $sql = "UPDATE tbl_dictamenes SET registro_borrado = 'I' WHERE id_dictamen = ?";
        $array = array($id);
        $result = $this->save($sql, $array);

        $this->cerrarConexion();
        return $result;
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
        $result = $this->save($sql, $array);

        $this->cerrarConexion();
        return $result;
    }

    public function verExistenciaCaso($numeroCaso)
    {
        $sql = "SELECT * 
                FROM tbl_dictamenes
                WHERE numero_caso = ? and registro_borrado = 'A'";
        $params = [$numeroCaso];
        $types = [PDO::PARAM_INT];

        $result = $this->select($sql, $params, $types);

        $this->cerrarConexion();
        return $result;
    }


    public function getTranscripciones()
    {
        $puesto = $this->puesto;
        $sede = $this->id_sede;

        if($puesto == 'Administrador' || $puesto == 'Jefe') {
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
        }else{
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
                    WHERE d.registro_borrado = 'A' AND u.sede = $sede";
        }
        $result = $this->selectAll($sql);

        $this->cerrarConexion();
        return $result;
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
        $result = $this->insertar($sql, $array);

        $this->cerrarConexion();
        return $result;
    }


    public function getTranscripcion($id)
    {
        $sql = "SELECT * FROM tbl_dictamen_transcripcion WHERE id = $id";
        $result = $this->select($sql);

        $this->cerrarConexion();
        return $result;
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
        $result = $this->save($sql, $array);

        $this->cerrarConexion();
        return $result;
    }


    public function eliminarTranscripcion($id)
    {
        $sql = "UPDATE tbl_dictamen_transcripcion SET registro_borrado = 'I' WHERE id = ?";
        $array = array($id);
        $result = $this->save($sql, $array);

        $this->cerrarConexion();
        return $result;
    }
}
