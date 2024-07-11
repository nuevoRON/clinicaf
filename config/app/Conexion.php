<?php
class Conexion {
    private $conect;
    public function __construct() {
       $pdo = "pgsql:host=" . HOST . ";dbname=" . DBNAME;
       try {
        $this->conect = new PDO($pdo, USER, PASS);
        $this->conect->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
       } catch (PDOException $e) {
        echo 'Error en la conexión: ' . $e->getMessage();
       }
    }
    public function conectar()
    {
        return $this->conect;
    }
}
?>
