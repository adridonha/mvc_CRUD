<?php
require_once(__DIR__ . '/../models/ProductModel_alvaro.php');

class ProductController {
    private $model;

    public function __construct($db) {
        $this->model = new ProductModel($db);
    }

    public function index() {
        $products = $this->getAllProducts();
        $families = $this->getAllFamilies();
        
        // Include the view file
        require_once(__DIR__ . '/../views/products/index.php');
    }

    public function create() {
        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            try {
                $cod = $_POST['cod'] ?? '';
                $short_name = $_POST['short_name'] ?? '';
                $description = $_POST['description'] ?? '';
                $RRP = $_POST['RRP'] ?? 0;
                $family = $_POST['family'] ?? '';

                if (empty($cod) || empty($short_name)) {
                    header('Location: index.php?controller=product&error=missing_fields');
                    exit;
                }

                if ($this->insertProduct($cod, $short_name, $description, $RRP, $family)) {
                    header('Location: index.php?controller=product&success=created');
                    exit;
                } else {
                    header('Location: index.php?controller=product&error=insert_failed');
                    exit;
                }
            } catch (PDOException $e) {
                error_log($e->getMessage());
                header('Location: index.php?controller=product&error=database_error');
                exit;
            }
        }
        $this->index();
    }

    public function update() {
        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            try {
                $cod = $_POST['cod'] ?? '';
                $short_name = $_POST['short_name'] ?? '';
                $description = $_POST['description'] ?? '';
                $RRP = $_POST['RRP'] ?? 0;
                $family = $_POST['family'] ?? '';

                if (empty($cod) || empty($short_name)) {
                    header('Location: index.php?controller=product&error=missing_fields');
                    exit;
                }

                if ($this->updateProduct($cod, $short_name, $description, $RRP, $family)) {
                    header('Location: index.php?controller=product&success=updated');
                    exit;
                } else {
                    header('Location: index.php?controller=product&error=update_failed');
                    exit;
                }
            } catch (PDOException $e) {
                error_log($e->getMessage());
                header('Location: index.php?controller=product&error=database_error');
                exit;
            }
        }
        $this->index();
    }

    public function delete() {
        if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['cod'])) {
            try {
                $cod = $_POST['cod'];
                if (empty($cod)) {
                    header('Location: index.php?controller=product&error=missing_fields');
                    exit;
                }

                if ($this->deleteProduct($cod)) {
                    header('Location: index.php?controller=product&success=deleted');
                    exit;
                } else {
                    header('Location: index.php?controller=product&error=delete_failed');
                    exit;
                }
            } catch (PDOException $e) {
                error_log($e->getMessage());
                header('Location: index.php?controller=product&error=database_error');
                exit;
            }
        }
        $this->index();
    }

    public function insertProduct($cod, $short_name, $description, $RRP, $family) {
        return $this->model->insertProduct($cod, $short_name, $description, $RRP, $family);
    }

    public function updateProduct($cod, $short_name, $description, $RRP, $family) {
        return $this->model->updateProduct($cod, $short_name, $description, $RRP, $family);
    }

    public function deleteProduct($cod) {
        return $this->model->deleteProduct($cod);
    }

    public function getAllProducts() {
        return $this->model->getAllProducts();
    }

    public function getAllFamilies() {
        return $this->model->getAllFamilies();
    }
}
?>

