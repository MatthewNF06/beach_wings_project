<?php
require_once 'config/Database.php';
require_once 'models/Quiosque.php';

$database = new Database();
$db = $database->getConnection();

// Chama o Model para procurar todos os quiosques abertos
$quiosqueModel = new Quiosque($db);
$quiosques_destaque = $quiosqueModel->lerTodosAbertos();

require_once 'views/includes/header.php';
require_once 'views/home.php';
require_once 'views/includes/footer.php';
?>