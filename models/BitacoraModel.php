<?php
###################################################################             #########################################################################
class BitacoraModel extends Query
{
    public function __construct()
    {
        parent::__construct();
    }
    public function getBitacora($tipo)
    {
        $sql = "SELECT b.FECHA, u.USUARIO, o.OBJETOS, b.ACCION, b.DESCRIPCION, b.TIPO FROM tbl_bitacora b JOIN tbl_objetos o ON b.ID_OBJETO = o.ID_OBJETOS JOIN tbl_usuario u ON u.ID_USUARIO = b.ID_USUARIO WHERE TIPO != $tipo";
        return $this->selectAll($sql);
    }

    public function crearEvento($idUser, $idObjeto, $accion, $descripcion, $fecha)
    {
        $sql = "INSERT INTO tbl_bitacora (id_usuario, id_modulo, accion, descripcion, fecha_accion) VALUES (?,?,?,?,?)";
        $array = array($idUser, $idObjeto, $accion, $descripcion, $fecha);
        return $this->insertar($sql, $array);
    }
}
?>