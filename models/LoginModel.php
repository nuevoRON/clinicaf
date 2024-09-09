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
                       u.sede,
                       s.ubicacion,
                       p.nom_puesto,
                       u.puesto,
                       u.intentos 
                FROM tbl_usu u
                INNER JOIN tbl_sedes s ON s.id_sede = u.sede 
                INNER JOIN tbl_puestos p ON p.id_puesto = u.puesto
                WHERE u.usuario = '$correo'";
        $result = $this->select($sql);

        $this->cerrarConexion();
        return $result;
    }

    public function getRol($idRol)
    {
        $sql = "SELECT * FROM tbl_roles WHERE id = '$idRol'";
        $result = $this->select($sql);

        $this->cerrarConexion();
        return $result;
    }

    public function bloquearUsuario($id)
    {
        $sql = "UPDATE tbl_usu SET estado=? WHERE id_usu=?";
        $array = array(7, $id);
        $result = $this->save($sql, $array);

        $this->cerrarConexion();
        return $result;
    }

    public function resetearIntentos($id)
    {
        $sql = "UPDATE tbl_usu SET intentos = 0 WHERE id_usu=?";
        $array = array($id);
        $result = $this->save($sql, $array);

        $this->cerrarConexion();
        return $result;
    }

    public function actualizarIntentos($id)
    {
        $sql = "UPDATE tbl_usu SET intentos = intentos + 1 WHERE id_usu=?";
        $array = array($id);
        $result = $this->save($sql, $array);

        $this->cerrarConexion();
        return $result;
    }
}
?>