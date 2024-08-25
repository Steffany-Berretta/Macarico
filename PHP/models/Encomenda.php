<?php
class Encomenda {
    private $conn;
    private $table_name = "encomendas";

    public $id_encomenda;
    public $id_cliente;
    public $data_encomenda;
    public $status;
    public $valor_total;

    public function __construct($db) {
        $this->conn = $db;
    }

    // Método para criar uma nova encomenda
    public function create() {
        $query = "INSERT INTO " . $this->table_name . "
                  SET
                    id_cliente = :id_cliente,
                    data_encomenda = :data_encomenda,
                    status = :status,
                    valor_total = :valor_total";

        $stmt = $this->conn->prepare($query);

        // Sanitizar
        $this->id_cliente = htmlspecialchars(strip_tags($this->id_cliente));
        $this->data_encomenda = htmlspecialchars(strip_tags($this->data_encomenda));
        $this->status = htmlspecialchars(strip_tags($this->status));
        $this->valor_total = htmlspecialchars(strip_tags($this->valor_total));

        // Vincular valores
        $stmt->bindParam(':id_cliente', $this->id_cliente);
        $stmt->bindParam(':data_encomenda', $this->data_encomenda);
        $stmt->bindParam(':status', $this->status);
        $stmt->bindParam(':valor_total', $this->valor_total);

        // Executar query
        if ($stmt->execute()) {
            return true;
        }

        return false;
    }

    // Método para ler todas as encomendas
    public function read() {
        $query = "SELECT
                    id_encomenda, id_cliente, data_encomenda, status, valor_total
                  FROM
                    " . $this->table_name . "
                  ORDER BY
                    data_encomenda DESC";

        $stmt = $this->conn->prepare($query);
        $stmt->execute();

        return $stmt;
    }

    // Método para atualizar uma encomenda existente
    public function update() {
        $query = "UPDATE " . $this->table_name . "
                  SET
                    id_cliente = :id_cliente,
                    data_encomenda = :data_encomenda,
                    status = :status,
                    valor_total = :valor_total
                  WHERE
                    id_encomenda = :id_encomenda";

        $stmt = $this->conn->prepare($query);

        // Sanitizar
        $this->id_cliente = htmlspecialchars(strip_tags($this->id_cliente));
        $this->data_encomenda = htmlspecialchars(strip_tags($this->data_encomenda));
        $this->status = htmlspecialchars(strip_tags($this->status));
        $this->valor_total = htmlspecialchars(strip_tags($this->valor_total));
        $this->id_encomenda = htmlspecialchars(strip_tags($this->id_encomenda));

        // Vincular valores
        $stmt->bindParam(':id_cliente', $this->id_cliente);
        $stmt->bindParam(':data_encomenda', $this->data_encomenda);
        $stmt->bindParam(':status', $this->status);
        $stmt->bindParam(':valor_total', $this->valor_total);
        $stmt->bindParam(':id_encomenda', $this->id_encomenda);

        // Executar query
        if ($stmt->execute()) {
            return true;
        }

        return false;
    }

    // Método para excluir uma encomenda
    public function delete() {
        $query = "DELETE FROM " . $this->table_name . " WHERE id_encomenda = :id_encomenda";

        $stmt = $this->conn->prepare($query);

        // Sanitizar
        $this->id_encomenda = htmlspecialchars(strip_tags($this->id_encomenda));

        // Vincular valor
        $stmt->bindParam(':id_encomenda', $this->id_encomenda);

        // Executar query
        if ($stmt->execute()) {
            return true;
        }

        return false;
    }
}
?>
