<?php
require 'Bitacora.php';

//Load Composer's autoloader
require 'vendor/autoload.php';
class Plazas extends Controller
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
    
public function listarPlazas()
    {
        $data = $this->model->getPlazas();
        for ($i = 0; $i < count($data); $i++) {
            $data[$i]['acciones'] = '<div>
            <button class="btn btn-danger" type="button" onclick="eliminarPlaza(' . $data[$i]['ID_PLAZA'] . ')"><i class = "fas fa-times-circle"></i></button>
            <button class="btn btn-info" type="button" onclick="editarPlaza(' . $data[$i]['ID_PLAZA'] . ')"><i class="fa-regular fa-pen-to-square"></i></button>
            </div>';
        }
        echo json_encode($data, JSON_UNESCAPED_UNICODE);
        die();
    }


    public function getPlaza($id){
        $data = $this->model->getPlaza($id);
        echo json_encode($data, JSON_UNESCAPED_UNICODE);
        die();
    }


    public function contarPlazasDisponibles(){
        $data = $this->model->contarPlazas();
        echo json_encode($data, JSON_UNESCAPED_UNICODE);
        die();
    }

    public function registrarPlaza(){
        if (isset($_POST)) {
            if (empty($_POST['nombres'])) {
                $res = array('msg' => 'EL NOMBRE ES REQUERIDO', 'type' => 'warning');
            } else if (empty($_POST['area'])) {
                $res = array('msg' => 'EL AREA ES REQUERIDA', 'type' => 'warning');
            } else if (empty($_POST['descripcion'])) {
                $res = array('msg' => 'LA DESCRIPCION ES REQUERIDA', 'type' => 'warning');
            } else if (empty($_POST['requisitos'])) {
                $res = array('msg' => 'LOS REQUISITOS SON REQUERIDOS', 'type' => 'warning');
            }else if (empty($_POST['beneficios'])) {
                $res = array('msg' => 'LOS BENEFICIOS SON REQUERIDOS', 'type' => 'warning');
            }else if (empty($_POST['fecha_limite'])) {
                $res = array('msg' => 'LA FECHA LIMITE ES REQUERIDA', 'type' => 'warning');
            }else{
                $nombres = strClean($_POST['nombres']);
                $descripcion = strClean($_POST['descripcion']); 
                $area = strClean($_POST['area']); 
                $requisitos = strClean($_POST['requisitos']);
                $beneficios = strClean($_POST['beneficios']);  
                $fecha_limite = strClean($_POST['fecha_limite']);
                $estado = strClean($_POST['estado']);
                
                $id = strClean($_POST['id']);
                if ($id == '') {
                    $data = $this->model->registrarPlaza($nombres,$area,$descripcion,$requisitos,$beneficios,$fecha_limite,$estado);//##(ORIGINAL)->   $data = $this->model->registrar($roles, $numeros);     <-(ORIGINAL)##//   
                        if ($data > 0) {
                            $bitacora = new Bitacora();
                            $bitacora->model->crearEvento($_SESSION['id_usuario'], 18, 'CREACION', 'SE HA CREADO LA PLAZA '.$nombres, 1);
                            $res = array('msg' => 'PLAZA REGISTRADA', 'type' => 'success');

                        } else {
                            $res = array('msg' => 'ERROR AL REGISTRAR', 'type' => 'error');
                        }
                } else {
                    //verificar si existen los datos (ACTUALIZAR)
                    $data = $this->model->actualizarPlaza($nombres,$area,$descripcion,$requisitos,$beneficios,$fecha_limite,$estado,$id);
                    if ($data > 0) {
                        $bitacora = new Bitacora();
                        $bitacora->model->crearEvento($_SESSION['id_usuario'], 18, 'ACTUALIZACIÓN', 'SE HA ACTUALIZADO LA PLAZA '.$nombres, 1);
                        $res = array('msg' => 'PLAZA ACTUALIZADA', 'type' => 'success');
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

    public function editarPlaza($id)
    {
        $data = $this->model->editarPlaza($id);
        echo json_encode($data, JSON_UNESCAPED_UNICODE);
        die();
    }


    public function eliminar($id)
    {
        $data = $this->model->eliminar($id);
        if ($data > 0) {
            $bitacora = new Bitacora();
            $bitacora->model->crearEvento($_SESSION['id_usuario'], 18, 'ELIMINACION', 'SE HA ELIMINADO LA PLAZA '.$id, 1);
            $res = array('msg' => 'PLAZA ELIMINADA', 'type' => 'success');
        } else {
            $res = array('msg' => 'ERROR AL ELIMINAR', 'type' => 'error');
        }
        echo json_encode($res, JSON_UNESCAPED_UNICODE);
        die(); 
    }

    public function getPlazas() {
        $data = $this->model->getPlazasCandidato();
        $res = array('plazas'=>$data, 'type'=>'success');
        echo json_encode($res, JSON_UNESCAPED_UNICODE);
        die();
    }

}