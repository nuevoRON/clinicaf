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
        $data['script'] = 'proveidos.js';
        $this->views->getView('inicio', 'lista-proveido', $data);
    }

    public function sedes()
    {
        $data['title'] = 'Panel Administrativo'; 
        $data['script'] = 'proveidos.js';
        $this->views->getView('inicio', 'agregar-sedes', $data);
    }

    public function controlDictamenes()
    {
        $data['title'] = 'Panel Administrativo'; 
        $data['script'] = 'proveidos.js';
        $this->views->getView('inicio', 'control_dictamenes', $data);
    }

    public function controlVacaciones()
    {
        $data['title'] = 'Panel Administrativo'; 
        $data['script'] = 'proveidos.js';
        $this->views->getView('inicio', 'control_vacaciones', $data);
    }


    public function controlJuicios()
    {
        $data['title'] = 'Panel Administrativo'; 
        $data['script'] = 'proveidos.js';
        $this->views->getView('inicio', 'control-juicios', $data);
    }


    public function evaluacionCasos()
    {
        $data['title'] = 'Panel Administrativo'; 
        $data['script'] = 'proveidos.js';
        $this->views->getView('inicio', 'evaluacion-casos', $data);
    }

    public function clinicaForense()
    {
        $data['title'] = 'Panel Administrativo'; 
        $data['script'] = 'proveidos.js';
        $this->views->getView('inicio', 'evaluado', $data);
    }


    public function listaEvaluacion()
    {
        $data['title'] = 'Panel Administrativo'; 
        $data['script'] = 'proveidos.js';
        $this->views->getView('inicio', 'lista-evaluacion', $data);
    }


    public function sexos()
    {
        $data['title'] = 'Panel Administrativo'; 
        $data['script'] = 'proveidos.js';
        $this->views->getView('inicio', 'sexos', $data);
    }

    public function personal()
    {
        $data['title'] = 'Panel Administrativo'; 
        $data['script'] = 'proveidos.js';
        $this->views->getView('inicio', 'personal', $data);
    }

}