<?php
class PersonalModel extends Query
{
    public function __construct()
    {
        parent::__construct();
    }

    public function listarEmpleados()
    {
        $sql = "SELECT  u.id_usu,
                        CONCAT(u.nombre, ' ', u.apellido) AS nombre_completo,
                        u.num_colegiacion,
                        u.num_empleado,
                        u.correo,
                        u.telefono,
                        j.nom_jornada,
                        e.nom_estado,
                        p.nom_puesto,
                        s.ubicacion
                FROM tbl_usu u
                INNER JOIN tbl_jornada j ON j.id_jornada = u.jornada
                INNER JOIN tbl_estados e ON e.id_estado = u.estado
                INNER JOIN tbl_puestos p ON p.id_puesto = u.puesto
                INNER JOIN tbl_sedes s ON s.id_sede = u.sede
                WHERE u.registro_borrado = 'A'";
        return $this->selectAll($sql);
    }


    public function listarPerfilEmpleado($id)
    {
        $sql = "SELECT  u.nombre, 
                        u.apellido,
                        u.usuario,
                        u.num_colegiacion,
                        u.num_empleado,
                        u.correo,
                        u.telefono,
                        j.nom_jornada,
                        p.nom_puesto,
                        s.ubicacion
                FROM tbl_usu u
                INNER JOIN tbl_jornada j ON j.id_jornada = u.jornada
                INNER JOIN tbl_puestos p ON p.id_puesto = u.puesto
                INNER JOIN tbl_sedes s ON s.id_sede = u.sede
                WHERE u.id_usu = $id";
        return $this->selectAll($sql);
    }


    public function insertarPersonal(
        $nombre,
        $apellido,
        $numColegiacion,
        $numEmpleado,
        $email,
        $telefono,
        $jornada,
        $puesto,
        $sede,
        $estado,
        $usuario,
        $clave,
        $clinica
    ) {
        $claveEncriptada = password_hash($clave, PASSWORD_DEFAULT, ['cost' => 10]);

        $sql = "INSERT INTO tbl_usu (usuario, nombre,apellido,correo,contrasena,telefono,num_colegiacion,num_empleado,
        estado,jornada,puesto,sede,laboratorio,registro_borrado) VALUES(?,?,?,?,?,?,?,?,?,?,?,?,?,?)";
        $array = array(
            $usuario,
            $nombre,
            $apellido,
            $email,
            $claveEncriptada,
            $telefono,
            $numColegiacion,
            $numEmpleado,
            $estado,
            $jornada,
            $puesto,
            $sede,
            $clinica,
            'A'
        );
        return $this->insertar($sql, $array);
    }

    public function obtenerEmpleado($id)
    {
        $sql = " SELECT * FROM tbl_usu WHERE id_usu = $id";
        return $this->select($sql);
    }

    public function getPuestos()
    {
        $sql = "SELECT * FROM tbl_puestos";
        return $this->selectAll($sql);
    }

    public function getEstados()
    {
        $sql = "SELECT * FROM tbl_estados";
        return $this->selectAll($sql);
    }

    public function getJornadas()
    {
        $sql = "SELECT * FROM tbl_jornada";
        return $this->selectAll($sql);
    }


    public function getClinicas()
    {
        $sql = "SELECT id_clinica, nombre FROM tbl_clinicas";
        return $this->selectAll($sql);
    }


    public function eliminarEmpleado($id)
    {
        $sql = "UPDATE tbl_usu SET registro_borrado = 'I'  WHERE id_usu=?";
        $array = array($id);
        return $this->save($sql, $array);
    }

    public function actualizarPersonal(
        $nombre,
        $apellido,
        $numColegiacion,
        $numEmpleado,
        $email,
        $telefono,
        $jornada,
        $puesto,
        $sede,
        $estado,
        $usuario,
        $clinica,
        $id
    ) {
        $sql = "UPDATE tbl_usu SET usuario = ?, nombre=?, apellido = ?, num_colegiacion = ?, num_empleado = ?,
                correo = ?, telefono = ?, jornada = ?, puesto = ?, sede = ?, estado=?, laboratorio = ?  WHERE id_usu=?";
        $array = array(
            $usuario,
            $nombre,
            $apellido,
            $numColegiacion,
            $numEmpleado,
            $email,
            $telefono,
            $jornada,
            $puesto,
            $sede,
            $estado,
            $clinica,
            $id
        );
        return $this->save($sql, $array);
    }


    public function actualizarPerfil(
        $nombre,
        $apellido,
        $email,
        $telefono,
        $id
    ) {
        $sql = "UPDATE tbl_usu SET nombre=?, apellido = ?, correo = ?, telefono = ? WHERE id_usu=?";
        $array = array(
            $nombre,
            $apellido,
            $email,
            $telefono,
            $id
        );
        return $this->save($sql, $array);
    }


    public function actualizarClave(
        $clave,
        $id
    ) {
        $claveEncriptada = password_hash($clave, PASSWORD_DEFAULT, ['cost' => 10]);

        $sql = "UPDATE tbl_usu SET contrasena=? WHERE id_usu=?";
        $array = array(
            $claveEncriptada,
            $id
        );
        return $this->save($sql, $array);
    }


    public function verExistenciaUsuario($usuario)
    {
        $sql = "SELECT * 
                FROM tbl_usu
                WHERE usuario = '$usuario'";
        return $this->select($sql);
    }

    public function verExistenciaColegiacion($numColegiacion)
    {
        $sql = "SELECT * 
                FROM tbl_usu
                WHERE num_colegiacion = '$numColegiacion'";
        return $this->select($sql);
    }

    public function verExistenciaNumEmpleado($numEmpleado)
    {
        $sql = "SELECT * 
                FROM tbl_usu
                WHERE num_empleado = '$numEmpleado'";
        return $this->select($sql);
    }

    public function verExistenciaEmail($email)
    {
        $sql = "SELECT * 
                FROM tbl_usu
                WHERE correo = '$email'";
        return $this->select($sql);
    }


    public function revisarUsuarioBloqueado($id)
    {
        $sql = "SELECT id_usu 
                FROM tbl_usu
                WHERE id_usu = $id AND estado = 7";
        return $this->select($sql);
    }


    public function resetearClave($clave, $id){
        $claveEncriptada = password_hash($clave, PASSWORD_DEFAULT, ['cost' => 12]);

        $sql = "UPDATE tbl_usu SET contrasena=?, estado = 1, intentos = 0 WHERE id_usu=?";
        $array = array($claveEncriptada,$id);
        return $this->save($sql, $array);
    }
}
