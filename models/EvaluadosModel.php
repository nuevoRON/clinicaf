<?php
class EvaluadosModel extends Query{
    public function __construct() {
        parent::__construct();
    }


    public function listarOcupaciones()
    {
        $sql = "SELECT * from tbl_ocupaciones";
        return $this->selectAll($sql);
    }

    public function listarEscolaridad()
    {
        $sql = "SELECT * from tbl_escolaridad";
        return $this->selectAll($sql);
    }


    public function listarInstrumentos()
    {
        $sql = "SELECT * from tbl_instrumento";
        return $this->selectAll($sql);
    }


    public function listarEstadoCivil()
    {
        $sql = "SELECT * from tbl_estado_civil";
        return $this->selectAll($sql);
    }


    public function listarNacionalidad()
    {
        $sql = "SELECT * from tbl_nacionalidad";
        return $this->selectAll($sql);
    }

    public function getPuestos()
    {
        $sql = "SELECT * from tbl_puesto";
        return $this->selectAll($sql);
    }

    public function listarEvaluados()
    {
        $sql = "SELECT  p.id_proveidos,
                        p.num_caso,
                        e.dni_evaluado,
                        e.nombre_evaluado, 
                        e.apellido_evaluado,
                        d.nom_dependencia,
                        r.nom_reconocimiento,
                        e.estado_evaluacion
                        FROM tbl_proveidos p
                INNER JOIN tbl_evaluado e on e.id_proveido = p.id_proveidos
                INNER JOIN tbl_dependencia d on d.id_dependencia = p.fiscalia_remitente
                INNER JOIN tbl_proveido_reconocimiento pr on pr.id_proveido_reconocimiento = p.id_proveidos
                INNER JOIN tbl_reconocimiento r on r.id_reconocimiento = pr.tipo_reconocimiento
                WHERE p.registro_borrado = 'A';";
        return $this->selectAll($sql);
    }

    public function editarEvaluado($id)
    {
        $sql = "SELECT  p.num_caso,
                        p.num_caso_ext,
                        p.fech_emi_soli,
                        p.fech_recep_soli,
                        p.num_solicitud,
                        d.nom_dependencia,
                        r.nom_reconocimiento,
                        e.nombre_evaluado,
                        e.apellido_evaluado,
                        e.dni_evaluado,
                        e.telefono_evaluado,
                        e.id_sexo,
                        e.edad,
                        e.diversidad,
                        e.tiempo,
                        e.nombre_acompanante,
                        e.apellido_acompanante,
                        e.dni_acompanante,
                        e.relacion_acompanante,
                        e.nacionalidad,
                        e.estado_civil,
                        e.ocupacion,
                        e.lugar_procedencia,
                        e.escolaridad,
                        e.tiempo,
                        e.estado_evaluacion,
                        h.id_departamento,
                        h.id_municipio,
                        h.localidad,
                        h.lugar_hecho,
                        h.fecha_hecho,
                        pr.tipo_reconocimiento,
                        pr.medico,
                        pr.fecha_citacion,
                        ev.consentimiento_informado,
                        ev.instrumento_agresion,
                        ev.descripcion_evaluacion,
                        ev.relacion_agresor,
                        ev.sede_evaluacion,
                        ev.especificar_relacion,
                        ev.fecha_finalizacion  
                FROM tbl_proveidos p
                INNER JOIN tbl_evaluado e on e.id_proveido = p.id_proveidos
                INNER JOIN tbl_hecho h on h.id_proveido = p.id_proveidos
                INNER JOIN tbl_evaluacion ev on ev.id_proveido = p.id_proveidos
                INNER JOIN tbl_dependencia d on d.id_dependencia = p.fiscalia_remitente
                INNER JOIN tbl_proveido_reconocimiento pr on pr.id_proveido_reconocimiento = p.id_proveidos
                INNER JOIN tbl_reconocimiento r on r.id_reconocimiento = pr.tipo_reconocimiento
               where p.id_proveidos = $id";
        return $this->select($sql);
    }


    public function insertarInstrumento($instrumento) {
        $sql = "INSERT INTO tbl_instrumento (nom_instrumento) VALUES(?)";
        $array = array($instrumento);
        return $this->insertar($sql, $array);
    }


    public function insertarOcupacion($ocupacion) {
        $sql = "INSERT INTO tbl_ocupaciones (nom_ocupacion) VALUES(?)";
        $array = array($ocupacion);
        return $this->insertar($sql, $array);
    }


    public function insertarNacionalidad($nacionalidad) {
        $sql = "INSERT INTO tbl_nacionalidad (nom_nacionalidad) VALUES(?)";
        $array = array($nacionalidad);
        return $this->insertar($sql, $array);
    }


    public function actualizarEvaluado($nombre, $apellido, $dni,$telefono,$sexo,$edad,
    $diversidad, $tiempo,$nombreAcomp, $apellidoAcomp,$relacion,$nacionalidad,$estadoCivil,$ocupacion,
    $lugarProcedencia, $escolaridad, $dniAcomp, $estadoEvaluacion, $id)
    {
        $sql = "UPDATE tbl_evaluado SET nombre_evaluado=?, apellido_evaluado=?, dni_evaluado=?, telefono_evaluado = ?,
        id_sexo = ?, edad = ?, diversidad = ?, tiempo = ?, nombre_acompanante = ?, apellido_acompanante = ?,
        relacion_acompanante = ?, nacionalidad = ?, estado_civil = ?, ocupacion = ?, lugar_procedencia = ?,
        escolaridad = ?, dni_acompanante = ?, estado_evaluacion = ? WHERE id_proveido=?";
        $array = array($nombre, $apellido, $dni,$telefono,$sexo,$edad,
        $diversidad, $tiempo,$nombreAcomp, $apellidoAcomp,$relacion,$nacionalidad,$estadoCivil,$ocupacion,
        $lugarProcedencia, $escolaridad, $dniAcomp, $estadoEvaluacion, $id);
        return $this->save($sql, $array);
    }


    public function actualizarHecho($departamento, $municipio, $localidad, $lugar, $fechaHecho,$id)
    {
        $sql = "UPDATE tbl_hecho SET id_departamento=?, id_municipio=?, localidad=?, lugar_hecho=?, fecha_hecho=? 
        WHERE id_proveido=?";
        $array = array($departamento, $municipio, $localidad, $lugar, $fechaHecho,$id);
        return $this->save($sql, $array);
    }

    public function actualizarEvaluacion($consentimiento, $instrumento, $descripcion, $relacionAgresor, $conocido,
    $sede, $fechaFinalizacion, $id)
    {
        $sql = "UPDATE tbl_evaluacion SET consentimiento_informado=?, instrumento_agresion=?, descripcion_evaluacion=?, 
        relacion_agresor=?, especificar_relacion = ?, sede_evaluacion=?, fecha_finalizacion = ? 
        WHERE id_proveido=?";
        $array = array($consentimiento, $instrumento, $descripcion, $relacionAgresor, $conocido,
        $sede, $fechaFinalizacion, $id);
        return $this->save($sql, $array);
    }


    public function eliminarProveido($id)
    {
        $sql = "UPDATE tbl_proveidos set registro_borrado = 'I' WHERE id_proveidos=?";
        $array = array($id);
        return $this->save($sql, $array);
    }

}