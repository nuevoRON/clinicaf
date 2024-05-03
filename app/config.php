<?php

/* definicion  de variables para la coneccion a la base de datos */
$servidor = "localhost";
$usuario = "root";
$password = "";
$bd = "clinica";

//podemos cambiar el mysql de la linea del PDO("mysql: por cualquier otro gestor de BD y ser igual

try{
    $conexion = new PDO("mysql:host=$servidor;dbname=$bd", $usuario, $password);
    $conexion-> setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
    echo "la coneccion a la base ha sido exitosa";
}
catch(PDOException $e){
    echo "la conexion a la base de datos fallo:" . $e->getMessage();
}
$conexion = null; 


/*
try{
    $pdo = new PDO($servidor, username: $usuario, password: $password,array(PDO::MYSQL_ATTR_INIT_COMMAND=>"SET NAMES utf8"));
    echo "La Conexion a la Base de Datos a Sido Exitosa";
}catch(PDOException $e){
   print_r($e);
    
} */