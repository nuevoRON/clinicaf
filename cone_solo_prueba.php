<?php


try{
    $conexion = new PDO("mysql:host=localhost; dbname=clinica", 'root', '');
    echo 'conexion exitosa';
}
catch(PDOException $e){
    echo "la conexion a la base de datos fallo:" . $e;
}