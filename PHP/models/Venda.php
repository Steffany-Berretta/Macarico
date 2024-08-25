<?php
class Venda {
    private $conn;
    private $table_name = "vendas";

    public $id_venda;
    public $id_cliente;
    public $data_venda;
    public $valor_total;
    public $tipo_pagamento;

    public function __construct($db) {
        $this->conn = $db;
    }

    // Método para criar uma nova venda
    public function create() {
        $query = "INSERT INTO " . $this->table_name . "
                  SET
                    id_cliente = :id_cliente,
                    data_venda = :data_venda,
                    valor_total = :valor_total,
                    tipo_pagamento = :tipo_pagamento";

        $stmt = $this->conn->prepare($query);

        // Sanitizar
        $this->id_cliente = htmlspecialchars(strip_tags($this->id_cliente));
        $this->data_venda = htmlspecialchars(strip_tags($this->data_venda));
        $this->valor_total = htmlspecialchars(strip_tags($this->valor_total));
        $this->tipo_pagamento = htmlspecialchars(strip_tags($this->tipo_pagamento));

        // Vincular valores
        $stmt->bindParam(':id_cliente', $this->id_cliente);
        $stmt->bindParam(':data_venda', $this->data_venda);
        $stmt->bindParam(':valor_total', $this->valor_total);
        $stmt->bindParam(':tipo_pagamento', $this->tipo_pagamento);

        // Executar query
        if ($stmt->execute()) {
            return true;
        }

        return false;
    }

    // Método para ler todas as vendas
    public function read() {
        $query = "SELECT
                    id_venda, id_cliente, data_venda, valor_total, tipo_pagamento
                  FROM
                    " . $this->table_name . "
                  ORDER BY
                    data_venda DESC";

        $stmt = $this->conn->prepare($query);
        $stmt->execute();

        return $stmt;
    }

    // Método para atualizar uma venda existente
    public function update() {
        $query = "UPDATE " . $this->table_name . "
                  SET
                    id_cliente = :id_cliente,
                    data_venda = :data_venda,
                    valor_total = :valor_total,
                    tipo_pagamento = :tipo_pagamento
                  WHERE
                    id_venda = :id_venda";

        $stmt = $this->conn->prepare($query);

        // Sanitizar
        $this->id_cliente = htmlspecialchars(strip_tags($this->id_cliente));
        $this->data_venda = htmlspecialchars(strip_tags($this->data_venda));
        $this->valor_total = htmlspecialchars(strip_tags($this->valor_total));
        $this->tipo_pagamento = htmlspecialchars(strip_tags($this->tipo_pagamento));
        $this->id_venda = htmlspecialchars(strip_tags($this->id_venda));

        // Vincular valores
        $stmt->bindParam(':id_cliente', $this->id_cliente);
        $stmt->bindParam(':data_venda', $this->data_venda);
        $stmt->bindParam(':valor_total', $this->valor_total);
        $stmt->bindParam(':tipo_pagamento', $this->tipo_pagamento);
        $stmt->bindParam(':id_venda', $this->id_venda);

        // Executar query
        if ($stmt->execute()) {
            return true;
        }

        return false;
    }

    // Método para excluir uma venda
    public function delete() {
        $query = "DELETE FROM " . $this->table_name . " WHERE id_venda = :id_venda";

        $stmt = $this->conn->prepare($query);

        // Sanitizar
        $this->id_venda = htmlspecialchars(strip_tags($this->id_venda));

        // Vincular valor
        $stmt->bindParam(':id_venda', $this->id_venda);

        // Executar query
        if ($stmt->execute()) {
            return true;
        }

        return false;
    }
}
?>
