<?php
require_once 'config/Database.php';
require_once 'models/Usuario.php';
require_once 'models/Pedido.php'; 

if (session_status() === PHP_SESSION_NONE) { session_start(); }

$database = new Database();
$db = $database->getConnection();

$usuarioModel = new Usuario($db);
$pedidoModel = new Pedido($db);

$msg_perfil = null;
$usuario_logado_id = $_SESSION['usuario_id'] ?? 1; // Simulação de ID 1 para testes

// Lógica de Cadastro/Atualização
if ($_SERVER["REQUEST_METHOD"] == "POST" && isset($_POST['form_cadastro'])) {
    $usuarioModel->nome = $_POST['nome'];
    $usuarioModel->email = $_POST['email'];
    $usuarioModel->senha = $_POST['senha'];
    
    // Junta os campos do endereço numa string para o banco
    $endereco = $_POST['rua'] . ", nº " . $_POST['numero'] . " - " . $_POST['bairro'] . ", " . $_POST['cidade'] . "/" . $_POST['estado'];
    $usuarioModel->endereco = $endereco;

    $resultado = $usuarioModel->cadastrar();
    if ($resultado === true) {
        $msg_perfil = ["tipo" => "success", "msg" => "Perfil atualizado com sucesso!"];
    } else {
        $msg_perfil = ["tipo" => "danger", "msg" => $resultado];
    }
}

// BUSCA O HISTÓRICO: Esta é a parte que faltava para a View funcionar!
$historico_pedidos = $pedidoModel->lerPorUsuario($usuario_logado_id);

require_once 'views/includes/header.php';
require_once 'views/perfil.php';
require_once 'views/includes/footer.php';