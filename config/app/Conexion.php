<?php
class Conexion {
    private $conect;
    public function __construct() {
       $pdo = "pgsql:host=" . HOST . ";dbname=" . DBNAME;
       try {
        $this->conect = new PDO($pdo, USER, PASS,[
            PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION,     
            PDO::ATTR_EMULATE_PREPARES => false,             
            PDO::ATTR_DEFAULT_FETCH_MODE => PDO::FETCH_ASSOC,
            PDO::ATTR_TIMEOUT => 5,                          
            PDO::ATTR_PERSISTENT => true   
        ]);
       } catch (PDOException $e) {
        echo 'Error en la conexión: ' . $e->getMessage();
       }
    }
    public function conectar()
    {
        return $this->conect;
    }


    public function cerrarConexion() {
        $this->conect = null;
    }
}
?>
