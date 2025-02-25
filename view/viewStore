<?php
// views/store/index.php

require_once '../model/Store.php';
require_once '../controler/controlerDefault.php';
// Crear una instancia del controlador
$controller = new controlerDefault();

// Manejar acciones (insertar, actualizar, eliminar)
if (isset($_GET['action'])) {
    $action = $_GET['action'];
    switch ($action) {
        case 'insert':
            if ($_SERVER['REQUEST_METHOD'] === 'POST') {
                $cod = $_POST['cod'];
                $name = $_POST['name'];
                $tlf = $_POST['tlf'];
                $controller->insertIntoTableStore($cod, $name, $tlf);
            }
            break;
        case 'update':
            if ($_SERVER['REQUEST_METHOD'] === 'POST') {
                $cod = $_POST['cod'];
                $name = $_POST['name'];
                $tlf = $_POST['tlf'];
                $controller->updateTableStore($cod, $name, $tlf);
            }
            break;
        case 'delete':
            if ($_SERVER['REQUEST_METHOD'] === 'POST') {
                $cod = $_POST['cod'];
                $controller->deleteFromTableStorebyCode($cod);
            }
            break;
    }
    // Redirigir para evitar reenvío de formularios
    header('viewStore.php');
    exit();
}

// Obtener todas las tiendas para mostrar en la tabla
$stores = $controller->getStores();
?>

<!DOCTYPE html>
<html>
<head>
    <meta http-equiv="content-type" content="text/html; charset=UTF-8">
    <title>PDO CRUD for Store Table</title>
    <link href="../../assets/dwes.css" rel="stylesheet" type="text/css">
</head>
<body>
    <div id="header">
        <h1>PDO CRUD for Store Table</h1>
    </div>
    <div id="content">
        <!-- Formulario para insertar una nueva tienda -->
        <h2>Add New Store</h2>
        <form action="index.php?action=insert" method="post">
            <label for="cod">Code:</label>
            <input type="text" id="cod" name="cod" required />
            <label for="name">Name:</label>
            <input type="text" id="name" name="name" required />
            <label for="tlf">Phone:</label>
            <input type="text" id="tlf" name="tlf" required />
            <input type="submit" value="Insert" />
        </form>

        <!-- Tabla para mostrar las tiendas existentes -->
        <h2>Existing Stores</h2>
        <table>
            <thead>
                <tr>
                    <th>Code</th>
                    <th>Name</th>
                    <th>Phone</th>
                    <th>Actions</th>
                </tr>
            </thead>
            <tbody>
                <?php foreach ($stores as $store): ?>
                    <tr>
                        <form action="index.php?action=update" method="post">
                            <td>
                                <input type="text" name="cod" value="<?php echo $store['cod']; ?>" readonly />
                            </td>
                            <td>
                                <input type="text" name="name" value="<?php echo $store['name']; ?>" />
                            </td>
                            <td>
                                <input type="text" name="tlf" value="<?php echo $store['tlf']; ?>" />
                            </td>
                            <td>
                                <input type="submit" value="Update" />
                            </td>
                        </form>
                        <td>
                            <form action="index.php?action=delete" method="post">
                                <input type="hidden" name="cod" value="<?php echo $store['cod']; ?>" />
                                <input type="submit" value="Delete" />
                            </form>
                        </td>
                    </tr>
                <?php endforeach; ?>
            </tbody>
        </table>
    </div>
    <div id="footer">
        <?php unset($db); ?>
    </div>
</body>
</html>
