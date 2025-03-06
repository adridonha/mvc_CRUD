<?php
class FamilyModel {
    private $db;

    public function __construct($db) {
        $this->db = $db;
    }

    // Insertar un nuevo registro
    public function insertFamily($cod, $name) {
        $sql = "INSERT INTO family (cod, name) VALUES (?, ?)";
        $stmt = $this->db->prepare($sql);
       return  $stmt->execute([$cod, $name]);
    }

    // Actualizar un registro
    public function updateFamily($cod, $name) {
        $sql = "UPDATE family SET name = ? WHERE cod = ?";
        $stmt = $this->db->prepare($sql);
       return $stmt->execute([$name, $cod]);
        
    }

    // Eliminar un registro
    public function deleteFamily($cod) {
        $sql = "DELETE FROM family WHERE cod = ?";
        $stmt = $this->db->prepare($sql);
        $stmt->execute([$cod]);
        return $stmt->rowCount() > 0;
    }

    // Obtener todos los registros
    public function getAllFamilies() {
        $sql = "SELECT * FROM family";
        $stmt = $this->db->query($sql);
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }
}
?>
