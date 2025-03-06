<?php
require_once(__DIR__ . '/../../controllers/FamilyController_Adrian.php');

$controller = new FamilyController();
$families = $controller->getFamilies();

require_once(__DIR__ . '/../../views/families/index.php');
?>