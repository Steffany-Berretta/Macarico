<?php
class Categoria {
    private $conn;
    private $table_name = "categorias";

    public $id_categoria;
    public $nome;
    public $descricao;

    public function __construct($db) {
        $this->conn = $db;
    }

    public function create() {
        $query = "INSERT INTO " . $this->table_name . " SET nome=:nome, descricao=:descricao";
        $stmt = $this->conn->prepare($query);

        $this->nome = htmlspecialchars(strip_tags($this->nome));
        $this->descricao = htmlspecialchars(strip_tags($this->descricao));

        $stmt->bindParam(":nome", $this->nome);
        $stmt->bindParam(":descricao", $this->descricao);

        if($stmt->execute()) {
            return true;
        }
        return false;
    }

    public function read() {
        $query = "SELECT * FROM " . $this->table_name . " ORDER BY nome ASC";
        $stmt = $this->conn->prepare($query);
        $stmt->execute();
        return $stmt;
    }

    public function update() {
        $query = "UPDATE " . $this->table_name . " SET nome = :nome, descricao = :descricao WHERE id_categoria = :id_categoria";
        $stmt = $this->conn->prepare($query);

        $this->nome = htmlspecialchars(strip_tags($this->nome));
        $this->descricao = htmlspecialchars(strip_tags($this->descricao));
        $this->id_categoria = htmlspecialchars(strip_tags($this->id_categoria));

        $stmt->bindParam(":nome", $this->nome);
        $stmt->bindParam(":descricao", $this->descricao);
        $stmt->bindParam(":id_categoria", $this->id_categoria);

        if($stmt->execute()) {
            return true;
        }
        return false;
    }

    public function delete() {
        $query = "DELETE FROM " . $this->table_name . " WHERE id_categoria = :id_categoria";
        $stmt = $this->conn->prepare($query);

        $this->id_categoria = htmlspecialchars(strip_tags($this->id_categoria));
        $stmt->bindParam(":id_categoria", $this->id_categoria);

        if($stmt->execute()) {
            return true;
        }
        return false;
    }
}
?>
