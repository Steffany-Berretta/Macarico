<?php
class Produto {
    private $conn;
    private $table_name = "produtos";

    public $id_produto;
    public $nome;
    public $descricao;
    public $codigo_de_barras;
    public $preco_custo;
    public $preco_venda;
    public $quantidade_estoque;
    public $data_criacao;
    public $data_atualizacao;

    // Construtor que aceita uma conexão com o banco de dados como parâmetro
    public function __construct($db) {
        $this->conn = $db;
    }

    // Método para criar um novo produto
    public function create() {
        $query = "INSERT INTO " . $this->table_name . "
                  SET nome=:nome, descricao=:descricao, codigo_de_barras=:codigo_de_barras, 
                      preco_custo=:preco_custo, preco_venda=:preco_venda, quantidade_estoque=:quantidade_estoque";

        $stmt = $this->conn->prepare($query);

        // Sanitiza os dados
        $this->nome = htmlspecialchars(strip_tags($this->nome));
        $this->descricao = htmlspecialchars(strip_tags($this->descricao));
        $this->codigo_de_barras = htmlspecialchars(strip_tags($this->codigo_de_barras));
        $this->preco_custo = htmlspecialchars(strip_tags($this->preco_custo));
        $this->preco_venda = htmlspecialchars(strip_tags($this->preco_venda));
        $this->quantidade_estoque = htmlspecialchars(strip_tags($this->quantidade_estoque));

        // Associa os valores
        $stmt->bindParam(":nome", $this->nome);
        $stmt->bindParam(":descricao", $this->descricao);
        $stmt->bindParam(":codigo_de_barras", $this->codigo_de_barras);
        $stmt->bindParam(":preco_custo", $this->preco_custo);
        $stmt->bindParam(":preco_venda", $this->preco_venda);
        $stmt->bindParam(":quantidade_estoque", $this->quantidade_estoque);

        // Executa a query
        if($stmt->execute()) {
            return true;
        }
        return false;
    }

    // Método para ler todos os produtos
    public function read() {
        $query = "SELECT * FROM " . $this->table_name . " ORDER BY data_criacao DESC";

        $stmt = $this->conn->prepare($query);
        $stmt->execute();

        return $stmt;
    }

    // Método para atualizar um produto existente
    public function update() {
        $query = "UPDATE " . $this->table_name . "
                  SET nome = :nome, descricao = :descricao, codigo_de_barras = :codigo_de_barras, 
                      preco_custo = :preco_custo, preco_venda = :preco_venda, quantidade_estoque = :quantidade_estoque
                  WHERE id_produto = :id_produto";

        $stmt = $this->conn->prepare($query);

        // Sanitiza os dados
        $this->nome = htmlspecialchars(strip_tags($this->nome));
        $this->descricao = htmlspecialchars(strip_tags($this->descricao));
        $this->codigo_de_barras = htmlspecialchars(strip_tags($this->codigo_de_barras));
        $this->preco_custo = htmlspecialchars(strip_tags($this->preco_custo));
        $this->preco_venda = htmlspecialchars(strip_tags($this->preco_venda));
        $this->quantidade_estoque = htmlspecialchars(strip_tags($this->quantidade_estoque));
        $this->id_produto = htmlspecialchars(strip_tags($this->id_produto));

        // Associa os valores
        $stmt->bindParam(":nome", $this->nome);
        $stmt->bindParam(":descricao", $this->descricao);
        $stmt->bindParam(":codigo_de_barras", $this->codigo_de_barras);
        $stmt->bindParam(":preco_custo", $this->preco_custo);
        $stmt->bindParam(":preco_venda", $this->preco_venda);
        $stmt->bindParam(":quantidade_estoque", $this->quantidade_estoque);
        $stmt->bindParam(":id_produto", $this->id_produto);

        // Executa a query
        if($stmt->execute()) {
            return true;
        }
        return false;
    }

    // Método para excluir um produto
    public function delete() {
        $query = "DELETE FROM " . $this->table_name . " WHERE id_produto = :id_produto";

        $stmt = $this->conn->prepare($query);

        // Sanitiza os dados
        $this->id_produto = htmlspecialchars(strip_tags($this->id_produto));

        // Associa o valor
        $stmt->bindParam(":id_produto", $this->id_produto);

        // Executa a query
        if($stmt->execute()) {
            return true;
        }
        return false;
    }
}
?>
