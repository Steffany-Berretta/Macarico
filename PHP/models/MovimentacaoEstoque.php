<?php
class MovimentacaoEstoque {
    private $conn;
    private $table_name = "movimentacao_estoque";

    public $id_movimentacao;
    public $id_produto;
    public $quantidade;
    public $tipo_movimentacao;
    public $data_movimentacao;
    public $observacao;

    public function __construct($db) {
        $this->conn = $db;
    }

    // Método para criar uma nova movimentação de estoque
    public function create() {
        $query = "INSERT INTO " . $this->table_name . "
                  SET
                    id_produto = :id_produto,
                    quantidade = :quantidade,
                    tipo_movimentacao = :tipo_movimentacao,
                    data_movimentacao = :data_movimentacao,
                    observacao = :observacao";

        $stmt = $this->conn->prepare($query);

        // Sanitizar
        $this->id_produto = htmlspecialchars(strip_tags($this->id_produto));
        $this->quantidade = htmlspecialchars(strip_tags($this->quantidade));
        $this->tipo_movimentacao = htmlspecialchars(strip_tags($this->tipo_movimentacao));
        $this->data_movimentacao = htmlspecialchars(strip_tags($this->data_movimentacao));
        $this->observacao = htmlspecialchars(strip_tags($this->observacao));

        // Vincular valores
        $stmt->bindParam(':id_produto', $this->id_produto);
        $stmt->bindParam(':quantidade', $this->quantidade);
        $stmt->bindParam(':tipo_movimentacao', $this->tipo_movimentacao);
        $stmt->bindParam(':data_movimentacao', $this->data_movimentacao);
        $stmt->bindParam(':observacao', $this->observacao);

        // Executar query
        if ($stmt->execute()) {
            return true;
        }

        return false;
    }

    // Método para ler todas as movimentações de estoque
    public function read() {
        $query = "SELECT
                    id_movimentacao, id_produto, quantidade, tipo_movimentacao, data_movimentacao, observacao
                  FROM
                    " . $this->table_name . "
                  ORDER BY
                    data_movimentacao DESC";

        $stmt = $this->conn->prepare($query);
        $stmt->execute();

        return $stmt;
    }

    // Método para atualizar uma movimentação de estoque existente
    public function update() {
        $query = "UPDATE " . $this->table_name . "
                  SET
                    id_produto = :id_produto,
                    quantidade = :quantidade,
                    tipo_movimentacao = :tipo_movimentacao,
                    data_movimentacao = :data_movimentacao,
                    observacao = :observacao
                  WHERE
                    id_movimentacao = :id_movimentacao";

        $stmt = $this->conn->prepare($query);

        // Sanitizar
        $this->id_produto = htmlspecialchars(strip_tags($this->id_produto));
        $this->quantidade = htmlspecialchars(strip_tags($this->quantidade));
        $this->tipo_movimentacao = htmlspecialchars(strip_tags($this->tipo_movimentacao));
        $this->data_movimentacao = htmlspecialchars(strip_tags($this->data_movimentacao));
        $this->observacao = htmlspecialchars(strip_tags($this->observacao));
        $this->id_movimentacao = htmlspecialchars(strip_tags($this->id_movimentacao));

        // Vincular valores
        $stmt->bindParam(':id_produto', $this->id_produto);
        $stmt->bindParam(':quantidade', $this->quantidade);
        $stmt->bindParam(':tipo_movimentacao', $this->tipo_movimentacao);
        $stmt->bindParam(':data_movimentacao', $this->data_movimentacao);
        $stmt->bindParam(':observacao', $this->observacao);
        $stmt->bindParam(':id_movimentacao', $this->id_movimentacao);

        // Executar query
        if ($stmt->execute()) {
            return true;
        }

        return false;
    }

    // Método para excluir uma movimentação de estoque
    public function delete() {
        $query = "DELETE FROM " . $this->table_name . " WHERE id_movimentacao = :id_movimentacao";

        $stmt = $this->conn->prepare($query);

        // Sanitizar
        $this->id_movimentacao = htmlspecialchars(strip_tags($this->id_movimentacao));

        // Vincular valor
        $stmt->bindParam(':id_movimentacao', $this->id_movimentacao);

        // Executar query
        if ($stmt->execute()) {
            return true;
        }

        return false;
    }
}
?>
