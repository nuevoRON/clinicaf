<?php
class UsuariosModel extends Query
{
    public function __construct()
    {
        parent::__construct();
    }
    public function getUsuarios()
    {
        $sql = "SELECT u.ID_USUARIO, EMPLEADO, CONCAT(u.NOMBRE_USUARIO, ' ' , u.APELLIDO_USUARIO) AS NOMBRE_USUARIO, u.CORREO_ELECTRONICO, u.NUM_IDENTIDAD, u.FECHA_VENCIMIENTO, u.ESTADO_USUARIO, e.DESCRIPCION, u.AUTOREGISTRO, CONCAT(u.DIRECCION_1) AS DIRECCION, u.id, r.ROL AS ROL FROM tbl_usuario u JOIN tbl_estado e ON u.ESTADO_USUARIO = e.ID_ESTADO JOIN tbl_roles r ON u.id = r.id WHERE u.ESTADO_USUARIO != 4";
        return $this->selectAll($sql);
    }
    public function getUsuariosCandidatos($isCandidato)
    {
        $sql = "SELECT u.ID_USUARIO, EMPLEADO, CONCAT(u.NOMBRE_USUARIO, ' ' , u.APELLIDO_USUARIO) AS NOMBRE_USUARIO, u.CORREO_ELECTRONICO, u.NUM_IDENTIDAD, u.FECHA_VENCIMIENTO, u.ESTADO_USUARIO, e.DESCRIPCION, u.AUTOREGISTRO, CONCAT(u.DIRECCION_1) AS DIRECCION, u.id, r.ROL AS ROL FROM tbl_usuario u JOIN tbl_estado e ON u.ESTADO_USUARIO = e.ID_ESTADO JOIN tbl_roles r ON u.id = r.id WHERE u.ESTADO_USUARIO != 4 AND u.EMPLEADO = $isCandidato";
        return $this->selectAll($sql);
    }
    public function getPreguntas()
    {
        $sql = "SELECT * FROM tbl_preguntas;";
        return $this->selectAll($sql);
    }


    public function getPreguntasConfiguradas($id)
    {
        $sql = "SELECT count(*) AS configuradas FROM tbl_preguntas_usuario WHERE ID_USUARIO = $id;";
        return $this->select($sql);
    }
    public function registrar($usuario, $nombres, $apellido, $correo, $identidad, $direccion, $contraseña, $rol)
    {
        $sqlParametro = "SELECT PARAMETROS, VALOR FROM tbl_parametro WHERE PARAMETROS = 'DIAS_VIGENCIA'";
        $parametros = $this->select($sqlParametro);
        $caducidad = $parametros['VALOR'];

        // Generar la fecha
        $fechaActual = new DateTime();
        $fechaCaducidad = $fechaActual->modify('+' . $caducidad . ' days');
        $fechaFormateada = $fechaCaducidad->format('Y-m-d H:i:s');

        $sql = "INSERT INTO tbl_usuario (USUARIO, NOMBRE_USUARIO, APELLIDO_USUARIO, CORREO_ELECTRONICO, NUM_IDENTIDAD, DIRECCION_1, CONTRASEÑA, id, FECHA_VENCIMIENTO) VALUES (?,?,?,?,?,?,?,?,?)";
        $array = array($usuario, $nombres, $apellido, $correo, $identidad, $direccion, $contraseña, $rol, $fechaFormateada);
        return $this->insertar($sql, $array);
    }
    public function autoregistrar($usuario, $nombres, $apellido, $correo, $identidad, $direccion, $contraseña)
    {
        $sqlParametro = "SELECT PARAMETROS, VALOR FROM tbl_parametro WHERE PARAMETROS = 'DIAS_VIGENCIA'";
        $parametros = $this->select($sqlParametro);
        $caducidad = $parametros['VALOR'];

        // Generar la fecha
        $fechaActual = new DateTime();
        $fechaCaducidad = $fechaActual->modify('+' . $caducidad . ' days');
        $fechaFormateada = $fechaCaducidad->format('Y-m-d H:i:s');

        $sql = "INSERT INTO tbl_usuario (USUARIO, NOMBRE_USUARIO, APELLIDO_USUARIO, CORREO_ELECTRONICO, NUM_IDENTIDAD, DIRECCION_1, CONTRASEÑA, FECHA_VENCIMIENTO, AUTOREGISTRO) VALUES (?,?,?,?,?,?,?,?,?)";
        $array = array($usuario, $nombres, $apellido, $correo, $identidad, $direccion, $contraseña, $fechaFormateada, true);
        return $this->insertar($sql, $array);
    }

    public function autoregistrarAdmin($usuario, $nombres, $apellido, $correo, $identidad, $direccion, $contraseña)
    {
        $sqlParametro = "SELECT PARAMETROS, VALOR FROM tbl_parametro WHERE PARAMETROS = 'DIAS_VIGENCIA'";
        $parametros = $this->select($sqlParametro);
        $caducidad = $parametros['VALOR'];

        // Generar la fecha
        $fechaActual = new DateTime();
        $fechaCaducidad = $fechaActual->modify('+' . $caducidad . ' days');
        $fechaFormateada = $fechaCaducidad->format('Y-m-d H:i:s');

        $sql = "INSERT INTO tbl_usuario (USUARIO, NOMBRE_USUARIO, APELLIDO_USUARIO, CORREO_ELECTRONICO, NUM_IDENTIDAD, DIRECCION_1, CONTRASEÑA, FECHA_VENCIMIENTO, AUTOREGISTRO, EMPLEADO) VALUES (?,?,?,?,?,?,?,?,?,?)";
        $array = array($usuario, $nombres, $apellido, $correo, $identidad, $direccion, $contraseña, $fechaFormateada, true, '1');
        return $this->insertar($sql, $array);
    }

    public function guardarPregunta($pregunta, $respuesta, $idUsuario)
    {
        $sql = "INSERT INTO tbl_preguntas_usuario (ID_PREGUNTA, ID_USUARIO, RESPUESTA) VALUES (?,?,?)";
        $array = array($pregunta, $idUsuario, $respuesta);
        return $this->insertar($sql, $array);
    }
    public function traerPregunta($idPregunta, $idUsuario)
    {
        $sql = "SELECT * FROM tbl_preguntas_usuario where ID_PREGUNTA = $idPregunta and ID_USUARIO = $idUsuario";
        return $this->select($sql);
    }
    public function getValidar($campo, $valor, $accion, $id)
    {
        if ($accion == 'registrar' && $id == 0) {
            $sql = " SELECT ID_USUARIO, CORREO_ELECTRONICO FROM tbl_usuario WHERE $campo = '$valor'";
        } else {
            $sql = " SELECT ID_USUARIO, CORREO_ELECTRONICO FROM tbl_usuario WHERE $campo = '$valor' AND ID_USUARIO != $id";
        }
        return $this->select($sql);
    }
    public function eliminar($id)
    {
        $sql = "UPDATE tbl_usuario SET ESTADO_USUARIO=? WHERE ID_USUARIO = ?";
        $array = array(4, $id);
        return $this->save($sql, $array);
    }
    public function editar($id)
    {
        $sql = " SELECT * FROM tbl_usuario WHERE ID_USUARIO = $id";
        return $this->select($sql);
    }
    public function actualizar($nombres,$apellido, $correo, $identidad, $direccion, $rol, $estado, $id)
    {
        $sql = "UPDATE tbl_usuario SET NOMBRE_USUARIO=?, APELLIDO_USUARIO=?, CORREO_ELECTRONICO=?, NUM_IDENTIDAD=?, DIRECCION_1=?, id=?, ESTADO_USUARIO=? WHERE ID_USUARIO=?";
        $array = array($nombres, $apellido, $correo, $identidad, $direccion, $rol, $estado, $id);
        return $this->save($sql, $array);
    }

    public function actualizarIntentos($intento, $id)
    {
        $sql = "UPDATE tbl_usuario SET INTENTO=? WHERE ID_USUARIO=?";
        $array = array($intento, $id);
        return $this->save($sql, $array);
    }
    public function actualizarEstado($id, $estado)
    {
        $sql = "UPDATE tbl_usuario SET ESTADO_USUARIO=? WHERE ID_USUARIO = ?";
        $array = array($estado, $id);
        return $this->save($sql, $array);
    }
    public function getParametro($parametro)
    {
        $sql = "SELECT p.ID_PARAMETRO, p.PARAMETROS, p.VALOR, p.ID_USUARIO, u.USUARIO, p.FECHA_CREACION, p.FECHA_MODIFICACION
        FROM tbl_parametro p
        JOIN tbl_usuario u ON p.ID_USUARIO = u.ID_USUARIO WHERE p.PARAMETROS = $parametro;";
        return $this->select($sql);
    }
    public function getUsuario($usuario)
    {
        $sql = "SELECT ID_USUARIO, NOMBRE_USUARIO, CORREO_ELECTRONICO, CONTRASEÑA, FECHA_VENCIMIENTO, INTENTOS, ESTADO_USUARIO FROM tbl_usuario WHERE USUARIO = '$usuario'";
        return $this->select($sql);
    }
    public function getUsuarioByID($id)
    {
        $sql = "SELECT ID_USUARIO, NOMBRE_USUARIO, CORREO_ELECTRONICO, CONTRASEÑA, FECHA_VENCIMIENTO, INTENTOS, ESTADO_USUARIO, AUTOREGISTRO FROM tbl_usuario WHERE ID_USUARIO = '$id'";
        return $this->select($sql);
    }
    public function bloquearUsuario($id)
    {
        $sql = "UPDATE tbl_usuario SET ESTADO_USUARIO=? WHERE ID_USUARIO=?";
        $array = array(3, $id);
        return $this->save($sql, $array);
    }

    public function modificarClave($clave, $id)
    {
        $sqlParametro = "SELECT PARAMETROS, VALOR FROM tbl_parametro WHERE PARAMETROS = 'DIAS_VIGENCIA'";
        $parametros = $this->select($sqlParametro);
        $caducidad = $parametros['VALOR'];

        // Generar la fecha
        $fechaActual = new DateTime();
        $fechaCaducidad = $fechaActual->modify('+' . $caducidad . ' days');
        $fechaFormateada = $fechaCaducidad->format('Y-m-d H:i:s');

        $sql = "UPDATE tbl_usuario SET CONTRASEÑA = ?, RESETEO_CLANZ = ?, FECHA_VENCIMIENTO = ? WHERE ID_USUARIO = ?";
        $array = array($clave, null, $fechaFormateada, $id);
        return $this->save($sql, $array);
    }

    public function modificarPerfil($nombre, $apellido, $correo, $identidad, $direccion, $id)
    {
        $sql = "UPDATE tbl_usuario SET NOMBRE_USUARIO=?, APELLIDO_USUARIO=?, CORREO_ELECTRONICO=?, NUM_IDENTIDAD=?, DIRECCION_1=? WHERE ID_USUARIO = ?";
        $array = array($nombre, $apellido, $correo, $identidad, $direccion, $id);
        return $this->save($sql, $array);
    }

    public function getMedicos()
    {
        $sql = "SELECT id_usu, nombre, apellido FROM tbl_usu WHERE puesto = '1'";
        return $this->selectAll($sql);
    }
    public function modificarDatos($contraseña, $id)
    {
        $sql = "UPDATE tbl_usuario SET CONTRASEÑA=? WHERE ID_USUARIO=?";
        $array = array($contraseña, $id);
        return $this->save($sql, $array);
    }
}
