<?php
class PostulacionesModel extends Query{
    public function __construct() {
        parent::__construct();
    }

    public function listarPostulacionesAdministrador()
    {
        $sql = "SELECT CONCAT(c.NOMBRE,' ', c.APELLIDO) AS NOMBRE, p.NOMBRE AS PLAZA,tp.DESCRIPCION, 
        ps.FECHA_INICIO, ps.FECHA_FINAL,c.ID_CANDIDATO,ps.ID_TIPO_PLAZA, c.CURRICULUM from tbl_postulante ps
        inner join tbl_candidato c ON c.ID_CANDIDATO=ps.ID_CANDIDATO
        inner join tbl_plaza p ON p.ID_PLAZA=ps.ID_TIPO_PLAZA
        inner join tbl_tipo_postulacion tp ON tp.ID_ESTADO_POSTULACION=ps.ID_ESTADO_POSTULACION
        where ps.ID_ESTADO_POSTULACION<4";
        return $this->selectAll($sql);
    }


    public function listarPostulacionesCandidato($id)
    {
        $sql = "SELECT p.NOMBRE AS PLAZA,tp.DESCRIPCION, ps.ID_TIPO_PLAZA,
        ps.FECHA_INICIO, ps.FECHA_FINAL,c.ID_CANDIDATO from tbl_postulante ps
        inner join tbl_candidato c ON c.ID_CANDIDATO=ps.ID_CANDIDATO
        inner join tbl_plaza p ON p.ID_PLAZA=ps.ID_TIPO_PLAZA
        inner join tbl_tipo_postulacion tp ON tp.ID_ESTADO_POSTULACION=ps.ID_ESTADO_POSTULACION
        where ps.ID_CANDIDATO=$id";
        return $this->selectAll($sql);
    }


    public function verSeguimientoPostulacion($id, $plaza)
    {
        $sql = "SELECT tp.DESCRIPCION, bp.FECHA, bp.COMENTARIO from tbl_bitacora_postulante bp
        inner join tbl_plaza p ON p.ID_PLAZA=bp.ID_TIPO_PLAZA
        inner join tbl_tipo_postulacion tp ON tp.ID_ESTADO_POSTULACION=bp.ID_ESTADO_POSTULACION
        where bp.ID_CANDIDATO=$id AND bp.ID_TIPO_PLAZA=$plaza";
        return $this->selectAll($sql);
    }


    public function contarPostulaciones($id_candidato)
    {
        $sql = "SELECT COUNT(*) AS CONTAR_POSTULACIONES FROM tbl_postulante WHERE ID_CANDIDATO=$id_candidato limit 1";
        return $this->selectAll($sql);
    }


    public function registrarEventoPostulacion($id_plaza,$id_candidato,$estadoPostulacion,$comentario) {
        $sql = "INSERT INTO tbl_bitacora_postulante (ID_CANDIDATO, ID_TIPO_PLAZA, ID_ESTADO_POSTULACION,
        FECHA,COMENTARIO) VALUES(?,?,?,NOW(),?)";
        $array = array($id_candidato,$id_plaza,$estadoPostulacion,$comentario);
        return $this->insertar($sql, $array);
    }


    public function registrarPostulacion($id_plaza,$id_candidato,$fechaInicio,$fechaFin,$estadoPostulacion) {
        $sql = "INSERT INTO tbl_postulante (ID_CANDIDATO, ID_TIPO_PLAZA, ID_ESTADO_POSTULACION,
        FECHA_INICIO,FECHA_FINAL) VALUES(?,?,?,?,?)";
        $array = array($id_candidato,$id_plaza,$estadoPostulacion,$fechaInicio,$fechaFin);
        return $this->insertar($sql, $array);
    }


    public function validarPostulacionPrevia($id_plaza,$id_candidato)
    {
        $sql = "SELECT * FROM tbl_postulante WHERE ID_TIPO_PLAZA = $id_plaza and ID_CANDIDATO=$id_candidato";
        return $this->select($sql);
    }


    public function validarExistenciaCandidato($id_candidato)
    {
        $sql = "SELECT * FROM tbl_candidato WHERE ID_CANDIDATO=$id_candidato";
        return $this->select($sql);
    }


    public function actualizarPostulacion($id_plaza,$id_candidato,$estadoPostulacion)
    {
        $sql = "UPDATE tbl_postulante SET ID_ESTADO_POSTULACION=? WHERE ID_TIPO_PLAZA = ? and ID_CANDIDATO=?";
        $array = array($estadoPostulacion,$id_plaza,$id_candidato);
        return $this->save($sql, $array);
    }


    public function eliminarPostulacionAdmin($id_plaza,$id_candidato)
    {
        $sql = "DELETE FROM tbl_postulante WHERE ID_TIPO_PLAZA = $id_plaza and ID_CANDIDATO=$id_candidato";
        return $this->select($sql);
    }


    public function eliminar($id_plaza,$id_candidato)
    {
        $sql = "DELETE FROM tbl_postulante WHERE ID_TIPO_PLAZA = $id_plaza and ID_CANDIDATO=$id_candidato";
        return $this->select($sql);
    }


    public function getInformacionCandidato($id_candidato,$id_plaza)
    {
        $sql = "SELECT C.NOMBRE, C.APELLIDO, C.CORREO,C.TELEFONO, C.IDENTIDAD, pt.ID_TIPO_PLAZA,
        p.NOMBRE as PLAZA FROM tbl_postulante pt
        inner join tbl_candidato C ON C.ID_CANDIDATO=PT.ID_CANDIDATO
        inner join tbl_plaza P ON P.ID_PLAZA=PT.ID_TIPO_PLAZA
        WHERE PT.ID_CANDIDATO=$id_candidato AND PT.ID_TIPO_PLAZA=$id_plaza limit 1";
        return $this->select($sql);
    }


    public function getInformacionPlaza($plaza)
    {
        $sql = "SELECT ID_PUESTO FROM tbl_puesto WHERE NOMBRE='$plaza'";
        return $this->select($sql);
    }


    public function getMensajeCorreo($estado)
    {
        $sql = "SELECT MENSAJE_CORREO FROM tbl_tipo_postulacion WHERE ID_ESTADO_POSTULACION=$estado";
        return $this->select($sql);
    }


    public function registrarEmpleado($nombre,$apellido,$identidad,$correo,$fechaIngreso,$telefono,$puesto,$plaza)
    {
        $sql = "INSERT INTO tbl_usuarios (NOMBRE, APELLIDO, IDENTIDAD, CORREO,FECHA_INGRESO,ID_ESTADO, 
        TELEFONO, ID_PUESTO, ID_AREA)values(?,?,?,?,?,?,?,?,?)";
        $array = array ($nombre,$apellido,$identidad,$correo,$fechaIngreso, 2, $telefono,$puesto,$plaza);
        return $this->insertar($sql, $array);
    }


    public function deshabilitarPlaza($id_plaza)
    {
        $sql = "UPDATE tbl_plaza SET ESTADO_PLAZA=1 WHERE ID_PLAZA = ?";
        $array = array($id_plaza);
        return $this->save($sql, $array);
    }


    public function registrarCandidatoRechazado($candidato,$plaza,$fecha)
    {
        $sql = "INSERT INTO tbl_candidato_rechazado values(?,?,?)";
        $array = array ($candidato,$plaza,$fecha);
        return $this->insertar($sql, $array);
    }


    public function listarCandidatosRechazados()
    {
        $sql = "SELECT CONCAT(c.NOMBRE,' ', c.APELLIDO) AS NOMBRE, p.NOMBRE AS PLAZA,cr.FECHA,
        c.ID_CANDIDATO, p.ID_PLAZA from tbl_candidato_rechazado cr
        inner join tbl_candidato c ON c.ID_CANDIDATO=cr.ID_CANDIDATO
        inner join tbl_plaza p ON p.ID_PLAZA=cr.ID_PLAZA";
        return $this->selectAll($sql);
    }

}


