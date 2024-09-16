<?php
class Query extends Conexion{
    private $pdo, $con;

    public function __construct() {
        $this->pdo = new Conexion();
        $this->con = $this->pdo->conectar();
    }

    public function select($sql, $params = [], $types = []){
        try {
            $stmt = $this->con->prepare($sql);

            if (!empty($params)) {
                foreach ($params as $key => $value) {
                    $type = isset($types[$key]) ? $types[$key] : PDO::PARAM_STR;
                    $stmt->bindValue($key + 1, $value, $type); 
                }
            }

            $stmt->execute();
            return $stmt->fetch(PDO::FETCH_ASSOC);
        } catch (PDOException $e) {
            echo "Error: " . $e->getMessage();
            return false; 
        } finally {
            $this->cerrarConexion(); 
        }
    }

    public function selectAll($sql, $params = []) {
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
            return false; 
        } finally {
            $this->cerrarConexion(); 
        }
    }

    public function insertar($sql, $array) {
        try {
            $stmt = $this->con->prepare($sql);
            $stmt->execute($array);
            return $this->con->lastInsertId();
        } catch (PDOException $e) {
            echo "Error: " . $e->getMessage();
            return 0; 
        } finally {
            $this->cerrarConexion(); 
        }
    }

    public function save($sql, $array) {
        try {
            $stmt = $this->con->prepare($sql);
            return $stmt->execute($array) ? 1 : 0;
        } catch (PDOException $e) {
            echo "Error: " . $e->getMessage();
            return 0; 
        } finally {
            $this->cerrarConexion(); 
        }
    }

    public function beginTransaction() {
        try {
            $this->con->beginTransaction();
        } catch (PDOException $e) {
            echo "Error al iniciar la transacción: " . $e->getMessage();
        }
    }

    public function commit() {
        try {
            $this->con->commit();
        } catch (PDOException $e) {
            echo "Error al hacer commit: " . $e->getMessage();
            $this->rollback(); 
        } finally {
            $this->cerrarConexion(); 
        }
    }

    public function rollback() {
        try {
            $this->con->rollBack();
        } catch (PDOException $e) {
            echo "Error al hacer rollback: " . $e->getMessage();
        } finally {
            $this->cerrarConexion(); 
        }
    }

    public function getSingleValue($sql, $params = []) {
        try {
            $stmt = $this->con->prepare($sql);
            $stmt->execute($params);
            return $stmt->fetchColumn();
        } catch (PDOException $e) {
            echo "Error: " . $e->getMessage();
            return false; 
        } finally {
            $this->cerrarConexion(); 
        }
    }

    public function cerrarConexion() {
        $this->pdo->cerrarConexion();
    }
}
