<?php
require_once(__DIR__ . '/../models/StockModel_abel.php');

class StockController {
    private $model;
    private $db;

    public function __construct($db) {
        $this->model = new StockModel($db);
        $this->db = $db;
    }

    public function index() {
        $stocks = $this->model->getAllStock();
        $products = $this->model->getAllProducts();
        $stores = $this->model->getAllStores();
        
        require_once(__DIR__ . '/../views/stocks/index.php');
    }

    public function create() {
        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            try {
                $product = $_POST['product'] ?? '';
                $store = $_POST['store'] ?? '';
                $units = $_POST['units'] ?? 0;

                if (empty($product) || empty($store)) {
                    header('Location: index.php?controller=stock&error=missing_fields');
                    exit;
                }

                if ($this->model->insertStock($product, $store, $units)) {
                    header('Location: index.php?controller=stock&success=created');
                } else {
                    header('Location: index.php?controller=stock&error=insert_failed');
                }
                exit;
            } catch (PDOException $e) {
                error_log($e->getMessage());
                header('Location: index.php?controller=stock&error=database_error');
                exit;
            }
        }
        $this->index();
    }

    public function update() {
        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            try {
                $product = $_POST['product'] ?? '';
                $store = $_POST['store'] ?? '';
                $units = $_POST['units'] ?? 0;

                if (empty($product) || empty($store)) {
                    header('Location: index.php?controller=stock&error=missing_fields');
                    exit;
                }

                if ($this->model->updateStock($product, $store, $units)) {
                    header('Location: index.php?controller=stock&success=updated');
                } else {
                    header('Location: index.php?controller=stock&error=update_failed');
                }
                exit;
            } catch (PDOException $e) {
                error_log($e->getMessage());
                header('Location: index.php?controller=stock&error=database_error');
                exit;
            }
        }
        $this->index();
    }

    public function delete() {
        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            try {
                $product = $_POST['product'] ?? '';
                $store = $_POST['store'] ?? '';

                if (empty($product) || empty($store)) {
                    header('Location: index.php?controller=stock&error=missing_fields');
                    exit;
                }

                if ($this->model->deleteStock($product, $store)) {
                    header('Location: index.php?controller=stock&success=deleted');
                } else {
                    header('Location: index.php?controller=stock&error=delete_failed');
                }
                exit;
            } catch (PDOException $e) {
                error_log($e->getMessage());
                header('Location: index.php?controller=stock&error=database_error');
                exit;
            }
        }
        $this->index();
    }
}
?>
