<?php
class UsuariosModel extends Query
{
    public function __construct()
    {
        parent::__construct();
    }

    public function getMedicos()
    {
        $sql = "SELECT id_usu, nombre, apellido FROM tbl_usu WHERE puesto IN (1,2,3) AND estado = 1";
        return $this->selectAll($sql);
    }
}
