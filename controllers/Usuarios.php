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
        echo json_encode($data, JSON_UNESCAPED_UNICODE);
        die();
    }

}
