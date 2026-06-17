<?php
class Pedido {
    private $conn;

    public $usuario_id;
    public $valor_total;
    public $itens; // Array com os produtos do carrinho

    public function __construct($db) { 
        $this->conn = $db; 
    }

    // Grava o pedido e os itens usando Transações ACID
    public function finalizarPedido() {
        try {
            $this->conn->beginTransaction();
            
            // 1. Grava o cabeçalho do Pedido
            $query = "INSERT INTO pedidos (usuario_id, valor_total) VALUES (?, ?)";
            $stmt = $this->conn->prepare($query);
            $stmt->execute([$this->usuario_id, $this->valor_total]);
            
            // Pega o ID que o MySQL acabou de gerar para este pedido
            $pedido_id = $this->conn->lastInsertId();

            // 2. Grava cada item do carrinho vinculado a este pedido
            $query_item = "INSERT INTO itens_pedido (pedido_id, produto_id, quantidade, preco_unitario) VALUES (?, ?, ?, ?)";
            $stmt_item = $this->conn->prepare($query_item);

            foreach ($this->itens as $item) {
                $stmt_item->execute([
                    $pedido_id, 
                    $item['produto_id'], 
                    $item['quantidade'], 
                    $item['preco']
                ]);
            }

            // 3. Confirma a transação (Tudo deu certo!)
            $this->conn->commit();
            return true;

        } catch (Exception $e) {
            // Se der qualquer erro no meio do caminho, desfaz tudo
            $this->conn->rollBack();
            return false;
        }
    }

    // Busca todos os pedidos antigos de um cliente
    public function lerPorUsuario($usuario_id) {
        $query = "SELECT * FROM pedidos WHERE usuario_id = ? ORDER BY criado_em DESC";
        $stmt = $this->conn->prepare($query);
        $stmt->execute([$usuario_id]);
        return $stmt;
    }
}
?>