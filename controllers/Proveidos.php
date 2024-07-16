<?php
require 'Bitacora.php';

//Load Composer's autoloader
require 'vendor/autoload.php';
class Proveidos extends Controller
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

    //metodo para registrar y modificar
    public function insertarProveido() {
        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            if (empty($_POST['numero_solicitud_reg'])) {
                $res = array('msg' => 'EL NUMERO DE SOLICIUD ES REQUERIDO', 'type' => 'warning');
            } else if (empty($_POST['fecha_emision'])) {
                $res = array('msg' => 'LA FECHA DE EMISION ES REQUERIDA', 'type' => 'warning');
            }else if (empty($_POST['fecha_recepcion'])) {
                $res = array('msg' => 'LA FECHA DE RECEPCION ES REQUERIDA', 'type' => 'warning');
            }else if (empty($_POST['item_dependencia_reg'])) {
                $res = array('msg' => 'LA FISCALIA ES REQUERIDA', 'type' => 'warning');
            }else {
                $numeroSolicitud = strClean($_POST['numero_solicitud_reg']);
                $fechaEmision = strClean($_POST['fecha_emision']);
                $fechaRecepcion = strClean($_POST['fecha_recepcion']);
                $fiscalia = strClean($_POST['item_dependencia_reg']);
                $numeroExterno = strClean($_POST['numero_externo_reg']);
    
                $data = $this->model->insertarProveido($numeroSolicitud, $fechaEmision, $fechaRecepcion, $fiscalia, $numeroExterno);
                if ($data > 0) {
                    //$bitacora = new Bitacora();
                    //$bitacora->model->crearEvento($_SESSION['id_usuario'], 12, 'CREACION', 'SE HA CREADO EL AREA ' . $nombres, 1);
                    $res = array('titulo' => 'Proveido Registrado', 'desc' => 'Los datos del proveido se guardaron exitosamente', 'type' => 'success');
                } else {
                    $res = array('titulo' => 'Error', 'desc' => 'Hubo un problema al registrar el proveido', 'type' => 'error');
                }
            }
            echo json_encode($res, JSON_UNESCAPED_UNICODE);
            die();
        }
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