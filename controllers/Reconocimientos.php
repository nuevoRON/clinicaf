<?php
//require 'Bitacora.php';

//Load Composer's autoloader
require 'vendor/autoload.php';
class Reconocimientos extends Controller
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

    public function getReconocimientos(){
        $data = $this->model->getReconocimientos();
        $res = array('reconocimientos'=>$data, 'type'=>'success');
        echo json_encode($res, JSON_UNESCAPED_UNICODE);
        die();
    }
   
}