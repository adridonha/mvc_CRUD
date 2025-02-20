<?php
require_once 'db.php';

class Product {
    private $db;
    private $cod;
    private $name;
    private $short_name;
    private $description;
    private $RRP;
    private $family;

    public function __construct() {
        $this->db = Db::getInstance();
    }

    public function insertProduct($cod, $name, $short_name, $description, $RRP, $family) {
        $sql = "INSERT INTO product (cod, name, short_name, description, RRP, family) VALUES (:cod, :name, :short_name, :description, :RRP, :family)";
        $stmt = $this->db->prepare($sql);
        return $stmt->execute(['cod' => $cod, 'name' => $name, 'short_name' => $short_name, 'description' => $description, 'RRP' => $RRP, 'family' => $family]);
    }

    public function updateProduct($cod, $name, $short_name, $description, $RRP, $family) {
        $sql = "UPDATE product SET name = :name, short_name = :short_name, description = :description, RRP = :RRP, family = :family WHERE cod = :cod";
        $stmt = $this->db->prepare($sql);
        return $stmt->execute(['cod' => $cod, 'name' => $name, 'short_name' => $short_name, 'description' => $description, 'RRP' => $RRP, 'family' => $family]);
    }

    public function deleteProduct($cod) {
        $sql = "DELETE FROM product WHERE cod = :cod";
        $stmt = $this->db->prepare($sql);
        return $stmt->execute(['cod' => $cod]);
    }

    public function getProducts() {
        $sql = "SELECT * FROM product";
        return $this->db->query($sql)->fetchAll(PDO::FETCH_ASSOC);
    }

    public function getProductByCod($cod) {
        $sql = "SELECT * FROM product WHERE cod = :cod";
        $stmt = $this->db->prepare($sql);
        $stmt->execute(['cod' => $cod]);
        return $stmt->fetch(PDO::FETCH_ASSOC);
    }

    public function displayProductTable() {
        $products = $this->getProducts();
        echo "<table border='1'>";
        echo "<tr><th>Cod</th><th>Name</th><th>Short Name</th><th>Description</th><th>RRP</th><th>Family</th></tr>";
        foreach ($products as $row) {
            echo "<tr>";
            echo "<td>{$row['cod']}</td>";
            echo "<td>{$row['name']}</td>";
            echo "<td>{$row['short_name']}</td>";
            echo "<td>{$row['description']}</td>";
            echo "<td>{$row['RRP']}</td>";
            echo "<td>{$row['family']}</td>";
            echo "</tr>";
        }
        echo "</table>";
    }
}

$product = new Product();
$product->displayProductTable();

