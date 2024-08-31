<?php
class LoginModel extends Query{
    public function __construct() {
        parent::__construct();
    }
    public function getDatos($correo)
    {
        $sql = "SELECT u.id_usu,
                       u.usuario,
                       u.nombre,
                       u.contrasena,
                       u.apellido,
                       u.estado,
                       s.ubicacion,
                       p.nom_puesto,
                       u.puesto,
                       u.intentos 
                FROM tbl_usu u
                INNER JOIN tbl_sedes s ON s.id_sede = u.sede 
                INNER JOIN tbl_puestos p ON p.id_puesto = u.puesto
                WHERE u.usuario = '$correo'";
        return $this->select($sql);
    }

    public function getRol($idRol)
    {
        $sql = "SELECT * FROM tbl_roles WHERE id = '$idRol'";
        return $this->select($sql);
    }

    public function bloquearUsuario($id)
    {
        $sql = "UPDATE tbl_usu SET estado=? WHERE id_usu=?";
        $array = array(7, $id);
        return $this->save($sql, $array);
    }

    public function resetearIntentos($id)
    {
        $sql = "UPDATE tbl_usu SET intentos = 0 WHERE id_usu=?";
        $array = array($id);
        return $this->save($sql, $array);
    }

    public function actualizarIntentos($id)
    {
        $sql = "UPDATE tbl_usu SET intentos = intentos + 1 WHERE id_usu=?";
        $array = array($id);
        return $this->save($sql, $array);
    }
}
?>