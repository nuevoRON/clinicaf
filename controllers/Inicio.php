<?php
class Inicio extends Controller{
    public function __construct() {
        parent ::__construct();
        session_start();
    }

    public function index()
    {
        $data['title'] = 'Panel Administrativo'; 
        $data['script'] = 'home.js';
        $this->views->getView('inicio', 'home', $data);
    }

    public function proveidos()
    {
        $data['title'] = 'Panel Administrativo'; 
        $data['script'] = 'home.js';
        $this->views->getView('inicio', 'lista-proveido', $data);
    }

}