<?php
class Produto {
    private $conn;
    private $table_name = "produtos";

    public function __construct($db) { 
        $this->conn = $db; 
    }

    // Lista todos os produtos cruzando com a tabela de quiosques (JOIN)
    public function lerTodos() {
        $query = "SELECT p.*, q.nome as nome_quiosque 
                  FROM " . $this->table_name . " p
                  LEFT JOIN quiosques q ON p.quiosque_id = q.id 
                  ORDER BY q.nome, p.categoria, p.nome";
        return $this->conn->query($query);
    }

    // (Opcional) Lista produtos de apenas um quiosque específico
    public function lerPorQuiosque($quiosque_id) {
        $stmt = $this->conn->prepare("SELECT * FROM " . $this->table_name . " WHERE quiosque_id = ? ORDER BY categoria, nome");
        $stmt->execute([$quiosque_id]);
        return $stmt;
    }

    public function buscarPorId($id) {
        $stmt = $this->conn->prepare("SELECT * FROM " . $this->table_name . " WHERE id = ? LIMIT 1");
        $stmt->execute([$id]);
        return $stmt->fetch(PDO::FETCH_ASSOC);
    }
}
?>