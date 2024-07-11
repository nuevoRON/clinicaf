<?php

//Load Composer's autoloader
require 'vendor/autoload.php';
class Candidatos extends Controller
{
    private $id_usuario;
    public function __construct()
    {
        parent::__construct();
        session_start();
        $this->id_usuario = $_SESSION['id_usuario'];
    }
    public function preguntas()
    {
        $data['title'] = 'confPreguntas';
        $data['script'] = 'confPreguntas.js';
        $this->views->getView('usuarios', 'preguntas', $data);
    }

    public function listar()
    {
        $data = $this->model->getUsuarios();
        for ($i = 0; $i < count($data); $i++) {
            if ($data[$i]['ID_ROL'] == 1) {
                $data[$i]['ID_ROL'] = '<span class="badge bg-success">ADMINISTRADOR</span>';
            } else {
                $data[$i]['ID_ROL'] = '<span class="badge bg-info">ASISTENTE</span>';
            }
            $data[$i]['acciones'] = '<div>
            <button class="btn btn-danger" type="button" onclick="eliminarUsuario(' . $data[$i]['ID_USUARIO'] . ')"><i class = "fas fa-times-circle"></i></button>
            <button class="btn btn-info" type="button" onclick="editarUsuario(' . $data[$i]['ID_USUARIO'] . ')"><i class="fa-regular fa-pen-to-square"></i></button>
            </div>';
        }
        echo json_encode($data, JSON_UNESCAPED_UNICODE);
        die();
    }

    public function getInformacionCandidato($id)
    {
        $data = $this->model->getInformacionCandidato($id);
        $res = array('candidato' => $data, 'type' => 'success');
        echo json_encode($res, JSON_UNESCAPED_UNICODE);
        die();
    }


    public function getEstudios($id)
    {
        $data = $this->model->getEstudios($id);
        echo json_encode($data, JSON_UNESCAPED_UNICODE);
        die();
    }

    public function getExperiencia($id)
    {
        $data = $this->model->getExperiencia($id);
        echo json_encode($data, JSON_UNESCAPED_UNICODE);
        die();
    }

    public function getHabilidades($id)
    {
        $data = $this->model->getHabilidades($id);
        echo json_encode($data, JSON_UNESCAPED_UNICODE);
        die();
    }

    public function getCursos($id)
    {
        $data = $this->model->getCursos($id);
        echo json_encode($data, JSON_UNESCAPED_UNICODE);
        die();
    }


    //metodo para registrar y modificar
    public function registrarInformacionPersonal()
    {
        if (isset($_POST)) {
            if (empty($_POST['fecha_nacimiento'])) {
                $res = array('msg' => 'LA FECHA DE NACIMIENTO ES REQUERIDA', 'type' => 'warning');
            } else if (empty($_POST['nombres'])) {
                $res = array('msg' => 'EL NOMBRE ES REQUERIDO', 'type' => 'warning');
            } else if (empty($_POST['apellido'])) {
                $res = array('msg' => 'EL APELLIDO ES REQUERIDO', 'type' => 'warning');
            } else if (empty($_POST['correo'])) {
                $res = array('msg' => 'EL CORREO ES REQUERIDO', 'type' => 'warning');
            } else if (empty($_POST['identidad'])) {
                $res = array('msg' => 'LA IDENTIDAD ES REQUERIDO', 'type' => 'warning');
            } else if (empty($_POST['sexo'])) {
                $res = array('msg' => 'EL SEXO ES REQUERIDO', 'type' => 'warning');
            } else if (empty($_POST['municipio'])) {
                $res = array('msg' => 'EL MUNICIPIO ES REQUERIDO', 'type' => 'warning');
            } else if (empty($_POST['telefono'])) {
                $res = array('msg' => 'EL TELEFONO ES REQUERIDO', 'type' => 'warning');
            } else{
                $nombres = strClean($_POST['nombres']);
                $apellido = strClean($_POST['apellido']);
                $correo = strClean($_POST['correo']);
                $identidad = strClean($_POST['identidad']);
                $fecha_nacimiento = strClean($_POST['fecha_nacimiento']);
                $sexo = strClean($_POST['sexo']);
                $estado_civil = strClean($_POST['estado_civil']);
                $municipio = ($_POST['municipio']);
                $telefono = ($_POST['telefono']);
        
                $id = ($_SESSION['id_usuario']);
                $nombre_archivo=($_FILES['curriculum']['name']);
                $nombre_archivoLimpio = str_replace(' ', '-', $nombre_archivo);
                $file_type = strtolower(pathinfo($nombre_archivoLimpio,PATHINFO_EXTENSION));

                if($file_type != "docx" && $file_type != "pdf"){
                    $res = array('msg' => 'SOLO SE PUEDEN SUBIR ARCHIVOS DE FORMATO PDF Y DOCX', 'type' => 'warning');
                }

                $temporal=$_FILES['curriculum']['tmp_name'];
                $carpeta='./assets/archivos/curriculums';
                $ruta=$carpeta.'/'.$nombre_archivoLimpio;
                move_uploaded_file($temporal,$carpeta.'/'. $nombre_archivoLimpio);

                try {
                    $data = $this->model->registrarCandidato($nombres, $apellido, $correo, $identidad, $fecha_nacimiento, $sexo, $estado_civil, $municipio, $telefono,$ruta,$id);

                    if (($data == 0)) {
                        $res = array('msg' => 'INFORMACIÓN PERSONAL REGISTRADA', 'type' => 'success');
                    } else {
                        $res = array('msg' => 'ERROR AL REGISTRAR', 'type' => 'error');
                    }
                } catch (PDOException $e) {
                    $res = array(
                        'type' => 'error',
                        'msg' => 'Error en la base de datos: ' . $e->getMessage()
                    );
                }
            }
        } else {
            $res = array('msg' => 'ERROR DESCONOCIDO', 'type' => 'error');
        }

        echo json_encode($res, JSON_UNESCAPED_UNICODE);
        die();
    }


    public function actualizarInformacionPersonal()
    {
        if (isset($_POST)) {
            if (empty($_POST['fecha_nacimiento'])) {
                $res = array('msg' => 'LA FECHA DE NACIMIENTO ES REQUERIDA', 'type' => 'warning');
            } else if (empty($_POST['nombres'])) {
                $res = array('msg' => 'EL NOMBRE ES REQUERIDO', 'type' => 'warning');
            } else if (empty($_POST['apellido'])) {
                $res = array('msg' => 'EL APELLIDO ES REQUERIDO', 'type' => 'warning');
            } else if (empty($_POST['correo'])) {
                $res = array('msg' => 'EL CORREO ES REQUERIDO', 'type' => 'warning');
            } else if (empty($_POST['identidad'])) {
                $res = array('msg' => 'LA IDENTIDAD ES REQUERIDO', 'type' => 'warning');
            } else if (empty($_POST['sexo'])) {
                $res = array('msg' => 'EL SEXO ES REQUERIDO', 'type' => 'warning');
            } else if (empty($_POST['municipio'])) {
                $res = array('msg' => 'EL MUNICIPIO ES REQUERIDO', 'type' => 'warning');
            } else if (empty($_POST['telefono'])) {
                $res = array('msg' => 'EL TELEFONO ES REQUERIDO', 'type' => 'warning');
            } else{
                $nombres = strClean($_POST['nombres']);
                $apellido = strClean($_POST['apellido']);
                $correo = strClean($_POST['correo']);
                $identidad = strClean($_POST['identidad']);
                $fecha_nacimiento = strClean($_POST['fecha_nacimiento']);
                $sexo = strClean($_POST['sexo']);
                $estado_civil = strClean($_POST['estado_civil']);
                $municipio = ($_POST['municipio']);
                $telefono = ($_POST['telefono']);
                $id = ($_SESSION['id_usuario']);

                try {
                    $data = $this->model->actualizarCandidato($nombres, $apellido, $correo, $identidad, $fecha_nacimiento, $sexo, $estado_civil, $municipio, $telefono,$id);

                    if (($data > 0)) {
                        $res = array('msg' => 'INFORMACIÓN PERSONAL ACTUALIAZADA', 'type' => 'success');
                    } else {
                        $res = array('msg' => 'ERROR AL REGISTRAR', 'type' => 'error');
                    }
                } catch (PDOException $e) {
                    $res = array(
                        'type' => 'error',
                        'msg' => 'Error en la base de datos: ' . $e->getMessage()
                    );
                } 
            }
        } else {
            $res = array('msg' => 'ERROR DESCONOCIDO', 'type' => 'error');
        }

        echo json_encode($res, JSON_UNESCAPED_UNICODE);
        die();
    }


    public function registrarNivelEducativo()
    {
        if (isset($_POST)) {
            if (empty($_POST['nivel_educativo'])) {
                $res = array('msg' => 'EL NIVEL EDUCATIVO ES REQUERIDO', 'type' => 'warning');
            } else if (empty($_POST['carrera'])) {
                $res = array('msg' => 'LA CARRERA ES REQUERIDA', 'type' => 'warning');
            } else if (empty($_POST['fecha_inicio'])) {
                $res = array('msg' => 'LA FECHA DE FINALIZACION DE ESTUDIOS ES REQUERIDA', 'type' => 'warning');
            }else{
                $nivel_educativo = ($_POST['nivel_educativo']);
                $carrera = ($_POST['carrera']);
                $fecha_finalizacion = ($_POST['fecha_inicio']);
        
                $id = ($_SESSION['id_usuario']);

                try {
                    //Los datos de educacion se guardan con un for debido a que pueden ser varios niveles educativos
                    for ($i = 0; $i < count($nivel_educativo); $i++) {
                        $data = $this->model->registrarEstudioCandidato(
                        $nivel_educativo[$i], 
                        $fecha_finalizacion[$i], 
                        $carrera[$i], 
                        $id,
                        $i+1);
                    }

                    if (($data == 0)) {
                        $res = array('msg' => 'NIVEL EDUCATIVO REGISTRADO', 'type' => 'success');
                    } else {
                        $res = array('msg' => 'ERROR AL REGISTRAR', 'type' => 'error');
                    }
                } catch (PDOException $e) {
                    $res = array(
                        'type' => 'error',
                        'msg' => 'Error en la base de datos: ' . $e->getMessage()
                    );
                }
            }
        } else {
            $res = array('msg' => 'ERROR DESCONOCIDO', 'type' => 'error');
        }

        echo json_encode($res, JSON_UNESCAPED_UNICODE);
        die();
    }


    public function actualizarNivelEducativo()
    {
        if (isset($_POST)) {
            if (empty($_POST['nivel_educativo'])) {
                $res = array('msg' => 'EL NIVEL EDUCATIVO ES REQUERIDO', 'type' => 'warning');
            } else if (empty($_POST['carrera'])) {
                $res = array('msg' => 'LA CARRERA ES REQUERIDA', 'type' => 'warning');
            } else if (empty($_POST['fecha_inicio'])) {
                $res = array('msg' => 'LA FECHA DE FINALIZACION DE ESTUDIOS ES REQUERIDA', 'type' => 'warning');
            }else{
                $nivel_educativo = ($_POST['nivel_educativo']);
                $carrera = ($_POST['carrera']);
                $fecha_finalizacion = ($_POST['fecha_inicio']);
                $id = ($_SESSION['id_usuario']);
    

                try {
                    //Los datos de educacion se guardan con un for debido a que pueden ser varios niveles educativos
                    for ($i = 0; $i < count($nivel_educativo); $i++) {
                        $data = $this->model->actualizarEstudioCandidato(
                        $nivel_educativo[$i], 
                        $fecha_finalizacion[$i], 
                        $carrera[$i], 
                        $id,
                        $i+1);
                    }

                    if (($data > 0)) {
                        $res = array('msg' => 'NIVEL EDUCATIVO ACTUALIZADO', 'type' => 'success');
                    } else {
                        $res = array('msg' => 'ERROR AL REGISTRAR', 'type' => 'error');
                    }
                } catch (PDOException $e) {
                    $res = array(
                        'type' => 'error',
                        'msg' => 'Error en la base de datos: ' . $e->getMessage()
                    );
                }
            }
        } else {
            $res = array('msg' => 'ERROR DESCONOCIDO', 'type' => 'error');
        }

        echo json_encode($res, JSON_UNESCAPED_UNICODE);
        die();
    }


    public function registrarExperienciaLaboral()
    {
        if (isset($_POST)) {
            $empresa   = ($_POST['empresa']);
            $puesto  = ($_POST['puesto']);
            $fecha_inicio_trabajo  = ($_POST['fecha_inicio_trabajo']);
            $fecha_fin_trabajo  = ($_POST['fecha_fin_trabajo']);
            $descripcion   = ($_POST['descripcion']);
            
        
                $id = ($_SESSION['id_usuario']);

                try {
                    //Los datos de educacion se guardan con un for debido a que pueden ser varios niveles educativos
                    if($puesto[0]!=''){
                        for ($i = 0; $i < count($puesto); $i++) {
                            $data = $this->model->registrarExperienciaCandidato(
                                $empresa[$i],
                                $puesto[$i],
                                $descripcion[$i],
                                $fecha_inicio_trabajo[$i],
                                $fecha_fin_trabajo[$i],
                                $id,
                                $i+1
                            ); 
                        }
                    }

                    if (($data == 0)) {
                        $res = array('msg' => 'EXPERIENCIA LABORAL REGISTRADA', 'type' => 'success');
                    } else {
                        $res = array('msg' => 'ERROR AL REGISTRAR', 'type' => 'error');
                    }
                } catch (PDOException $e) {
                    $res = array(
                        'type' => 'error',
                        'msg' => 'Error en la base de datos: ' . $e->getMessage()
                    );
                }
        } else {
            $res = array('msg' => 'ERROR DESCONOCIDO', 'type' => 'error');
        }

        echo json_encode($res, JSON_UNESCAPED_UNICODE);
        die();
    }


    public function actualizarExperienciaLaboral()
    {
        if (isset($_POST)) {
            $empresa   = ($_POST['empresa']);
            $puesto  = ($_POST['puesto']);
            $fecha_inicio_trabajo  = ($_POST['fecha_inicio_trabajo']);
            $fecha_fin_trabajo  = ($_POST['fecha_fin_trabajo']);
            $descripcion   = ($_POST['descripcion']);
        
            $id = ($_SESSION['id_usuario']);

                try {
                    //Los datos de educacion se guardan con un for debido a que pueden ser varios niveles educativos
                    if($puesto[0]!=''){
                        for ($i = 0; $i < count($puesto); $i++) {
                            $data = $this->model->actualizarExperienciaCandidato(
                                $empresa[$i],
                                $puesto[$i],
                                $descripcion[$i],
                                $fecha_inicio_trabajo[$i],
                                $fecha_fin_trabajo[$i],
                                $id,
                                $i+1
                            ); 
                        }
                    }

                    if (($data >0)) {
                        $res = array('msg' => 'EXPERIENCIA LABORAL ACTUALIZADA', 'type' => 'success');
                    } else {
                        $res = array('msg' => 'ERROR AL ACTUALIZAR', 'type' => 'error');
                    }
                } catch (PDOException $e) {
                    $res = array(
                        'type' => 'error',
                        'msg' => 'Error en la base de datos: ' . $e->getMessage()
                    );
                }
        } else {
            $res = array('msg' => 'ERROR DESCONOCIDO', 'type' => 'error');
        }

        echo json_encode($res, JSON_UNESCAPED_UNICODE);
        die();
    }


    public function registrarCursosHabilidades()
    {
        if (isset($_POST)) {
            $habilidad   = ($_POST['habilidad']);
            $curso   = ($_POST['curso']);
            $fecha_curso   = ($_POST['fecha_curso']);
            $descripcion_curso   = ($_POST['descripcion_curso']);
        
                $id = ($_SESSION['id_usuario']);

                try {
                    if($habilidad!=''){
                        $dataHabilidad = $this->model->registrarHabilidadCandidato($habilidad,$id); 
                    }

                    //Los datos de cursos se guardan con un for debido a que pueden haber varios cursos anteriores
                    if($curso[0]!=''){
                        for ($i = 0; $i < count($curso); $i++) {
                            $dataCurso = $this->model->registrarCursosCandidato(
                                $curso[$i],
                                $fecha_curso[$i],
                                $descripcion_curso[$i],
                                $id,
                                $i+1
                            ); 
                        }
                    }

                   
                    $res = array('msg' => 'DATOS DE CANDIDATO REGISTRADOS', 'type' => 'success');
                    
                } catch (PDOException $e) {
                    $res = array(
                        'type' => 'error',
                        'msg' => 'Error en la base de datos: ' . $e->getMessage()
                    );
                }
        } else {
            $res = array('msg' => 'ERROR DESCONOCIDO', 'type' => 'error');
        }

        echo json_encode($res, JSON_UNESCAPED_UNICODE);
        die();
    }


    public function actualizarCursosHabilidades()
    {
        if (isset($_POST)) {
            $habilidad   = ($_POST['habilidad']);
            $curso   = ($_POST['curso']);
            $fecha_curso   = ($_POST['fecha_curso']);
            $descripcion_curso   = ($_POST['descripcion_curso']);
        
                $id = ($_SESSION['id_usuario']);

                try {
                    if($habilidad!=''){
                        $dataHabilidad = $this->model->actualizarHabilidadCandidato($habilidad,$id); 
                    }

                    //Los datos de cursos se guardan con un for debido a que pueden haber varios cursos anteriores
                    if($curso[0]!=''){
                        for ($i = 0; $i < count($curso); $i++) {
                            $dataCurso = $this->model->actualizarCursosCandidato(
                                $curso[$i],
                                $fecha_curso[$i],
                                $descripcion_curso[$i],
                                $id,
                                $i+1
                            ); 
                        }
                    }

                   
                    $res = array('msg' => 'DATOS DE CANDIDATO ACTUALIZADOS', 'type' => 'success');
                    
                } catch (PDOException $e) {
                    $res = array(
                        'type' => 'error',
                        'msg' => 'Error en la base de datos: ' . $e->getMessage()
                    );
                }
        } else {
            $res = array('msg' => 'ERROR DESCONOCIDO', 'type' => 'error');
        }

        echo json_encode($res, JSON_UNESCAPED_UNICODE);
        die();
    }


}