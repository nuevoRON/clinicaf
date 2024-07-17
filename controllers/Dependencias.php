<?php
//require 'Bitacora.php';

//Load Composer's autoloader
require 'vendor/autoload.php';
class Dependencias extends Controller
{

    private $id_usuario;
    public function __construct()
    {
        parent::__construct();
        session_start();
        if (!empty($_SESSION['id_usuario'])) {
            $this->id_usuario = $_SESSION['id_usuario'];
        }
    }

    public function getDependencias(){
        $data = $this->model->getDependencias();
        $res = array('dependencias'=>$data, 'type'=>'success');
        echo json_encode($res, JSON_UNESCAPED_UNICODE);
        die();
    }


    public function getDepartamentos(){
        $data = $this->model->getDepartamentos();
        $res = array('departamentos'=>$data, 'type'=>'success');
        echo json_encode($res, JSON_UNESCAPED_UNICODE);
        die();
    }


    public function getMunicipios($id)
    {   
        $data = $this->model->getMunicipios($id);
        echo json_encode($data, JSON_UNESCAPED_UNICODE);
        die();
    }

    //metodo para registrar y modificar
    public function registrarPuesto(){
        if (isset($_POST)) {
            if (empty($_POST['nombres'])) {
                $res = array('msg' => 'EL NOMBRE ES REQUERIDO', 'type' => 'warning');
            } else if (empty($_POST['descripcion'])) {
                $res = array('msg' => 'EL NOMBRE ES REQUERIDO', 'type' => 'warning');
            }else if (empty($_POST['salario'])) {
                $res = array('msg' => 'EL SALARO ES REQUERIDO', 'type' => 'warning');
            }else{
                $nombres = strClean($_POST['nombres']);
                $descripcion = strClean($_POST['descripcion']); 
                $salario = strClean($_POST['salario']); //

                $id = strClean($_POST['id']);
                if ($id == '') {
                    $data = $this->model->registrarPuesto($nombres,$descripcion,$salario);
                        if ($data > 0) {
                            $bitacora = new Bitacora();
                            $bitacora->model->crearEvento($_SESSION['id_usuario'], 26, 'CREACION', 'SE HA CREADO EL PUESTO '.$nombres, 1);
                            $res = array('msg' => 'PUESTO REGISTRADO', 'type' => 'success');

                        } else {
                            $res = array('msg' => 'ERROR AL REGISTRAR', 'type' => 'error');
                        }
                } else {
                    //verificar si existen los datos (ACTUALIZAR)
                    $data = $this->model->actualizarPuesto($nombres,$descripcion,$salario,$id);
                    if ($data > 0) {
                        $bitacora = new Bitacora();
                        $bitacora->model->crearEvento($_SESSION['id_usuario'], 26, 'ACTUALIZACIÓN', 'SE HA ACTUALIZADO EL PUESTO '.$nombres, 1);
                        $res = array('msg' => 'PUESTO ACTUALIZADO', 'type' => 'success');
                    } else {
                        $res = array('msg' => 'ERROR AL ACTUALIZAR', 'type' => 'error');
                    }       
                }
            }
        } else {
            $res = array('msg' => 'ERROR DESCONOCIDO', 'type' => 'error');
        }
        echo json_encode($res, JSON_UNESCAPED_UNICODE);
        die();
    }

    public function editarPuesto($id)
    {
        $data = $this->model->editarPuesto($id);
        echo json_encode($data, JSON_UNESCAPED_UNICODE);
        die();
    }

    public function eliminarPuesto($id)
    {
        $data = $this->model->eliminarPuesto($id);
        if ($data == 0) {
            $res = array('msg' => 'PUESTO ELIMINADO', 'type' => 'success');
        } else {
            $res = array('msg' => 'ERROR AL ELIMINAR', 'type' => 'error');
        } 

        echo json_encode($res, JSON_UNESCAPED_UNICODE);
        die();
    }
}