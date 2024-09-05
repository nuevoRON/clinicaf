<?php

class Bitacora extends Controller
{
    private $id_usuario;

    public function __construct()
    {
        parent::__construct();
        if (session_status() == PHP_SESSION_NONE) {
            session_start();
        }

        if (!empty($_SESSION['id_usuario'])) {
            $this->id_usuario = $_SESSION['id_usuario'];
        }
    }

    private function verificarSesion()
    {
        if (empty($this->id_usuario)) {
            echo json_encode([
                'titulo' => 'Acceso Denegado',
                'desc' => 'Debes iniciar sesión para realizar esta acción.',
                'type' => 'error'
            ], JSON_UNESCAPED_UNICODE);
            die();
        }
    }

    public function listar()
    {
        $this->verificarSesion();
        if ($_SERVER['REQUEST_METHOD'] === 'GET') {
            $data = $this->model->getBitacora();
            echo json_encode($data, JSON_UNESCAPED_UNICODE);
            exit();
        }
    }

    public function crearEvento() {
        $this->verificarSesion();

        $datosEnBruto = file_get_contents("php://input");
        $datosDecodificados = json_decode($datosEnBruto, true); 
        $this->model->crearEvento($datosDecodificados['idUser'], $datosDecodificados['idObjeto'], $datosDecodificados['accion'], 
        $datosDecodificados['descripcion'], $datosDecodificados['fecha']);
        echo json_encode($datosDecodificados, JSON_UNESCAPED_UNICODE);
        die();
    }
}
