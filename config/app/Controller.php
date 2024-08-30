<?php
require './middleware/CorsMiddleware.php';

class Controller {
    protected $views, $model;
    public function __construct() {
        CorsMiddleware::handle();
        $this->views = new Views();
        $this->cargarModel();
    }
    public function cargarModel()
    {
        $model = get_class($this) . 'Model';
        $ruta = 'models/' . $model . '.php';
        if (file_exists($ruta)) {
            require_once $ruta;
            $this->model = new $model();
        }
    }
}

?>