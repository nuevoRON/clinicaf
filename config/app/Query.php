<?php
class Query extends Conexion{
    private $pdo, $con;
    public function __construct() {
        $this->pdo = new Conexion();
        $this->con = $this->pdo->conectar();
    }

    public function select($sql, $params = [], $types = []){
        $stmt = $this->con->prepare($sql);

        if (!empty($params)) {
            foreach ($params as $key => $value) {
                $type = isset($types[$key]) ? $types[$key] : PDO::PARAM_STR;
                $stmt->bindValue($key + 1, $value, $type); 
            }
        }
        $stmt->execute();
        return $stmt->fetch(PDO::FETCH_ASSOC);
    }
    
    public function selectAll($sql, $params = [])
    {
        try {
            $stmt = $this->con->prepare($sql);

            if (!empty($params)) {
                foreach ($params as $index => $value) {
                    $stmt->bindValue($index + 1, $value);
                }
            }

            $stmt->execute();
            return $stmt->fetchAll(PDO::FETCH_ASSOC);
        } catch (PDOException $e) {
            echo "Error: " . $e->getMessage();
        }
    }


    public function insertar($sql, $array)
    {
        $result = $this->con->prepare($sql);
        $data = $result->execute($array);
        if ($data){
            $res = $this->con->lastInsertId();
        }else {
            $res = 0;
        }
        return $res;
    }
    public function save($sql, $array)
    {
        $result = $this->con->prepare($sql);
        $data = $result->execute($array);
        if ($data){
            $res = 1;
        }else {
            $res = 0;
        }
        return $res;
    }

     public function beginTransaction() {
        $this->con->beginTransaction();
    }

    public function commit() {
        $this->con->commit();
    }

    public function rollback() {
        $this->con->rollBack();
    }
    
    public function getSingleValue($sql, $params = []) {
        $result = $this->con->prepare($sql);
        $result->execute($params);
        return $result->fetchColumn();
    }

    public function cerrarConexion() {
        $this->pdo->cerrarConexion(); 
    }
}
?>