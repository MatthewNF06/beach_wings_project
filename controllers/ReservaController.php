<?php
require_once 'models/Reserva.php';
require_once 'models/Quiosque.php'; 

$database = new Database();
$db = $database->getConnection();
$reservaModel = new Reserva($db);
$quiosqueModel = new Quiosque($db);

$mensagem = null;

if ($_SERVER["REQUEST_METHOD"] == "POST" && isset($_POST['form_reserva'])) {
    $reservaModel->quiosque_id = $_POST['quiosque_id']; // Recebe o quiosque escolhido
    $reservaModel->nome_cliente = $_POST['nome_cliente'];
    $reservaModel->email = $_POST['email'];
    $reservaModel->data_reserva = $_POST['data_reserva'];
    $reservaModel->numero_pessoas = $_POST['numero_pessoas'];

    $validacao = $reservaModel->validar();
    
    if ($validacao === true) {
        if ($reservaModel->criar()) {
            $mensagem = ["tipo" => "success", "msg" => "Mesa reservada com sucesso!"];
        } else {
            $mensagem = ["tipo" => "danger", "msg" => "Erro ao conectar com o banco de dados."];
        }
    } else {
        $mensagem = ["tipo" => "danger", "msg" => $validacao];
    }
}

// Busca dados para preencher a tela
$reservas = $reservaModel->lerTodas();
$lista_quiosques = $quiosqueModel->lerTodosAbertos();

require_once 'views/includes/header.php';
require_once 'views/reserva.php';
require_once 'views/includes/footer.php';
?>