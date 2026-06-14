<?php
class Usuario {
    private $conn;
    public $nome, $email, $senha, $endereco;

    public function __construct($db) { $this->conn = $db; }

    public function cadastrar() {
        if(empty($this->nome) || empty($this->email) || empty($this->senha)) return "Preencha os campos obrigatórios.";
        
        $query = "INSERT INTO usuarios SET nome=:n, email=:e, senha=:s, endereco=:end";
        $stmt = $this->conn->prepare($query);
        try {
            $stmt->execute([
                ':n' => htmlspecialchars(strip_tags($this->nome)),
                ':e' => htmlspecialchars(strip_tags($this->email)),
                ':s' => password_hash($this->senha, PASSWORD_BCRYPT),
                ':end' => htmlspecialchars(strip_tags($this->endereco))
            ]);
            return true;
        } catch(PDOException $e) {
            return "Erro: E-mail já registado.";
        }
    }
}
?>