
<?php
require_once 'db.php';
require_once 'header.php';
echo showHeader();
class Stock {
    
    private $db;
    private $product;
    private $store;
    private $units;


    public function __construct() {
        $this->db = Db::getInstance();
    }
    public function insertStock($product, $store, $units) {
        $sql = "INSERT INTO stock (product, store, units) VALUES (:product, :store, :units)";
        $stmt = $this->db->prepare($sql);
        return $stmt->execute(['product' => $product, 'store' => $store, 'units' => $units]);
    }

    public function updateStock($product, $store, $units) {
        $sql = "UPDATE stock SET units = :units WHERE product = :product AND store = :store";
        $stmt = $this->db->prepare($sql);
        return $stmt->execute(['product' => $product, 'store' => $store, 'units' => $units]);
    }

    public function deleteStock($product, $store) {
        $sql = "DELETE FROM stock WHERE product = :product AND store = :store";
        $stmt = $this->db->prepare($sql);
        return $stmt->execute(['product' => $product, 'store' => $store]);
    }

    public function getStock() {
        $sql = "SELECT * FROM stock";
        return $this->db->query($sql)->fetchAll(PDO::FETCH_ASSOC);
    }

    public function getProducts() {
        $sql = "SELECT cod, short_name FROM product";
        return $this->db->query($sql)->fetchAll(PDO::FETCH_KEY_PAIR);
    }

    public function getStores() {
        $sql = "SELECT cod, name FROM store";
        return $this->db->query($sql)->fetchAll(PDO::FETCH_KEY_PAIR);
    }
    public function displayStockTable() {
        $stock = $this->getStock();
        echo "<table border='1'>";
        echo "<tr><th>Product</th><th>Store</th><th>Units</th></tr>";
        foreach ($stock as $row) {
            echo "<tr>";
            echo "<td>{$row['product']}</td>";
            echo "<td>{$row['store']}</td>";
            echo "<td>{$row['units']}</td>";
            echo "</tr>";
        }
        echo "</table>";
    }
}
$stock = new Stock();
$stock->displayStockTable();
