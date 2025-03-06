<?php
require_once(__DIR__ . '/../models/FamilyModel_Adrian.php');

class FamilyController {
    private $model;

    public function __construct($db) {
        $this->model = new FamilyModel($db);
    }

    public function index() {
        $families = $this->model->getAllFamilies();
        require_once(__DIR__ . '/../views/families/index.php');
    }

    public function create() {
        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            try {
                $cod = $_POST['cod'] ?? '';
                $name = $_POST['name'] ?? '';

                if (empty($cod) || empty($name)) {
                    header('Location: index.php?controller=family&error=missing_fields');
                    exit;
                }

                if ($this->model->insertFamily($cod, $name)) {
                    header('Location: index.php?controller=family&success=created');
                    exit;
                } else {
                    header('Location: index.php?controller=family&error=insert_failed');
                    exit;
                }
            } catch (PDOException $e) {
                error_log($e->getMessage());
                header('Location: index.php?controller=family&error=database_error');
                exit;
            }
        }
        $this->index();
    }

    public function update() {
        if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['action']) && $_POST['action'] === 'edit') {
            try {
                $cod = $_POST['cod'] ?? '';
                $name = $_POST['name'] ?? '';

                if (empty($cod) || empty($name)) {
                    header('Location: index.php?controller=family&error=missing_fields');
                    exit;
                }

                if ($this->model->updateFamily($cod, $name)) {
                    header('Location: index.php?controller=family&success=updated');
                    exit;
                } else {
                    header('Location: index.php?controller=family&error=update_failed');
                    exit;
                }
            } catch (PDOException $e) {
                error_log($e->getMessage());
                header('Location: index.php?controller=family&error=database_error');
                exit;
            }
        }
        $this->index();
    }

    public function delete() {
        if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['action']) && $_POST['action'] === 'delete' && isset($_POST['cod'])) {
            try {
                $cod = $_POST['cod'];
                // Removed the empty code validation to allow deletion of families without code
                if ($this->model->deleteFamily($cod)) {
                    header('Location: index.php?controller=family&success=deleted');
                    exit;
                } else {
                    header('Location: index.php?controller=family&error=delete_failed');
                    exit;
                }
            } catch (PDOException $e) {
                error_log($e->getMessage());
                header('Location: index.php?controller=family&error=database_error');
                exit;
            }
        }
        $this->index();
    }
}
?>
