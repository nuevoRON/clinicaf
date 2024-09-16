<?php
//verifica si hay sesiones iniciadas
if (session_status() !== PHP_SESSION_ACTIVE) {
  session_start();
}

require 'vendor/autoload.php';
require 'models/ProveidosModel.php';

class Exportacion extends Controller
{
    public function exportarProveidos(){
      $fechaInicio = !empty($_GET['fechaInicio']) ? strClean($_GET['fechaInicio']) : null;
      $fechaFinal = !empty($_GET['fechaFinal']) ? strClean($_GET['fechaFinal']) : null;
      $reconocimiento = !empty($_GET['reconocimiento']) ? strClean($_GET['reconocimiento']) : null;
      $medico = !empty($_GET['medico']) ? strClean($_GET['medico']) : null;
      $sexo = !empty($_GET['sexo']) ? strClean($_GET['sexo']) : null;

      $data = $this->model->listarProveidos($fechaInicio,$fechaFinal,$reconocimiento,$medico,$sexo);
      echo json_encode($data, JSON_UNESCAPED_UNICODE);
      die();
      
    }  


    public function exportarVacaciones(){
      $fechaInicio = !empty($_GET['fecha_inicio']) ? strClean($_GET['fecha_inicio']) : null;
      $fechaFinal = !empty($_GET['fecha_final']) ? strClean($_GET['fecha_final']) : null;
      $medico = !empty($_GET['medico']) ? strClean($_GET['medico']) : null; 
      
      $data = $this->model->listarVacaciones($fechaInicio,$fechaFinal,$medico); 
      echo json_encode($data, JSON_UNESCAPED_UNICODE);
      die();
    }   

    public function exportarRevisionCasos(){
      $data = $this->model->getRevisiones();

    }

}

