<?php
require 'Bitacora.php';

use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\SMTP;
use PHPMailer\PHPMailer\Exception;

//Load Composer's autoloader
require 'vendor/autoload.php';
class Usuarios extends Controller
{

    public function getMedicos()
    {
        $data = $this->model->getMedicos();
        $res = array('medicos' => $data, 'type' => 'success');
        echo json_encode($res, JSON_UNESCAPED_UNICODE);
        die();
    }

}
