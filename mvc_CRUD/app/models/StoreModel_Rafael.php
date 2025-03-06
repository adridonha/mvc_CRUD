<?php
class StoreModel {
    private $db;

    // Constructor para la conexión a la base de datos
    public function __construct() {
        $this->db = new PDO("mysql:host=localhost;dbname=dwes", "dwes", "dwes");
    }

    // Insertar un nuevo registro en la tabla store
    public function insertStore($cod, $name, $tlf) {
        try {
            $sql = "INSERT INTO store (cod, name, tlf) VALUES (?, ?, ?)";
            $stmt = $this->db->prepare($sql);
            return $stmt->execute([$cod, $name, $tlf]);
        } catch (PDOException $e) {
            error_log($e->getMessage());
            return false;
        }
    }

    // Actualizar un registro existente
    public function updateStore($cod, $name, $tlf) {
        try {
            $sql = "UPDATE store SET name = ?, tlf = ? WHERE cod = ?";
            $stmt = $this->db->prepare($sql);
            return $stmt->execute([$name, $tlf, $cod]);
        } catch (PDOException $e) {
            error_log($e->getMessage());
            return false;
        }
    }

    // Eliminar un registro
    public function deleteStore($cod) {
        try {
            $sql = "DELETE FROM store WHERE cod = ?";
            $stmt = $this->db->prepare($sql);
            return $stmt->execute([$cod]);
        } catch (PDOException $e) {
            error_log($e->getMessage());
            return false;
        }
    }

    // Obtener todos los registros de la tabla store
    public function getAllStores() {
        $sql = "SELECT cod, name, tlf FROM store";
        $stmt = $this->db->query($sql);
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }
}
?>
