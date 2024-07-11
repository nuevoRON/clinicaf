<?php
class LoginModel extends Query{
    public function __construct() {
        parent::__construct();
    }
    public function getDatos($correo)
    {
        $sql = "SELECT * FROM tbl_usu WHERE usuario = '$correo'";
        return $this->select($sql);
    }

    public function actualizarIntentos($intento, $id)
    {
        $sql = "UPDATE tbl_usuario SET INTENTOS=? WHERE ID_USUARIO=?";
        $array = array($intento, $id);
        return $this->save($sql, $array);
    }

    public function getRol($idRol)
    {
        $sql = "SELECT * FROM tbl_roles WHERE id = '$idRol'";
        return $this->select($sql);
    }

    public function bloquearUsuario($id)
    {
        $sql = "UPDATE tbl_usuario SET ESTADO_USUARIO=? WHERE ID_USUARIO=?";
        $array = array(3, $id);
        return $this->save($sql, $array);
    }

    public function getParametro($parametro)
    {
        $sql = "SELECT p.ID_PARAMETRO, p.PARAMETROS, p.VALOR, p.ID_USUARIO, u.USUARIO, p.FECHA_CREACION, p.FECHA_MODIFICACION
        FROM tbl_parametro p
        JOIN tbl_usuario u ON p.ID_USUARIO = u.ID_USUARIO WHERE p.PARAMETROS = $parametro;";
        return $this->select($sql);
    }
}
?>