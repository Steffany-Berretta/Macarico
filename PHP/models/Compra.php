<?php
class Compra {
    private $conn;
    private $table_name = "compras";

    public $id_compra;
    public $id_fornecedor;
    public $data_compra;
    public $valor_total;

    public function __construct($db) {
        $this->conn = $db;
    }

    // Método para criar uma nova compra
    public function create() {
        $query = "INSERT INTO " . $this->table_name . "
                  SET
                    id_fornecedor = :id_fornecedor,
                    data_compra = :data_compra,
                    valor_total = :valor_total";

        $stmt = $this->conn->prepare($query);

        // Sanitizar
        $this->id_fornecedor = htmlspecialchars(strip_tags($this->id_fornecedor));
        $this->data_compra = htmlspecialchars(strip_tags($this->data_compra));
        $this->valor_total = htmlspecialchars(strip_tags($this->valor_total));

        // Vincular valores
        $stmt->bindParam(':id_fornecedor', $this->id_fornecedor);
        $stmt->bindParam(':data_compra', $this->data_compra);
        $stmt->bindParam(':valor_total', $this->valor_total);

        // Executar query
        if ($stmt->execute()) {
            return true;
        }

        return false;
    }

    // Método para ler todas as compras
    public function read() {
        $query = "SELECT
                    id_compra, id_fornecedor, data_compra, valor_total
                  FROM
                    " . $this->table_name . "
                  ORDER BY
                    data_compra DESC";

        $stmt = $this->conn->prepare($query);
        $stmt->execute();

        return $stmt;
    }

    // Método para atualizar uma compra existente
    public function update() {
        $query = "UPDATE " . $this->table_name . "
                  SET
                    id_fornecedor = :id_fornecedor,
                    data_compra = :data_compra,
                    valor_total = :valor_total
                  WHERE
                    id_compra = :id_compra";

        $stmt = $this->conn->prepare($query);

        // Sanitizar
        $this->id_fornecedor = htmlspecialchars(strip_tags($this->id_fornecedor));
        $this->data_compra = htmlspecialchars(strip_tags($this->data_compra));
        $this->valor_total = htmlspecialchars(strip_tags($this->valor_total));
        $this->id_compra = htmlspecialchars(strip_tags($this->id_compra));

        // Vincular valores
        $stmt->bindParam(':id_fornecedor', $this->id_fornecedor);
        $stmt->bindParam(':data_compra', $this->data_compra);
        $stmt->bindParam(':valor_total', $this->valor_total);
        $stmt->bindParam(':id_compra', $this->id_compra);

        // Executar query
        if ($stmt->execute()) {
            return true;
        }

        return false;
    }

    // Método para excluir uma compra
    public function delete() {
        $query = "DELETE FROM " . $this->table_name . " WHERE id_compra = :id_compra";

        $stmt = $this->conn->prepare($query);

        // Sanitizar
        $this->id_compra = htmlspecialchars(strip_tags($this->id_compra));

        // Vincular valor
        $stmt->bindParam(':id_compra', $this->id_compra);

        // Executar query
        if ($stmt->execute()) {
            return true;
        }

        return false;
    }
}
?>
