<?php
 $servidor = "127.0.0.1";
 $usuario = "postgres";
 $password = "ubuntu";
 $bd = "clinica";
 
 //podemos cambiar el mysql de la linea del PDO("mysql: por cualquier otro gestor de BD y ser igual
 
 try{
     $conexion = new PDO("pgsql:host=$servidor;dbname=$bd", $usuario, $password);
     $conexion-> setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
     echo "la coneccion a la base ha sido exitosa";
 }
 catch(PDOException $e){
     echo "la conexion a la base de datos fallo:" . $e->getMessage();
 }
 $conexion = null; 
 
 session_start();
 $Usuario=$_POST['usuario'];
 $Clave=$_POST['clave'];

 $query="SELECT FROM * tbl_usuario WHERE usuario='$Usuario', AND contrase='$Clave'";
 $consulta=pg_query($conexion,$query);
 $cantidad=pg_num_rows($consulta);
 if($cantidad>0){
        $_SESSION['nombre_usuario']=$Usuario;
            header("location: home.php");
 }else{
    echo "datos incorrectos";
 }
 