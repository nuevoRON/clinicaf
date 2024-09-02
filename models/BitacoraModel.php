<?php
###################################################################             #########################################################################
class BitacoraModel extends Query
{
    public function __construct()
    {
        parent::__construct();
    }
    public function getBitacora()
    {
        $sql = "SELECT 
                    u.usuario,
                    m.nombre,
                    b.accion,
                    b.descripcion,
                    b.fecha_accion
                FROM tbl_bitacora b
                INNER JOIN tbl_usu u on u.id_usu = b.id_usuario 
                INNER JOIN tbl_modulos m on m.id = b.id_modulo
                ORDER BY b.id_bitacora DESC";
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