<?php
require_once 'models/Reserva.php';
$database = new Database();
$reservaModel = new Reserva($database->getConnection());
$mensagem = null;

if ($_SERVER["REQUEST_METHOD"] == "POST" && isset($_POST['form_reserva'])) {
    $reservaModel->nome_cliente = $_POST['nome_cliente'];
    $reservaModel->email = $_POST['email'];
    $reservaModel->data_reserva = $_POST['data_reserva'];
    $reservaModel->numero_pessoas = $_POST['numero_pessoas'];

    $validacao = $reservaModel->validar();
    if ($validacao === true) {
        $reservaModel->criar();
        $mensagem = ["tipo" => "success", "msg" => "Reserva confirmada!"];
    } else {
        $mensagem = ["tipo" => "danger", "msg" => $validacao];
    }
}
$reservas = $reservaModel->lerTodas();
?>