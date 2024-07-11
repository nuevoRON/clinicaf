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

    public function crearEvento($idUser, $idObjeto, $accion, $descripcion, $tipo)
    {
        // Establecer la zona horaria a 'America/Tegucigalpa' (Honduras)
        date_default_timezone_set('America/Tegucigalpa');


        $sql = "INSERT INTO tbl_bitacora (FECHA, ID_USUARIO, ID_OBJETO, ACCION, DESCRIPCION, TIPO) VALUES (?,?,?,?,?,?)";
        $fechaActual = new DateTime();
        $fechaFormateada = $fechaActual->format('Y-m-d H:i:s');
        $array = array($fechaFormateada, $idUser, $idObjeto, $accion, $descripcion, $tipo);
        return $this->insertar($sql, $array);
    }
}
?>