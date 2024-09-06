<?php
class VacacionesModel extends Query
{
    public function __construct()
    {
        parent::__construct();
    }

    public function insertarVacaciones($idEmpleado, $fechaInicio, $fechaFin, $diasVacaciones, $observaciones)
    {
        $sql = "INSERT INTO tbl_vacaciones(id_usu,fecha_inicio,fecha_final,dias_vacaciones,observaciones,
        registro_borrado) VALUES(?,?,?,?,?,?)";
        $array = array($idEmpleado, $fechaInicio, $fechaFin, $diasVacaciones, $observaciones, 'A');

        $result = $this->insertar($sql, $array);

        $this->cerrarConexion();
        return $result;
    }

    public function editarVacacion($id)
    {
        $sql = " SELECT 
                        v.id_vacaciones,
                        v.id_usu,
                        CONCAT(u.nombre,' ',u.apellido) as nombre_completo,
                        u.estado,
                        v.fecha_inicio,
                        v.fecha_final,
                        v.dias_vacaciones,
                        v.observaciones
                FROM tbl_vacaciones v
                INNER JOIN tbl_usu u ON u.id_usu = v.id_usu
                WHERE id_vacaciones = $id";
        $result = $this->select($sql);

        $this->cerrarConexion();
        return $result;
    }

    public function getVacaciones()
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
        $result = $this->selectAll($sql);

        $this->cerrarConexion();
        return $result;
    }



    public function getEmpleados()
    {
        $sql = "SELECT id_usu, num_empleado FROM tbl_usu";
        $result = $this->selectAll($sql);

        $this->cerrarConexion();
        return $result;
    }


    public function getNombreEmpleado($id)
    {
        $sql = "SELECT CONCAT(nombre,' ',apellido)as nombre_completo FROM tbl_usu
                where id_usu = $id";
        $result = $this->select($sql);

        $this->cerrarConexion();
        return $result;
    }

    public function eliminarVacaciones($id)
    {
        $sql = "UPDATE tbl_vacaciones SET registro_borrado='I' WHERE id_vacaciones=?";
        $array = array($id);
        return $this->save($sql, $array);

        $this->cerrarConexion();
        return $result;
    }

    public function actualizarVacaciones($idEmpleado, $fechaInicio, $fechaFin, $diasVacaciones, $observaciones, $id)
    {
        $sql = "UPDATE tbl_vacaciones SET id_usu=?, fecha_inicio = ?, fecha_final = ?, dias_vacaciones = ?,
        observaciones = ? WHERE id_vacaciones=?";
        $array = array($idEmpleado, $fechaInicio, $fechaFin, $diasVacaciones, $observaciones, $id);
        return $this->save($sql, $array);

        $this->cerrarConexion();
        return $result;
    }


    public function actualizarEstado($idEmpleado, $estado)
    {
        $sql = "UPDATE tbl_usu SET estado=? WHERE id_usu=?";
        $array = array($estado, $idEmpleado);
        return $this->save($sql, $array);

        $this->cerrarConexion();
        return $result;
    }
}
