<?php
class CitacionesModel extends Query
{
    private $id_sede;
    private $puesto;

    public function __construct()
    {
        parent::__construct();
        session_start();
        if (!empty($_SESSION['id_usuario'])) {
            $this->id_sede = $_SESSION['id_sede'];
            $this->puesto = $_SESSION['puesto'];
        }
    }

    public function getCitaciones()
    {
        $puesto = $this->puesto;
        $sede = $this->id_sede;

        if($puesto == 'Administrador' || $puesto == 'Jefe') {
            $sql = "SELECT c.id_citacion,
                        p.num_caso, 
                        c.tipo_citacion,
                        c.fecha_recep_citacion,
                        c.fecha_citacion,
                        u.nombre,
                        u.apellido,
                        c.lugar_citacion
                    FROM tbl_citaciones c
                    INNER JOIN tbl_proveidos p ON p.id_proveidos = c.numero_caso
                    INNER JOIN tbl_usu u ON u.id_usu = c.medico
                    WHERE c.registro_borrado = 'A'";
        }else{
            $sql = "SELECT c.id_citacion,
                        p.num_caso, 
                        c.tipo_citacion,
                        c.fecha_recep_citacion,
                        c.fecha_citacion,
                        u.nombre,
                        u.apellido,
                        c.lugar_citacion
                    FROM tbl_citaciones c
                    INNER JOIN tbl_proveidos p ON p.id_proveidos = c.numero_caso
                    INNER JOIN tbl_usu u ON u.id_usu = c.medico
                    WHERE c.registro_borrado = 'A' AND u.sede = $sede";
        }
        $result = $this->selectAll($sql);

        $this->cerrarConexion();
        return $result;
    }


    public function insertarCitacion($numeroCaso, $tipoCitacion, $fechaRecibe, $fechaCitacion, $medico, $lugarCitacion)
    {
        $sql = "INSERT INTO tbl_citaciones (numero_caso,tipo_citacion,fecha_recep_citacion,fecha_citacion,medico,
        lugar_citacion, registro_borrado) VALUES(?,?,?,?,?,?,?)";
        $array = array($numeroCaso, $tipoCitacion, $fechaRecibe, $fechaCitacion, $medico, $lugarCitacion, 'A');
        $result = $this->insertar($sql, $array);

        $this->cerrarConexion();
        return $result;
    }


    public function getCitacion($id)
    {
        $sql = "SELECT *
                FROM tbl_citaciones c
                WHERE id_citacion = $id";
        $result = $this->select($sql);

        $this->cerrarConexion();
        return $result;
    }

    public function getNumerosCasos()
    {
        $puesto = $this->puesto;
        $sede = $this->id_sede;

        if($puesto == 'Administrador' || $puesto == 'Jefe') {
            $sql = "SELECT id_proveidos, num_caso FROM tbl_proveidos";
        }else{
            $sql = "SELECT 
                            p.id_proveidos, 
                            p.num_caso 
                    FROM tbl_proveidos p
                    INNER JOIN tbl_proveido_reconocimiento pr on pr.id_proveido_reconocimiento = p.id_proveidos
                    INNER JOIN tbl_reconocimiento r on r.id_reconocimiento = pr.tipo_reconocimiento
                    INNER JOIN tbl_usu u on u.id_usu = pr.medico
                    WHERE p.registro_borrado = 'A' AND u.sede = $sede";
        }

        $result = $this->selectAll($sql);

        $this->cerrarConexion();
        return $result;
    }

    public function eliminarCitacion($id)
    {
        $sql = "UPDATE tbl_citaciones SET registro_borrado = 'I' WHERE id_citacion = ?";
        $array = array($id);
        $result = $this->save($sql, $array);

        $this->cerrarConexion();
        return $result;
    }

    public function actualizarCitacion($numeroCaso, $tipoCitacion, $fechaRecibe, $fechaCitacion, $medico, $lugarCitacion, $id)
    {
        $sql = "UPDATE tbl_citaciones SET numero_caso=?, tipo_citacion=?, fecha_recep_citacion = ?,
        fecha_citacion = ?, medico = ?, lugar_citacion = ? WHERE id_citacion = ?";
        $array = array($numeroCaso, $tipoCitacion, $fechaRecibe, $fechaCitacion, $medico, $lugarCitacion, $id);
        $result = $this->save($sql, $array);

        $this->cerrarConexion();
        return $result;
    }
}
