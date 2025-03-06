<?php
class StockModel {
    private $db;

    public function __construct($db) {
        $this->db = $db;
    }

    public function insertStock($product, $store, $units) {
        $sql = "INSERT INTO stock (product, store, units) VALUES (?, ?, ?)";
        $stmt = $this->db->prepare($sql);
        return $stmt->execute([$product, $store, $units]);
    }

    public function updateStock($product, $store, $units) {
        $sql = "UPDATE stock SET units = ? WHERE product = ? AND store = ?";
        $stmt = $this->db->prepare($sql);
        return $stmt->execute([$units, $product, $store]);
    }

    public function deleteStock($product, $store) {
        $sql = "DELETE FROM stock WHERE product = ? AND store = ?";
        $stmt = $this->db->prepare($sql);
        return $stmt->execute([$product, $store]);
    }

    public function getAllStock() {
        $sql = "SELECT s.product, s.store, s.units, p.short_name as product_name 
               FROM stock s 
               LEFT JOIN product p ON s.product = p.cod";
        return $this->db->query($sql)->fetchAll(PDO::FETCH_ASSOC);
    }

    public function getAllProducts() {
        $sql = "SELECT cod, short_name FROM product";
        return $this->db->query($sql)->fetchAll(PDO::FETCH_ASSOC);
    }

    public function getAllStores() {
        $sql = "SELECT cod, name FROM store";
        return $this->db->query($sql)->fetchAll(PDO::FETCH_ASSOC);
    }
}
?>
