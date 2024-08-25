<?php
class ItensEncomenda {
    private $conn;
    private $table_name = "itens_encomenda";

    public $id_item_encomenda;
    public $id_encomenda;
    public $id_produto;
    public $id_fornecedor; // Novo campo para ligar ao fornecedor
    public $quantidade;
    public $preco_unitario;

    // Construtor que aceita uma conexão com o banco de dados como parâmetro
    public function __construct($db) {
        $this->conn = $db;
    }

    // Método para criar um novo item de encomenda
    public function create() {
        $query = "INSERT INTO " . $this->table_name . "
                  SET id_encomenda = :id_encomenda, id_produto = :id_produto, id_fornecedor = :id_fornecedor,
                      quantidade = :quantidade, preco_unitario = :preco_unitario";

        $stmt = $this->conn->prepare($query);

        // Sanitiza os dados
        $this->id_encomenda = htmlspecialchars(strip_tags($this->id_encomenda));
        $this->id_produto = htmlspecialchars(strip_tags($this->id_produto));
        $this->id_fornecedor = htmlspecialchars(strip_tags($this->id_fornecedor)); // Sanitiza id_fornecedor
        $this->quantidade = htmlspecialchars(strip_tags($this->quantidade));
        $this->preco_unitario = htmlspecialchars(strip_tags($this->preco_unitario));

        // Associa os valores
        $stmt->bindParam(":id_encomenda", $this->id_encomenda);
        $stmt->bindParam(":id_produto", $this->id_produto);
        $stmt->bindParam(":id_fornecedor", $this->id_fornecedor); // Associa id_fornecedor
        $stmt->bindParam(":quantidade", $this->quantidade);
        $stmt->bindParam(":preco_unitario", $this->preco_unitario);

        // Executa a query
        if ($stmt->execute()) {
            return true;
        }
        return false;
    }

    // Método para ler os itens de uma encomenda
    public function readByEncomenda($id_encomenda) {
        $query = "SELECT ie.*, p.nome AS nome_produto, f.nome AS nome_fornecedor
                  FROM " . $this->table_name . " ie
                  LEFT JOIN produtos p ON ie.id_produto = p.id_produto
                  LEFT JOIN fornecedores f ON ie.id_fornecedor = f.id_fornecedor
                  WHERE id_encomenda = :id_encomenda";

        $stmt = $this->conn->prepare($query);
        $stmt->bindParam(":id_encomenda", $id_encomenda);
        $stmt->execute();

        return $stmt;
    }

    // Método para atualizar um item de encomenda
    public function update() {
        $query = "UPDATE " . $this->table_name . "
                  SET id_produto = :id_produto, id_fornecedor = :id_fornecedor, quantidade = :quantidade,
                      preco_unitario = :preco_unitario
                  WHERE id_item_encomenda = :id_item_encomenda";

        $stmt = $this->conn->prepare($query);

        // Sanitiza os dados
        $this->id_item_encomenda = htmlspecialchars(strip_tags($this->id_item_encomenda));
        $this->id_produto = htmlspecialchars(strip_tags($this->id_produto));
        $this->id_fornecedor = htmlspecialchars(strip_tags($this->id_fornecedor));
        $this->quantidade = htmlspecialchars(strip_tags($this->quantidade));
        $this->preco_unitario = htmlspecialchars(strip_tags($this->preco_unitario));

        // Associa os valores
        $stmt->bindParam(":id_item_encomenda", $this->id_item_encomenda);
        $stmt->bindParam(":id_produto", $this->id_produto);
        $stmt->bindParam(":id_fornecedor", $this->id_fornecedor);
        $stmt->bindParam(":quantidade", $this->quantidade);
        $stmt->bindParam(":preco_unitario", $this->preco_unitario);

        // Executa a query
        if ($stmt->execute()) {
            return true;
        }
        return false;
    }

    // Método para deletar um item de encomenda
    public function delete() {
        $query = "DELETE FROM " . $this->table_name . " WHERE id_item_encomenda = :id_item_encomenda";

        $stmt = $this->conn->prepare($query);

        // Sanitiza os dados
        $this->id_item_encomenda = htmlspecialchars(strip_tags($this->id_item_encomenda));

        // Associa os valores
        $stmt->bindParam(":id_item_encomenda", $this->id_item_encomenda);

        // Executa a query
        if ($stmt->execute()) {
            return true;
        }
        return false;
    }
}
?>
