<?php
class Reserva {
    private $conn;
    private $table_name = "reservas";

    public $nome_cliente;
    public $email;
    public $data_reserva;
    public $numero_pessoas;

    public function __construct($db) { $this->conn = $db; }

    public function validar() {
        if (empty($this->nome_cliente) || empty($this->email) || empty($this->data_reserva)) return "Preencha todos os campos.";
        if (!filter_var($this->email, FILTER_VALIDATE_EMAIL)) return "E-mail inválido.";
        if ($this->numero_pessoas < 1) return "Mínimo de 1 pessoa.";
        return true;
    }

    public function criar() {
        $query = "INSERT INTO " . $this->table_name . " SET nome_cliente=:n, email=:e, data_reserva=:d, numero_pessoas=:p";
        $stmt = $this->conn->prepare($query);
        $stmt->execute([
            ':n' => htmlspecialchars(strip_tags($this->nome_cliente)),
            ':e' => htmlspecialchars(strip_tags($this->email)),
            ':d' => $this->data_reserva,
            ':p' => $this->numero_pessoas
        ]);
        return true;
    }

    public function lerTodas() {
        $stmt = $this->conn->query("SELECT * FROM " . $this->table_name . " ORDER BY data_reserva ASC");
        return $stmt;
    }
}
?>