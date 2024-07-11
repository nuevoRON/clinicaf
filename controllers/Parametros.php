<?php
require 'Bitacora.php';

// Load Composer's autoloader
require 'vendor/autoload.php';

class Parametros extends Controller
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

    public function listarParametros()
    {
        $data = $this->model->getParametros();
        for ($i = 0; $i < count($data); $i++) {
            // Modifica la estructura de acuerdo a tus necesidades
            $data[$i]['acciones'] = '<div>
                <button class="btn btn-danger" type="button" onclick="eliminarParametro(' . $data[$i]['ID_PARAMETRO'] . ')"><i class="fas fa-times-circle"></i></button>
                <button class="btn btn-info" type="button" onclick="editarParametro(' . $data[$i]['ID_PARAMETRO'] . ')"><i class="fa-regular fa-pen-to-square"></i></button>
                </div>';
        }
        echo json_encode($data, JSON_UNESCAPED_UNICODE);
        die();
    }

    public function getParametrosSelect(){
        $data = $this->model->getParametrosSelect();
        $res = array('parametros'=>$data, 'type'=>'success');
        echo json_encode($res, JSON_UNESCAPED_UNICODE);
        die();
    }

    public function registrarParametro()
    {
        if (isset($_POST)) {
            if (empty($_POST['nombre'])) {
                $res = array('msg' => 'EL NOMBRE ES REQUERIDO', 'type' => 'warning');
            } else if (empty($_POST['valor'])) {
                $res = array('msg' => 'EL VALOR ES REQUERIDO', 'type' => 'warning');
            }else{
                $nombre = strClean($_POST['nombre']);
                $valor = strClean($_POST['valor']); //

                $id = strClean($_POST['id']);
                if ($id == '') {
                    $data = $this->model->registrarParametro($nombre,$valor);//##(ORIGINAL)->   $data = $this->model->registrar($roles, $numeros);     <-(ORIGINAL)##//   
                        if ($data > 0) {
                            $bitacora = new Bitacora();
                            $bitacora->model->crearEvento($_SESSION['id_usuario'], 29, 'CREACION', 'SE HA CREADO EL PARAMETRO '.$nombre, 1);
                            $res = array('msg' => 'PARAMETRO REGISTRADO', 'type' => 'success');

                        } else {
                            $res = array('msg' => 'ERROR AL REGISTRAR', 'type' => 'error');
                        }
                } else {
                    //verificar si existen los datos (ACTUALIZAR)
                    $data = $this->model->actualizarParametro($nombre,$valor,$id);
                    if ($data > 0) {
                        $bitacora = new Bitacora();
                        $bitacora->model->crearEvento($_SESSION['id_usuario'], 29, 'ACTUALIZACIÓN', 'SE HA ACTUALIZADO EL PARAMETRO '.$nombre, 1);
                        $res = array('msg' => 'PARAMETRO ACTUALIZADO', 'type' => 'success');
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
    

    public function editarParametro($id)
    {
        $data = $this->model->editarParametro($id);
        echo json_encode($data, JSON_UNESCAPED_UNICODE);
        die();
    }

    public function eliminarParametro($id)
    {
        $data = $this->model->eliminarParametro($id);
        if ($data == 0) {
            $bitacora = new Bitacora();
            $bitacora->model->crearEvento($_SESSION['id_usuario'], 29, 'ELIMINACION', 'SE HA ELIMINADO EL PARÁMETRO '.$id, 1);
            $res = array('msg' => 'PARÁMETRO ELIMINADO', 'type' => 'success');
        } else {
            $res = array('msg' => 'ERROR AL ELIMINAR', 'type' => 'error');
        }
        echo json_encode($res, JSON_UNESCAPED_UNICODE);
        die(); 
    }
}

