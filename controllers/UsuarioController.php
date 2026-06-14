<?php
require_once 'models/Usuario.php';
$database = new Database();
$usuarioModel = new Usuario($database->getConnection());
$msg_perfil = null;

if ($_SERVER["REQUEST_METHOD"] == "POST" && isset($_POST['form_cadastro'])) {
    $usuarioModel->nome = $_POST['nome'];
    $usuarioModel->email = $_POST['email'];
    $usuarioModel->senha = $_POST['senha'];
    
    // Recolhe os campos separados e formata num único endereço
    $rua = $_POST['rua'];
    $numero = $_POST['numero'];
    $bairro = $_POST['bairro'];
    $cidade = $_POST['cidade'];
    $estado = $_POST['estado'];
    $cep = $_POST['cep'];
    
    $endereco_completo = "$rua, Nº $numero, Bairro $bairro - $cidade/$estado. CEP: $cep";
    $usuarioModel->endereco = $endereco_completo;

    $resultado = $usuarioModel->cadastrar();
    if ($resultado === true) {
        $msg_perfil = ["tipo" => "success", "msg" => "Conta criada com sucesso! O seu endereço foi guardado."];
    } else {
        $msg_perfil = ["tipo" => "danger", "msg" => $resultado];
    }
}
?>