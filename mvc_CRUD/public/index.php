<?php
require_once '../app/config/config.php';

// Create database connection
try {
    $db = new PDO('mysql:host=' . DB_HOST . ';dbname=' . DB, DB_USER, DB_PASS);
    $db->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
} catch(PDOException $e) {
    echo "Connection failed: " . $e->getMessage();
    exit;
}
?>

<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>CRUD MVC</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@4.6.2/dist/css/bootstrap.min.css" rel="stylesheet">
    <link href="css/custom.css" rel="stylesheet">
</head>
<body>
    <div class="container mt-4">
        <div class="row mb-4">
            <div class="col text-center">
                <a href="index.php?controller=product" class="btn btn-primary mx-2">Productos</a>
                <a href="index.php?controller=family" class="btn btn-success mx-2">Familias</a>
                <a href="index.php?controller=stock" class="btn btn-info mx-2">Stock</a>
                <a href="index.php?controller=store" class="btn btn-warning mx-2">Tiendas</a>
            </div>
        </div>
        <div class="row">
            <div class="col">
                <?php
                $controller = isset($_GET['controller']) ? $_GET['controller'] : DEFAULT_CONTROLLER;
                $action = isset($_GET['action']) ? $_GET['action'] : DEFAULT_ACTION;

                switch($controller) {
                    case 'store':
                        require_once '../app/controllers/StoreController_Rafael.php';
                        $controller = new StoreController($db);
                        break;
                    case 'stock':
                        require_once '../app/controllers/StockController_Abel.php';
                        $controller = new StockController($db);
                        break;
                    case 'family':
                        require_once '../app/controllers/FamilyController_Adrian.php';
                        $controller = new FamilyController($db);
                        break;
                    default:
                        require_once '../app/controllers/ProductController_AlvaroTrigueros.php';
                        $controller = new ProductController($db);
                        break;
                }

                switch($action) {
                    case 'create':
                        $controller->create();
                        break;
                    case 'update':
                        $controller->update();
                        break;
                    case 'delete':
                        $controller->delete();
                        break;
                    default:
                        $controller->index();
                        break;
                }
                ?>
            </div>
        </div>
    </div>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>