<?php
require 'Bitacora.php';

//Load Composer's autoloader
require 'vendor/autoload.php';
class Areas extends Controller
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

    public function plazasDisponibles()
    {
        $data['title'] = 'Plazas Disponibles';
        $data['script'] = 'plazas.js';
        $this->views->getView('usuarios', 'plazasDisponibles', $data);
    }

    public function pdfAreas()
    {
        $data['title'] = 'Plazas Disponibles';
        $data['script'] = 'plazas.js';
        $this->views->getView('pdf', 'pdfAreas', $data);
    }

    public function listarAreas()
    {
        $data = $this->model->getAreas();
        for ($i = 0; $i < count($data); $i++) {
            $data[$i]['acciones'] = '<div>
            <button class="btn btn-danger" type="button" onclick="eliminarArea(' . $data[$i]['ID_AREA'] . ')"><i class = "fas fa-times-circle"></i></button>
            <button class="btn btn-info" type="button" onclick="editarArea(' . $data[$i]['ID_AREA'] . ')"><i class="fa-regular fa-pen-to-square"></i></button>
            </div>';
        }
        echo json_encode($data, JSON_UNESCAPED_UNICODE);
        die();
    }

    public function getAreas(){
        $data = $this->model->getAreas();
        $res = array('areas'=>$data, 'type'=>'success');
        echo json_encode($res, JSON_UNESCAPED_UNICODE);
        die();
    }

    //metodo para registrar y modificar
    public function registrarArea(){
        if (isset($_POST)) {
            if (empty($_POST['nombres'])) {
                $res = array('msg' => 'EL NOMBRE ES REQUERIDO', 'type' => 'warning');
            } else if (empty($_POST['descripcion'])) {
                $res = array('msg' => 'EL NOMBRE ES REQUERIDO', 'type' => 'warning');
            }else{
                $nombres = strClean($_POST['nombres']);
                $descripcion = strClean($_POST['descripcion']); //

                $id = strClean($_POST['id']);
                if ($id == '') {
                    $data = $this->model->registrarArea($nombres,$descripcion);//##(ORIGINAL)->   $data = $this->model->registrar($roles, $numeros);     <-(ORIGINAL)##//   
                        if ($data > 0) {
                            $bitacora = new Bitacora();
                            $bitacora->model->crearEvento($_SESSION['id_usuario'], 12, 'CREACION', 'SE HA CREADO EL AREA '.$nombres, 1);
                            $res = array('msg' => 'AREA REGISTRADA', 'type' => 'success');

                        } else {
                            $res = array('msg' => 'ERROR AL REGISTRAR', 'type' => 'error');
                        }
                } else {
                    //verificar si existen los datos (ACTUALIZAR)
                    $data = $this->model->actualizarArea($nombres,$descripcion,$id);
                    if ($data > 0) {
                        $bitacora = new Bitacora();
                        $bitacora->model->crearEvento($_SESSION['id_usuario'], 12, 'ACTUALIZACIÓN', 'SE HA ACTUALIZADO EL AREA '.$nombres, 1);
                        $res = array('msg' => 'AREA ACTUALIZADA', 'type' => 'success');
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

    public function editarArea($id)
    {
        $data = $this->model->editarArea($id);
        echo json_encode($data, JSON_UNESCAPED_UNICODE);
        die();
    }

    public function eliminarArea($id)
    {
        $data = $this->model->eliminarArea($id);
        if ($data == 0) {
            $bitacora = new Bitacora();
            $bitacora->model->crearEvento($_SESSION['id_usuario'], 12, 'ELIMINACION', 'SE HA ACTUALIZADO EL AREA '.$id, 1);
            $res = array('msg' => 'AREA ELIMINADA', 'type' => 'success');
        } else {
            $res = array('msg' => 'ERROR AL ELIMINAR', 'type' => 'error');
        }
        echo json_encode($res, JSON_UNESCAPED_UNICODE);
        die();  
    }
}