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

    public function listarProveidos()
    {
        $sql = "SELECT  p.id_proveidos,
                        p.num_caso,
                        e.dni_evaluado,
                        e.nombre_evaluado, 
                        e.apellido_evaluado,
                        d.nom_dependencia,
                        r.nom_reconocimiento,
                        pr.fecha_citacion
                        FROM tbl_proveidos p
                INNER JOIN tbl_evaluado e on e.id_proveido = p.id_proveidos
                INNER JOIN tbl_dependencia d on d.id_dependencia = p.fiscalia_remitente
                INNER JOIN tbl_proveido_reconocimiento pr on pr.id_proveido_reconocimiento = p.id_proveidos
                INNER JOIN tbl_reconocimiento r on r.id_reconocimiento = pr.tipo_reconocimiento
                WHERE p.registro_borrado = 'A';";
        return $this->selectAll($sql);
    }

    public function insertarProveido($numeroSolicitud, $fechaEmision, $fechaRecepcion, $fiscalia, $numeroExterno) {
        $sql = "INSERT INTO tbl_proveidos (num_caso,num_caso_ext,fech_emi_soli, fech_recep_soli,
        fiscalia_remitente, registro_borrado) VALUES(?,?,?,?,?,?)";
        $array = array($numeroSolicitud,  $numeroExterno, $fechaEmision, $fechaRecepcion, $fiscalia, 'A');
        return $this->insertar($sql, $array);
    }

    public function insertarEvaluado($nombre, $apellido, $dni, $dataProveido) {
        $sql = "INSERT INTO tbl_evaluado (nombre_evaluado,apellido_evaluado,dni_evaluado, id_proveido, estado_evaluacion) 
        VALUES(?,?,?,?,?)";
        $array = array($nombre,  $apellido, $dni, $dataProveido, 'Nuevo');
        return $this->insertar($sql, $array);
    }

    public function insertarHecho($departamento, $municipio, $localidad, $lugar, $fechaHecho, $dataProveido) {
        $sql = "INSERT INTO tbl_hecho (id_departamento,id_municipio,localidad, lugar_hecho,fecha_hecho,
        id_proveido) VALUES(?,?,?,?,?,?)";
        $array = array($departamento, $municipio, $localidad, $lugar, $fechaHecho, $dataProveido);
        return $this->insertar($sql, $array);
    }

    public function insertarReconocimiento($dataProveido, $tipoReconocimiento, $medico, $fechaCitacion) {
        $sql = "INSERT INTO tbl_proveido_reconocimiento (id_proveido_reconocimiento,tipo_reconocimiento,medico, fecha_citacion) 
        VALUES(?,?,?,?)";
        $array = array($dataProveido, $tipoReconocimiento, $medico, $fechaCitacion);
        return $this->insertar($sql, $array);
    }

    public function insertarEvaluacion($dataProveido) {
        $sql = "INSERT INTO tbl_evaluacion (id_proveido) VALUES(?)";
        $array = array($dataProveido);
        return $this->insertar($sql, $array);
    }

    public function editarProveido($id)
    {
        $sql = "SELECT  p.num_caso,
                        p.num_caso_ext,
                        p.fech_emi_soli,
                        p.fech_recep_soli,
                        p.fiscalia_remitente,
                        e.nombre_evaluado,
                        e.apellido_evaluado,
                        e.dni_evaluado,
                        h.id_departamento,
                        h.id_municipio,
                        h.localidad,
                        h.lugar_hecho,
                        h.fecha_hecho,
                        pr.tipo_reconocimiento,
                        pr.medico,
                        pr.fecha_citacion  
                FROM tbl_proveidos p
                INNER JOIN tbl_evaluado e on e.id_proveido = p.id_proveidos
                INNER JOIN tbl_hecho h on h.id_proveido = p.id_proveidos
                INNER JOIN tbl_dependencia d on d.id_dependencia = p.fiscalia_remitente
                INNER JOIN tbl_proveido_reconocimiento pr on pr.id_proveido_reconocimiento = p.id_proveidos
                INNER JOIN tbl_reconocimiento r on r.id_reconocimiento = pr.tipo_reconocimiento
               where p.id_proveidos = $id";
        return $this->select($sql);
    }

    public function actualizarProveido($numeroSolicitud, $fechaEmision, $fechaRecepcion, $fiscalia, $numeroExterno,$id)
    {
        $sql = "UPDATE tbl_proveidos SET num_caso=?, num_caso_ext=?, fech_emi_soli=?, fech_recep_soli=?,
        fiscalia_remitente=? WHERE id_proveidos=?";
        $array = array($numeroSolicitud, $fechaEmision, $fechaRecepcion, $fiscalia, $numeroExterno, $id);
        return $this->save($sql, $array);
    }


    public function actualizarEvaluado($nombre, $apellido, $dni,$id)
    {
        $sql = "UPDATE tbl_evaluado SET nombre_evaluado=?, apellido_evaluado=?, dni_evaluado=?
        WHERE id_proveido=?";
        $array = array($nombre, $apellido, $dni,$id);
        return $this->save($sql, $array);
    }

    public function actualizarHecho($departamento, $municipio, $localidad, $lugar, $fechaHecho,$id)
    {
        $sql = "UPDATE tbl_hecho SET id_departamento=?, id_municipio=?, localidad=?, lugar_hecho=?, fecha_hecho=? 
        WHERE id_proveido=?";
        $array = array($departamento, $municipio, $localidad, $lugar, $fechaHecho,$id);
        return $this->save($sql, $array);
    }

    public function actualizarReconocimiento($tipoReconocimiento, $medico, $fechaCitacion, $id)
    {
        $sql = "UPDATE tbl_proveido_reconocimiento SET tipo_reconocimiento=?, medico=?, fecha_citacion=?
        where id_proveido_reconocimiento = ?";
        $array = array($tipoReconocimiento, $medico, $fechaCitacion, $id);
        return $this->save($sql, $array);
    }


    public function eliminarProveido($id)
    {
        $sql = "UPDATE tbl_proveidos set registro_borrado = 'I' WHERE id_proveidos=?";
        $array = array($id);
        return $this->save($sql, $array);
    }

}