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
}
catch(PDOException $e){
    echo "la conexion a la base de datos fallo:" . $e->getMessage();
}
$conexion = null;