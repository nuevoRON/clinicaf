<?php
class PermisosModel extends Query
{
    //Objeto que contiene los campos de los permisos disponibles para validar
    private $acciones = [
        1 => 'consulta',
        2 => 'insercion',
        3 => 'actualizacion',
        4 => 'eliminacion',
    ];

    public function __construct()
    {
        parent::__construct();
    }

    public function insertarPermiso($puesto, $modulo, $consulta, $insercion, $actualizacion, $eliminacion)
    {
        $sql = "INSERT INTO tbl_permisos (id_modulo, id_puesto, consulta, insercion, actualizacion, eliminacion,
        registro_borrado) VALUES(?,?,?,?,?,?,?)";
        $array = array($modulo, $puesto, $consulta, $insercion, $actualizacion, $eliminacion, 'A');
        
        $result = $this->insertar($sql, $array);

        $this->cerrarConexion();
        return $result;
    }

    public function obtenerPermisos($id)
    {
        $sql = " SELECT * FROM tbl_permisos WHERE id = $id";
        $result = $this->select($sql);

        $this->cerrarConexion();
        return $result;
    }

    public function getPermisos()
    {
        $sql = " SELECT 
                        pr.id,
                        p.nom_puesto,
                        m.nombre,
                        pr.consulta,
                        pr.insercion,
                        pr.actualizacion,
                        pr.eliminacion
                FROM tbl_permisos pr
                INNER JOIN tbl_puestos p ON p.id_puesto = pr.id_puesto
                INNER JOIN tbl_modulos m ON m.id = pr.id_modulo
                WHERE pr.registro_borrado = 'A'";
        $result = $this->selectAll($sql);

        $this->cerrarConexion();
        return $result;
    }

    public function eliminarPermiso($id)
    {
        $sql = "UPDATE tbl_permisos SET registro_borrado = 'I' WHERE id = $id";
        $result = $this->select($sql);

        $this->cerrarConexion();
        return $result;
    }

    public function actualizarPermiso($puesto, $modulo, $consulta, $insercion, $actualizacion, $eliminacion, $id)
    {
        $sql = "UPDATE tbl_permisos SET id_puesto=?, id_modulo=?, consulta=?, insercion=?,
        actualizacion=?, eliminacion=? WHERE id=?";
        $array = array($puesto, $modulo, $consulta, $insercion, $actualizacion, $eliminacion,  $id);
        return $this->save($sql, $array);

        $this->cerrarConexion();
        return $result;
    }


    
    public function validarPermisos($consulta, $modulo)
    {
        if (!array_key_exists($consulta, $this->acciones)) {
            throw new Exception("Consulta no válida.");
        }
    
        $campo = $this->acciones[$consulta];
        $modulo = filter_var($modulo, FILTER_VALIDATE_INT);
        $puesto = filter_var($_SESSION['id_puesto'], FILTER_VALIDATE_INT);
    
        if ($modulo === false || $puesto === false) {
            throw new Exception("Parámetros inválidos.");
        }

        $sql = "SELECT $campo FROM tbl_permisos WHERE id_modulo = ? AND id_puesto = ?
                AND registro_borrado = 'A'";
        $params = [$modulo, $puesto];
        $types = [PDO::PARAM_INT, PDO::PARAM_INT]; 

        $result =  $this->select($sql, $params, $types);
        $this->cerrarConexion();
        return $result;
    }


    public function verExistenciaPermiso($pues, $mod)
    {
        $puesto = filter_var($pues, FILTER_VALIDATE_INT);
        $modulo = filter_var($mod, FILTER_VALIDATE_INT);
        
        $sql = "SELECT * FROM tbl_permisos WHERE id_modulo = ? AND id_puesto = ?
                AND registro_borrado = 'A'";
        $params = [$modulo, $puesto];
        $types = [PDO::PARAM_INT, PDO::PARAM_INT]; 

        $result =  $this->select($sql, $params, $types);

        $this->cerrarConexion();
        return $result;
    }
}
