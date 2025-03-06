<?php
require_once(__DIR__ . '/../models/StoreModel_Rafael.php');

class StoreController {
    private $model;
    private $db;

    public function __construct($db) {
        $this->model = new StoreModel($db);
        $this->db = $db;
    }

    public function index() {
        $stores = $this->model->getAllStores();
        require_once(__DIR__ . '/../views/stores/index.php');
    }

    public function create() {
        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            try {
                $cod = $_POST['cod'] ?? '';
                $name = $_POST['name'] ?? '';
                $tlf = $_POST['tlf'] ?? '';
                
                if (empty($cod) || empty($name)) {
                    header('Location: index.php?controller=store&error=missing_fields');
                    exit;
                }

                if ($this->model->insertStore($cod, $name, $tlf)) {
                    header('Location: index.php?controller=store&success=created');
                } else {
                    header('Location: index.php?controller=store&error=create_failed');
                }
                exit;
            } catch (PDOException $e) {
                error_log($e->getMessage());
                header('Location: index.php?controller=store&error=database_error');
                exit;
            }
        }
        $this->index();
    }

    public function update() {
        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            try {
                $cod = $_POST['cod'] ?? '';
                $name = $_POST['name'] ?? '';
                $tlf = $_POST['tlf'] ?? '';
                
                if (empty($cod) || empty($name)) {
                    header('Location: index.php?controller=store&error=missing_fields');
                    exit;
                }

                if ($this->model->updateStore($cod, $name, $tlf)) {
                    header('Location: index.php?controller=store&success=updated');
                } else {
                    header('Location: index.php?controller=store&error=update_failed');
                }
                exit;
            } catch (PDOException $e) {
                error_log($e->getMessage());
                header('Location: index.php?controller=store&error=database_error');
                exit;
            }
        }
        $this->index();
    }

    public function delete() {
        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            try {
                $cod = $_POST['cod'] ?? '';
                
                if (empty($cod)) {
                    header('Location: index.php?controller=store&error=missing_fields');
                    exit;
                }

                if ($this->model->deleteStore($cod)) {
                    header('Location: index.php?controller=store&success=deleted');
                    exit;
                } else {
                    header('Location: index.php?controller=store&error=delete_failed');
                    exit;
                }
            } catch (PDOException $e) {
                error_log($e->getMessage());
                header('Location: index.php?controller=store&error=database_error');
                exit;
            }
        }
        header('Location: index.php?controller=store');
        exit;
    }
}
?>
