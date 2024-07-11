<?php
class CandidatosModel extends Query{
    public function __construct() {
        parent::__construct();
    }

    public function getInformacionCandidato($id)
    {
        $sql = "SELECT C.NOMBRE, C.APELLIDO, C.IDENTIDAD, C.CORREO, C.FECHA_NACIMIENTO,C.TELEFONO,
        S.NOMBRE as SEXO, E.NOMBRE AS ESTADO_CIVIL, M.NOMBRE AS MUNICIPIO,
        S.ID_SEXO, E.CODIGO_ESTADO_CIVIL,M.ID_MUNICIPIO,c.ID_CANDIDATO FROM tbl_candidato C
        inner join tbl_sexo S ON C.SEXO=S.ID_SEXO
        inner join tbl_estado_civil E ON E.CODIGO_ESTADO_CIVIL=C.ESTADO_CIVIL
        inner join tbl_municipio M ON M.ID_MUNICIPIO=C.DIRECCION_DEP_MUN
        WHERE C.ID_CANDIDATO=$id limit 1";
        return $this->selectAll($sql);
    }

    public function getEstudios($id)
    {
        $sql = "SELECT e.NOMBRE_CARRERA, e.FECHA, e.REGISTRO_ESTUDIO, te.NOMBRE_TITULO,
        e.CODIGO_ESTUDIO FROM tbl_estudios e
        inner join tbl_tipo_estudios te on te.CODIGO_ESTUDIOS=e.CODIGO_ESTUDIO
         WHERE e.ID_CANDIDATO = $id
         ORDER BY e.REGISTRO_ESTUDIO asc";
        return $this->selectAll($sql);
    }

    public function getExperiencia($id)
    {
        $sql = "SELECT NOMBRE_EMPRESA, PUESTO, DESCRIPCION,FECHA_INICO,FECHA_FINAL, REGISTRO_EXPERIENCIA
         FROM tbl_experiencia_laboral WHERE ID_CANDIDATO = $id
         ORDER BY REGISTRO_EXPERIENCIA asc";
        return $this->selectAll($sql);
    }

    public function getHabilidades($id)
    {
        $sql = "SELECT DESCRIPCION FROM tbl_habilidades WHERE ID_CANDIDATO = $id";
        return $this->selectAll($sql);
    }

    public function getCursos($id)
    {
        $sql = "SELECT NOMBRE, DESCRIPCION, FECHA, REGISTRO_CURSO FROM tbl_cursos WHERE ID_CANDIDATO = $id
        ORDER BY REGISTRO_CURSO asc";
        return $this->selectAll($sql);
    }


    public function registrarCandidato($nombres,$apellido,$correo,$identidad,$fecha_nacimiento,$sexo,$estado_civil,
        $municipio,$telefono,$curriculum,$id) {
        $sql = "INSERT INTO tbl_candidato VALUES (?,?,?,?,?,?,?,?,?,?,?)";
        $array = array(
            $id, $nombres, $apellido, $identidad, $correo, $fecha_nacimiento, $telefono, $sexo,
            $estado_civil, $municipio, $curriculum
        );
        return $this->insertar($sql, $array);
    }


    public function actualizarCandidato($nombres,$apellido,$correo,$identidad,$fecha_nacimiento,$sexo,$estado_civil,
        $municipio,$telefono,$id) {
        $sql = "UPDATE tbl_candidato SET NOMBRE=?, APELLIDO=?,IDENTIDAD=?,CORREO=?,FECHA_NACIMIENTO=?,
        TELEFONO=?,SEXO=?,ESTADO_CIVIL=?,DIRECCION_DEP_MUN=? WHERE ID_CANDIDATO=?";
        $array = array($nombres, $apellido, $identidad, $correo, $fecha_nacimiento, $telefono, $sexo,
        $estado_civil, $municipio,$id);
        return $this->save($sql, $array);
    }

    public function registrarEstudioCandidato($nivel_educativo, $fecha_finalizacion, $carrera, $id, $posicion)
    {
        $sqlEstudio = "INSERT INTO tbl_estudios VALUES (?,?,?,?,?)";
        $array = array($id, $nivel_educativo, $carrera, $fecha_finalizacion,$posicion);
        return $this->insertar($sqlEstudio, $array);
    }


    public function actualizarEstudioCandidato($nivel_educativo, $fecha_finalizacion, $carrera, $id, $posicion)
    {
        $sqlEstudio = "UPDATE tbl_estudios SET CODIGO_ESTUDIO=?,NOMBRE_CARRERA=?,FECHA=?
         WHERE ID_CANDIDATO=? and REGISTRO_ESTUDIO=?";
        $array = array($nivel_educativo, $carrera, $fecha_finalizacion,$id, $posicion);
        return $this->save($sqlEstudio, $array);
    }

    public function registrarExperienciaCandidato($empresa,$puesto,$descripcion,$fecha_inicio_trabajo,
    $fecha_fin_trabajo,$id,$posicion) {
        $sqlExperienciaLaboral = "INSERT INTO tbl_experiencia_laboral VALUES (?,?,?,?,?,?,?)";
        $array = array($id, $empresa, $puesto, $descripcion, $fecha_inicio_trabajo, $fecha_fin_trabajo,$posicion);
        return $this->insertar($sqlExperienciaLaboral, $array);
    }

    public function actualizarExperienciaCandidato($empresa,$puesto,$descripcion,$fecha_inicio_trabajo,
    $fecha_fin_trabajo,$id,$posicion)
    {
        $sqlEstudio = "UPDATE tbl_experiencia_laboral SET NOMBRE_EMPRESA=?,PUESTO=?,DESCRIPCION=?,
        FECHA_INICO=?, FECHA_FINAL=? WHERE ID_CANDIDATO=? and REGISTRO_EXPERIENCIA=?";
        $array = array($empresa, $puesto, $descripcion, $fecha_inicio_trabajo, $fecha_fin_trabajo, $id, $posicion);
        return $this->save($sqlEstudio, $array);
    }

    public function registrarHabilidadCandidato($habilidad, $id)
    {
        $sqlHabilidades = "INSERT INTO tbl_habilidades VALUES (?,?)";
        $array = array($id, $habilidad);
        return $this->insertar($sqlHabilidades, $array);
    }


    public function actualizarHabilidadCandidato($habilidad, $id)
    {
        $sqlHabilidades = "UPDATE tbl_habilidades SET DESCRIPCION=?
        WHERE ID_CANDIDATO=?";
        $array = array($habilidad, $id);
        return $this->insertar($sqlHabilidades, $array);
    }

    public function registrarCursosCandidato($curso, $fecha, $descripcion, $id, $posicion)
    {
        $sqlHabilidades = "INSERT INTO tbl_cursos VALUES (?,?,?,?,?)";
        $array = array($id, $curso, $descripcion, $fecha, $posicion);
        return $this->insertar($sqlHabilidades, $array);
    }


    public function actualizarCursosCandidato($curso, $fecha, $descripcion, $id, $posicion)
    {
        $sqlHabilidades = "UPDATE tbl_cursos SET NOMBRE=?, DESCRIPCION=?, FECHA=? WHERE ID_CANDIDATO=?
        AND REGISTRO_CURSO=?";
        $array = array($curso, $descripcion, $fecha, $id, $posicion);
        return $this->save($sqlHabilidades, $array);
    }


}