<?php

class ProveidosModel extends Query
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

    public function getPuestos()
    {
        $sql = "SELECT * from tbl_puesto";
        $result = $this->selectAll($sql);

        $this->cerrarConexion();
        return $result;
    }

    public function getMedicos()
    {
        $puesto = $this->puesto;
        $sede = $this->id_sede;

        if ($puesto == 'Administrador' || $puesto == 'Jefe') {
            $sql = "SELECT 
                        id_usu, 
                        CONCAT(nombre, ' ', apellido) AS nombre_completo 
                    FROM tbl_usu 
                    WHERE puesto IN (1,2,3) 
                    AND estado = 1
                    AND registro_borrado = 'A'";
        } else {
            $sql = "SELECT 
                    id_usu, 
                    CONCAT(nombre, ' ', apellido) AS nombre_completo 
                FROM tbl_usu 
                WHERE puesto IN (1,2,3) 
                AND estado = 1
                AND registro_borrado = 'A'
                AND sede = $sede";
        }

        $result = $this->selectAll($sql);

        $this->cerrarConexion();
        return $result;
    }

    public function getEmpleados()
    {
        $puesto = $this->puesto;
        $sede = $this->id_sede;

        if ($puesto == 'Administrador' || $puesto == 'Jefe') {
            $sql = "SELECT 
                        id_usu, 
                        CONCAT(nombre, ' ', apellido) AS nombre_completo 
                    FROM tbl_usu 
                    WHERE registro_borrado = 'A'";
        } else {
            $sql = "SELECT 
                    id_usu, 
                    CONCAT(nombre, ' ', apellido) AS nombre_completo 
                FROM tbl_usu 
                WHERE registro_borrado = 'A'
                AND sede = $sede";
        }

        $result = $this->selectAll($sql);

        $this->cerrarConexion();
        return $result;
    }

    public function listarProveidos()
    {
        $puesto = $this->puesto;
        $sede = $this->id_sede;

        if ($puesto == 'Administrador' || $puesto == 'Jefe') {
            $sql = "SELECT  p.id_proveidos,
                            p.num_caso,
                            e.dni_evaluado,
                            e.nombre_evaluado, 
                            e.apellido_evaluado,
                            d.nom_dependencia,
                            r.nom_reconocimiento,
                            pr.fecha_citacion,
                            e.estado_evaluacion
                            FROM tbl_proveidos p
                    INNER JOIN tbl_evaluado e on e.id_proveido = p.id_proveidos
                    INNER JOIN tbl_dependencia d on d.id_dependencia = p.fiscalia_remitente
                    INNER JOIN tbl_proveido_reconocimiento pr on pr.id_proveido_reconocimiento = p.id_proveidos
                    INNER JOIN tbl_reconocimiento r on r.id_reconocimiento = pr.tipo_reconocimiento
                    WHERE p.registro_borrado = 'A';";
        } else {
            $sql = "SELECT  p.id_proveidos,
                            p.num_caso,
                            e.dni_evaluado,
                            e.nombre_evaluado, 
                            e.apellido_evaluado,
                            d.nom_dependencia,
                            r.nom_reconocimiento,
                            pr.fecha_citacion,
                            e.estado_evaluacion
                            FROM tbl_proveidos p
                    INNER JOIN tbl_evaluado e on e.id_proveido = p.id_proveidos
                    INNER JOIN tbl_dependencia d on d.id_dependencia = p.fiscalia_remitente
                    INNER JOIN tbl_proveido_reconocimiento pr on pr.id_proveido_reconocimiento = p.id_proveidos
                    INNER JOIN tbl_reconocimiento r on r.id_reconocimiento = pr.tipo_reconocimiento
                    INNER JOIN tbl_usu u on u.id_usu = pr.medico
                    WHERE p.registro_borrado = 'A' AND u.sede = $sede";
        }
        $result = $this->selectAll($sql);

        $this->cerrarConexion();
        return $result;
    }

    public function insertarProveido(
        $numeroSolicitud,
        $fechaEmision,
        $fechaRecepcion,
        $fiscalia,
        $numeroExterno,
        $numeroCasoCorrelativo,
        $especificar
    ) {
        $sql = "INSERT INTO tbl_proveidos (num_caso,num_caso_ext,fech_emi_soli, fech_recep_soli,
        fiscalia_remitente, registro_borrado, num_solicitud, especifique_cual) VALUES(?,?,?,?,?,?,?,?)";
        $array = array(
            $numeroCasoCorrelativo,
            $numeroExterno,
            $fechaEmision,
            $fechaRecepcion,
            $fiscalia,
            'A',
            $numeroSolicitud,
            $especificar
        );

        $result = $this->insertar($sql, $array);

        $this->cerrarConexion();
        return $result;
    }

    public function insertarEvaluado($nombre, $apellido, $dni, $dataProveido)
    {
        $sql = "INSERT INTO tbl_evaluado (nombre_evaluado,apellido_evaluado,dni_evaluado, id_proveido, estado_evaluacion) 
        VALUES(?,?,?,?,?)";
        $array = array($nombre,  $apellido, $dni, $dataProveido, 'Nuevo');

        $result = $this->insertar($sql, $array);

        $this->cerrarConexion();
        return $result;
    }

    public function insertarHecho($departamento, $municipio, $localidad, $lugar, $fechaHecho, $dataProveido)
    {
        $sql = "INSERT INTO tbl_hecho (id_departamento,id_municipio,localidad, lugar_hecho,fecha_hecho,
        id_proveido) VALUES(?,?,?,?,?,?)";
        $array = array($departamento, $municipio, $localidad, $lugar, $fechaHecho, $dataProveido);

        $result = $this->insertar($sql, $array);

        $this->cerrarConexion();
        return $result;
    }

    public function insertarReconocimiento($dataProveido, $tipoReconocimiento, $medico, $fechaCitacion)
    {
        $sql = "INSERT INTO tbl_proveido_reconocimiento (id_proveido_reconocimiento,tipo_reconocimiento,medico, fecha_citacion) 
        VALUES(?,?,?,?)";
        $array = array($dataProveido, $tipoReconocimiento, $medico, $fechaCitacion);

        $result = $this->insertar($sql, $array);

        $this->cerrarConexion();
        return $result;
    }

    public function insertarEvaluacion($dataProveido)
    {
        $sql = "INSERT INTO tbl_evaluacion (id_proveido) VALUES(?)";
        $array = array($dataProveido);

        $result = $this->insertar($sql, $array);

        $this->cerrarConexion();
        return $result;
    }

    public function editarProveido($id)
    {
        $sql = "SELECT  p.num_caso,
                        p.num_caso_ext,
                        p.fech_emi_soli,
                        p.fech_recep_soli,
                        p.fiscalia_remitente,
                        p.especifique_cual,
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
        $result = $this->select($sql);

        $this->cerrarConexion();
        return $result;
    }

    public function actualizarProveido($fechaEmision, $fechaRecepcion, $fiscalia, $numeroExterno, $especificar, $id)
    {
        $sql = "UPDATE tbl_proveidos SET num_caso_ext = ?, fech_emi_soli=?, fech_recep_soli=?,
        fiscalia_remitente=?, especifique_cual=? WHERE id_proveidos=?";
        $array = array($numeroExterno, $fechaEmision, $fechaRecepcion, $fiscalia, $especificar, $id);
        return $this->save($sql, $array);

        $this->cerrarConexion();
        return $result;
    }


    public function actualizarEvaluado($nombre, $apellido, $dni, $id)
    {
        $sql = "UPDATE tbl_evaluado SET nombre_evaluado=?, apellido_evaluado=?, dni_evaluado=?
        WHERE id_proveido=?";
        $array = array($nombre, $apellido, $dni, $id);
        return $this->save($sql, $array);

        $this->cerrarConexion();
        return $result;
    }

    public function actualizarHecho($departamento, $municipio, $localidad, $lugar, $fechaHecho, $id)
    {
        $sql = "UPDATE tbl_hecho SET id_departamento=?, id_municipio=?, localidad=?, lugar_hecho=?, fecha_hecho=? 
        WHERE id_proveido=?";
        $array = array($departamento, $municipio, $localidad, $lugar, $fechaHecho, $id);
        return $this->save($sql, $array);

        $this->cerrarConexion();
        return $result;
    }

    public function actualizarReconocimiento($tipoReconocimiento, $medico, $fechaCitacion, $id)
    {
        $sql = "UPDATE tbl_proveido_reconocimiento SET tipo_reconocimiento=?, medico=?, fecha_citacion=?
        where id_proveido_reconocimiento = ?";
        $array = array($tipoReconocimiento, $medico, $fechaCitacion, $id);
        return $this->save($sql, $array);

        $this->cerrarConexion();
        return $result;
    }


    public function eliminarProveido($id)
    {
        $sql = "UPDATE tbl_proveidos set registro_borrado = 'I' WHERE id_proveidos=?";
        $array = array($id);
        return $this->save($sql, $array);

        $this->cerrarConexion();
        return $result;
    }


    public function obtenerDatosSedes($id)
    {
        $sql = "select s.cod_numerico,
                    c.codigo_numerico
                from tbl_usu u
                inner join tbl_sedes s on s.id_sede = u.sede 
                inner join tbl_clinicas c on c.id_clinica = u.laboratorio
                where u.id_usu = $id";
        $result = $this->selectAll($sql);

        $this->cerrarConexion();
        return $result;
    }


    public function obtenerUltimoCorrelativo($sede, $laboratorio)
    {
        $sql = "SELECT ultimo_correlativo FROM tbl_correlativos_solicitud WHERE sede = ? AND laboratorio = ? FOR UPDATE";
        return $this->getSingleValue($sql, [$sede, $laboratorio]);
    }


    public function obtenerAnioCorrelativo($sede, $laboratorio)
    {
        $sql = "SELECT anio FROM tbl_correlativos_solicitud WHERE sede = ? AND laboratorio = ? FOR UPDATE";
        return $this->getSingleValue($sql, [$sede, $laboratorio]);
    }

    //Funciones para generar numero de solicitud
    public function insertarNuevoCorrelativo($sede, $laboratorio, $correlativoInicial, $añoActual)
    {
        $sql = "INSERT INTO tbl_correlativos_solicitud (sede, laboratorio, ultimo_correlativo, anio) VALUES (?,?,?,?)";
        return $this->save($sql, [$sede, $laboratorio, $correlativoInicial, $añoActual]);
    }

    public function actualizarUltimoCorrelativo($sede, $laboratorio, $nuevoCorrelativo, $añoActual)
    {
        $sql = "UPDATE tbl_correlativos_solicitud SET ultimo_correlativo = ?, anio = ? WHERE sede = ? AND laboratorio = ?";
        return $this->save($sql, [$nuevoCorrelativo, $añoActual, $sede, $laboratorio]);
    }


    //Funciones para generar numero de caso
    public function obtenerUltimoCorrelativoCaso($sede)
    {
        $sql = "SELECT ultimo_correlativo FROM tbl_correlativo_caso WHERE sede = ? FOR UPDATE";
        return $this->getSingleValue($sql, [$sede]);
    }

    public function obtenerAnioCorrelativoCaso($sede)
    {
        $sql = "SELECT anio FROM tbl_correlativo_caso WHERE sede = ? FOR UPDATE";
        return $this->getSingleValue($sql, [$sede]);
    }

    public function insertarNuevoCorrelativoCaso($sede, $correlativoInicial, $añoActual)
    {
        $sql = "INSERT INTO tbl_correlativo_caso (sede, ultimo_correlativo, anio) VALUES (?,?,?)";
        return $this->save($sql, [$sede, $correlativoInicial, $añoActual]);
    }

    public function actualizarUltimoCorrelativoCaso($sede, $nuevoCorrelativo, $añoActual)
    {
        $sql = "UPDATE tbl_correlativo_caso SET ultimo_correlativo = ?, anio = ? WHERE sede = ?";
        return $this->save($sql, [$nuevoCorrelativo, $añoActual ,$sede]);
    }

    public function iniciarTransaccion()
    {
        $this->beginTransaction();
    }

    public function confirmarTransaccion()
    {
        $this->commit();
    }

    public function revertirTransaccion()
    {
        $this->rollback();
    }
}
