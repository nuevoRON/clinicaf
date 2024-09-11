<?php
class exportacionExcelModel extends Query
{
    public function __construct()
    {
        parent::__construct();
    }

    public function listarProveidos($fechaInicio, $fechaFinal, $reconocimiento, $medico, $sexo)
    {
        // Consulta base
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
                WHERE p.registro_borrado = 'A'";

        // Array para almacenar los parámetros de consulta
        $array = array();
        
        // Añadir condiciones dinámicas a la consulta solo si los parámetros están presentes
        if (!empty($fechaInicio) && !empty($fechaFinal)) {
            $sql .= " AND pr.fecha_citacion BETWEEN ? AND ?";
            array_push($array, $fechaInicio, $fechaFinal);
        }
        
        if (!empty($sexo)) {
            $sql .= " AND e.sexo = ?";
            array_push($array, $sexo);
        }
        
        if (!empty($medico)) {
            $sql .= " AND pr.medico = ?";
            array_push($array, $medico);
        }

        if (!empty($reconocimiento)) {
            $sql .= " AND pr.tipo_reconocimiento = ?";
            array_push($array, $reconocimiento);
        }

        // Comprobar si hay parámetros a enlazar
        if (count($array) > 0) {
            // Ejecutar la consulta con los parámetros
            $result = $this->selectAll($sql, $array);
        } else {
            // Ejecutar la consulta sin parámetros si no hay filtros
            $result = $this->selectAll($sql);
        }
        
        // Cerrar conexión
        $this->cerrarConexion();

        return $result;
    }


    public function listarVacaciones($fechaInicio,$fechaFinal,$medico)
    {
        $sql = "SELECT 
                        v.id_vacaciones,
                        u.num_empleado,
                        CONCAT(u.nombre,' ',u.apellido) as nombre_completo,
                        e.nom_estado,
                        v.fecha_inicio,
                        v.fecha_final,
                        v.dias_vacaciones,
                        v.observaciones
                FROM tbl_vacaciones v
                INNER JOIN tbl_usu u ON u.id_usu = v.id_usu
                INNER JOIN tbl_estados e ON e.id_estado = u.estado
                WHERE v.registro_borrado = 'A'";
        // Array para almacenar los parámetros de consulta
        $array = array();
        
        // Añadir condiciones dinámicas a la consulta solo si los parámetros están presentes
        if (!empty($fechaInicio) && !empty($fechaFinal)){
            $sql .= " AND v.fecha_inicio >= ? AND v.fecha_final <= ?";
            array_push($array, $fechaFinal,$fechaInicio);
        }

        if (!empty($medico)){
            $sql .= " AND v.id_usu = ?";
            array_push($array, $medico);
        }

        if (count($array) > 0) {
            $result = $this->selectAll($sql, $array);
        } else {
            $result = $this->selectAll($sql);
        }

        $this->cerrarConexion();
        return $result;
    }


    public function getRevisiones()
    {
        $sql = "SELECT  r.id_revision,
                        CONCAT(u.nombre, ' ', u.apellido) AS nombre_completo,
                        r.fecha_revision,
                        r.numero_dictamen,
                        r.nombre_evaluado,
                        r.fecha_evaluacion,
                        t.nom_reconocimiento,
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

}
