<?php
class Quiosque {
    private $conn;
    private $table_name = "quiosques";

    public function __construct($db) { 
        $this->conn = $db; 
    }

    // Retorna apenas os quiosques que estão abertos no momento
    public function lerTodosAbertos() {
        $query = "SELECT * FROM " . $this->table_name . " WHERE status_aberto = 1 ORDER BY nome";
        return $this->conn->query($query);
    }

    // Busca os detalhes de um quiosque específico
    public function buscarPorId($id) {
        $stmt = $this->conn->prepare("SELECT * FROM " . $this->table_name . " WHERE id = ? LIMIT 1");
        $stmt->execute([$id]);
        return $stmt->fetch(PDO::FETCH_ASSOC);
    }
}
?>