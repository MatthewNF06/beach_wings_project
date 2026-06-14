<?php
class Produto {
    private $conn;
    public function __construct($db) { $this->conn = $db; }

    public function lerTodos() {
        return $this->conn->query("SELECT * FROM produtos ORDER BY categoria, nome");
    }

    public function buscarPorId($id) {
        $stmt = $this->conn->prepare("SELECT * FROM produtos WHERE id = ? LIMIT 1");
        $stmt->execute([$id]);
        return $stmt->fetch(PDO::FETCH_ASSOC);
    }
}
?>