<?php
class Inicio extends Controller{
    public function __construct() {
        parent ::__construct();
        session_start();
    }

    public function index()
    {
        $this->views->getView('inicio', 'home');
    }

    public function proveidos()
    {
        $this->views->getView('inicio', 'lista-proveido');
    }

       public function controlDictamenes()
    {
        $this->views->getView('inicio', 'control_dictamenes');
    }

    public function controlVacaciones()
    {
        $this->views->getView('inicio', 'control_vacaciones');
    }


    public function controlJuicios()
    {
        $this->views->getView('inicio', 'control-juicios');
    }


    public function evaluacionCasos()
    {
        $this->views->getView('inicio', 'evaluacion-casos');
    }

    public function clinicaForense()
    {
        $this->views->getView('inicio', 'evaluado');
    }


    public function listaEvaluacion()
    {
        $this->views->getView('inicio', 'lista-evaluacion');
    }


    public function sexos()
    {
        $this->views->getView('inicio', 'sexos');
    }

    public function personal()
    {
        $this->views->getView('inicio', 'personal');
    }

    public function agregarsedes()
    {
        $this->views->getView('inicio', 'agregar-sedes');
    }

    public function puestos()
    {
        $this->views->getView('inicio', 'agragar_puestos');
    }

    public function reconocmientos()
    {
        $this->views->getView('inicio', 'lista_reconocimiento');
    }

    public function modulos()
    {
        $this->views->getView('inicio', 'modulos');
    }


    public function permisos()
    {
        $this->views->getView('inicio', 'permisos');
    }

    public function error()
    {
        $this->views->getView('inicio', '404');
    }


    public function perfil()
    {
        $this->views->getView('inicio', 'perfil');
    }


    public function plantillas()
    {
        $this->views->getView('inicio', 'plantillas');
    }

}