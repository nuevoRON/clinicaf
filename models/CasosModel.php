<?php
class CasosModel extends Query
{
    public function __construct()
    {
        parent::__construct();
    }

    public function getRevisiones()
    {
        $sql = "SELECT  r.id_revision,
                        CONCAT(u.nombre, ' ', u.apellido) AS nombre_completo,
                        r.enviado_para,
                        r.fecha_revision,
                        r.tipo_dictamen,
                        r.numero_dictamen,
                        r.nombre_evaluado,
                        r.fecha_evaluacion,
                        t.nom_reconocimiento,
                        r.obs_reconocimiento,
                        r.estado_dictamen,
                        r.obs_dictamen,
                        r.sede_medico,
                        s.ubicacion
                FROM tbl_revision_casos r
                INNER JOIN tbl_usu u ON u.id_usu = r.medico
                INNER JOIN tbl_reconocimiento t ON t.id_reconocimiento = r.tipo_reconocimiento
                INNER JOIN tbl_sedes s ON s.id_sede = r.sede_clinica
                WHERE r.registro_borrado = 'A'";
        $result = $this->selectAll($sql);

        $this->cerrarConexion();
        return $result;
    }


    public function insertarRevision(
        $medico,
        $enviadoPara,
        $fechaRevision,
        $tipoDictamen,
        $numDictamen,
        $nombreEvaluado,
        $fechaRealizacion,
        $tipoReconocimiento,
        $obsReconocimiento,
        $estadoDictamen,
        $obsDictamen,
        $sedeMedico,
        $sedeClinica
    ) {
        $sql = "INSERT INTO tbl_revision_casos (
                            medico,
                            enviado_para,
                            fecha_revision,
                            tipo_dictamen,
                            numero_dictamen,
                            nombre_evaluado, 
                            fecha_evaluacion,
                            tipo_reconocimiento
                            ,obs_reconocimiento,
                            estado_dictamen,
                            obs_dictamen,
                            sede_medico,
                            sede_clinica,
                            registro_borrado) 
                VALUES(?,?,?,?,?,?,?,?,?,?,?,?,?,?)";
        $array = array(
            $medico,
            $enviadoPara,
            $fechaRevision,
            $tipoDictamen,
            $numDictamen,
            $nombreEvaluado,
            $fechaRealizacion,
            $tipoReconocimiento,
            $obsReconocimiento,
            $estadoDictamen,
            $obsDictamen,
            $sedeMedico,
            $sedeClinica,
            'A'
        );
        $result = $this->insertar($sql, $array);

        $this->cerrarConexion();
        return $result;
    }

    public function obtenerRevision($id)
    {
        $sql = " SELECT * FROM tbl_revision_casos WHERE id_revision = ?";
        $params = [$id];
        $types = [PDO::PARAM_INT]; 

        $result =  $this->select($sql, $params, $types);
        $this->cerrarConexion();
        return $result;
    }

    public function getPuestos()
    {
        $sql = "SELECT * FROM tbl_puestos";
        $result = $this->selectAll($sql);

        $this->cerrarConexion();
        return $result;
    }

    public function getEstados()
    {
        $sql = "SELECT * FROM tbl_estados";
        $result = $this->selectAll($sql);

        $this->cerrarConexion();
        return $result;
    }

    public function getJornadas()
    {
        $sql = "SELECT * FROM tbl_jornada";
        $result = $this->selectAll($sql);

        $this->cerrarConexion();
        return $result;
    }

    public function eliminarRevision($id)
    {
        $sql = "UPDATE tbl_revision_casos SET registro_borrado = 'I'  WHERE id_revision=?";
        $array = array($id);
        $result = $this->save($sql, $array);

        $this->cerrarConexion();
        return $result;
    }

    public function actualizarRevision(
        $medico,
        $enviadoPara,
        $fechaRevision,
        $tipoDictamen,
        $numDictamen,
        $nombreEvaluado,
        $fechaRealizacion,
        $tipoReconocimiento,
        $obsReconocimiento,
        $estadoDictamen,
        $obsDictamen,
        $sedeMedico,
        $sedeClinica,
        $id
        
    ) {
        $sql = "UPDATE tbl_revision_casos SET medico=?, enviado_para = ?, fecha_revision = ?, tipo_dictamen = ?,
                numero_dictamen = ?, nombre_evaluado = ?, fecha_evaluacion = ?, tipo_reconocimiento = ?, 
                obs_reconocimiento = ?, estado_dictamen=?, obs_dictamen=?, sede_medico=?, sede_clinica = ?
                WHERE id_revision=?";
        $array = array(
            $medico,
            $enviadoPara,
            $fechaRevision,
            $tipoDictamen,
            $numDictamen,
            $nombreEvaluado,
            $fechaRealizacion,
            $tipoReconocimiento,
            $obsReconocimiento,
            $estadoDictamen,
            $obsDictamen,
            $sedeMedico,
            $sedeClinica,
            $id
        );
        $result = $this->save($sql, $array);

        $this->cerrarConexion();
        return $result;
    }
}
