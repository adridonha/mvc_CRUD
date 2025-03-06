<?php
class ProductModel {
    private $db;

    public function __construct($db) {
        $this->db = $db;
    }

    public function insertProduct($cod, $short_name, $description, $RRP, $family) {
        $sql = "INSERT INTO product (cod, name, short_name, description, RRP, family) VALUES (?, NULL, ?, ?, ?, ?)";
        $stmt = $this->db->prepare($sql);
        return $stmt->execute([$cod, $short_name, $description, $RRP, $family]);
    }

    public function updateProduct($cod, $short_name, $description, $RRP, $family) {
        $sql = "UPDATE product SET short_name = ?, description = ?, RRP = ?, family = ? WHERE cod = ?";
        $stmt = $this->db->prepare($sql);
        return $stmt->execute([$short_name, $description, $RRP, $family, $cod]);
    }

    public function deleteProduct($cod) {
        $sql = "DELETE FROM stock WHERE product = ?";
        $stmt = $this->db->prepare($sql);
        $stmt->execute([$cod]);

        $sql = "DELETE FROM product WHERE cod = ?";
        $stmt = $this->db->prepare($sql);
        return $stmt->execute([$cod]);
    }

    public function getAllProducts() {
        $sql = "SELECT cod, name, short_name, description, RRP, family FROM product";
        return $this->db->query($sql)->fetchAll(PDO::FETCH_ASSOC);
    }

    public function getAllFamilies() {
        $sql = "SELECT cod, name FROM family";
        return $this->db->query($sql)->fetchAll(PDO::FETCH_ASSOC);
    }
}
?>
