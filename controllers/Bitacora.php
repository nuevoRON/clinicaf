<?php

class Bitacora extends Controller
{
    public function __construct()
    {
        parent::__construct();
        if (session_status() == PHP_SESSION_NONE) {
            session_start();
        }
    }

    public function Bitacora()
    {
        $data['title'] = 'BITACORA';
        $data['script'] = 'bitacora.js';
        $this->views->getView('admin', 'bitacora', $data);    
    }
    public function listar()
    {
        $data = $this->model->getBitacora(0);
        echo json_encode($data, JSON_UNESCAPED_UNICODE);
        exit();
    }

    public function crearEvento() {
        $datosEnBruto = file_get_contents("php://input");
        $datosDecodificados = json_decode($datosEnBruto, true); 
        $this->model->crearEvento($datosDecodificados['idUser'], $datosDecodificados['idObjeto'], $datosDecodificados['accion'], $datosDecodificados['descripcion'], true);
        echo json_encode($datosDecodificados, JSON_UNESCAPED_UNICODE);
        die();
    }
}
